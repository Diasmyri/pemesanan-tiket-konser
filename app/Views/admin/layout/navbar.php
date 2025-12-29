<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticketing.AI - Pro Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --side-bg: #0f1115;
            --accent: #6366f1;
            --accent-glow: rgba(99, 102, 241, 0.4);
            --text-dim: #94a3b8;
            --glass: rgba(255, 255, 255, 0.03);
            --font-main: 'Plus Jakarta Sans', sans-serif;
        }

        body {
            background-color: #f8fafc;
            font-family: var(--font-main);
            overflow-x: hidden;
        }

        .sidebar {
            width: 280px;
            height: 100vh;
            background: var(--side-bg);
            position: fixed;
            left: 0; top: 0;
            z-index: 1000;
            border-right: 1px solid rgba(255,255,255,0.05);
            display: flex;
            flex-direction: column;
            transition: all 0.3s ease;
        }

        .brand-box {
            padding: 35px 25px;
            background: linear-gradient(to bottom, rgba(99, 102, 241, 0.05), transparent);
        }

        .logo-icon {
            width: 45px; height: 45px;
            background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
            border-radius: 14px;
            display: flex; align-items: center; justify-content: center;
            box-shadow: 0 8px 20px var(--accent-glow);
            margin-right: 15px;
        }

        .brand-name {
            font-weight: 800; font-size: 1.4rem; color: #fff;
            letter-spacing: -0.5px; margin: 0;
        }

        .live-status {
            font-size: 10px; background: rgba(34, 197, 94, 0.1);
            color: #22c55e; padding: 2px 8px; border-radius: 20px;
            border: 1px solid rgba(34, 197, 94, 0.2);
            display: inline-flex; align-items: center; gap: 5px; margin-top: 5px;
        }

        .dot { width: 6px; height: 6px; background: #22c55e; border-radius: 50%; animation: pulse 1.5s infinite; }
        @keyframes pulse { 0% { transform: scale(1); opacity: 1; } 50% { transform: scale(1.5); opacity: 0.5; } 100% { transform: scale(1); opacity: 1; } }

        .nav-scroll { flex: 1; padding: 10px 18px; overflow-y: auto; }
        .menu-label { color: #475569; font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: 1.5px; margin: 25px 12px 12px; }

        .nav-link-custom {
            display: flex; align-items: center; padding: 12px 16px;
            color: var(--text-dim); text-decoration: none; border-radius: 12px;
            margin-bottom: 5px; transition: all 0.2s; font-weight: 500; font-size: 14.5px;
        }

        .nav-link-custom i { width: 24px; font-size: 18px; margin-right: 12px; }
        .nav-link-custom:hover { background: var(--glass); color: #fff; }
        .nav-link-custom.active { background: var(--accent); color: #fff; box-shadow: 0 10px 20px rgba(99, 102, 241, 0.2); }

        .btn-dropdown { width: 100%; border: none; background: none; text-align: left; display: flex; align-items: center; }
        .btn-dropdown i.fa-chevron-right { margin-left: auto; font-size: 11px; transition: 0.3s; }

        .sub-menu { list-style: none; padding-left: 45px; margin-bottom: 10px; display: none; }
        .sub-menu.show { display: block; animation: slideDown 0.3s ease; }
        .sub-menu a { color: var(--text-dim); text-decoration: none; font-size: 13.5px; padding: 8px 0; display: block; transition: 0.2s; }
        .sub-menu a:hover { color: var(--accent); }

        .sidebar-user { padding: 20px; background: rgba(0,0,0,0.2); border-top: 1px solid rgba(255,255,255,0.05); }
        .user-card { display: flex; align-items: center; gap: 12px; background: var(--glass); padding: 12px; border-radius: 15px; }
        .user-img { width: 38px; height: 38px; border-radius: 10px; background: var(--accent); display: flex; align-items: center; justify-content: center; color: #fff; }
        
        .logout-pill { display: block; width: 100%; margin-top: 12px; padding: 10px; border-radius: 10px; border: 1px solid rgba(248, 113, 113, 0.2); color: #f87171; text-align: center; text-decoration: none; font-size: 13px; font-weight: 600; transition: 0.3s; }
        .logout-pill:hover { background: #f87171; color: #fff; }

        .main-content { margin-left: 280px; padding: 0; min-height: 100vh; width: calc(100% - 280px); }
        @keyframes slideDown { from { opacity: 0; transform: translateY(-10px); } to { opacity: 1; transform: translateY(0); } }
    </style>
</head>
<body>

    <aside class="sidebar">
        <div class="brand-box">
            <div class="d-flex align-items-center">
                <div class="logo-icon"><i class="fas fa-bolt text-white"></i></div>
                <div>
                    <h1 class="brand-name">TIX-PRO</h1>
                    <div class="live-status"><span class="dot"></span> System Live</div>
                </div>
            </div>
        </div>

        <div class="nav-scroll">
            <p class="menu-label">Main</p>
            <a href="/admin/dashboard" class="nav-link-custom active">
                <i class="fas fa-tachometer-alt"></i> Dashboard
            </a>

            <p class="menu-label">Masters</p>
            <button class="nav-link-custom btn-dropdown" onclick="toggleSub('masterSub')">
                <i class="fas fa-database"></i> <span>Master Data</span>
                <i class="fas fa-chevron-right" id="icon-masterSub"></i>
            </button>
            <ul class="sub-menu" id="masterSub">
                <li><a href="/admin/masters/artists"><i class="fas fa-microphone me-2"></i> Artists</a></li>
                <li><a href="/admin/masters/events"><i class="fas fa-calendar-alt me-2"></i> Events</a></li>
                <li><a href="/admin/masters/venues"><i class="fas fa-map-marker-alt me-2"></i> Venues</a></li>
                <li><a href="/admin/masters/tickettypes"><i class="fas fa-ticket-alt me-2"></i> Ticket Types</a></li>
                <li><a href="/admin/masters/users"><i class="fas fa-users me-2"></i> Users</a></li>
            </ul>

            <p class="menu-label">Transaksi</p>
            <button class="nav-link-custom btn-dropdown" onclick="toggleSub('transSub')">
                <i class="fas fa-exchange-alt"></i> <span>Transactions</span>
                <i class="fas fa-chevron-right" id="icon-transSub"></i>
            </button>
            <ul class="sub-menu" id="transSub">
                <li><a href="/admin/transactions/orders"><i class="fas fa-file-invoice me-2"></i> Orders</a></li>
                <li><a href="/admin/transactions/payments"><i class="fas fa-credit-card me-2"></i> Payments</a></li>
                <li><a href="/admin/transactions/checkin"><i class="fas fa-qrcode me-2"></i> Check-in</a></li>
                <li><a href="/admin/transactions/refunds"><i class="fas fa-undo me-2"></i> Ajukan Refund</a></li>
            </ul>

            <p class="menu-label">Analysis</p>
            <a href="/admin/laporan/harian" class="nav-link-custom">
                <i class="fas fa-chart-bar"></i> Daily Analytics
            </a>
        </div>

        <div class="sidebar-user">
            <div class="user-card">
                <div class="user-img"><i class="fas fa-user-shield"></i></div>
                <div class="overflow-hidden">
                    <div class="text-white fw-bold text-truncate" style="font-size: 14px;">Admin Utama</div>
                    <div class="text-muted" style="font-size: 11px;">System Manager</div>
                </div>
            </div>
            <a href="javascript:void(0)" onclick="confirmLogout()" class="logout-pill">
                <i class="fas fa-sign-out-alt me-2"></i> Logout
            </a>
        </div>
    </aside>

    <main class="main-content">
        <?= $this->renderSection('content') ?>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function toggleSub(id) {
            const sub = document.getElementById(id);
            const icon = document.getElementById('icon-' + id);
            if (sub.style.display === "block") {
                sub.style.display = "none";
                icon.style.transform = "rotate(0deg)";
            } else {
                sub.style.display = "block";
                icon.style.transform = "rotate(90deg)";
            }
        }

        function confirmLogout() {
            if(confirm('Akhiri sesi admin sekarang?')) {
                window.location.href = '/admin/auth/logout';
            }
        }
    </script>
</body>
</html>