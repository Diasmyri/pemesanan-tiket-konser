<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= $title ?></title>

    <link rel="stylesheet" href="/assets/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">

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
            position: fixed; inset: 0; width: 100%; height: 100%;
            object-fit: cover; z-index: -3;
            filter: brightness(0.65) saturate(0.9) blur(1.2px);
            pointer-events: none;
        }

        body::after {
            content: ""; position: fixed; inset: 0;
            background: radial-gradient(circle at top, rgba(255, 255, 255, 0.08), transparent 45%),
                        linear-gradient(rgba(10, 12, 20, 0.78), rgba(10, 12, 20, 0.85));
            z-index: -2; pointer-events: none;
        }

        /* ================= SIDEBAR ================= */
        .sidebar {
            position: fixed; top: 0; left: 0; width: 260px; height: 100vh;
            background: linear-gradient(180deg, #111423, #0d101a);
            border-right: 1px solid var(--border-color);
            padding: 32px 24px; z-index: 1000; overflow-y: auto;
        }

        .brand {
            font-size: 22px; font-weight: 700; color: var(--accent);
            text-align: center; margin-bottom: 42px; letter-spacing: 0.5px;
        }

        .section-title {
            font-size: 11px; color: var(--text-muted); margin: 30px 0 12px;
            letter-spacing: 1.6px; text-transform: uppercase; cursor: pointer;
            display: flex; align-items: center; justify-content: space-between;
            padding: 8px 0; transition: var(--transition);
        }

        .section-title:hover { color: var(--accent); }

        .submenu { display: none; margin-left: 16px; padding-left: 0; list-style: none; }
        .submenu.open { display: block; }

        .sidebar a {
            display: flex; align-items: center; gap: 12px; padding: 12px 16px;
            margin-bottom: 10px; font-size: 14px; color: var(--text-main);
            text-decoration: none; border-radius: 12px; transition: var(--transition);
        }

        .sidebar a:hover { background: var(--hover-bg); transform: translateX(6px); }
        .sidebar a.active { background: linear-gradient(135deg, #1f2a44, #2b3760); font-weight: 600; box-shadow: var(--shadow); }

        /* ================= CONTENT ================= */
        .content { margin-left: 260px; padding: 50px 60px; min-height: 100vh; }

        .dashboard-header { display: flex; align-items: center; gap: 18px; margin-bottom: 42px; }

        .dash-icon {
            width: 64px; height: 64px; display: grid; place-items: center;
            font-size: 28px; border-radius: 18px;
            background: linear-gradient(135deg, #1f2a44, #2b3760); box-shadow: var(--shadow);
        }

        .dash-text h1 { margin: 0; font-weight: 700; }
        .dash-text p { margin: 4px 0 0; color: var(--text-muted); }

        /* ================= CARD & FILTER ================= */
        .card-box {
            background: linear-gradient(160deg, #1a1f2e, #141826);
            border: 1px solid var(--border-color); box-shadow: var(--shadow);
            padding: 30px; border-radius: 22px; margin-bottom: 26px;
        }

        .filter-fieldset {
            border: 1px solid rgba(255,255,255,0.1); padding: 15px;
            border-radius: 12px; position: relative; margin-bottom: 20px;
        }

        .filter-legend {
            position: absolute; top: -12px; left: 15px; background: #1a1f2e;
            padding: 0 10px; font-size: 11px; font-weight: 600; color: var(--text-muted);
            text-transform: uppercase;
        }

        .filter-input {
            background: rgba(255, 255, 255, 0.05); border: 1px solid var(--border-color);
            color: #fff; padding: 8px 12px; border-radius: 8px; font-size: 13px;
        }

        /* ================= TABLE ================= */
        .table-custom { width: 100%; border-collapse: collapse; }
        .table-custom thead th {
            background: rgba(255, 255, 255, 0.06); color: var(--text-muted);
            padding: 14px; font-size: 11px; text-transform: uppercase;
            letter-spacing: 0.7px; border-bottom: 1px solid var(--border-color);
        }
        .table-custom tbody td {
            padding: 16px 14px; border-bottom: 1px solid var(--border-color);
            font-size: 13px; color: var(--text-main); vertical-align: middle;
        }
        .table-custom tbody tr:hover { background: rgba(255, 255, 255, 0.04); }

        /* ================= BUTTONS ================= */
        .btn-custom { border: none; padding: 10px 20px; border-radius: 10px; font-weight: 600; font-size: 13px; transition: 0.3s; }
        .btn-filter { background: #1f8f55; color: white; }
        .btn-pdf { background: var(--accent); color: #000; }
        .btn-excel { background: #1e6091; color: white; }
        .btn-filter:hover, .btn-pdf:hover, .btn-excel:hover { opacity: 0.8; transform: translateY(-2px); }

        /* Style Waktu Transaksi */
        .badge-waktu {
            background: rgba(255, 255, 255, 0.08); padding: 6px 12px;
            border-radius: 8px; color: var(--text-main); font-size: 12px;
            border: 1px solid rgba(255, 255, 255, 0.1); display: inline-block;
        }

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
        <li><a href="/admin/transactions/refunds"><i class="fas fa-rotate-left"></i> Refunds</a></li>
    </ul>

    <div class="section-title" onclick="toggleSubmenu(this)">LAPORAN <i class="fas fa-chevron-down"></i></div>
    <ul class="submenu open">
        <li><a href="/admin/laporan/harian" class="active"><i class="fas fa-file-invoice-dollar"></i> Laporan Harian</a></li>
        <li><a href="/admin/laporan/bulanan"><i class="fas fa-chart-line"></i> Laporan Bulanan</a></li>
    </ul>
</div>

<div class="content">
    <div class="dashboard-header">
        <div class="dash-icon"><i class="fas fa-file-invoice-dollar"></i></div>
        <div class="dash-text">
            <h1>Laporan Penjualan</h1>
            <p><?= $periode ?></p>
        </div>
    </div>

    <div class="card-box">
        <form method="get" action="">
            <div class="row">
                <div class="col-md-6">
                    <div class="filter-fieldset">
                        <span class="filter-legend">Filter Range Hari</span>
                        <div class="d-flex align-items-center gap-2">
                            <input type="date" name="tgl_awal" class="filter-input w-100" value="<?= $filter['tgl_awal'] ?>">
                            <span class="small text-muted">sd</span>
                            <input type="date" name="tgl_akhir" class="filter-input w-100" value="<?= $filter['tgl_akhir'] ?>">
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="filter-fieldset">
                        <span class="filter-legend">Filter Range Bulan</span>
                        <div class="d-flex align-items-center gap-2">
                            <input type="month" name="bln_awal" class="filter-input w-100" value="<?= $filter['bln_awal'] ?>">
                            <span class="small text-muted">sd</span>
                            <input type="month" name="bln_akhir" class="filter-input w-100" value="<?= $filter['bln_akhir'] ?>">
                        </div>
                    </div>
                </div>
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn-custom btn-filter">Filter Data</button>
                <a href="<?= base_url('admin/laporan/harian/exportPdf?' . http_build_query($filter)) ?>" target="_blank" class="btn-custom btn-pdf text-decoration-none text-center">Export PDF</a>
                <a href="<?= base_url('admin/laporan/harian/exportExcel?' . http_build_query($filter)) ?>" class="btn-custom btn-excel text-decoration-none text-center">Export Excel</a>
            </div>
        </form>
    </div>

    <div class="card-box p-0 overflow-hidden">
        <div class="table-responsive">
            <table class="table-custom">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode</th>
                        <th>User</th>
                        <th>Event</th>
                        <th>Jenis Tiket</th>
                        <th class="text-center">QTY</th>
                        <th class="text-end">Total</th>
                        <th class="text-center">Waktu Transaksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(!empty($transaksi)): $no=1; foreach($transaksi as $t): ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td class="fw-bold" style="color: var(--accent);">TRX-<?= $t['kode'] ?></td>
                        <td><?= $t['user'] ?? 'Guest' ?></td>
                        <td><?= $t['event'] ?></td>
                        <td><span class="badge" style="background: rgba(30,96,145,0.3); color: #fff; border: 1px solid #1e6091;"><?= $t['paket'] ?></span></td>
                        <td class="text-center"><?= $t['qty'] ?></td>
                        <td class="text-end fw-bold">Rp <?= number_format($t['total'], 0, ',', '.') ?></td>
                        <td class="text-center">
                            <span class="badge-waktu">
                                <i class="fa-regular fa-clock me-1 text-warning"></i> <?= date('d/m/Y H:i', strtotime($t['created_at'])) ?>
                            </span>
                        </td>
                    </tr>
                    <?php endforeach; else: ?>
                    <tr><td colspan="8" class="text-center py-5 text-muted">Tidak ada transaksi ditemukan.</td></tr>
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
    submenu.classList.toggle('open');
    if (submenu.classList.contains('open')) icon.style.transform = 'rotate(180deg)';
    else icon.style.transform = 'rotate(0deg)';
}
</script>
</body>
</html>