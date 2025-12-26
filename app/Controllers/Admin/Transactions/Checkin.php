<?php

namespace App\Controllers\Admin\Transactions;

use App\Controllers\BaseController;
use App\Models\CheckinModel;
use App\Models\OrderModel;

class Checkin extends BaseController
{
    protected $checkinModel;
    protected $orderModel;

    public function __construct()
    {
        $this->checkinModel = new CheckinModel();
        $this->orderModel   = new OrderModel();
    }

    // ============================
    // LIST CHECK-IN
    // ============================
    public function index()
    {
        $data['title'] = "Check-in";

        $data['checkins'] = $this->checkinModel
            ->select('checkins.*, users.nama AS user_name, events.title AS event_name, ticket_types.name AS ticket_type_name')
            ->join('orders', 'orders.id = checkins.order_id')
            ->join('users', 'users.id = orders.user_id')
            ->join('events', 'events.id = orders.event_id')
            ->join('ticket_types', 'ticket_types.id = orders.ticket_type_id')
            ->orderBy('checkins.id', 'DESC')
            ->findAll();

        return view('admin/transactions/checkin_index', $data);
    }

    // ============================
    // FORM CHECK-IN
    // ============================
    public function create()
    {
        $data['title'] = "Create Check-in";

        $data['orders'] = $this->orderModel
            ->select('orders.id, users.nama AS user_name, events.title AS event_name, ticket_types.name AS ticket_type_name')
            ->join('users', 'users.id = orders.user_id')
            ->join('events', 'events.id = orders.event_id')
            ->join('ticket_types', 'ticket_types.id = orders.ticket_type_id')
            ->whereNotIn('orders.id', function ($builder) {
                return $builder->select('order_id')->from('checkins');
            })
            ->findAll();

        return view('admin/transactions/checkin_form', $data);
    }

    // ============================
    // SIMPAN CHECK-IN
    // ============================
    public function store()
    {
        $orderId = $this->request->getPost('order_id');

        if (!$orderId) {
            return redirect()->back()->with('error', 'Order belum dipilih.');
        }

        $this->checkinModel->save([
            'order_id'      => $orderId,
            'checked_in_at' => date('Y-m-d H:i:s'),
            'status'        => 'checked_in',
        ]);

        return redirect()->to('/admin/transactions/checkin')->with('success', 'Check-in berhasil.');
    }

    // ============================
    // DETAIL CHECK-IN
    // ============================
    public function show($id)
    {
        $data['title'] = "Detail Check-in";

        $data['checkin'] = $this->checkinModel
            ->select('checkins.*, users.nama AS user_name, events.title AS event_name, ticket_types.name AS ticket_type_name')
            ->join('orders', 'orders.id = checkins.order_id')
            ->join('users', 'users.id = orders.user_id')
            ->join('events', 'events.id = orders.event_id')
            ->join('ticket_types', 'ticket_types.id = orders.ticket_type_id')
            ->where('checkins.id', $id)
            ->first();

        return view('admin/transactions/checkin_detail', $data);
    }
}
