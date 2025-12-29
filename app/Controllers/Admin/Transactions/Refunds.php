<?php

namespace App\Controllers\Admin\Transactions;

use App\Controllers\BaseController;
use App\Models\RefundModel;
use App\Models\OrderModel;

class Refunds extends BaseController
{
    protected $refundModel;
    protected $orderModel;
    protected $db; // Tambahan untuk transaction

    public function __construct()
    {
        $this->refundModel = new RefundModel();
        $this->orderModel  = new OrderModel();
        $this->db          = \Config\Database::connect();
    }

    public function index()
    {
        $perPage = 10;
        $page    = $this->request->getVar('page') ?? 1;

        $refunds = $this->refundModel
            ->select([
                'refunds.id',
                'refunds.order_id',
                'refunds.status',
                'refunds.reason',
                'refunds.qty',
                'refunds.refund_amount',
                'refunds.created_at',
                'orders.total_price',
                'orders.event_id', // Tambah ini untuk stok
                'orders.qty AS order_qty',
                'orders.status AS order_status',
                'users.username AS customer_name'
            ])
            ->join('orders', 'orders.id = refunds.order_id')
            ->join('users', 'users.id = refunds.user_id')
            ->orderBy('refunds.created_at', 'DESC')
            ->paginate($perPage, 'refunds');

        return view('admin/transactions/refunds_index', [
            'refunds' => $refunds,
            'pager'   => $this->refundModel->pager,
            'page'    => (int) $page,
            'perPage' => $perPage
        ]);
    }

    public function approve($id)
    {
        $refund = $this->refundModel->find($id);

        if (!$refund || $refund['status'] !== 'pending') {
            return redirect()->back()
                ->with('error', 'Refund tidak bisa disetujui');
        }

        $order = $this->orderModel->find($refund['order_id']);
        if (!$order) {
            return redirect()->back()->with('error', 'Order tidak ditemukan');
        }

        $this->db->transStart(); // MULAI TRANSAKSI

        $this->refundModel->update($id, [
            'status'        => 'approved',
            'qty'           => $order['qty'],
            'refund_amount' => $order['total_price'],
            'approved_at'   => date('Y-m-d H:i:s')
        ]);

        $this->orderModel->update($refund['order_id'], [
            'status' => 'refund_pending',
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        $this->db->transComplete(); // SELESAI TRANSAKSI

        return redirect()->back()
            ->with('success', 'Refund disetujui, menunggu pengembalian dana');
    }

    public function reject($id)
    {
        $refund = $this->refundModel->find($id);

        if (!$refund || $refund['status'] !== 'pending') {
            return redirect()->back()
                ->with('error', 'Refund tidak bisa ditolak');
        }

        $this->db->transStart();

        $this->refundModel->update($id, [
            'status'     => 'rejected',
            'admin_note' => $this->request->getPost('admin_note') ?? 'Refund ditolak oleh admin'
        ]);

        $this->orderModel->update($refund['order_id'], [
            'status' => 'paid',
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        $this->db->transComplete();

        return redirect()->back()
            ->with('success', 'Refund ditolak');
    }

    public function refunded($id)
    {
        $refund = $this->refundModel->find($id);

        if (!$refund || $refund['status'] !== 'approved') {
            return redirect()->back()
                ->with('error', 'Refund belum disetujui atau sudah selesai');
        }

        $order = $this->orderModel->find($refund['order_id']);

        $this->db->transStart(); // MULAI TRANSAKSI

        $this->refundModel->update($id, [
            'status'      => 'refunded',
            'refunded_at' => date('Y-m-d H:i:s')
        ]);

        $this->orderModel->update($refund['order_id'], [
            'status'     => 'refunded',
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        // LOGIC TAMBAHAN: Update status pembayaran di tabel payments (jika ada)
        $this->db->table('payments')->where('order_id', $refund['order_id'])->update(['status' => 'refunded']);

        // LOGIC TAMBAHAN: Kembalikan stok tiket otomatis
        $this->db->table('ticket_types')
                 ->where('event_id', $order['event_id'])
                 ->set('stock', 'stock + ' . (int)$order['qty'], false)
                 ->update();

        $this->db->transComplete(); // SELESAI TRANSAKSI

        if ($this->db->transStatus() === FALSE) {
            return redirect()->back()->with('error', 'Gagal memproses pengembalian dana');
        }

        return redirect()->back()
            ->with('success', 'Refund selesai, dana dikembalikan & stok tiket telah bertambah');
    }
}