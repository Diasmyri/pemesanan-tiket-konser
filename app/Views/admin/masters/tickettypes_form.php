<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= $title ?></title>

    <link rel="stylesheet" href="/assets/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">

    <style>
        /* ================= ROOT ================= */
        :root {
            --bg-main: #0d0f18;
            --bg-sidebar: #111423;
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

        body {
            font-family: 'Poppins', sans-serif;
            background: var(--bg-main);
            color: var(--text-main);
            margin: 0;
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
            margin-left: 240px;
            padding: 40px 45px;
        }

        /* ================= TITLE ================= */
        .page-title {
            text-align: center;
            font-size: 34px;
            font-weight: 700;
            color: #fff;
            margin-bottom: 6px;
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 12px;
        }

        .small-muted {
            text-align: center;
            color: var(--text-muted);
            font-size: 15px;
            margin-bottom: 28px;
        }

        /* ================= CARD ================= */
        .card-box {
            background: linear-gradient(160deg, rgba(30, 37, 58, 0.85), rgba(16, 19, 33, 0.85));
            border: 1px solid var(--border-color);
            box-shadow: var(--shadow);
            padding: 35px;
            border-radius: 18px;
            max-width: 900px;
            margin: auto;
        }

        /* ================= FORM GROUP ================= */
        .form-group {
            position: relative;
            margin-bottom: 24px;
            animation: slideInUp 0.6s ease-out forwards;
            opacity: 0;
            transform: translateY(20px);
        }

        .form-group:nth-child(1) { animation-delay: 0.1s; }
        .form-group:nth-child(2) { animation-delay: 0.2s; }
        .form-group:nth-child(3) { animation-delay: 0.3s; }
        .form-group:nth-child(4) { animation-delay: 0.4s; }
        .form-group:nth-child(5) { animation-delay: 0.5s; }
        .form-group:nth-child(6) { animation-delay: 0.6s; }
        .form-group:nth-child(7) { animation-delay: 0.7s; }
        .form-actions { animation-delay: 0.8s; }

        @keyframes slideInUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        label {
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 8px;
            color: #d9e2ff;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        label i {
            color: var(--accent);
            font-size: 16px;
        }

        /* ================= FORM CONTROL ================= */
        .form-control,
        select.form-control {
            width: 100%;
            background: linear-gradient(135deg, #111829, #151d33);
            border: 1px solid rgba(255, 255, 255, 0.12);
            color: #fff;
            height: 50px;
            border-radius: 12px;
            padding: 0 16px;
            transition: var(--transition);
            font-size: 14px;
            box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .form-control:hover {
            border-color: rgba(255, 213, 79, 0.3);
            box-shadow: 0 0 8px rgba(255, 213, 79, 0.1);
        }

        .form-control:focus {
            border-color: var(--accent);
            box-shadow: 0 0 12px rgba(255, 213, 79, 0.4), inset 0 2px 4px rgba(0, 0, 0, 0.1);
            background: linear-gradient(135deg, #151d33, #1a2138);
            transform: translateY(-2px);
            outline: none;
        }

        textarea.form-control {
            height: 140px !important;
            padding-top: 14px;
            resize: vertical;
        }

        input[type="file"].form-control {
            height: auto !important;
            padding: 12px 16px;
            cursor: pointer;
        }

        input[type="file"].form-control:hover {
            background: linear-gradient(135deg, #151d33, #1a2138);
        }

        /* ================= PREVIEW ================= */
        .preview-container {
            margin-top: 16px;
            text-align: center;
        }

        .preview-img {
            border-radius: 12px;
            width: 200px;
            height: 200px;
            object-fit: cover;
            border: 2px solid rgba(255, 255, 255, 0.1);
            box-shadow: var(--shadow);
            transition: var(--transition);
            display: block;
            margin: 0 auto;
        }

        .preview-img:hover {
            transform: scale(1.05);
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.4);
        }

        /* ================= FORM ACTIONS ================= */
        .form-actions {
            text-align: center;
            margin-top: 30px;
            animation: slideInUp 0.6s ease-out forwards;
            opacity: 0;
            transform: translateY(20px);
        }

        .btn-save {
            background: linear-gradient(135deg, var(--primary), #2a3d6a);
            padding: 14px 28px;
            border-radius: 12px;
            color: #fff;
            border: none;
            transition: var(--transition);
            font-size: 16px;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            box-shadow: var(--shadow);
            position: relative;
            overflow: hidden;
        }

        .btn-save::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s;
        }

        .btn-save:hover {
            background: linear-gradient(135deg, #223669, var(--primary));
            transform: translateY(-3px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.5);
        }

        .btn-save:hover::before {
            left: 100%;
        }

        .btn-save:active {
            transform: translateY(-1px);
        }

        /* ================= RESPONSIVE ================= */
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
            .page-title {
                font-size: 28px;
                flex-direction: column;
                gap: 10px;
            }
            .card-box {
                padding: 20px;
            }
            .preview-img {
                width: 150px;
                height: 150px;
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
    <a href="/admin/dashboard"><i class="fas fa-gauge"></i> Dashboard</a>

    <div class="section-title" onclick="toggleSubmenu(this)">
        MASTERS <i class="fas fa-chevron-down"></i>
    </div>
    <ul class="submenu">
        <li><a href="/admin/masters/artists"><i class="fas fa-microphone"></i> Artists</a></li>
        <li><a href="/admin/masters/events"><i class="fas fa-calendar"></i> Events</a></li>
        <li><a href="/admin/masters/venues"><i class="fas fa-location-dot"></i> Venues</a></li>
        <li><a href="/admin/masters/tickettypes" class="active"><i class="fas fa-ticket"></i> Ticket Types</a></li>
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

<!-- CONTENT -->
<div class="content">

    <div class="page-title">
        <i class="fas fa-ticket"></i> <?= $title ?>
    </div>
    <p class="small-muted">Isi data tipe tiket dengan lengkap.</p>

    <div class="card-box">
        <form action="<?= $formAction ?>" method="post" class="w-100">
            <?= csrf_field() ?>

            <div class="form-group mb-4">
                <label for="event_id">
                    <i class="fas fa-calendar"></i> Pilih Event
                </label>
                <select name="event_id" id="event_id" class="form-control" required>
                    <option value="">-- Pilih Event --</option>
                    <?php foreach ($events as $e): ?>
                        <option value="<?= $e['id'] ?>"
                            <?= old('event_id', $ticket['event_id'] ?? '') == $e['id'] ? 'selected' : '' ?>>
                            <?= $e['title'] ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group mb-4">
                <label for="name">
                    <i class="fas fa-tag"></i> Nama Tipe Tiket
                </label>
                <input type="text" name="name" id="name" class="form-control"
                       value="<?= old('name', $ticket['name'] ?? '') ?>"
                       placeholder="Contoh: VIP, Regular, Festival" required>
            </div>

            <div class="form-group mb-4">
                <label for="price">
                    <i class="fas fa-dollar-sign"></i> Harga Tiket
                </label>
                <input type="number" name="price" id="price" class="form-control"
                       value="<?= old('price', $ticket['price'] ?? '') ?>"
                       placeholder="Masukkan harga tiket..." required>
            </div>

            <div class="form-group mb-4">
                <label for="stock">
                    <i class="fas fa-boxes"></i> Stok Tiket
                </label>
                <input type="number" name="stock" id="stock" class="form-control"
                       value="<?= old('stock', $ticket['stock'] ?? '') ?>"
                       placeholder="Masukkan stok tiket..." required>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn-save">
                    <i class="fas fa-save"></i> Simpan Tipe Tiket
                </button>
            </div>

        </form>
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

// Auto-open submenu jika halaman aktif ada
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