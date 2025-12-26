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
    public function index()
{
    $session = session();
    $user_id = $session->get('user_id');

    // DEBUG: Uncomment baris di bawah ini untuk cek ID user yang login
    // dd($user_id); 

    if (!$user_id) {
        return redirect()->to('/user/login');
    }

    $orders = $this->db->table('orders o')
        ->select('
            o.id,
            o.qty,
            o.total_price,
            o.created_at,
            o.status AS order_status,
            e.title AS event_name,
            p.ticket_code,
            p.status AS payment_status,
            r.status AS refund_status
        ')
        ->join('events e', 'e.id = o.event_id', 'left') // Gunakan left join untuk jaga-jaga
        ->join('payments p', 'p.order_id = o.id', 'left')
        ->join('refunds r', 'r.order_id = o.id', 'left')
        ->where('o.user_id', $user_id)
        ->where('o.status !=', 'cancelled') 
        ->orderBy('o.id', 'DESC')
        ->get()
        ->getResultArray();

    return view('user/transactions_index', [
        'orders' => $orders
    ]);
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

        if (!$user_id) {
            return $this->response->setJSON(['success' => false, 'message' => 'Silakan login.']);
        }

        $order_id = $this->request->getPost('order_id');
        $method   = $this->request->getPost('method');
        $file     = $this->request->getFile('payment_proof');

        if (!$order_id || !$method || !$file || !$file->isValid()) {
            return $this->response->setJSON(['success' => false, 'message' => 'Data tidak lengkap.']);
        }

        $order = $this->orderModel->find($order_id);
        
        if ($order['status'] === 'paid') {
             return $this->response->setJSON(['success' => false, 'message' => 'Order ini sudah dibayar.']);
        }

        $newName = $file->getRandomName();
        $file->move(WRITEPATH . 'uploads/payments', $newName);

        $ticket_code = 'TIX-' . strtoupper(bin2hex(random_bytes(4))) . '-' . $order_id;

        $this->db->transStart();
        
        $this->db->table('payments')->insert([
            'order_id'      => $order_id,
            'user_id'       => $user_id,
            'method'        => $method,
            'amount'        => $order['total_price'],
            'payment_proof' => $newName,
            'ticket_code'   => $ticket_code,
            'status'        => 'approved', 
            'payment_date'  => date('Y-m-d H:i:s'),
            'created_at'    => date('Y-m-d H:i:s')
        ]);

        $this->orderModel->update($order_id, [
            'status'       => 'paid',
            'updated_at'   => date('Y-m-d H:i:s')
        ]);
        
        $this->db->transComplete();

        return $this->response->setJSON(['success' => true, 'message' => 'Pembayaran berhasil!']);
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