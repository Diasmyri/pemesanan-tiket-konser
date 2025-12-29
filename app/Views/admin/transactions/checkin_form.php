<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Laporan Transaksi - Admin Panel</title>

<link rel="stylesheet" href="/assets/css/bootstrap.min.css">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">

<style>
/* ================= ROOT & GLOBAL ================= */
:root {
    --bg-main: #0e1117;
    --bg-sidebar: #111423;
    --primary: #1f2a44;
    --accent: #ffd54f;
    --text-main: #ffffff;
    --text-muted: #a1a6b3;
    --border-color: rgba(255, 255, 255, 0.08);
    --hover-bg: rgba(255, 255, 255, 0.08);
    --shadow: 0 18px 45px rgba(0, 0, 0, 0.55);
    --transition: all 0.35s ease;
}
* { box-sizing: border-box; }
body { margin: 0; font-family: 'Poppins', sans-serif; background: var(--bg-main); color: var(--text-main); overflow-x: hidden; }

/* Background Video */
.bg-video { position: fixed; inset: 0; width: 100%; height: 100%; object-fit: cover; z-index: -3; filter: brightness(0.6) saturate(0.9) blur(1.2px); pointer-events: none; }
body::after { content: ""; position: fixed; inset: 0; background: radial-gradient(circle at top, rgba(255, 255, 255, 0.08), transparent 45%), linear-gradient(rgba(10, 12, 20, 0.78), rgba(10, 12, 20, 0.85)); z-index: -2; pointer-events: none; }

