<?php

namespace App\Controllers\Admin\Transactions;

use App\Controllers\BaseController;
use App\Models\OrderModel;

class Orders extends BaseController
{
    protected $orderModel;

    public function __construct()
    {
        $this->orderModel = new OrderModel();
    }

    // LIST ORDER
    public function index()
    {
        $orders = $this->orderModel
                       ->select('orders.*, users.username, events.title AS event_name, ticket_types.name AS ticket_type_name')
                       ->join('users', 'users.id = orders.user_id')
                       ->join('events', 'events.id = orders.event_id')
                       ->join('ticket_types', 'ticket_types.id = orders.ticket_type_id')
                       ->orderBy('orders.created_at', 'DESC')
                       ->paginate(10, 'default');

        $pager = $this->orderModel->pager;

        return view('admin/transactions/orders_index', [
            'orders' => $orders,
            'pager'  => $pager,
        ]);
    }
}
