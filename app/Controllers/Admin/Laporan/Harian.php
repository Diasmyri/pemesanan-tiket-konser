<?php

namespace App\Controllers\Admin\Laporan;

use App\Controllers\BaseController;
use App\Models\OrderModel;
use App\Models\PaymentModel;
use App\Models\CheckinModel;

class Harian extends BaseController
{
    protected $orderModel;
    protected $paymentModel;
    protected $checkinModel;

    public function __construct()
    {
        $this->orderModel   = new OrderModel();
        $this->paymentModel = new PaymentModel();
        $this->checkinModel = new CheckinModel();
    }

    public function index()
    {
        $db = \Config\Database::connect();

        // 1. Ambil input tanggal dari filter (default hari ini)
        $tanggal = $this->request->getGet('date') ?? date('Y-m-d');

        // 2. STATISTIK UTAMA (DIAMBIL DARI TABEL PAYMENTS SESUAI FOTO DB)
        
        // Total Omzet (Revenue) dari tabel payments yang statusnya 'approved'
        $revRow = $this->paymentModel
            ->where("DATE(payment_date)", $tanggal)
            ->where('status', 'approved')
            ->selectSum('amount', 'total')
            ->first();
        $totalRevenue = (float)($revRow['total'] ?? 0);

        // Total Tiket Terjual Hari Ini (Dari Order yang sudah Paid/Approved)
        $ticketRow = $this->orderModel
            ->where("DATE(created_at)", $tanggal)
            ->where('status', 'paid') 
            ->selectSum('qty', 'total_qty')
            ->first();
        $totalTicketsSold = (int)($ticketRow['total_qty'] ?? 0);

        // Total Check-in Hari Ini
        $checkinRow = $db->table('checkins')
            ->join('orders', 'orders.id = checkins.order_id')
            ->where("DATE(checkins.created_at)", $tanggal)
            ->selectSum('orders.qty', 'total_qty')
            ->get()->getRowArray();
        $totalCheckIn = (int)($checkinRow['total_qty'] ?? 0);

        // Pesanan Masuk Hari Ini (Semua Status untuk statistik counter)
        $totalOrders = $this->orderModel->where("DATE(created_at)", $tanggal)->countAllResults();

        // 3. DATA GRAFIK PENJUALAN PER JAM
        $hourlyRaw = $db->table('orders')
            ->select("HOUR(created_at) as jam, SUM(qty) as total")
            ->where("DATE(created_at)", $tanggal)
            ->where("status", "paid")
            ->groupBy("jam")
            ->orderBy("jam", "ASC")
            ->get()->getResultArray();

        $hourlyData = array_fill(0, 24, 0); 
        foreach ($hourlyRaw as $row) {
            $hourlyData[(int)$row['jam']] = (int)$row['total'];
        }

        // 4. RINCIAN PENJUALAN PER EVENT
        $eventSales = $db->table('orders')
            ->select('events.title as event_name, ticket_types.name as ticket_name, SUM(orders.qty) as qty, SUM(orders.total_price) as subtotal')
            ->join('events', 'events.id = orders.event_id')
            ->join('ticket_types', 'ticket_types.id = orders.ticket_type_id')
            ->where("DATE(orders.created_at)", $tanggal)
            ->where('orders.status', 'paid')
            ->groupBy('events.id, ticket_types.id')
            ->get()->getResultArray();

        // 5. METODE PEMBAYARAN (Berdasarkan Tabel Payments)
        $paymentMethods = $db->table('payments')
            ->select('method, COUNT(*) as total')
            ->where("DATE(payment_date)", $tanggal)
            ->where('status', 'approved')
            ->groupBy('method')
            ->get()->getResultArray();

        $data = [
            'title'            => 'Laporan Harian - ' . date('d M Y', strtotime($tanggal)),
            'tanggal'          => $tanggal,
            'totalRevenue'     => $totalRevenue,
            'totalTicketsSold' => $totalTicketsSold,
            'totalCheckIn'     => $totalCheckIn,
            'totalOrders'      => $totalOrders,
            'hourlyData'       => $hourlyData,
            'eventSales'       => $eventSales,
            'paymentMethods'   => $paymentMethods
        ];

        return view('admin/laporan/harian', $data);
    }
}