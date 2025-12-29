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

 public function index()
{
    $keyword = $this->request->getVar('keyword');
    $perPage = 10;
    $currentPage = $this->request->getVar('page') ?? 1;

    $builder = $this->orderModel
                    ->select('orders.*, users.username, events.title AS event_name, ticket_types.name AS ticket_type_name')
                    ->join('users', 'users.id = orders.user_id')
                    ->join('events', 'events.id = orders.event_id')
                    ->join('ticket_types', 'ticket_types.id = orders.ticket_type_id')
                    ->whereIn('orders.status', ['pending', 'paid', 'cancelled', 'refunded']);

    if ($keyword) {
        $builder->groupStart()
                ->like('users.username', $keyword)
                ->orLike('events.title', $keyword)
                ->orLike('ticket_types.name', $keyword)
                ->orLike('orders.status', $keyword)
                ->orLike('orders.qty', $keyword)
                // Mencari berdasarkan harga (menghilangkan format titik/koma agar mudah dicari)
                ->orLike('orders.total_price', $keyword)
                // Mencari berdasarkan format tanggal (Contoh: "2025-12" atau "27")
                ->orLike('DATE_FORMAT(orders.created_at, "%d %M %Y %H:%i")', $keyword)
                ->groupEnd();
    }

    $data = [
        'orders'    => $builder->orderBy('orders.created_at', 'DESC')->paginate($perPage, 'default'),
        'pager'     => $this->orderModel->pager,
        'keyword'   => $keyword,
        'page'      => $currentPage,
        'perPage'   => $perPage,
        'title'     => 'Global Search Orders'
    ];

    return view('admin/transactions/orders_index', $data);
}
}