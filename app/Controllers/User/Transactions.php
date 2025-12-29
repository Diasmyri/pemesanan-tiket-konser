<?php

namespace App\Controllers\User;

use App\Controllers\BaseController;
use App\Models\OrderModel;
use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Writer\PngWriter;

class Transactions extends BaseController
{
    protected $orderModel;
    protected $db;

    public function __construct()
    {
        $this->orderModel = new OrderModel();
        $this->db = \Config\Database::connect();
    }

    // ================= LIST TRANSAKSI USER =================
   // File: App\Controllers\User\Transactions.php

// File: App\Controllers\User\Transactions.php

public function index() {
    $session = session();
    $user_id = $session->get('user_id');

    if (!$user_id) return redirect()->to('/user/login');

    $orders = $this->db->table('orders o')
        ->select('
            o.id, o.qty, o.total_price, o.status AS order_status,
            e.title AS event_name,
            p.ticket_code, p.status AS payment_status,
            r.status AS refund_status,
            c.status AS checkin_status
        ')
        ->join('events e', 'e.id = o.event_id', 'left')
        ->join('payments p', 'p.order_id = o.id', 'left')
        ->join('refunds r', 'r.order_id = o.id', 'left')
        ->join('checkins c', 'c.order_id = o.id', 'left') // Pastikan tabel bernama 'checkins' sesuai input Anda
        ->where('o.user_id', $user_id)
        ->where('o.status !=', 'cancelled') 
        ->orderBy('o.id', 'DESC')
        ->get()
        ->getResultArray();

    return view('user/transactions_index', ['orders' => $orders]);
}

    // ================= QR CODE GENERATOR =================
    public function qr($ticketCode = null)
    {
        if (!$ticketCode) {
            return $this->response->setStatusCode(404);
        }

        $result = Builder::create()
            ->writer(new PngWriter())
            ->data($ticketCode)
            ->size(300)
            ->margin(10)
            ->build();

        return $this->response
            ->setHeader('Content-Type', 'image/png')
            ->setBody($result->getString());
    }

    // ================= CANCEL ORDER (SUDAH DISESUAIKAN DATABASE LU) =================
    public function cancelOrder($id)
    {
        $session = session();
        $user_id = $session->get('user_id');

        if (!$user_id) {
            return $this->response->setJSON(['success' => false, 'message' => 'Silakan login kembali.']);
        }

        // 1. Ambil data order
        // Note: Pastikan di tabel orders lu ada kolom ticket_type_id untuk balikkan stok ke tipe tiket yang bener
        $order = $this->db->table('orders')->where('id', $id)->where('user_id', $user_id)->get()->getRowArray();

        if (!$order) {
            return $this->response->setJSON(['success' => false, 'message' => 'Pesanan tidak ditemukan.']);
        }

        $this->db->transStart();

        try {
            // 2. KEMBALIKAN STOK KE TABEL ticket_types (Sesuai screenshot phpMyAdmin lu)
            // Karena di screenshot lu kolomnya namanya 'stock'
            $this->db->table('ticket_types')
                     ->where('event_id', $order['event_id']) 
                     ->set('stock', 'stock + ' . (int)$order['qty'], false)
                     ->update();

            // 3. Hapus data di tabel anak agar tidak error relasi
            $this->db->table('payments')->where('order_id', $id)->delete();
            $this->db->table('refunds')->where('order_id', $id)->delete();
            
            // 4. Hapus data utama
            $this->db->table('orders')->where('id', $id)->delete();

            $this->db->transComplete();

            if ($this->db->transStatus() === false) {
                return $this->response->setJSON(['success' => false, 'message' => 'Gagal update stok di ticket_types.']);
            }

            return $this->response->setJSON(['success' => true, 'message' => 'Pesanan dibatalkan & Stok berhasil balik!']);

        } catch (\Exception $e) {
            return $this->response->setJSON(['success' => false, 'message' => 'Error: ' . $e->getMessage()]);
        }
    }

    // ================= PROSES PEMBAYARAN =================
   public function storePayment()
{
    $session = session();
    $user_id = $session->get('user_id');

    // 1. Validasi Sesi Login
    if (!$user_id) {
        return $this->response->setJSON(['success' => false, 'message' => 'Silakan login kembali.']);
    }

    // 2. Ambil Input Data
    $order_id = $this->request->getPost('order_id');
    $method   = $this->request->getPost('method');
    $file     = $this->request->getFile('payment_proof');

    // 3. Validasi Keberadaan Data & File
    if (!$order_id || !$method || !$file || !$file->isValid()) {
        return $this->response->setJSON(['success' => false, 'message' => 'Data tidak lengkap atau file corrupt.']);
    }

    // 4. Tambahan: Validasi Format File (Hanya Gambar)
    if (!in_array($file->getMimeType(), ['image/jpeg', 'image/jpg', 'image/png'])) {
        return $this->response->setJSON(['success' => false, 'message' => 'Format file harus JPG atau PNG.']);
    }

    // 5. Cek Status Order
    $order = $this->orderModel->find($order_id);
    if (!$order) {
        return $this->response->setJSON(['success' => false, 'message' => 'Order tidak ditemukan.']);
    }
    
    if ($order['status'] === 'paid') {
         return $this->response->setJSON(['success' => false, 'message' => 'Order ini sudah lunas.']);
    }

    // 6. PROSES UPLOAD KE FOLDER PUBLIC
    // Kita pakai FCPATH agar file masuk ke folder /public/uploads/payments/
    $newName = $file->getRandomName();
    $uploadPath = FCPATH . 'uploads/payments';
    
    // Pastikan folder ada, jika tidak buat foldernya
    if (!is_dir($uploadPath)) {
        mkdir($uploadPath, 0777, true);
    }

    if (!$file->move($uploadPath, $newName)) {
        return $this->response->setJSON(['success' => false, 'message' => 'Gagal memindahkan file ke server.']);
    }

    // 7. Generate Ticket Code
    $ticket_code = 'TIX-' . strtoupper(bin2hex(random_bytes(4))) . '-' . $order_id;

    // 8. Database Transaction
    $this->db->transStart();
    
    // Insert ke tabel payments
    $this->db->table('payments')->insert([
        'order_id'      => $order_id,
        'user_id'       => $user_id,
        'method'        => $method,
        'amount'        => $order['total_price'],
        'payment_proof' => $newName, // Nama file unik yang baru saja diupload
        'ticket_code'   => $ticket_code,
        'status'        => 'approved', // Langsung approved atau ganti 'pending' jika butuh verifikasi admin
        'payment_date'  => date('Y-m-d H:i:s'),
        'created_at'    => date('Y-m-d H:i:s')
    ]);

    // Update status di tabel orders
    $this->orderModel->update($order_id, [
        'status'     => 'paid',
        'updated_at' => date('Y-m-d H:i:s')
    ]);
    
    $this->db->transComplete();

    // 9. Response Balikan
    if ($this->db->transStatus() === false) {
        return $this->response->setJSON(['success' => false, 'message' => 'Terjadi kesalahan pada database.']);
    }

    return $this->response->setJSON(['success' => true, 'message' => 'Pembayaran berhasil dikonfirmasi!']);
}
    public function storeRefund()
{
    $session = session();
    $user_id = $session->get('user_id');
    $order_id = $this->request->getPost('order_id');
    $reason   = $this->request->getPost('reason');

    if (!$user_id) {
        return $this->response->setJSON(['success' => false, 'message' => 'Sesi berakhir.']);
    }

    $this->db->transStart();

    // 1. CEK: Apakah sudah ada data refund untuk order_id ini?
    $existingRefund = $this->db->table('refunds')
                               ->where('order_id', $order_id)
                               ->get()
                               ->getRow();

    if ($existingRefund) {
        // 2. UPDATE: Jika data sudah ada (tapi ditolak/pending), timpa data lama
        // Ini mencegah duplikasi data di tampilan ledger (image_eceec9.jpg)
        $this->db->table('refunds')
                 ->where('order_id', $order_id)
                 ->update([
                     'reason'     => $reason,
                     'status'     => 'pending', // Reset status jadi pending lagi
                     'created_at' => date('Y-m-d H:i:s') // Opsional: update waktu pengajuan
                 ]);
    } else {
        // 3. INSERT: Jika benar-benar baru pertama kali mengajukan refund
        $this->db->table('refunds')->insert([
            'order_id'   => $order_id,
            'user_id'    => $user_id,
            'reason'     => $reason,
            'status'     => 'pending',
            'created_at' => date('Y-m-d H:i:s')
        ]);
    }

    // 4. Update status di tabel payments
    $this->db->table('payments')
             ->where('order_id', $order_id)
             ->update(['status' => 'refund_process']); 

    // 5. Update status di tabel orders
    $this->orderModel->update($order_id, [
        'status'     => 'refund_pending', 
        'updated_at' => date('Y-m-d H:i:s')
    ]);

    $this->db->transComplete();

    if ($this->db->transStatus() === FALSE) {
        return $this->response->setJSON(['success' => false, 'message' => 'Gagal memproses pengajuan.']);
    }

    return $this->response->setJSON([
        'success' => true, 
        'message' => 'Pengajuan refund berhasil diperbarui/dikirim.'
    ]);
}
}