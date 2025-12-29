<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Laporan Transaksi - Admin Panel</title>

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

        /* Background Video */
        .bg-video { position: fixed; inset: 0; width: 100%; height: 100%; object-fit: cover; z-index: -3; filter: brightness(0.65) saturate(0.9) blur(1.2px); pointer-events: none; }
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

        /* Content & Tables */
        .content { margin-left: 260px; padding: 50px 60px; position: relative; z-index: 5; }
        .page-title { font-size: 38px; font-weight: 700; display: flex; align-items: center; gap: 14px; text-shadow: 0 10px 40px rgba(0, 0, 0, 0.65); margin-bottom: 10px; }
        .small-muted { color: var(--text-muted); margin-bottom: 36px; opacity: 0.85; font-size: 14px; }
        .card-box { position: relative; background: linear-gradient(160deg, rgba(26, 31, 46, 0.88), rgba(20, 24, 38, 0.88)); backdrop-filter: blur(16px); -webkit-backdrop-filter: blur(16px); border: 1px solid var(--border-color); border-radius: 22px; padding: 30px; box-shadow: var(--shadow); transition: var(--transition); }
        .table { background: transparent !important; color: #fff; margin-bottom: 0; }
        .table thead th { background: rgba(255, 255, 255, 0.06); font-size: 11px; text-transform: uppercase; color: var(--text-muted); padding: 14px; border-bottom: 1px solid var(--border-color); }
        .table tbody td { padding: 16px; border-bottom: 1px solid var(--border-color); vertical-align: middle; font-size: 14px; }
        .search-box { background: rgba(17, 24, 41, 0.85); border: 1px solid var(--border-color); color: #fff; padding: 12px 16px; border-radius: 12px; width: 300px; font-size: 14px; transition: var(--transition); }

        /* Status Badges - Refund Specific */
        .status-badge { padding: 5px 12px; border-radius: 8px; font-size: 12px; font-weight: 600; text-transform: uppercase; }
        .status-pending { background: rgba(255, 213, 79, 0.2); color: #ffd54f; }
        .status-approved { background: rgba(0, 123, 255, 0.2); color: #007bff; }
        .status-refunded { background: rgba(40, 167, 69, 0.2); color: #28a745; }
        .status-rejected { background: rgba(220, 53, 69, 0.2); color: #dc3545; }

        /* Action Buttons */
        .btn-action { width:32px; height:32px; border-radius:8px; display:inline-flex; align-items:center; justify-content:center; transition:var(--transition); border:none; color:#fff; text-decoration:none; }
        .btn-check { background: rgba(40, 167, 69, 0.2); color: #28a745; }
        .btn-check:hover { background: #28a745; color: #fff; }
        .btn-x { background: rgba(220, 53, 69, 0.2); color: #dc3545; }
        .btn-x:hover { background: #dc3545; color: #fff; }
        .btn-money { background: rgba(255, 213, 79, 0.2); color: #ffd54f; }
        .btn-money:hover { background: #ffd54f; color: #000; }
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
        <li><a href="/admin/transactions/checkin"><i class="fas fa-qrcode"></i> Check-in</a></li>
        <li><a href="/admin/transactions/refunds" class="active"><i class="fas fa-rotate-left"></i> Refunds</a></li>
    </ul>
</div>

<div class="content">

    <div class="page-title">
        <i class="fas fa-rotate-left"></i> Refunds
    </div>
    <p class="small-muted">Kelola permintaan pengembalian dana dan stok tiket secara manual.</p>

    <div class="card-box">
        <?php if (session()->getFlashdata('success')) : ?>
            <div class="alert alert-success" style="background: rgba(40, 167, 69, 0.2); color: #28a745; border: none; border-radius: 12px;"><?= session()->getFlashdata('success') ?></div>
        <?php endif; ?>
        <?php if (session()->getFlashdata('error')) : ?>
            <div class="alert alert-danger" style="background: rgba(220, 53, 69, 0.2); color: #dc3545; border: none; border-radius: 12px;"><?= session()->getFlashdata('error') ?></div>
        <?php endif; ?>

        <div class="top-actions" style="display: flex; justify-content: flex-end; margin-bottom: 25px;">
            <form method="get">
                <input type="text" class="search-box" name="keyword" 
                       placeholder="Cari Order ID atau User..." value="<?= esc($keyword ?? '') ?>">
            </form>
        </div>

        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th width="50">#</th>
                        <th>User</th>
                        <th>Order Detail</th>
                        <th>Alasan</th>
                        <th>Nominal Refund</th>
                        <th class="text-center">Status</th>
                        <th>Tanggal</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                <?php if (empty($refunds)) : ?>
                    <tr>
                        <td colspan="8" class="text-center text-secondary">Tidak ada data pengajuan refund.</td>
                    </tr>
                <?php else : ?>
                    <?php $no = 1 + ($perPage * ($page - 1)); foreach ($refunds as $r) : ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td>
                            <span class="fw-bold text-white"><?= esc($r['customer_name']) ?></span><br>
                            <small class="text-muted">ID: #<?= esc($r['order_id']) ?></small>
                        </td>
                        <td>
                            <span style="color:var(--accent); font-size:13px;">Qty: <?= $r['order_qty'] ?> Tiket</span><br>
                            <small class="text-muted">Order Status: <?= $r['order_status'] ?></small>
                        </td>
                        <td>
                            <small class="text-white" title="<?= esc($r['reason']) ?>">
                                <?= mb_strimwidth(esc($r['reason']), 0, 30, "...") ?>
                            </small>
                        </td>
                        <td>
                            <span class="fw-bold text-white">Rp <?= number_format($r['refund_amount'] ?? $r['total_price'], 0, ',', '.') ?></span>
                        </td>
                        <td class="text-center">
                            <span class="status-badge status-<?= $r['status'] ?>">
                                <?= $r['status'] ?>
                            </span>
                        </td>
                        <td>
                            <small class="text-white"><?= date('d/m/Y', strtotime($r['created_at'])) ?></small><br>
                            <small class="text-muted"><?= date('H:i', strtotime($r['created_at'])) ?></small>
                        </td>
                        <td class="text-center">
                            <div class="d-flex gap-2 justify-content-center">
                                <?php if($r['status'] === 'pending'): ?>
                                    <a href="/admin/transactions/refunds/approve/<?= $r['id'] ?>" class="btn-action btn-check" title="Approve" onclick="return confirm('Setujui refund ini?')">
                                        <i class="fas fa-check"></i>
                                    </a>
                                    <a href="/admin/transactions/refunds/reject/<?= $r['id'] ?>" class="btn-action btn-x" title="Reject" onclick="return confirm('Tolak refund ini?')">
                                        <i class="fas fa-times"></i>
                                    </a>
                                <?php elseif($r['status'] === 'approved'): ?>
                                    <a href="/admin/transactions/refunds/refunded/<?= $r['id'] ?>" class="btn-action btn-money" title="Tandai Sudah Transfer" onclick="return confirm('Pastikan dana sudah ditransfer manual. Lanjutkan?')">
                                        <i class="fas fa-wallet"></i>
                                    </a>
                                <?php else: ?>
                                    <i class="fas fa-lock text-muted" title="Selesai"></i>
                                <?php endif; ?>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach ?>
                <?php endif ?>
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            <?= $pager->links('refunds','default_full') ?>
        </div>

    </div>
</div>

<script>
function toggleSubmenu(element) {
    const submenu = element.nextElementSibling;
    const icon = element.querySelector('i.fa-chevron-down');
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
        const icon = sectionTitle.querySelector('i.fa-chevron-down');
        submenu.classList.add('open');
        if (icon) icon.style.transform = 'rotate(180deg)';
    }
});
</script>

</body>
</html>