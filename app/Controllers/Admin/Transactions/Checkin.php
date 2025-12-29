<?php

namespace App\Controllers\Admin\Transactions;

use App\Controllers\BaseController;
use App\Models\CheckinModel;
use App\Models\OrderModel;

class Checkin extends BaseController
{
    protected $checkinModel;
    protected $orderModel;
    protected $db;

    public function __construct()
    {
        $this->checkinModel = new CheckinModel();
        $this->orderModel   = new OrderModel();
        $this->db           = \Config\Database::connect();
    }

    public function index()
    {
        $data['title'] = "Check-in Management";

        // Ambil SEMUA data yang sudah PAYMENT APPROVED
        // Digabung dengan LEFT JOIN ke tabel checkins untuk tahu mana yang sudah/belum check-in
        $data['checkins'] = $this->db->table('payments p')
            ->select('
                p.order_id, 
                p.ticket_code, 
                u.nama AS user_name, 
                e.title AS event_name, 
                tt.name AS ticket_type_name,
                c.checked_in_at,
                c.status AS checkin_status
            ')
            ->join('orders o', 'o.id = p.order_id')
            ->join('users u', 'u.id = o.user_id')
            ->join('events e', 'e.id = o.event_id')
            ->join('ticket_types tt', 'tt.id = o.ticket_type_id')
            ->join('checkins c', 'c.order_id = p.order_id', 'left') // Left join supaya data yang belum check-in tetep muncul
            ->where('p.status', 'approved')
            ->orderBy('c.checked_in_at', 'ASC')
            ->get()->getResultArray();

        return view('admin/transactions/checkin_index', $data);
    }

    // FUNGSI UNTUK PROSES CHECK-IN MANUAL
    public function process($orderId)
    {
        // Cek dulu apakah sudah pernah check-in
        $existing = $this->checkinModel->where('order_id', $orderId)->first();

        if ($existing) {
            return redirect()->back()->with('error', 'Tiket ini sudah pernah check-in sebelumnya.');
        }

        // Simpan data ke tabel checkins
        $this->checkinModel->save([
            'order_id'      => $orderId,
            'checked_in_at' => date('Y-m-d H:i:s'),
            'status'        => 'checked_in',
        ]);

        return redirect()->to('/admin/transactions/checkin')->with('success', 'Check-in Berhasil! Silakan persilakan user masuk.');
    }
}