<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Check-in Gate - Admin Panel</title>

    <link rel="stylesheet" href="/assets/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">

    <style>
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

    /* Background Video Setup */
    .bg-video { position: fixed; inset: 0; width: 100%; height: 100%; object-fit: cover; z-index: -3; filter: brightness(0.45) saturate(0.9) blur(1.2px); pointer-events: none; }
    body::after { content: ""; position: fixed; inset: 0; background: radial-gradient(circle at top, rgba(255, 255, 255, 0.08), transparent 45%), linear-gradient(rgba(10, 12, 20, 0.78), rgba(10, 12, 20, 0.85)); z-index: -2; pointer-events: none; }

    /* Sidebar & Nav Styles */
    .sidebar { position: fixed; top: 0; left: 0; width: 260px; height: 100vh; background: linear-gradient(180deg, #111423, #0d101a); border-right: 1px solid var(--border-color); padding: 32px 24px; z-index: 1000; overflow-y: auto; }
    .brand { font-size: 22px; font-weight: 700; color: var(--accent); text-align: center; margin-bottom: 42px; letter-spacing: 0.5px; }
    .section-title { font-size: 11px; color: var(--text-muted); margin: 30px 0 12px; letter-spacing: 1.6px; text-transform: uppercase; cursor: pointer; display: flex; align-items: center; justify-content: space-between; padding: 8px 0; transition: var(--transition); }
    .section-title:hover { color: var(--accent); }
    .submenu { display: none; margin-left: 16px; padding-left: 0; list-style: none; }
    .submenu.open { display: block; }
    .sidebar a { display: flex; align-items: center; gap: 12px; padding: 12px 16px; margin-bottom: 10px; font-size: 14px; color: var(--text-main); text-decoration: none; border-radius: 12px; transition: var(--transition); }
    .sidebar a:hover { background: var(--hover-bg); transform: translateX(6px); }
    .sidebar a.active { background: linear-gradient(135deg, #1f2a44, #2b3760); font-weight: 600; box-shadow: var(--shadow); }

    /* Content & Tables */
    .content { margin-left: 260px; padding: 50px 60px; position: relative; z-index: 5; }
    .page-title { font-size: 38px; font-weight: 700; display: flex; align-items: center; gap: 14px; text-shadow: 0 10px 40px rgba(0, 0, 0, 0.65); margin-bottom: 10px; }
    .small-muted { color: var(--text-muted); margin-bottom: 36px; opacity: 0.85; font-size: 14px; }
    .card-box { position: relative; background: linear-gradient(160deg, rgba(26, 31, 46, 0.88), rgba(20, 24, 38, 0.88)); backdrop-filter: blur(16px); -webkit-backdrop-filter: blur(16px); border: 1px solid var(--border-color); border-radius: 22px; padding: 30px; box-shadow: var(--shadow); transition: var(--transition); }
    
    .table { background: transparent !important; color: #fff; margin-bottom: 0; }
    .table thead th { background: rgba(255, 255, 255, 0.06); font-size: 11px; text-transform: uppercase; color: var(--text-muted); padding: 14px; border-bottom: 1px solid var(--border-color); }
    .table tbody td { padding: 16px; border-bottom: 1px solid var(--border-color); vertical-align: middle; font-size: 14px; }
    
    /* Search Box */
    .search-container { margin-bottom: 25px; display: flex; justify-content: flex-end; }
    .search-box { background: rgba(17, 24, 41, 0.85); border: 1px solid var(--border-color); color: #fff; padding: 12px 16px; border-radius: 12px; width: 350px; font-size: 14px; transition: var(--transition); }
    .search-box:focus { outline: none; border-color: var(--accent); box-shadow: 0 0 15px rgba(255, 213, 79, 0.15); }

    /* Check-in Specific Styles */
    .ticket-box { font-family: 'Courier New', monospace; background: rgba(255, 213, 79, 0.1); color: var(--accent); padding: 4px 10px; border-radius: 6px; border: 1px dashed rgba(255, 213, 79, 0.5); font-weight: 700; letter-spacing: 1px; }
    .status-badge { padding: 6px 12px; border-radius: 8px; font-size: 11px; font-weight: 600; display: inline-flex; align-items: center; gap: 6px; }
    .status-in { background: rgba(40, 167, 69, 0.2); color: #28a745; }
    .status-wait { background: rgba(255, 255, 255, 0.05); color: #777; }
    .btn-checkin { background: var(--accent); color: #000; border: none; padding: 8px 18px; border-radius: 10px; font-weight: 700; font-size: 12px; transition: var(--transition); text-decoration: none; display: inline-flex; align-items: center; gap: 8px; }
    .btn-checkin:hover { transform: translateY(-2px); box-shadow: 0 5px 15px rgba(255, 213, 79, 0.3); color: #000; }
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
        <li><a href="/admin/transactions/checkin" class="active"><i class="fas fa-qrcode"></i> Check-in</a></li>
        <li><a href="/admin/transactions/refunds"><i class="fas fa-plus"></i> Ajukan Refund</a></li>
    </ul>

</div>

<div class="content">

    <div class="page-title">
        <i class="fas fa-qrcode"></i> Check-in Gate
    </div>
    <p class="small-muted">Verifikasi tiket dan kedatangan penonton di lokasi event.</p>

    <div class="card-box">
        <?php if(session()->getFlashdata('success')): ?>
            <div class="alert alert-success" style="background: rgba(40,167,69,0.2); border:none; color:#28a745;"><?= session()->getFlashdata('success') ?></div>
        <?php endif; ?>

        <div class="search-container">
            <input type="text" id="checkinSearch" class="search-box" placeholder="Cari Kode Tiket, Nama User, atau Event...">
        </div>

        <div class="table-responsive">
            <table class="table table-hover" id="checkinTable">
                <thead>
                    <tr>
                        <th>Ticket Code</th>
                        <th>User</th>
                        <th>Event / Type</th>
                        <th>Waktu Check-in</th>
                        <th>Status</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                <?php if(empty($checkins)): ?>
                    <tr class="no-data"><td colspan="6" class="text-center text-muted py-5">Belum ada data tiket yang tersedia.</td></tr>
                <?php else: ?>
                    <?php foreach ($checkins as $c): ?>
                    <tr>
                        <td><span class="ticket-box"><?= $c['ticket_code'] ?></span></td>
                        <td>
                            <span class="fw-bold text-white"><?= esc($c['user_name']) ?></span><br>
                            <small class="text-muted">#ORD-<?= $c['order_id'] ?></small>
                        </td>
                        <td>
                            <span style="color: var(--accent)"><?= esc($c['event_name']) ?></span><br>
                            <small class="text-muted"><?= esc($c['ticket_type_name']) ?></small>
                        </td>
                        <td>
                            <span class="text-white">
                                <?= $c['checked_in_at'] ? date('d M, H:i', strtotime($c['checked_in_at'])) : '<small class="text-muted">— Belum Masuk —</small>' ?>
                            </span>
                        </td>
                        <td>
                            <?php if($c['checkin_status'] == 'checked_in'): ?>
                                <span class="status-badge status-in"><i class="fas fa-check-circle"></i> IN GATE</span>
                            <?php else: ?>
                                <span class="status-badge status-wait"><i class="fas fa-circle-notch"></i> OUTSIDE</span>
                            <?php endif; ?>
                        </td>
                        <td class="text-center">
                            <?php if(!$c['checkin_status']): ?>
                                <a href="/admin/transactions/checkin/process/<?= $c['order_id'] ?>" 
                                   class="btn-checkin" onclick="return confirm('Konfirmasi Check-in untuk Tiket ini?')">
                                    <i class="fas fa-sign-in-alt"></i> SCAN & ENTER
                                </a>
                            <?php else: ?>
                                <span style="color: #28a745; font-size: 12px; font-weight: 600;">
                                    <i class="fas fa-circle-check"></i> VERIFIED
                                </span>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php endforeach ?>
                <?php endif ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
// Toggle Submenu Sidebar
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

// Auto-open Submenu if active
document.addEventListener('DOMContentLoaded', function() {
    const activeLink = document.querySelector('.submenu a.active');
    if (activeLink) {
        const submenu = activeLink.closest('.submenu');
        const sectionTitle = submenu.previousElementSibling;
        const icon = sectionTitle.querySelector('i');
        submenu.classList.add('open');
        icon.style.transform = 'rotate(180deg)';
    }

    // Real-time Search Logic
    const searchInput = document.getElementById('checkinSearch');
    const tableRows = document.querySelectorAll('#checkinTable tbody tr:not(.no-data)');

    searchInput.addEventListener('input', function() {
        const query = this.value.toLowerCase();
        
        tableRows.forEach(row => {
            const text = row.innerText.toLowerCase();
            row.style.display = text.includes(query) ? '' : 'none';
        });
    });
});
</script>

</body>
</html>