/* Sidebar */
.sidebar { position: fixed; top: 0; left: 0; width: 260px; height: 100vh; background: linear-gradient(180deg, #111423, #0d101a); border-right: 1px solid var(--border-color); padding: 32px 24px; z-index: 1000; overflow-y: auto; }
.brand { font-size: 22px; font-weight: 700; color: var(--accent); text-align: center; margin-bottom: 42px; letter-spacing: 0.5px; }
.section-title { font-size: 11px; color: var(--text-muted); margin: 30px 0 12px; letter-spacing: 1.6px; text-transform: uppercase; cursor: pointer; display: flex; align-items: center; justify-content: space-between; padding: 8px 0; transition: var(--transition); }
.section-title:hover { color: var(--accent); }
.submenu { display: none; margin-left: 16px; padding-left: 0; list-style: none; }
.submenu.open { display: block; }
.sidebar a { display: flex; align-items: center; gap: 12px; padding: 12px 16px; margin-bottom: 10px; font-size: 14px; color: var(--text-main); text-decoration: none; border-radius: 12px; transition: var(--transition); }
.sidebar a:hover { background: var(--hover-bg); transform: translateX(6px); }
.sidebar a.active { background: linear-gradient(135deg, #1f2a44, #2b3760); font-weight: 600; box-shadow: var(--shadow); }

/* Content */
.content { margin-left: 260px; padding: 50px 60px; position: relative; z-index: 5; }
.page-title { font-size: 38px; font-weight: 700; display: flex; align-items: center; gap: 14px; text-shadow: 0 10px 40px rgba(0, 0, 0, 0.65); margin-bottom: 10px; }
.small-muted { color: var(--text-muted); margin-bottom: 36px; opacity: 0.85; font-size: 14px; }

/* Stat Cards */
.report-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 20px; margin-bottom: 30px; }
.stat-card { background: linear-gradient(160deg, rgba(255,255,255,0.05), rgba(255,255,255,0.01)); border: 1px solid var(--border-color); border-radius: 20px; padding: 24px; backdrop-filter: blur(10px); }
.stat-card i { font-size: 24px; color: var(--accent); margin-bottom: 15px; display: block; }
.stat-label { font-size: 12px; color: var(--text-muted); text-transform: uppercase; letter-spacing: 1px; }
.stat-value { font-size: 24px; font-weight: 700; margin-top: 5px; }

/* Table Box */
.card-box { background: linear-gradient(160deg, rgba(26, 31, 46, 0.88), rgba(20, 24, 38, 0.88)); backdrop-filter: blur(16px); border: 1px solid var(--border-color); border-radius: 22px; padding: 30px; box-shadow: var(--shadow); }
.table { background: transparent !important; color: #fff; margin-bottom: 0; }
.table thead th { background: rgba(255, 255, 255, 0.06); font-size: 11px; text-transform: uppercase; color: var(--text-muted); padding: 14px; border-bottom: 1px solid var(--border-color); }
.table tbody td { padding: 16px; border-bottom: 1px solid var(--border-color); vertical-align: middle; font-size: 14px; }

/* Filter & Print */
.top-actions { display: flex; justify-content: space-between; margin-bottom: 25px; gap: 15px; align-items: center; }
.filter-group { display: flex; gap: 10px; }
.date-input { background: rgba(17, 24, 41, 0.85); border: 1px solid var(--border-color); color: #fff; padding: 10px 15px; border-radius: 12px; font-size: 14px; }
.btn-print { background: var(--accent); color: #000; font-weight: 700; border: none; padding: 10px 20px; border-radius: 12px; transition: var(--transition); text-decoration: none; }
.btn-print:hover { transform: translateY(-2px); opacity: 0.9; color: #000; }
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
        <li><a href="/admin/transactions/refunds"><i class="fas fa-plus"></i> Ajukan Refund</a></li>
    </ul>

</div>

<div class="content">
    <div class="page-title">
        <i class="fas <?= ($type == 'daily') ? 'fa-clock' : 'fa-calendar' ?>"></i> 
        Laporan <?= ($type == 'daily') ? 'Harian' : 'Bulanan' ?>
    </div>
    <p class="small-muted">Analisa pendapatan dan statistik penjualan tiket secara berkala.</p>

    <div class="report-grid">
        <div class="stat-card">
            <i class="fas fa-sack-dollar"></i>
            <div class="stat-label">Total Pendapatan</div>
            <div class="stat-value" style="color: var(--accent);">Rp <?= number_format($summary['total_revenue'] ?? 0, 0, ',', '.') ?></div>
        </div>
        <div class="stat-card">
            <i class="fas fa-ticket"></i>
            <div class="stat-label">Tiket Terjual</div>
            <div class="stat-value"><?= number_format($summary['total_tickets'] ?? 0, 0, ',', '.') ?> Qty</div>
        </div>
        <div class="stat-card">
            <i class="fas fa-receipt"></i>
            <div class="stat-label">Total Transaksi</div>
            <div class="stat-value"><?= number_format($summary['total_orders'] ?? 0, 0, ',', '.') ?> Transaksi</div>
        </div>
    </div>

    <div class="card-box">
        <div class="top-actions">
            <form method="get" class="filter-group">
                <input type="<?= ($type == 'daily') ? 'date' : 'month' ?>" name="period" class="date-input" value="<?= $period ?>">
                <button type="submit" class="btn-print" style="background: rgba(255,255,255,0.1); color: #fff;">Filter</button>
            </form>
            <button onclick="window.print()" class="btn-print"><i class="fas fa-print"></i> Cetak PDF</button>
        </div>

        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th width="150">Tanggal</th>
                        <th>Event</th>
                        <th>User</th>
                        <th class="text-center">Qty</th>
                        <th>Pendapatan</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($reports)) : ?>
                        <tr><td colspan="6" class="text-center text-muted py-5">Tidak ada data untuk periode ini.</td></tr>
                    <?php else : ?>
                        <?php foreach ($reports as $r) : ?>
                        <tr>
                            <td><span class="text-white"><?= date('d M Y', strtotime($r['created_at'])) ?></span></td>
                            <td>
                                <span style="color:var(--accent);"><?= esc($r['event_name']) ?></span><br>
                                <small class="text-muted"><?= esc($r['ticket_type']) ?></small>
                            </td>
                            <td><?= esc($r['username']) ?></td>
                            <td class="text-center"><?= $r['qty'] ?></td>
                            <td><span class="fw-bold">Rp <?= number_format($r['total_price'], 0, ',', '.') ?></span></td>
                            <td><span class="badge" style="background:rgba(40,167,69,0.1); color:#28a745;"><?= $r['status'] ?></span></td>
                        </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
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
</body>
</html>