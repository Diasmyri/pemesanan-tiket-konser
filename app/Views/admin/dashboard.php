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

        * {
            box-sizing: border-box;
        }

        /* ================= BODY ================= */
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

        /* GLOBAL OVERLAY (LEMBUT BIAR VIDEO KELIATAN) */
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

        .section-title:hover {
            color: var(--accent);
        }

        .section-title i {
            transition: var(--transition);
        }

        .submenu {
            display: none;
            margin-left: 16px;
            padding-left: 0;
            list-style: none;
        }

        .submenu.open {
            display: block;
        }

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

        /* ================= HEADER ================= */
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

        .dash-text h1 {
            margin: 0;
            font-weight: 700;
        }

        .dash-text p {
            margin: 4px 0 0;
            color: var(--text-muted);
        }

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

        .card-box::after {
            content: "";
            position: absolute;
            inset: 0;
            background: linear-gradient(
                120deg,
                transparent,
                rgba(255, 255, 255, 0.08),
                transparent
            );
            opacity: 0;
            transition: opacity 0.4s ease;
        }

        .card-box:hover {
            transform: translateY(-6px);
            box-shadow:
                0 0 0 1px rgba(255, 213, 79, 0.18),
                0 28px 80px rgba(0, 0, 0, 0.75);
        }

        .card-box:hover::after {
            opacity: 1;
        }

        .card-title {
            font-size: 15px;
            font-weight: 600;
            padding-bottom: 14px;
            margin-bottom: 22px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.08);
            letter-spacing: 0.3px;
        }

        .card-value {
            font-size: 34px;
            font-weight: 700;
        }

        /* ================= STATS ================= */
        .stats-row {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
            gap: 26px;
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

        .table tbody tr {
            transition: background 0.25s ease, transform 0.25s ease;
        }

        .table tbody tr:hover {
            background: rgba(255, 255, 255, 0.05);
            transform: scale(1.01);
        }

        /* ================= BADGE ================= */
        .badge {
            padding: 6px 14px;
            font-size: 10px;
            border-radius: 999px;
            font-weight: 700;
            letter-spacing: 0.6px;
            text-transform: uppercase;
            box-shadow: 0 6px 16px rgba(0, 0, 0, 0.45);
        }

        .badge-success {
            background: #1f8f55;
        }

        .badge-warning {
            background: #c98a10;
            animation: pulse 2s infinite;
        }

        .badge-danger {
            background: #b33a3a;
        }

        @keyframes pulse {
            0%, 100% {
                box-shadow: 0 0 0 rgba(201, 138, 16, 0.0);
            }
            50% {
                box-shadow: 0 0 18px rgba(201, 138, 16, 0.55);
            }
        }

        /* ================= CHART ================= */
        canvas {
            height: 280px !important;
        }

        /* ================= RESPONSIVE ================= */
        @media (max-width: 1200px) {
            .sidebar {
                width: 220px;
            }
            .content {
                margin-left: 220px;
                padding: 40px 32px;
            }
        }

        @media (max-width: 768px) {
            .bg-video {
                display: none;
            }
            .sidebar {
                position: relative;
                width: 100%;
                height: auto;
                padding: 20px;
            }
            .content {
                margin-left: 0;
                padding: 32px 22px;
            }
        }

        @media (max-width: 576px) {
            .card-box {
                padding: 22px;
            }
            .card-value {
                font-size: 26px;
            }
            canvas {
                height: 200px !important;
            }
        }
    </style>
</head>

<body>

<!-- BACKGROUND VIDEO -->
<video autoplay muted loop playsinline class="bg-video"
poster="https://images.unsplash.com/photo-1518972559570-7cc1309f3229?auto=format&fit=crop&w=2400&q=80">
    <source src="https://cdn.coverr.co/videos/coverr-concert-crowd-light-show-1596/1080p.mp4" type="video/mp4">
</video>

<!-- SIDEBAR -->
<div class="sidebar">
    <div class="brand">Admin Panel - Ticketing</div>

    <div class="section-title">MAIN</div>
    <a href="/admin/dashboard" class="active"><i class="fas fa-gauge"></i> Dashboard</a>

    <div class="section-title" onclick="toggleSubmenu(this)">
        MASTERS <i class="fas fa-chevron-down"></i>
    </div>
    <ul class="submenu">
        <li><a href="/admin/masters/artists"><i class="fas fa-microphone"></i> Artists</a></li>
        <li><a href="/admin/masters/events"><i class="fas fa-calendar"></i> Events</a></li>
        <li><a href="/admin/masters/venues"><i class="fas fa-location-dot"></i> Venues</a></li>
        <li><a href="/admin/masters/tickettypes"><i class="fas fa-ticket"></i> Ticket Types</a></li>
        <li><a href="/admin/masters/users"><i class="fas fa-users"></i> Users</a></li>
    </ul>

    <div class="section-title" onclick="toggleSubmenu(this)">
        TRANSAKSI <i class="fas fa-chevron-down"></i>
    </div>
    <ul class="submenu">
        <li><a href="/admin/transactions/orders"><i class="fas fa-receipt"></i> Orders</a></li>
        <li><a href="/admin/transactions/payments"><i class="fas fa-credit-card"></i> Payments</a></li>
        <li><a href="/admin/transactions/checkin"><i class="fas fa-qrcode"></i> Check-in</a></li>
    </ul>

    <div class="section-title" onclick="toggleSubmenu(this)">
        LAPORAN <i class="fas fa-chevron-down"></i>
    </div>
    <ul class="submenu">
        <li><a href="/admin/reports/daily"><i class="fas fa-clock"></i> Harian</a></li>
        <li><a href="/admin/reports/monthly"><i class="fas fa-calendar"></i> Bulanan</a></li>
    </ul>
</div>

<!-- CONTENT -->
<div class="content">

    <div class="dashboard-header">
        <div class="dash-icon">
            <i class="fas fa-chart-pie"></i>
        </div>
        <div class="dash-text">
            <h1>Dashboard</h1>
            <p>Ringkasan aktivitas dan statistik sistem ticketing.</p>
        </div>
    </div>

    <!-- STATS -->
    <div class="stats-row">
        <div class="card-box">
            <div class="card-title">🎟️ Tiket Terjual</div>
            <div class="card-value"><?= number_format($totalTicketsSold) ?></div>
        </div>
        <div class="card-box">
            <div class="card-title">📅 Total Event</div>
            <div class="card-value"><?= number_format($totalEvents) ?></div>
        </div>
        <div class="card-box">
            <div class="card-title">👥 Total User</div>
            <div class="card-value"><?= number_format($totalUsers) ?></div>
        </div>
        <div class="card-box">
            <div class="card-title">💰 Revenue</div>
            <div class="card-value">Rp <?= number_format($totalRevenue, 0, ',', '.') ?></div>
        </div>
    </div>

    <!-- TABLES -->
    <div class="row g-4">
        <div class="col-md-7">
            <div class="card-box">
                <div class="card-title">Order Terbaru</div>

                <table class="table table-light table-hover table-sm">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>User</th>
                            <th>Event</th>
                            <th>Qty</th>
                            <th>Total</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($recentOrders)): foreach ($recentOrders as $o): ?>
                            <tr>
                                <td><?= $o['id'] ?></td>
                                <td><?= $o['user_name'] ?></td>
                                <td><?= $o['event_name'] ?></td>
                                <td><?= $o['qty'] ?></td>
                                <td>Rp <?= number_format($o['total_price'], 0, ',', '.') ?></td>
                                <td>
                                    <?php
                                    $s = strtolower($o['status']);
                                    $badge = match ($s) {
                                        'paid' => 'badge-success',
                                        'pending' => 'badge-warning',
                                        'failed' => 'badge-danger',
                                        default => 'bg-secondary'
                                    };
                                    ?>
                                    <span class="badge <?= $badge ?>"><?= $s ?></span>
                                </td>
                            </tr>
                        <?php endforeach; else: ?>
                            <tr>
                                <td colspan="6" class="text-center text-muted">Belum ada order.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="col-md-5">
            <div class="card-box">
                <div class="card-title">Event Terdekat</div>

                <table class="table table-light table-hover table-sm">
                    <thead>
                        <tr>
                            <th>Event</th>
                            <th>Tanggal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($upcomingEvents)): foreach ($upcomingEvents as $e): ?>
                            <tr>
                                <td><?= $e['title'] ?></td>
                                <td><?= date('d M Y', strtotime($e['date'])) ?></td>
                            </tr>
                        <?php endforeach; else: ?>
                            <tr>
                                <td colspan="2" class="text-center text-muted">Tidak ada event.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- CHART -->
    <div class="row g-4 mt-4">
        <div class="col-md-7">
            <div class="card-box">
                <div class="card-title">Penjualan 7 Hari</div>
                <canvas id="salesChart"></canvas>
            </div>
        </div>
        <div class="col-md-5">
            <div class="card-box">
                <div class="card-title">Status Pembayaran</div>
                <canvas id="paymentChart"></canvas>
            </div>
        </div>
    </div>

