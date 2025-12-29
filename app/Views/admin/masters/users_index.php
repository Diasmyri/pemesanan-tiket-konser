<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Users - Admin Panel</title>

    <link rel="stylesheet" href="/assets/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">

    <style>
        /* ================= ROOT (Identik Dashboard) ================= */
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

        .page-header {
            display: flex;
            align-items: center;
            gap: 18px;
            margin-bottom: 42px;
        }

        .page-icon {
            width: 64px;
            height: 64px;
            display: grid;
            place-items: center;
            font-size: 28px;
            border-radius: 18px;
            background: linear-gradient(135deg, #1f2a44, #2b3760);
            box-shadow: var(--shadow);
            color: var(--accent);
        }

        .page-text h1 { margin: 0; font-weight: 700; }
        .page-text p { margin: 4px 0 0; color: var(--text-muted); }

        /* ================= CARD ================= */
        .card-box {
            background: linear-gradient(160deg, #1a1f2e, #141826);
            border: 1px solid var(--border-color);
            box-shadow: var(--shadow);
            padding: 30px;
            border-radius: 22px;
            margin-bottom: 26px;
        }

        /* ================= TABLE ================= */
        .table {
            background: transparent !important;
            color: var(--text-main);
        }

        .table thead th {
            background: rgba(255, 255, 255, 0.06);
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 0.7px;
            color: var(--text-muted);
            padding: 16px;
            border-bottom: 1px solid var(--border-color) !important;
        }

        .table tbody td {
            font-size: 14px;
            padding: 16px;
            border-bottom: 1px solid var(--border-color);
            vertical-align: middle;
        }

        .table tbody tr:hover { background: rgba(255, 255, 255, 0.04); }

        /* ================= SEARCH & PAGINATION ================= */
        .search-box {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid var(--border-color);
            color: #fff;
            border-radius: 12px;
            padding: 10px 18px;
        }
        .search-box:focus {
            background: rgba(255, 255, 255, 0.1);
            border-color: var(--accent);
            box-shadow: none;
            color: #fff;
        }

        .pagination .page-link {
            background: var(--bg-card);
            border: 1px solid var(--border-color);
            color: var(--text-muted);
            margin: 0 3px;
            border-radius: 8px;
        }
        .pagination .page-item.active .page-link {
            background: var(--accent);
            color: #000;
            border-color: var(--accent);
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
    <ul class="submenu open"> <li><a href="/admin/masters/artists"><i class="fas fa-microphone"></i> Artists</a></li>
        <li><a href="/admin/masters/events"><i class="fas fa-calendar"></i> Events</a></li>
        <li><a href="/admin/masters/venues"><i class="fas fa-location-dot"></i> Venues</a></li>
        <li><a href="/admin/masters/tickettypes"><i class="fas fa-ticket"></i> Ticket Types</a></li>
        <li><a href="/admin/masters/users" class="active"><i class="fas fa-users"></i> Users</a></li>
    </ul>

    <div class="section-title" onclick="toggleSubmenu(this)">TRANSAKSI <i class="fas fa-chevron-down"></i></div>
    <ul class="submenu">
        <li><a href="/admin/transactions/orders"><i class="fas fa-receipt"></i> Orders</a></li>
        <li><a href="/admin/transactions/payments"><i class="fas fa-credit-card"></i> Payments</a></li>
        <li><a href="/admin/transactions/checkin"><i class="fas fa-qrcode"></i> Check-in</a></li>
        <li><a href="/admin/transactions/refunds"><i class="fas fa-rotate-left"></i> Refunds</a></li>
    </ul>
</div>

<div class="content">
    <div class="page-header">
        <div class="page-icon"><i class="fas fa-users"></i></div>
        <div class="page-text">
            <h1>Users Management</h1>
            <p>Kelola data pengguna dan hak akses sistem.</p>
        </div>
    </div>

    <div class="card-box">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h5 class="mb-0" style="font-weight: 600;">Daftar Pengguna</h5>
            <form method="get" class="d-flex gap-2">
                <input type="text" name="keyword" class="form-control search-box" 
                       placeholder="Cari user..." value="<?= $keyword ?? '' ?>" style="width: 250px;">
                <button class="btn btn-warning" style="border-radius: 12px; font-weight: 600;"><i class="fas fa-search"></i></button>
            </form>
        </div>

        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th width="60">#</th>
                        <th>Username</th>
                        <th>Nama Lengkap</th>
                        <th>Email</th>
                        <th>No. Telepon</th>
                        <th>Alamat</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(!empty($users)): ?>
                        <?php $no = 1 + (($currentPage - 1) * $perPage); ?>
                        <?php foreach ($users as $u): ?>
                            <tr>
                                <td class="text-muted"><?= $no++ ?></td>
                                <td style="color: var(--accent); font-weight: 600;"><?= esc($u['username']) ?></td>
                                <td><?= esc($u['nama']) ?></td>
                                <td><?= esc($u['email']) ?></td>
                                <td><?= esc($u['nomor_telepon']) ?></td>
                                <td class="text-muted"><?= esc($u['alamat'] ?? '-') ?></td>
                            </tr>
                        <?php endforeach ?>
                    <?php else: ?>
                        <tr><td colspan="6" class="text-center py-5 text-muted">Data user tidak ditemukan.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <?php if(isset($pager)): ?>
        <div class="mt-4 d-flex justify-content-center">
            <?= $pager->links('users', 'default_full') ?>
        </div>
        <?php endif; ?>
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