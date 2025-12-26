<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Orders - Admin Panel</title>

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

        .status-badge {
            padding: 5px 10px;
            border-radius: 6px;
            font-size: 12px;
            font-weight: 600;
            text-transform: capitalize;
        }

        .pending { background: #ffca28; color: #000; }
        .paid { background: #4caf50; }
        .cancelled { background: #e53935; }
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
    <a href="/admin/transactions/orders" class="active"><i class="fas fa-receipt"></i> Orders</a>
    <a href="/admin/transactions/payments"><i class="fas fa-credit-card"></i> Payments</a>
    <a href="/admin/transactions/checkin"><i class="fas fa-qrcode"></i> Check-in</a>

    <div class="section-title">LAPORAN</div>
    <a href="/admin/reports/daily"><i class="fas fa-clock"></i> Harian</a>
    <a href="/admin/reports/monthly"><i class="fas fa-calendar"></i> Bulanan</a>
</div>

<!-- CONTENT -->
<div class="content">

    <div class="page-title">🧾 Orders</div>
    <p style="color:#9aa4c7;">Kelola pemesanan tiket.</p>

    <div class="card-box">

        <?php if(session()->getFlashdata('success')): ?>
            <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
        <?php endif; ?>

        <div class="d-flex justify-content-end mb-3">
            <form method="get">
                <input type="text" name="keyword" class="form-control search-box"
                       placeholder="Search order..." value="<?= $keyword ?? '' ?>"
                       style="width: 240px;">
            </form>
        </div>

        <table class="table table-bordered table-dark table-hover mt-3">
            <thead>
            <tr>
                <th width="50">#</th>
                <th>User</th>
                <th>Event</th>
                <th>Ticket Type</th>
                <th>Qty</th>
                <th>Total</th>
                <th>Status</th>
            </tr>
            </thead>

            <tbody>
            <?php if(empty($orders)): ?>
                <tr>
                    <td colspan="7" class="text-center text-secondary py-3">Tidak ada data.</td>
                </tr>
            <?php else: ?>
                <?php $no = 1; foreach ($orders as $o): ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $o['username'] ?></td>
                        <td><?= $o['event_name'] ?></td>
                        <td><?= $o['ticket_type_name'] ?></td>
                        <td><?= $o['qty'] ?></td>
                        <td>Rp <?= number_format($o['total_price'], 0, ',', '.') ?></td>
                        <td>
                            <span class="status-badge <?= $o['status'] ?>">
                                <?= $o['status'] ?>
                            </span>
                        </td>
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
