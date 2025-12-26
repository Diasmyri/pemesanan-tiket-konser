<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\EventModel;
use App\Models\OrderModel;
use App\Models\PaymentModel;
use App\Models\UserModel;
use App\Models\TicketTypeModel;

class Dashboard extends BaseController
{
    protected $eventModel;
    protected $orderModel;
    protected $paymentModel;
    protected $userModel;
    protected $ticketTypeModel;

    public function __construct()
    {
        $this->eventModel      = new EventModel();
        $this->orderModel      = new OrderModel();
        $this->paymentModel    = new PaymentModel();
        $this->userModel       = new UserModel();
        $this->ticketTypeModel = new TicketTypeModel();
    }

    public function index()
    {
        // ==========================
        // 1. CARD STATISTIK UTAMA
        // ==========================

        // Events (countAll() lebih aman daripada countAllResults() di chaining)
        $totalEvents = $this->eventModel->countAll();

        // Users
        $totalUsers = $this->userModel->countAll();

        // Tickets sold → pake kolom `qty` dari orders berstatus paid
        $ticketsRow = $this->orderModel
            ->where('status', 'paid')
            ->selectSum('qty', 'total_qty')
            ->first();

        $totalTicketsSold = isset($ticketsRow['total_qty']) ? (int)$ticketsRow['total_qty'] : 0;

        // Revenue → dari payments.amount
        $revRow = $this->paymentModel->selectSum('amount', 'total_amount')->first();
        $totalRevenue = isset($revRow['total_amount']) ? (float)$revRow['total_amount'] : 0;


        // ==========================
        // 2. GRAFIK PENJUALAN 7 HARI
        // ==========================

        // Ambil 7 hari terakhir (termasuk hari ini). Format day: YYYY-MM-DD
        $sales7days = $this->orderModel
            ->select("DATE(created_at) as day, SUM(qty) as total")
            ->where('created_at >=', date('Y-m-d', strtotime('-6 days'))) // -6 agar termasuk hari ini = 7 hari total
            ->where('status', 'paid')
            ->groupBy('DATE(created_at)')
            ->orderBy('day', 'ASC')
            ->findAll();

        // Jika butuh konsisten array of {day, total} sudah OK, bila butuh fill 0 untuk hari tanpa penjualan, bisa ditambah nanti.


        // ==========================
        // 3. GRAFIK STATUS PEMBAYARAN
        // ==========================
        // Ambil dari orders (bukan payments) dan normalisasi status agar Pending/Pending / pending jadi satu
        $db = \Config\Database::connect();
        $builder = $db->table('orders');
        $paymentStatus = $builder
            ->select("LOWER(TRIM(status)) AS status, COUNT(*) AS total", false)
            ->groupBy("LOWER(TRIM(status))", false)
            ->get()
            ->getResultArray();

        // Jika ingin urutkan atau pastikan ada key paid/pending meskipun 0:
        $statusMap = [];
        foreach ($paymentStatus as $row) {
            $statusMap[$row['status']] = (int)$row['total'];
        }
        // Pastikan minimal ada paid & pending keys (opsional)
        if (!isset($statusMap['paid']))    $statusMap['paid'] = 0;
        if (!isset($statusMap['pending'])) $statusMap['pending'] = 0;

        // Convert kembali ke array format yang view expects (array of ['status'=>..., 'total'=>...])
        $paymentStatusFormatted = [];
        foreach ($statusMap as $st => $tot) {
            $paymentStatusFormatted[] = [
                'status' => $st,
                'total'  => $tot
            ];
        }


        // ==========================
        // 4. ORDER TERBARU
        // ==========================

        $recentOrders = $this->orderModel
            ->select('orders.*, users.nama AS user_name, events.title AS event_name')
            ->join('users', 'users.id = orders.user_id', 'left')
            ->join('events', 'events.id = orders.event_id', 'left')
            ->orderBy('orders.created_at', 'DESC')
            ->limit(10)
            ->findAll();


        // ==========================
        // 5. EVENT TERDEKAT
        // ==========================

        $upcomingEvents = $this->eventModel
            ->where('date >=', date('Y-m-d'))
            ->orderBy('date', 'ASC')
            ->limit(5)
            ->findAll();


        // ==========================
        // SEND DATA KE VIEW
        // ==========================

        $data = [
            'totalEvents'      => $totalEvents,
            'totalUsers'       => $totalUsers,
            'totalTicketsSold' => $totalTicketsSold,
            'totalRevenue'     => $totalRevenue,

            'sales7days'       => $sales7days,
            'paymentStatus'    => $paymentStatusFormatted,

            'recentOrders'     => $recentOrders,
            'upcomingEvents'   => $upcomingEvents,
        ];

        return view('admin/dashboard', $data);
    }
}