</div>

<script>
function toggleSubmenu(element) {
    const submenu = element.nextElementSibling;
    const icon = element.querySelector('i');
    
    if (submenu.classList.contains('open')) {
        submenu.classList.remove('open');
        icon.style.transform = 'rotate(0deg)';
    } else {
        submenu.classList.add('open');
        icon.style.transform = 'rotate(180deg)';
    }
}

// Auto-open submenu jika halaman aktif ada di dalamnya
document.addEventListener('DOMContentLoaded', function() {
    const activeLink = document.querySelector('.submenu a.active');
    if (activeLink) {
        const submenu = activeLink.closest('.submenu');
        const sectionTitle = submenu.previousElementSibling;
        const icon = sectionTitle.querySelector('i');
        submenu.classList.add('open');
        icon.style.transform = 'rotate(180deg)';
    }
});
</script>

<script>
new Chart(document.getElementById("salesChart"), {
    type: "line",
    data: {
        labels: <?= json_encode(array_column($sales7days,'day')) ?>,
        datasets: [{
            data: <?= json_encode(array_column($sales7days,'total')) ?>,
            borderColor: "#007bff",
            backgroundColor: "rgba(0,123,255,.18)",
            fill: true,
            tension: .35
        }]
    },
    options: {
        plugins:{ legend:{ display:false } },
        maintainAspectRatio:false
    }
});

new Chart(document.getElementById("paymentChart"), {
    type: "doughnut",
    data: {
        labels: <?= json_encode(array_column($paymentStatus,'status')) ?>,
        datasets: [{
            data: <?= json_encode(array_column($paymentStatus,'total')) ?>,
            backgroundColor: ["#28a745","#ffc107","#dc3545","#6c757d"]
        }]
    },
    options: {
        maintainAspectRatio:false
    }
});
</script>

</body>
</html>