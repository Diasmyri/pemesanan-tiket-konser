<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Events - Admin Panel</title>

    <link rel="stylesheet" href="/assets/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">

    <style>
        /* ================= ROOT ================= */
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

        * {
            box-sizing: border-box;
        }

        /* ================= BODY ================= */
        body {
            margin: 0;
            font-family: 'Poppins', sans-serif;
            background: var(--bg-main);
            color: var(--text-main);
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

        .section-title:hover {
            color: var(--accent);
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
            position: relative;
            z-index: 5;
        }

        .page-title {
            font-size: 38px;
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 14px;
            text-shadow: 0 10px 40px rgba(0, 0, 0, 0.65);
        }

        .small-muted {
            color: var(--text-muted);
            margin-bottom: 36px;
            opacity: 0.85;
        }

        /* ================= ALERT ================= */
        .alert {
            padding: 12px 16px;
            border-radius: 12px;
            margin-bottom: 20px;
            font-size: 14px;
        }

        .alert-success {
            background: rgba(40, 167, 69, 0.15);
            color: #28a745;
            border: 1px solid rgba(40, 167, 69, 0.3);
        }

        .alert-danger {
            background: rgba(220, 53, 69, 0.15);
            color: #dc3545;
            border: 1px solid rgba(220, 53, 69, 0.3);
        }

        /* ================= CARD (GLASS) ================= */
        .card-box {
            position: relative;
            background: linear-gradient(160deg, rgba(26, 31, 46, 0.88), rgba(20, 24, 38, 0.88));
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid var(--border-color);
            border-radius: 22px;
            padding: 30px;
            box-shadow: var(--shadow);
            transition: var(--transition);
        }

        .card-box:hover {
            transform: translateY(-4px);
            box-shadow: 0 0 0 1px rgba(255, 213, 79, 0.18), 0 30px 90px rgba(0, 0, 0, 0.75);
        }

        /* ================= TOP ACTION ================= */
        .top-actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 22px;
            flex-wrap: wrap;
            gap: 15px;
        }

        .action-btn {
            background: linear-gradient(135deg, #1f2a44, #2b3760);
            padding: 12px 22px;
            border-radius: 14px;
            color: #fff;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: var(--transition);
            text-decoration: none;
            border: none;
        }

        .action-btn:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow);
            color: #fff;
        }

        /* ================= SEARCH ================= */
        .search-box {
            background: rgba(17, 24, 41, 0.85);
            border: 1px solid var(--border-color);
            color: #fff;
            padding: 12px 16px;
            border-radius: 12px;
            width: 260px;
            font-size: 14px;
            transition: var(--transition);
        }

        .search-box:focus {
            outline: none;
            border-color: var(--accent);
            box-shadow: 0 0 0 2px rgba(255, 213, 79, 0.2);
        }

        /* ================= TABLE ================= */
        .table {
            background: transparent !important;
            color: #fff;
        }

        .table thead th {
            background: rgba(255, 255, 255, 0.06);
            font-size: 11px;
            text-transform: uppercase;
            color: var(--text-muted);
            padding: 14px;
            border-bottom: 1px solid var(--border-color);
            font-weight: 600;
        }

        .table tbody td {
            padding: 16px;
            border-bottom: 1px solid var(--border-color);
            vertical-align: middle;
            font-size: 14px;
        }

        .table tbody tr:hover {
            background: rgba(255, 255, 255, 0.05);
        }

        .event-poster {
            width: 60px;
            height: 80px;
            object-fit: cover;
            border-radius: 8px;
            border: 1px solid rgba(255, 255, 255, 0.12);
        }

        /* ================= ACTION BUTTON ================= */
        .btn-action {
            width: 36px;
            height: 36px;
            border-radius: 10px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            transition: var(--transition);
            margin-right: 8px;
            border: none;
            text-decoration: none;
        }

        .btn-edit { background: rgba(255, 213, 79, 0.15); color: #ffd54f; }
        .btn-edit:hover { background: rgba(255, 213, 79, 0.35); transform: scale(1.05); }

        .btn-delete { background: rgba(255, 90, 90, 0.15); color: #ff6b6b; }
        .btn-delete:hover { background: rgba(255, 90, 90, 0.35); transform: scale(1.05); }

        /* ================= PAGINATION ================= */
        .pagination {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }

        @media (max-width: 768px) {
            .sidebar { position: relative; width: 100%; height: auto; }
            .content { margin-left: 0; padding: 32px 22px; }
            .top-actions { flex-direction: column; align-items: stretch; }
        }
    </style>
</head>

<body>

<video autoplay muted loop playsinline class="bg-video"
poster="https://images.unsplash.com/photo-1518972559570-7cc1309f3229?auto=format&fit=crop&w=2400&q=80">
    <source src="https://cdn.coverr.co/videos/coverr-concert-crowd-light-show-1596/1080p.mp4" type="video/mp4">
</video>

<div class="sidebar">
    <div class="brand">Admin Panel - Ticketing</div>
    <div class="section-title">MAIN</div>
    <a href="/admin/dashboard"><i class="fas fa-gauge"></i> Dashboard</a>

    <div class="section-title" onclick="toggleSubmenu(this)">
        MASTERS <i class="fas fa-chevron-down"></i>
    </div>
    <ul class="submenu">
        <li><a href="/admin/masters/artists"><i class="fas fa-microphone"></i> Artists</a></li>
        <li><a href="/admin/masters/events" class="active"><i class="fas fa-calendar-days"></i> Events</a></li>
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
        <li><a href="/admin/transactions/refunds"><i class="fas fa-plus"></i> Ajukan Refund</a></li>
    </ul>

</div>

<div class="content">
    <div class="page-title">
        <i class="fas fa-calendar-days"></i> Events
    </div>
    <p class="small-muted">Kelola data event konser.</p>

    <div class="card-box">
        <?php if (session()->getFlashdata('success')) : ?>
            <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
        <?php endif; ?>
        <?php if (session()->getFlashdata('error')) : ?>
            <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
        <?php endif; ?>

        <div class="top-actions">
            <a href="/admin/masters/events/create" class="action-btn">
                <i class="fas fa-plus"></i> Tambah Event
            </a>
            <form method="get">
                <input type="text" class="search-box" name="keyword"
                       placeholder="Cari judul, artis, venue..." value="<?= esc($keyword ?? '') ?>">
            </form>
        </div>

        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th width="70">Poster</th>
                        <th>Judul</th>
                        <th>Artist</th>
                        <th>Venue</th>
                        <th>Tanggal</th>
                        <th>Jam</th>
                        <th width="150">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                <?php if (empty($events)) : ?>
                    <tr>
                        <td colspan="7" class="text-center text-secondary">Tidak ada data.</td>
                    </tr>
                <?php else : ?>
                    <?php foreach ($events as $e) : ?>
                    <tr>
                        <td>
                            <?php if ($e['poster']) : ?>
                                <img src="/uploads/events/<?= $e['poster'] ?>" class="event-poster">
                            <?php else : ?>
                                <span class="text-secondary">No Image</span>
                            <?php endif; ?>
                        </td>
                        <td><?= esc($e['title']) ?></td>
                        <td>
                            <?php if (!empty($e['artists'])): ?>
                                <?= esc(implode(', ', array_column($e['artists'], 'name'))) ?>
                            <?php else: ?>
                                -
                            <?php endif; ?>
                        </td>
                        <td><?= esc($e['venue_name']) ?></td>
                        <td><?= date('d M Y', strtotime($e['date'])) ?></td>
                        <td><?= substr($e['start_time'],0,5) ?> - <?= substr($e['end_time'],0,5) ?></td>
                        <td>
                            <?php if($e['editable']): ?>
                                <a href="/admin/masters/events/edit/<?= $e['id'] ?>" class="btn-action btn-edit" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                            <?php else: ?>
                                <span class="badge bg-secondary" style="font-size:10px;">Locked</span>
                            <?php endif; ?>

                            <a href="/admin/masters/events/delete/<?= $e['id'] ?>"
                               onclick="return confirm('Hapus event ini? Semua data terkait akan hilang.')"
                               class="btn-action btn-delete" title="Hapus">
                                <i class="fas fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                    <?php endforeach ?>
                <?php endif ?>
                </tbody>
            </table>
        </div>

        <div class="pagination">
            <?= $pager->links('default', 'default_full') ?>
        </div>
    </div>
</div>

<script>
function toggleSubmenu(element) {
    const submenu = element.nextElementSibling;
    const icon = element.querySelector('i');
    submenu.classList.toggle('open');
    icon.style.transform = submenu.classList.contains('open') ? 'rotate(180deg)' : 'rotate(0deg)';
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