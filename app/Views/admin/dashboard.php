<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard - Admin Panel</title>

    <link rel="stylesheet" href="/assets/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        /* ================= ROOT ================= */
        :root {
            --bg-main: #0d0f18;
            --bg-sidebar: #111423;
            --bg-card: #1a1f2e;
            --primary: #1b2b52;
            --accent: #ffd54f;
            --text-main: #e9ecf6;
            --text-muted: #9aa5c3;
            --border-color: rgba(255, 255, 255, 0.05);
            --hover-bg: rgba(255, 255, 255, 0.06);
            --shadow: 0 8px 20px rgba(0, 0, 0, 0.28);
            --transition: all 0.25s ease;
        }

        * { box-sizing: border-box; }

        body {
            font-family: 'Poppins', sans-serif;
            color: var(--text-main);
            margin: 0;
            line-height: 1.6;
            background: var(--bg-main);
            overflow-x: hidden;
        }

        /* ================= BACKGROUND VIDEO ================= */
        .bg-video {
            position: fixed;
            inset: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            z-index: -3;
            filter: brightness(0.65) saturate(0.9) blur(1.2px);
            pointer-events: none;
        }

        body::after {
            content: "";
            position: fixed;
            inset: 0;
            background:
                radial-gradient(circle at top, rgba(255, 255, 255, 0.08), transparent 45%),
                linear-gradient(rgba(10, 12, 20, 0.78), rgba(10, 12, 20, 0.85));
            z-index: -2;
            pointer-events: none;
        }

        /* ================= SIDEBAR ================= */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            width: 260px;
            height: 100vh;
            background: linear-gradient(180deg, #111423, #0d101a);
            border-right: 1px solid var(--border-color);
            padding: 32px 24px;
            z-index: 1000;
            overflow-y: auto;
        }

        .brand {
            font-size: 22px;
            font-weight: 700;
            color: var(--accent);
            text-align: center;
            margin-bottom: 42px;
            letter-spacing: 0.5px;
        }

        .section-title {
            font-size: 11px;
            color: var(--text-muted);
            margin: 30px 0 12px;
            letter-spacing: 1.6px;
            text-transform: uppercase;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 8px 0;
            transition: var(--transition);
        }

        .section-title:hover { color: var(--accent); }

        .submenu {
            display: none;
            margin-left: 16px;
            padding-left: 0;
            list-style: none;
        }

        .submenu.open { display: block; }

        .sidebar a {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 16px;
            margin-bottom: 10px;
            font-size: 14px;
            color: var(--text-main);
            text-decoration: none;
            border-radius: 12px;
            transition: var(--transition);
        }

        .sidebar a:hover {
            background: var(--hover-bg);
            transform: translateX(6px);
        }

        .sidebar a.active {
            background: linear-gradient(135deg, #1f2a44, #2b3760);
            font-weight: 600;
            box-shadow: var(--shadow);
        }

        /* ================= CONTENT ================= */
        .content {
            margin-left: 260px;
            padding: 50px 60px;
            min-height: 100vh;
        }

        .dashboard-header {
            display: flex;
            align-items: center;
            gap: 18px;
            margin-bottom: 42px;
        }

        .dash-icon {
            width: 64px;
            height: 64px;
            display: grid;
            place-items: center;
            font-size: 28px;
            border-radius: 18px;
            background: linear-gradient(135deg, #1f2a44, #2b3760);
            box-shadow: var(--shadow);
        }

        .dash-text h1 { margin: 0; font-weight: 700; }
        .dash-text p { margin: 4px 0 0; color: var(--text-muted); }

        /* ================= CARD ================= */
        .card-box {
            position: relative;
            overflow: hidden;
            background:
                radial-gradient(circle at top left, rgba(255, 255, 255, 0.06), transparent 40%),
                linear-gradient(160deg, #1a1f2e, #141826);
            border: 1px solid var(--border-color);
            box-shadow: var(--shadow);
            padding: 30px;
            border-radius: 22px;
            margin-bottom: 26px;
            transition: var(--transition);
        }

        .card-box:hover {
            transform: translateY(-6px);
            box-shadow: 0 0 0 1px rgba(255, 213, 79, 0.18), 0 28px 80px rgba(0, 0, 0, 0.75);
        }

        .card-title {
            font-size: 15px;
            font-weight: 600;
            padding-bottom: 14px;
            margin-bottom: 22px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.08);
            letter-spacing: 0.3px;
        }

        .card-value { font-size: 34px; font-weight: 700; }

        /* ================= STATS ================= */
        .stats-row {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 20px;
            margin-top: 40px;
        }

        /* ================= TABLE ================= */
        .table {
            background: transparent !important;
            color: var(--text-main);
            border-radius: 16px;
            overflow: hidden;
        }

        .table thead th {
            background: rgba(255, 255, 255, 0.06);
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 0.7px;
            color: var(--text-muted);
            padding: 12px 14px;
            border-bottom: 1px solid var(--border-color) !important;
        }

        .table tbody td {
            font-size: 13px;
            padding: 14px;
            border-bottom: 1px solid var(--border-color);
            vertical-align: middle;
        }

        .table tbody tr:hover { background: rgba(255, 255, 255, 0.05); }

        /* ================= BADGE ================= */
        .badge {
            padding: 6px 14px;
            font-size: 10px;
            border-radius: 999px;
            font-weight: 700;
            text-transform: uppercase;
        }
        .badge-success { background: #1f8f55; }
        .badge-warning { background: #c98a10; }
        .badge-info { background: #1e6091; }
        .badge-danger { background: #b02a37; } 

        canvas { height: 280px !important; }

        @media (max-width: 768px) {
            .bg-video { display: none; }
            .sidebar { position: relative; width: 100%; height: auto; padding: 20px; }
            .content { margin-left: 0; padding: 32px 22px; }
        }
    </style>
</head>

<body>

<video autoplay muted loop playsinline class="bg-video">
    <source src="https://cdn.coverr.co/videos/coverr-concert-crowd-light-show-1596/1080p.mp4" type="video/mp4">
</video>

<div class="sidebar">
    <div class="brand">Admin Panel - Ticketing</div>

    <div class="section-title">MAIN</div>
    <a href="/admin/dashboard" class="active"><i class="fas fa-gauge"></i> Dashboard</a>

    <div class="section-title" onclick="toggleSubmenu(this)">MASTERS <i class="fas fa-chevron-down"></i></div>
    <ul class="submenu">
        <li><a href="/admin/masters/artists"><i class="fas fa-microphone"></i> Artists</a></li>
        <li><a href="/admin/masters/events"><i class="fas fa-calendar"></i> Events</a></li>
        <li><a href="/admin/masters/venues"><i class="fas fa-location-dot"></i> Venues</a></li>
        <li><a href="/admin/masters/tickettypes"><i class="fas fa-ticket"></i> Ticket Types</a></li>
        <li><a href="/admin/masters/users"><i class="fas fa-users"></i> Users</a></li>
    </ul>

    <div class="section-title" onclick="toggleSubmenu(this)">TRANSAKSI <i class="fas fa-chevron-down"></i></div>
    <ul class="submenu">
        <li><a href="/admin/transactions/orders"><i class="fas fa-receipt"></i> Orders</a></li>
        <li><a href="/admin/transactions/payments"><i class="fas fa-credit-card"></i> Payments</a></li>
        <li><a href="/admin/transactions/checkin"><i class="fas fa-qrcode"></i> Check-in</a></li>
        <li><a href="/admin/transactions/refunds"><i class="fas fa-rotate-left"></i> Refunds</a></li>
    </ul>

    <div class="section-title" onclick="toggleSubmenu(this)">LAPORAN <i class="fas fa-chevron-down"></i></div>
    <ul class="submenu">
        <li><a href="/admin/laporan/harian"><i class="fas fa-file-invoice-dollar"></i> Laporan Harian</a></li>
        <li><a href="/admin/laporan/bulanan"><i class="fas fa-chart-line"></i> Laporan Bulanan</a></li>
    </ul>
</div>

<div class="content">
    <div class="dashboard-header">
        <div class="dash-icon"><i class="fas fa-chart-pie"></i></div>
        <div class="dash-text">
            <h1>Dashboard</h1>
            <p>Ringkasan aktivitas dan statistik sistem ticketing.</p>
        </div>
    </div>

    <div class="stats-row">
        <div class="card-box">
            <div class="card-title">🎟️ Tiket Terjual</div>
            <div class="card-value"><?= number_format($totalTicketsSold) ?></div>
        </div>
        <div class="card-box">
            <div class="card-title">🏃 Check-In</div>
            <div class="card-value"><?= number_format($totalCheckIn) ?></div>
            <div style="font-size: 11px; color: var(--accent); margin-top: 5px; font-weight: 600;">
                <?= ($totalTicketsSold > 0) ? round(($totalCheckIn / $totalTicketsSold) * 100, 1) : 0 ?>% dari Tiket Terjual
            </div>
        </div>
        <div class="card-box">
            <div class="card-title">📅 Total Event</div>
            <div class="card-value"><?= number_format($totalEvents) ?></div>
        </div>
        <div class="card-box">
            <div class="card-title">👥 Total User</div>
            <div class="card-value"><?= number_format($totalUsers) ?></div>
        </div>
        <div class="card-box" style="border: 1px solid rgba(255, 213, 79, 0.3);">
            <div class="card-title">💰 Revenue (Paid Only)</div>
            <div class="card-value" style="font-size: 24px; margin-top: 10px; color: var(--accent);">Rp <?= number_format($totalRevenue, 0, ',', '.') ?></div>
        </div>
    </div>

    <div class="row g-4 mt-2">
        <div class="col-12">
            <div class="card-box">
                <div class="card-title"><i class="fas fa-calendar-alt me-2 text-warning"></i> Daftar Keseluruhan Event</div>
                <div class="table-responsive" style="max-height: 350px; overflow-y: auto;">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Nama Event</th>
                                <th>Tanggal Pelaksanaan</th>
                                <th>Venue</th>
                                <th class="text-center">Status Jadwal</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($allEvents)): foreach ($allEvents as $e): 
                                $isExpired = strtotime($e['date']) < strtotime(date('Y-m-d'));
                                $statusLabel = $isExpired ? 'Expired' : 'Active';
                                $statusBadge = $isExpired ? 'badge-danger' : 'badge-success';
                            ?>
                                <tr>
                                    <td><strong><?= $e['title'] ?></strong></td>
                                    <td><i class="far fa-calendar-check me-1"></i> <?= date('d M Y', strtotime($e['date'])) ?></td>
                                    <td>
                                        <i class="fas fa-location-dot me-1 text-muted"></i> 
                                        <?= $e['venue_name'] ?? '<span class="text-muted italic">Tidak ada venue</span>' ?>
                                    </td>
                                    <td class="text-center">
                                        <span class="badge <?= $statusBadge ?>"><?= $statusLabel ?></span>
                                    </td>
                                </tr>
                            <?php endforeach; else: ?>
                                <tr><td colspan="4" class="text-center text-muted">Tidak ada data event.</td></tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4 mt-1">
        <div class="col-md-6">
            <div class="card-box">
                <div class="card-title"><i class="fas fa-ticket-alt me-2 text-primary"></i> Rincian Tiket Terjual per Event</div>
                <div class="table-responsive">
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th>Nama Event</th>
                                <th>Tipe Tiket</th>
                                <th class="text-center">Terjual</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($soldDetails)): foreach ($soldDetails as $sd): ?>
                                <tr>
                                    <td><strong><?= $sd['event_name'] ?></strong></td>
                                    <td><span class="badge badge-info"><?= $sd['ticket_name'] ?></span></td>
                                    <td class="text-center"><span class="h6 fw-bold text-accent"><?= number_format($sd['total_sold']) ?></span></td>
                                </tr>
                            <?php endforeach; else: ?>
                                <tr><td colspan="3" class="text-center text-muted">Belum ada tiket terjual.</td></tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card-box">
                <div class="card-title"><i class="fas fa-user-check me-2 text-success"></i> Rincian Kedatangan per Event</div>
                <div class="table-responsive">
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th>Nama Event</th>
                                <th>Tipe Tiket</th>
                                <th class="text-center">Check-In</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($checkinDetails)): foreach ($checkinDetails as $cd): ?>
                                <tr>
                                    <td><strong><?= $cd['event_name'] ?></strong></td>
                                    <td><span class="badge badge-info"><?= $cd['ticket_name'] ?></span></td>
                                    <td class="text-center"><span class="h6 fw-bold text-accent"><?= number_format($cd['total']) ?></span></td>
                                </tr>
                            <?php endforeach; else: ?>
                                <tr><td colspan="3" class="text-center text-muted">Belum ada data check-in.</td></tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4 mt-1">
        <div class="col-md-7">
            <div class="card-box">
                <div class="card-title">Order Terbaru</div>
                <div class="table-responsive">
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>User</th>
                                <th>Event</th>
                                <th>Total</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($recentOrders)): foreach ($recentOrders as $o): 
                                $s = strtolower($o['status']);
                                if(in_array($s, ['failed', 'expired'])) continue;
                                $badge = match ($s) { 'paid' => 'badge-success', 'pending' => 'badge-warning', 'refunded' => 'badge-info', default => 'bg-secondary' };
                                ?>
                                <tr>
                                    <td><?= $o['id'] ?></td>
                                    <td><?= $o['user_name'] ?></td>
                                    <td><small><?= $o['event_name'] ?></small></td>
                                    <td>Rp <?= number_format($o['total_price'], 0, ',', '.') ?></td>
                                    <td><span class="badge <?= $badge ?>"><?= $s ?></span></td>
                                </tr>
                            <?php endforeach; else: ?>
                                <tr><td colspan="5" class="text-center text-muted">Belum ada order.</td></tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-5">
            <div class="card-box">
                <div class="card-title">Status Pembayaran (%)</div>
                <canvas id="paymentChart"></canvas>
            </div>
        </div>
    </div>

    <div class="row g-4 mt-1">
        <div class="col-12">
            <div class="card-box">
                <div class="card-title">Penjualan 7 Hari Terakhir</div>
                <canvas id="salesChart" style="height: 300px;"></canvas>
            </div>
        </div>
    </div>
</div>

<script>
function toggleSubmenu(element) {
    const submenu = element.nextElementSibling;
    const icon = element.querySelector('i');
    submenu.classList.toggle('open');
    if (submenu.classList.contains('open')) icon.style.transform = 'rotate(180deg)';
    else icon.style.transform = 'rotate(0deg)';
}

// Chart Sales
new Chart(document.getElementById("salesChart"), {
    type: "line",
    data: {
        labels: <?= json_encode(array_column($sales7days ?? [], 'day')) ?>,
        datasets: [{
            label: 'Total Penjualan',
            data: <?= json_encode(array_column($sales7days ?? [], 'total')) ?>,
            borderColor: "#007bff",
            backgroundColor: "rgba(0,123,255,.18)",
            fill: true,
            tension: .35
        }]
    },
    options: {
        plugins:{ legend:{ display:false } },
        maintainAspectRatio:false,
        scales: {
            y: { ticks: { color: '#9aa5c3' }, grid: { color: 'rgba(255,255,255,0.05)' } },
            x: { ticks: { color: '#9aa5c3' }, grid: { display: false } }
        }
    }
});

// Chart Payment Status
<?php 
$filteredPayments = array_filter($paymentStatus ?? [], function($item) {
    return in_array(strtolower($item['status']), ['paid', 'pending', 'refunded']);
});
?>
new Chart(document.getElementById("paymentChart"), {
    type: "doughnut",
    data: {
        labels: <?= json_encode(array_values(array_column($filteredPayments,'status'))) ?>,
        datasets: [{
            data: <?= json_encode(array_values(array_column($filteredPayments,'total'))) ?>,
            backgroundColor: ["#1f8f55","#c98a10","#1e6091"],
            borderWidth: 0
        }]
    },
    options: {
        maintainAspectRatio:false,
        plugins: {
            legend: { 
                position: 'bottom', 
                labels: { color: '#ffffff', font: { weight: 'bold', size: 11 } } 
            }
        }
    }
});
</script>
</body>
</html>