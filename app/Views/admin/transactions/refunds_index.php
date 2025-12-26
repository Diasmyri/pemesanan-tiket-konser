<?php
$page    = $page ?? 1;
$perPage = $perPage ?? 10;
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Refunds - Admin Panel</title>

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

* { box-sizing: border-box; }

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

.brand { font-size: 22px; font-weight: 700; color: var(--accent); text-align: center; margin-bottom: 42px; letter-spacing: 0.5px; }

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
.section-title i { transition: var(--transition); }

.submenu { display: none; margin-left: 16px; padding-left: 0; list-style: none; }
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

.sidebar a:hover { background: var(--hover-bg); transform: translateX(6px); }
.sidebar a.active { background: linear-gradient(135deg, #1f2a44, #2b3760); font-weight: 600; box-shadow: var(--shadow); }

/* ================= CONTENT ================= */
.content { margin-left: 260px; padding: 50px 60px; position: relative; z-index: 5; }

/* ================= PAGE HEADER ================= */
.page-title { font-size: 38px; font-weight: 700; display: flex; align-items: center; gap: 14px; text-shadow: 0 10px 40px rgba(0,0,0,0.65); margin-bottom: 10px; }
.small-muted { color: var(--text-muted); margin-bottom: 36px; opacity: 0.85; font-size: 14px; }

/* ================= ALERT ================= */
.alert { padding: 12px 16px; border-radius: 12px; margin-bottom: 20px; font-size: 14px; }
.alert-success { background: rgba(40,167,69,0.15); color:#28a745; border:1px solid rgba(40,167,69,0.3); }

/* ================= CARD ================= */
.card-box {
    position: relative;
    background: linear-gradient(160deg, rgba(26,31,46,0.88), rgba(20,24,38,0.88));
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
    box-shadow: 0 0 0 1px rgba(255,213,79,0.18), 0 30px 90px rgba(0,0,0,0.75);
}

/* ================= TOP ACTION ================= */
.top-actions { display:flex; justify-content:space-between; align-items:center; margin-bottom:22px; flex-wrap:wrap; gap:15px; }
.action-btn {
    background: linear-gradient(135deg,#1f2a44,#2b3760);
    padding:12px 22px;
    border-radius:14px;
    color:#fff;
    font-weight:600;
    display:flex;
    align-items:center;
    gap:8px;
    transition:var(--transition);
    text-decoration:none;
    border:none;
}
.action-btn:hover { transform:translateY(-2px); box-shadow: var(--shadow); }

/* ================= TABLE ================= */
.table { background:transparent !important; color:#fff; margin-bottom:0; }
.table thead th { background: rgba(255,255,255,0.06); font-size:11px; text-transform:uppercase; color:var(--text-muted); padding:14px; border-bottom:1px solid var(--border-color); font-weight:600; }
.table tbody td { padding:16px; border-bottom:1px solid var(--border-color); vertical-align:middle; font-size:14px; }
.table tbody tr:hover { background: rgba(255,255,255,0.05); }
.table tbody tr:last-child td { border-bottom:none; }

/* ================= ACTION BUTTON ================= */
.btn-action { width:36px; height:36px; border-radius:10px; display:inline-flex; align-items:center; justify-content:center; transition:var(--transition); margin-right:8px; border:none; text-decoration:none; }
.btn-approve { background: rgba(40,167,69,0.15); color:#28a745; }
.btn-approve:hover { background: rgba(40,167,69,0.35); transform: scale(1.05); }
.btn-reject { background: rgba(255,90,90,0.15); color:#ff6b6b; }
.btn-reject:hover { background: rgba(255,90,90,0.35); transform: scale(1.05); }

/* ================= PAGINATION ================= */
.mt-3 { margin-top:20px !important; }
.pagination { display:flex; justify-content:center; margin:0; }
.pagination .page-link { background: rgba(17,24,41,0.85); border:1px solid var(--border-color); color: var(--text-main); padding:8px 12px; border-radius:8px; margin:0 2px; transition:var(--transition); }
.pagination .page-link:hover { background: var(--hover-bg); color: var(--accent); }
.pagination .page-item.active .page-link { background: var(--accent); color: var(--bg-main); border-color: var(--accent); }

/* ================= RESPONSIVE ================= */
@media(max-width:768px){
    .bg-video{display:none;}
    .sidebar{position:relative;width:100%;height:auto;padding:20px;}
    .content{margin-left:0;padding:32px 22px;}
    .page-title{font-size:28px;flex-direction:column;gap:10px;text-align:center;}
    .top-actions{flex-direction:column;align-items:stretch;}
    .search-box{width:100%;}
    .table-responsive{overflow-x:auto;}
    .card-box{padding:20px;}
    .btn-action{width:32px;height:32px;}
}
</style>
</head>
<body>

<!-- BACKGROUND VIDEO -->
<video autoplay muted loop playsinline class="bg-video" poster="https://images.unsplash.com/photo-1518972559570-7cc1309f3229?auto=format&fit=crop&w=2400&q=80">
    <source src="https://cdn.coverr.co/videos/coverr-concert-crowd-light-show-1596/1080p.mp4" type="video/mp4">
</video>
</head>

<body>

<!-- SIDEBAR -->
<div class="sidebar">
    <div class="brand">Admin Panel - Ticketing</div>

    <div class="section-title">MAIN</div>
    <a href="/admin/dashboard"><i class="fas fa-gauge"></i> Dashboard</a>

    <div class="section-title" onclick="toggleSubmenu(this)">
        TRANSAKSI <i class="fas fa-chevron-down"></i>
    </div>
    <ul class="submenu open">
        <li><a href="/admin/transactions/orders"><i class="fas fa-receipt"></i> Orders</a></li>
        <li><a href="/admin/transactions/payments"><i class="fas fa-credit-card"></i> Payments</a></li>
        <li><a href="/admin/transactions/checkin"><i class="fas fa-qrcode"></i> Check-in</a></li>
        <li><a href="/admin/transactions/refunds/create" class="active">
            <i class="fas fa-rotate-left"></i> Refunds
        </a></li>
    </ul>
</div>

<!-- CONTENT -->
<div class="content">
    <div class="page-title">
        <i class="fas fa-rotate-left"></i> Refunds
    </div>
    <p class="small-muted">Kelola pengajuan refund tiket (manual).</p>

    <div class="card-box">

        <?php if(session()->getFlashdata('success')): ?>
            <div class="alert alert-success">
                <?= session()->getFlashdata('success') ?>
            </div>
        <?php endif; ?>

        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Order ID</th>
                    <th>User</th>
                    <th>Tanggal Request</th>
                    <th>Status</th>
                    <th width="160">Aksi</th>
                </tr>
                </thead>
                <tbody>

                <?php if(empty($refunds)): ?>
                    <tr>
                        <td colspan="6" class="text-center text-muted">
                            Tidak ada data refund
                        </td>
                    </tr>
                <?php else: ?>
                    <?php $no = 1 + ($page-1)*$perPage; ?>
                    <?php foreach($refunds as $r): ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $r['order_id'] ?></td>
                        <td><?= $r['customer_name'] ?></td>
                        <td><?= date('d M Y', strtotime($r['created_at'])) ?></td>
                        <td>
                            <span class="badge bg-secondary">
                                <?= ucfirst($r['status']) ?>
                            </span>
                        </td>
                        <td>

                            <?php if($r['status'] === 'pending'): ?>
                                <a href="/admin/transactions/refunds/approve/<?= $r['id'] ?>"
                                   class="btn-action btn-approve" title="Approve">
                                    <i class="fas fa-check"></i>
                                </a>

                                <a href="/admin/transactions/refunds/reject/<?= $r['id'] ?>"
                                   class="btn-action btn-reject" title="Reject">
                                    <i class="fas fa-times"></i>
                                </a>

                            <?php elseif($r['status'] === 'approved'): ?>
                                <a href="/admin/transactions/refunds/refunded/<?= $r['id'] ?>"
                                   class="btn-action btn-approve"
                                   title="Uang sudah dikembalikan (manual)">
                                    <i class="fas fa-money-bill-wave"></i>
                                </a>

                            <?php else: ?>
                                <span class="text-muted">
                                    <?= ucfirst($r['status']) ?>
                                </span>
                            <?php endif; ?>

                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php endif; ?>

                </tbody>
            </table>
        </div>

        <div class="mt-3">
            <?= $pager->links('default','default_full') ?? '' ?>
        </div>

    </div>
</div>

<script>
function toggleSubmenu(el){
    const submenu = el.nextElementSibling;
    submenu.classList.toggle('open');
}
</script>

</body>
</html>
