<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= $title ?></title>

    <link rel="stylesheet" href="/assets/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
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

        body {
            font-family: 'Poppins', sans-serif;
            color: var(--text-main);
            background: var(--bg-main);
            margin: 0;
            overflow-x: hidden;
        }

        .bg-video {
            position: fixed;
            inset: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            z-index: -3;
            filter: brightness(0.65) blur(1.2px);
            pointer-events: none;
        }

        body::after {
            content: "";
            position: fixed;
            inset: 0;
            background: linear-gradient(rgba(10, 12, 20, 0.8), rgba(10, 12, 20, 0.9));
            z-index: -2;
        }

        /* SIDEBAR */
        .sidebar {
            position: fixed;
            top: 0; left: 0; width: 260px; height: 100vh;
            background: linear-gradient(180deg, #111423, #0d101a);
            border-right: 1px solid var(--border-color);
            padding: 32px 24px;
            z-index: 1000;
        }

        .brand { font-size: 20px; font-weight: 700; color: var(--accent); text-align: left; margin-bottom: 42px; text-transform: uppercase; }

        .sidebar a {
            display: flex; align-items: center; gap: 12px; padding: 12px 16px;
            margin-bottom: 10px; font-size: 14px; color: var(--text-main);
            text-decoration: none; border-radius: 12px; transition: var(--transition);
        }

        .sidebar a:hover { background: var(--hover-bg); transform: translateX(6px); }
        .sidebar a.active { background: linear-gradient(135deg, #1f2a44, #2b3760); font-weight: 600; box-shadow: var(--shadow); }

        .section-title { font-size: 11px; color: var(--text-muted); margin: 30px 0 12px; letter-spacing: 1.6px; text-transform: uppercase; }

        /* CONTENT */
        .content { margin-left: 260px; padding: 40px 50px; min-height: 100vh; }

        .page-header { display: flex; align-items: center; justify-content: space-between; margin-bottom: 35px; }
        
        /* CARD BOX (Identik Dashboard) */
        .card-box {
            background: #1a1f2e;
            border: 1px solid var(--border-color);
            padding: 24px;
            border-radius: 18px;
            box-shadow: var(--shadow);
            height: 100%;
        }

        .card-label { font-size: 13px; font-weight: 600; color: var(--text-main); margin-bottom: 15px; display: flex; align-items: center; gap: 10px; }
        .card-value { font-size: 32px; font-weight: 700; color: #fff; margin-bottom: 5px; }
        .card-subtext { font-size: 12px; color: var(--accent); font-weight: 600; }

        /* TABLE */
        .table { color: var(--text-main); margin-bottom: 0; }
        .table thead th { background: rgba(255, 255, 255, 0.03); color: var(--text-muted); font-size: 11px; text-transform: uppercase; border: none; padding: 15px; }
        .table tbody td { border-bottom: 1px solid var(--border-color); padding: 15px; vertical-align: middle; }

        .filter-input {
            background: rgba(255, 255, 255, 0.05); border: 1px solid var(--border-color);
            color: #fff; padding: 8px 15px; border-radius: 10px; font-size: 14px;
        }

        /* KHUSUS CHART AGAR TIDAK ANCUR */
        .chart-container {
            position: relative;
            height: 300px; /* Lock tinggi biar gak melar */
            width: 100%;
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
    <a href="/admin/dashboard"><i class="fas fa-gauge"></i> Dashboard</a>
    
    <div class="section-title">LAPORAN</div>
    <a href="/admin/laporan/harian" class="active"><i class="fas fa-calendar-day"></i> Laporan Harian</a>
    <a href="/admin/laporan/bulanan"><i class="fas fa-calendar-alt"></i> Laporan Bulanan</a>
</div>

<div class="content">
    <div class="page-header">
        <div>
            <h1 class="m-0 h3 fw-bold">Laporan Harian</h1>
            <p class="text-muted m-0" style="font-size: 14px;">Ringkasan aktivitas dan statistik sistem ticketing.</p>
        </div>
        
        <form method="get" class="d-flex gap-2">
            <input type="date" name="date" class="filter-input" value="<?= $tanggal ?>">
            <button type="submit" class="btn btn-warning px-4 fw-bold" style="border-radius: 10px; font-size: 14px;">Filter</button>
        </form>
    </div>

    <div class="row g-4 mb-4">
        <div class="col-md-3">
            <div class="card-box">
                <div class="card-label">🎟️ Tiket Terjual</div>
                <div class="card-value"><?= number_format($totalTicketsSold) ?></div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card-box">
                <div class="card-label">🏃 Check-In</div>
                <div class="card-value"><?= number_format($totalCheckIn) ?></div>
                <div class="card-subtext"><?= ($totalTicketsSold > 0) ? round(($totalCheckIn / $totalTicketsSold) * 100, 1) : 0 ?>% dari Tiket Terjual</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card-box">
                <div class="card-label">📋 Total Order</div>
                <div class="card-value"><?= number_format($totalOrders) ?></div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card-box">
                <div class="card-label">💰 Revenue</div>
                <div class="card-value">Rp <?= number_format($totalRevenue, 0, ',', '.') ?></div>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-md-8">
            <div class="card-box">
                <div class="card-label"><i class="fas fa-chart-line text-primary"></i> Tren Penjualan per Jam</div>
                <div class="chart-container">
                    <canvas id="hourlyChart"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card-box">
                <div class="card-label"><i class="fas fa-credit-card text-success"></i> Metode Pembayaran</div>
                <div class="chart-container">
                    <canvas id="paymentPieChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-12">
            <div class="card-box">
                <div class="card-label mb-4"><i class="fas fa-list text-warning"></i> Rincian Penjualan per Event</div>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Nama Event</th>
                                <th>Tipe Tiket</th>
                                <th class="text-center">QTY</th>
                                <th class="text-end">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(!empty($eventSales)): foreach($eventSales as $es): ?>
                                <tr>
                                    <td class="fw-bold"><?= $es['event_name'] ?></td>
                                    <td><span class="text-muted"><?= $es['ticket_name'] ?></span></td>
                                    <td class="text-center"><span class="badge bg-dark px-3"><?= $es['qty'] ?></span></td>
                                    <td class="text-end fw-bold" style="color: var(--accent);">Rp <?= number_format($es['subtotal'], 0, ',', '.') ?></td>
                                </tr>
                            <?php endforeach; else: ?>
                                <tr><td colspan="4" class="text-center py-4 text-muted">Tidak ada transaksi lunas di tanggal ini.</td></tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // CHART TREN PER JAM - DIBIKIN RESPONSIVE & STABLE
    const hourlyCtx = document.getElementById("hourlyChart").getContext('2d');
    new Chart(hourlyCtx, {
        type: "line",
        data: {
            labels: Array.from({length: 24}, (_, i) => i + ":00"),
            datasets: [{
                label: 'Tiket Terjual',
                data: <?= json_encode($hourlyData) ?>,
                borderColor: "#ffd54f",
                backgroundColor: "rgba(255, 213, 79, 0.1)",
                borderWidth: 3,
                fill: true,
                tension: 0.4,
                pointRadius: 4,
                pointBackgroundColor: "#ffd54f"
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { display: false } },
            scales: {
                y: { 
                    beginAtZero: true,
                    grid: { color: 'rgba(255,255,255,0.05)' }, 
                    ticks: { color: '#9aa5c3', stepSize: 1 } 
                },
                x: { 
                    grid: { display: false }, 
                    ticks: { color: '#9aa5c3' } 
                }
            }
        }
    });

    // CHART METODE PEMBAYARAN
    const paymentCtx = document.getElementById("paymentPieChart").getContext('2d');
    new Chart(paymentCtx, {
        type: "doughnut",
        data: {
            labels: <?= json_encode(array_column($paymentMethods, 'method')) ?>,
            datasets: [{
                data: <?= json_encode(array_column($paymentMethods, 'total')) ?>,
                backgroundColor: ["#ffd54f", "#4facfe", "#00f2fe", "#f093fb"],
                borderWidth: 0,
                hoverOffset: 10
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { 
                    position: 'bottom', 
                    labels: { color: '#9aa5c3', padding: 20, font: { size: 11 } } 
                }
            },
            cutout: '70%'
        }
    });
</script>

</body>
</html>