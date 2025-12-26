<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Payments - Admin Panel</title>

    <link rel="stylesheet" href="/assets/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: #0d0f1a;
            color: #fff;
            margin: 0;
            padding: 0;
        }

        .sidebar {
            position: fixed;
            left: 0;
            top: 0;
            width: 240px;
            height: 100vh;
            background: #0f1120;
            border-right: 1px solid rgba(255,255,255,0.05);
            padding: 22px;
        }

        .brand {
            font-size: 18px;
            font-weight: 600;
            color: #ffd54f;
            margin-bottom: 25px;
        }

        .section-title {
            font-size: 11px;
            letter-spacing: 1px;
            color: #777;
            margin-top: 25px;
            margin-bottom: 10px;
            text-transform: uppercase;
        }

        .sidebar a {
            display: block;
            padding: 10px 12px;
            font-size: 14px;
            text-decoration: none;
            color: #c8cbe4;
            border-radius: 6px;
            transition: 0.2s;
        }

        .sidebar a:hover {
            background: rgba(255,255,255,0.07);
            color: #fff;
        }

        .sidebar a.active {
            background: #12244a;
            color: #fff;
            font-weight: 600;
        }

        .content {
            margin-left: 260px;
            padding: 45px;
        }

        .page-title {
            font-size: 28px;
            font-weight: 600;
            margin-bottom: 8px;
        }

        .card-box {
            background: #131728;
            border: 1px solid rgba(255,255,255,0.08);
            padding: 25px;
            border-radius: 14px;
            margin-top: 20px;
        }

        table {
            color: #cfd6f3 !important;
        }

        thead {
            background: #1b2345 !important;
        }

        .search-box {
            background: #1b2345;
            border: 1px solid rgba(255,255,255,0.12);
            color: #fff;
        }

        .action-btn {
            background: #1c2740;
            border: 1px solid rgba(255,255,255,0.15);
            padding: 8px 16px;
            border-radius: 8px;
            color: #fff;
            font-size: 14px;
        }
    </style>
</head>

<body>

<!-- SIDEBAR -->
<div class="sidebar">
    <div class="brand">Admin Panel - Ticketing</div>

    <div class="section-title">MAIN</div>
    <a href="/admin/dashboard"><i class="fas fa-gauge"></i> Dashboard</a>

    <div class="section-title">MASTERS</div>
    <a href="/admin/masters/artists"><i class="fas fa-user"></i> Artists</a>
    <a href="/admin/masters/events"><i class="fas fa-calendar-days"></i> Events</a>
    <a href="/admin/masters/venues"><i class="fas fa-map-location-dot"></i> Venues</a>
    <a href="/admin/masters/tickettypes"><i class="fas fa-ticket"></i> Ticket Types</a>
    <a href="/admin/masters/users"><i class="fas fa-users"></i> Users</a>

    <div class="section-title">TRANSAKSI</div>
    <a href="/admin/transactions/orders"><i class="fas fa-receipt"></i> Orders</a>
    <a href="/admin/transactions/payments" class="active"><i class="fas fa-credit-card"></i> Payments</a>
    <a href="/admin/transactions/checkin"><i class="fas fa-qrcode"></i> Check-in</a>
    <a href="/admin/transactions/refunds" class="active"><i class="fas fa-rotate-left"></i> Refunds</a>

    <div class="section-title">LAPORAN</div>
    <a href="/admin/reports/daily"><i class="fas fa-clock"></i> Harian</a>
    <a href="/admin/reports/monthly"><i class="fas fa-calendar"></i> Bulanan</a>
</div>

<!-- CONTENT -->
<div class="content">

    <div class="page-title">💳 Payments</div>
    <p style="color:#9aa4c7;">Kelola pembayaran order.</p>

    <div class="card-box">

        <?php if(session()->getFlashdata('success')): ?>
            <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
        <?php endif; ?>

        <table class="table table-bordered table-dark table-hover mt-3">
            <thead>
            <tr>
                <th>Order</th>
                <th>User</th>
                <th>Event</th>
                <th>Amount</th>
                <th>Metode</th>
                <th>Tgl Bayar</th>
            </tr>
            </thead>

            <tbody>
            <?php if(empty($payments)): ?>
                <tr>
                    <td colspan="7" class="text-center text-secondary py-3">Tidak ada data pembayaran.</td>
                </tr>
            <?php else: ?>

                <?php foreach ($payments as $p): ?>
                    <tr>
                        <td>#<?= $p['order_id'] ?></td>
                        <td><?= $p['user_name'] ?></td>
                        <td><?= $p['event_name'] ?></td>
                        <td>Rp <?= number_format($p['amount'], 0, ',', '.') ?></td>
                        <td><?= ucfirst($p['method']) ?></td>
                        <td><?= $p['payment_date'] ?></td>
                    </tr>
                <?php endforeach ?>

            <?php endif ?>
            </tbody>
        </table>

        <div class="mt-3">
            <?= $pager->links('default', 'default_full') ?>
        </div>

    </div>

</div>

</body>
</html>
