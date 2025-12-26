<?php

namespace App\Controllers\Admin\Transactions;

use App\Controllers\BaseController;
use App\Models\RefundModel;
use App\Models\OrderModel;

class Refunds extends BaseController
{
    protected $refundModel;
    protected $orderModel;

    public function __construct()
    {
        $this->refundModel = new RefundModel();
        $this->orderModel  = new OrderModel();
    }

    // ======================================================
    // LIST SEMUA REFUND
    // ======================================================
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

    // ======================================================
    // APPROVE REFUND (ADMIN SETUJU)
    // ======================================================
    public function approve($id)
    {
        $refund = $this->refundModel->find($id);

        if (!$refund || $refund['status'] !== 'pending') {
            return redirect()->back()
                ->with('error', 'Refund tidak bisa disetujui');
        }

        // Ambil order untuk qty & total_price
        $order = $this->orderModel->find($refund['order_id']);
        if (!$order) {
            return redirect()->back()->with('error', 'Order tidak ditemukan');
        }

        // update refund: set qty & refund_amount otomatis
        $this->refundModel->update($id, [
            'status'        => 'approved',
            'qty'           => $order['qty'],
            'refund_amount' => $order['total_price'],
            'approved_by'   => session()->get('admin_id'),
            'approved_at'   => date('Y-m-d H:i:s')
        ]);

        // update order status
        $this->orderModel->update($refund['order_id'], [
            'status' => 'refund_pending',
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        return redirect()->back()
            ->with('success', 'Refund disetujui, menunggu pengembalian dana');
    }

    // ======================================================
    // REJECT REFUND (ADMIN TOLAK)
    // ======================================================
    public function reject($id)
    {
        $refund = $this->refundModel->find($id);

        if (!$refund || $refund['status'] !== 'pending') {
            return redirect()->back()
                ->with('error', 'Refund tidak bisa ditolak');
        }

        // update refund
        $this->refundModel->update($id, [
            'status'     => 'rejected',
            'admin_note' => $this->request->getPost('admin_note') ?? 'Refund ditolak oleh admin'
        ]);

        // kembalikan order ke paid
        $this->orderModel->update($refund['order_id'], [
            'status' => 'paid',
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        return redirect()->back()
            ->with('success', 'Refund ditolak');
    }

    // ======================================================
    // REFUNDED (DANA SUDAH DITRANSFER MANUAL)
    // ======================================================
    public function refunded($id)
    {
        $refund = $this->refundModel->find($id);

        if (!$refund || $refund['status'] !== 'approved') {
            return redirect()->back()
                ->with('error', 'Refund belum disetujui atau sudah selesai');
        }

        // update refund: status refunded + timestamp
        $this->refundModel->update($id, [
            'status'      => 'refunded',
            'refunded_at' => date('Y-m-d H:i:s')
        ]);

        // update order status ke refunded
        $this->orderModel->update($refund['order_id'], [
            'status'     => 'refunded',
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        return redirect()->back()
            ->with('success', 'Refund selesai, dana sudah dikembalikan');
    }
}
