<?php

namespace App\Controllers\Admin\Transactions;

use App\Controllers\BaseController;
use App\Models\PaymentModel;
use App\Models\OrderModel;

class Payments extends BaseController
{
    protected $paymentModel;
    protected $orderModel;

    public function __construct()
    {
        $this->paymentModel = new PaymentModel();
        $this->orderModel   = new OrderModel();
    }

    // ======================================================
    // LIST PAYMENT
    // ======================================================
    public function index()
    {
        $keyword = $this->request->getGet('keyword');

        $builder = $this->paymentModel
            ->select('
                payments.*,
                orders.id AS order_id,
                orders.status AS order_status,
                users.username AS user_name,
                events.title AS event_name
            ')
            ->join('orders', 'orders.id = payments.order_id', 'left')
            ->join('users', 'users.id = orders.user_id', 'left')
            ->join('events', 'events.id = orders.event_id', 'left')
            ->orderBy('payments.id', 'DESC');

        if (!empty($keyword)) {
            $builder->groupStart()
                ->like('users.username', $keyword)
                ->orLike('events.title', $keyword)
                ->groupEnd();
        }

        $payments = $builder->paginate(10);

        return view('admin/transactions/payments_index', [
            'title'    => 'Payments',
            'payments' => $payments,
            'pager'    => $this->paymentModel->pager,
            'keyword'  => $keyword
        ]);
    }

    // ======================================================
    // AJAX DETAIL ORDER
    // ======================================================
    public function orderDetail($orderId)
    {
        $order = $this->orderModel
            ->select('
                orders.*,
                users.username AS user_name,
                events.title AS event_name
            ')
            ->join('users', 'users.id = orders.user_id')
            ->join('events', 'events.id = orders.event_id')
            ->where('orders.id', $orderId)
            ->first();

        if (!$order) {
            return $this->response->setJSON([
                'status'  => false,
                'message' => 'Order tidak ditemukan'
            ]);
        }

        return $this->response->setJSON([
            'status'      => true,
            'user_name'   => $order['user_name'],
            'event_name'  => $order['event_name'],
            'total_price' => $order['total_price']
        ]);
    }

    // ======================================================
    // FORM INPUT PAYMENT
    // ======================================================
    public function create()
    {
        $orders = $this->orderModel
            ->select('
                orders.*,
                users.username AS user_name,
                events.title AS event_name
            ')
            ->join('users', 'users.id = orders.user_id')
            ->join('events', 'events.id = orders.event_id')
            ->where('orders.status', 'pending')
            ->orderBy('orders.id', 'DESC')
            ->findAll();

        return view('admin/transactions/payments_form', [
            'title'      => 'Tambah Pembayaran',
            'orders'     => $orders,
            'formAction' => '/admin/transactions/payments/store'
        ]);
    }

    // ======================================================
    // SIMPAN PAYMENT BARU
    // ======================================================
    public function store()
    {
        $orderId = $this->request->getPost('order_id');
        $order   = $this->orderModel->find($orderId);

        if (!$order) {
            return redirect()->back()
                ->with('error', 'Order tidak ditemukan');
        }

        // 🚫 CEK SUDAH PERNAH BAYAR
        $exists = $this->paymentModel
            ->where('order_id', $orderId)
            ->first();

        if ($exists) {
            return redirect()->back()
                ->with('error', 'Order ini sudah dibayar');
        }

        // ======================
        // SIMPAN PAYMENT
        // ======================
        $paymentData = [
            'order_id'     => $orderId,
            'amount'       => $order['total_price'],
            'method'       => $this->request->getPost('payment_method'),
            'payment_date' => $this->request->getPost('payment_date'),
            'created_at'   => date('Y-m-d H:i:s')
        ];

        $this->paymentModel->insert($paymentData);

        // ======================
        // UPDATE STATUS ORDER
        // ======================
        $this->orderModel->update($orderId, [
            'status' => 'paid'
        ]);

        return redirect()->to('/admin/transactions/payments')
            ->with('success', 'Pembayaran berhasil ditambahkan');
    }
}
