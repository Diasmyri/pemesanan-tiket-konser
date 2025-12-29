<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\EventModel;
use App\Models\OrderModel;
use App\Models\PaymentModel;
use App\Models\UserModel;
use App\Models\TicketTypeModel;
use App\Models\CheckinModel;

class Dashboard extends BaseController
{
    protected $eventModel;
    protected $orderModel;
    protected $paymentModel;
    protected $userModel;
    protected $ticketTypeModel;
    protected $checkinModel;

    public function __construct()
    {
        $this->eventModel      = new EventModel();
        $this->orderModel      = new OrderModel();
        $this->paymentModel    = new PaymentModel();
        $this->userModel       = new UserModel();
        $this->ticketTypeModel = new TicketTypeModel();
        $this->checkinModel    = new CheckinModel();
    }

    public function index()
    {
        $db = \Config\Database::connect();

        // ==========================
        // 1. CARD STATISTIK UTAMA
        // ==========================
        $totalEvents = $this->eventModel->countAll();
        $totalUsers  = $this->userModel->countAll();

        // Total Tiket Terjual (Hanya status paid)
        $ticketsRow = $this->orderModel
            ->where('status', 'paid')
            ->selectSum('qty', 'total_qty')
            ->first();
        $totalTicketsSold = (int)($ticketsRow['total_qty'] ?? 0);

        // Total Check-In
        $totalCheckIn = $this->checkinModel->countAllResults();

        // Total Revenue
        $revRow = $this->paymentModel->selectSum('amount', 'total_amount')->first();
        $totalRevenue = (float)($revRow['total_amount'] ?? 0);

        // ==========================
        // 2. GRAFIK PENJUALAN 7 HARI
        // ==========================
        $salesRaw = $this->orderModel
            ->select("DATE(created_at) as day, SUM(qty) as total")
            ->where('created_at >=', date('Y-m-d 00:00:00', strtotime('-6 days')))
            ->where('status', 'paid')
            ->groupBy('day')
            ->orderBy('day', 'ASC')
            ->findAll();

        $sales7days = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = date('Y-m-d', strtotime("-$i days"));
            $found = false;
            foreach ($salesRaw as $row) {
                if ($row['day'] == $date) {
                    $sales7days[] = ['day' => $date, 'total' => (int)$row['total']];
                    $found = true;
                    break;
                }
            }
            if (!$found) {
                $sales7days[] = ['day' => $date, 'total' => 0];
            }
        }

        // ==========================
        // 3. GRAFIK STATUS PEMBAYARAN
        // ==========================

        // $paymentStatusRaw = $db->table('orders')
        //     ->select("LOWER(TRIM(status)) AS status, COUNT(*) AS total")
        //     ->groupBy("status")
        //     ->get()
        //     ->getResultArray();

        $paymentStatusRaw = $db->table('orders')
            ->select("LOWER(TRIM(status)) AS status, SUM(qty) AS total") // SUM qty agar grafik akurat
            ->groupBy("status")
            ->get()
            ->getResultArray();

        $statusMap = ['paid' => 0, 'pending' => 0, 'failed' => 0, 'expired' => 0, 'refunded' => 0];
        foreach ($paymentStatusRaw as $row) {
            if (array_key_exists($row['status'], $statusMap)) {
                $statusMap[$row['status']] = (int)$row['total'];
            }
        }

        $paymentStatusFormatted = [];
        foreach ($statusMap as $st => $tot) {
            $paymentStatusFormatted[] = ['status' => ucfirst($st), 'total' => $tot];
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

            // ==========================================
            // 5. SELURUH EVENT (FIX: JOIN KE VENUES)
            // ==========================================
            $allEvents = $this->eventModel
                ->select('events.*, venues.name as venue_name') // Sudah diubah dari 'nama' ke 'name'
                ->join('venues', 'venues.id = events.venue_id', 'left')
                ->orderBy('events.date', 'DESC')
                ->findAll();

            // ==========================
            // 6. RINCIAN CHECK-IN PER EVENT & TIPE (FIXED QTY)
            // ==========================
            $checkinDetails = $db->table('checkins')
                ->select('events.title as event_name, ticket_types.name as ticket_name, SUM(orders.qty) as total') // Ganti COUNT jadi SUM qty
                ->join('orders', 'orders.id = checkins.order_id')
                ->join('events', 'events.id = orders.event_id')
                ->join('ticket_types', 'ticket_types.id = orders.ticket_type_id')
                ->groupBy('events.id, ticket_types.id')
                ->get()
                ->getResultArray();


        // // ==========================
        // // 6. RINCIAN CHECK-IN PER EVENT & TIPE
        // // ==========================
        // $checkinDetails = $db->table('checkins')
        //     ->select('events.title as event_name, ticket_types.name as ticket_name, COUNT(checkins.id) as total')
        //     ->join('orders', 'orders.id = checkins.order_id')
        //     ->join('events', 'events.id = orders.event_id')
        //     ->join('ticket_types', 'ticket_types.id = orders.ticket_type_id')
        //     ->groupBy('events.id, ticket_types.id')
        //     ->get()
        //     ->getResultArray();

            
        // ==========================================
        // 7. RINCIAN TIKET TERJUAL PER EVENT & TIPE
        // ==========================================
        $soldDetails = $db->table('orders')
            ->select('events.title as event_name, ticket_types.name as ticket_name, SUM(orders.qty) as total_sold')
            ->join('events', 'events.id = orders.event_id')
            ->join('ticket_types', 'ticket_types.id = orders.ticket_type_id')
            ->where('orders.status', 'paid')
            ->groupBy('events.id, ticket_types.id')
            ->get()
            ->getResultArray();

        // ==========================
        // SEND DATA KE VIEW
        // ==========================
        $data = [
            'totalEvents'      => $totalEvents,
            'totalUsers'       => $totalUsers,
            'totalTicketsSold' => $totalTicketsSold,
            'totalCheckIn'     => $totalCheckIn, 
            'checkinDetails'   => $checkinDetails,
            'soldDetails'      => $soldDetails,
            'totalRevenue'     => $totalRevenue,
            'sales7days'       => $sales7days,
            'paymentStatus'    => $paymentStatusFormatted,
            'recentOrders'     => $recentOrders,
            'allEvents'        => $allEvents,
            'title'            => 'Admin Dashboard'
        ];

        return view('admin/dashboard', $data);
    }
}