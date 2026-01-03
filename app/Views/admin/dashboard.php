<?= $this->extend('admin/layout/navbar') ?>

<?= $this->section('content') ?>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<style>
    :root {
        --primary: #4318FF;
        --primary-glow: rgba(67, 24, 255, 0.15);
        --secondary: #A3AED0;
        --navy: #1B2559;
        --bg-body: #F4F7FE;
        --success: #05cd99;
        --warning: #ffb814;
        --danger: #ee5d50;
        --white: #ffffff;
    }

    /* Layout Wrapper */
    .content {
        padding: 40px 30px;
        background-color: var(--bg-body);
        min-height: 100vh;
    }

    /* Premium Cards */
    .card-box {
        background: var(--white);
        border-radius: 24px; /* Lebih rounded */
        padding: 24px;
        border: 1px solid rgba(224, 230, 243, 0.5); /* Border halus */
        box-shadow: 0px 15px 35px rgba(112, 144, 176, 0.08); /* Shadow lebih natural */
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        height: 100%;
    }

    .card-box:hover {
        transform: translateY(-8px);
        box-shadow: 0px 30px 45px rgba(112, 144, 176, 0.15);
    }

    /* Typography Stats */
    .card-title {
        color: var(--secondary);
        font-size: 13px;
        font-weight: 700;
        margin-bottom: 6px;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .card-value {
        color: var(--navy);
        font-size: 32px; /* Lebih besar */
        font-weight: 800;
        letter-spacing: -1.5px;
    }

    /* Custom Stats Grid */
    .stats-container {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
        gap: 24px;
        margin-bottom: 32px;
    }

    /* Tables Modern Refinement */
    .table thead th {
        background: #F8FAFD;
        border-radius: 8px;
        border: none;
        color: var(--secondary);
        font-size: 11px;
        text-transform: uppercase;
        font-weight: 800;
        padding: 12px 15px;
    }

    .table tbody td {
        border-bottom: 1px solid #F1F4F9;
        padding: 18px 15px;
        vertical-align: middle;
        font-size: 14.5px;
        color: var(--navy);
        font-weight: 500;
    }

    /* Badges Modern */
    .badge {
        padding: 8px 14px;
        border-radius: 10px;
        font-weight: 700;
        font-size: 11px;
        border: none;
    }
    .badge-info { background: var(--primary-glow); color: var(--primary); }
    .badge-success { background: rgba(5, 205, 153, 0.12); color: var(--success); }
    .badge-warning { background: rgba(255, 184, 20, 0.12); color: var(--warning); }
    .badge-danger { background: rgba(238, 93, 80, 0.12); color: var(--danger); }

    /* Horizontal Row */
    .horizontal-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 24px;
        margin-bottom: 32px;
    }

    /* Scrollbar Table */
    .table-responsive::-webkit-scrollbar { height: 4px; }
    .table-responsive::-webkit-scrollbar-thumb { background: #E0E5F2; border-radius: 10px; }

    @media (max-width: 992px) {
        .horizontal-row { grid-template-columns: 1fr; }
    }
</style>

<div class="content">
    <div class="mb-5 d-flex justify-content-between align-items-center">
        <div>
            <h1 style="font-weight: 850; color: var(--navy); letter-spacing: -1.5px; margin-bottom: 6px; font-family: 'Plus Jakarta Sans', sans-serif;">Analytics Overview</h1>
            <p style="color: var(--secondary); font-weight: 600; margin: 0; font-size: 16px;">Monitor your real-time event ecosystem data.</p>
        </div>
        <div class="text-end d-none d-md-block">
            <div class="card-box px-4 py-2 d-flex align-items-center" style="border-radius: 14px; box-shadow: none; border: 1px solid #E0E5F2;">
                <i class="far fa-calendar-alt me-2 text-primary"></i> 
                <span style="font-weight: 700; color: var(--navy); font-size: 14px;"><?= date('D, d M Y') ?></span>
            </div>
        </div>
    </div>

    <div class="stats-container">
        <div class="card-box">
            <div class="card-title">Tickets Sold</div>
            <div class="card-value"><?= number_format($totalTicketsSold ?? 0) ?></div>
        </div>
        <div class="card-box">
            <div class="card-title">Check-In</div>
            <div class="card-value"><?= number_format($totalCheckIn ?? 0) ?></div>
            <div style="font-size: 13px; color: var(--success); font-weight: 700; margin-top: 8px; display: flex; align-items: center; gap: 5px;">
                <div style="width: 8px; height: 8px; background: var(--success); border-radius: 50%;"></div>
                <?= ($totalTicketsSold > 0) ? round(($totalCheckIn / $totalTicketsSold) * 100, 1) : 0 ?>% scan rate
            </div>
        </div>
        <div class="card-box">
            <div class="card-title">Total Events</div>
            <div class="card-value"><?= number_format($totalEvents ?? 0) ?></div>
        </div>
        <div class="card-box">
            <div class="card-title">Active Users</div>
            <div class="card-value"><?= number_format($totalUsers ?? 0) ?></div>
        </div>
        <div class="card-box" style="background: linear-gradient(135deg, #4318FF 0%, #70adf1 100%); border: none;">
            <div class="card-title" style="color: rgba(255,255,255,0.7)">Net Revenue</div>
            <div class="card-value" style="color: #fff; font-size: 26px;">Rp <?= number_format($totalRevenue ?? 0, 0, ',', '.') ?></div>
        </div>
    </div>

    <div class="horizontal-row">
        <div class="card-box">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h5 style="font-weight: 800; color: var(--navy); margin: 0;"><i class="fas fa-shopping-bag me-2 text-primary"></i> Sales by Event</h5>
            </div>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr><th>Event</th><th>Type</th><th class="text-center">Sold</th></tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($soldDetails)): foreach ($soldDetails as $sd): ?>
                            <tr>
                                <td style="max-width: 180px;" class="text-truncate"><strong><?= $sd['event_name'] ?></strong></td>
                                <td><span class="badge badge-info"><?= $sd['ticket_name'] ?></span></td>
                                <td class="text-center"><strong style="color: var(--navy)"><?= number_format($sd['total_sold']) ?></strong></td>
                            </tr>
                        <?php endforeach; endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="card-box">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h5 style="font-weight: 800; color: var(--navy); margin: 0;"><i class="fas fa-user-check me-2 text-success"></i> Check-in Progress</h5>
            </div>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr><th>Event</th><th>Type</th><th class="text-center">Gate In</th></tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($checkinDetails)): foreach ($checkinDetails as $cd): ?>
                            <tr>
                                <td style="max-width: 180px;" class="text-truncate"><strong><?= $cd['event_name'] ?></strong></td>
                                <td><span class="badge badge-info"><?= $cd['ticket_name'] ?></span></td>
                                <td class="text-center text-primary"><strong style="font-weight: 800;"><?= number_format($cd['total']) ?></strong></td>
                            </tr>
                        <?php endforeach; endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="row g-4 mb-4">
        <div class="col-md-8">
            <div class="card-box">
                <h5 style="font-weight: 800; color: var(--navy); margin-bottom: 25px;">Event Schedule</h5>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr><th>Event Name</th><th>Date</th><th>Location</th><th>Status</th></tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($allEvents)): foreach ($allEvents as $e): 
                                $isExpired = strtotime($e['date']) < strtotime(date('Y-m-d'));
                            ?>
                                <tr>
                                    <td><strong><?= $e['title'] ?></strong></td>
                                    <td class="text-muted"><?= date('d M Y', strtotime($e['date'])) ?></td>
                                    <td class="text-muted"><i class="fas fa-map-marker-alt me-1" style="font-size: 12px;"></i> <?= $e['venue_name'] ?? 'N/A' ?></td>
                                    <td><span class="badge <?= $isExpired ? 'badge-danger' : 'badge-success' ?>"><?= $isExpired ? 'Expired' : 'Live' ?></span></td>
                                </tr>
                            <?php endforeach; endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card-box">
                <h5 style="font-weight: 800; color: var(--navy); margin-bottom: 25px;">Payment Analysis</h5>
                <div style="height: 280px; position: relative;">
                    <canvas id="paymentChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="card-box mb-4">
        <h5 style="font-weight: 800; color: var(--navy); margin-bottom: 25px;">Recent Transactions</h5>
        <div class="table-responsive">
            <table class="table">
                <thead><tr><th>Order ID</th><th>Customer</th><th>Total Price</th><th>Status</th></tr></thead>
                <tbody>
                    <?php if (!empty($recentOrders)): foreach ($recentOrders as $o): 
                        $s = strtolower($o['status']);
                        if(in_array($s, ['failed', 'expired'])) continue;
                        $badge = match ($s) { 'paid' => 'badge-success', 'pending' => 'badge-warning', 'refunded' => 'badge-info', default => 'bg-secondary' };
                    ?>
                        <tr>
                            <td><span style="font-family: monospace; font-weight: 700;">#<?= $o['id'] ?></span></td>
                            <td>
                                <div style="font-weight: 800;"><?= $o['user_name'] ?></div>
                                <div style="color: var(--secondary); font-size: 12px; font-weight: 600;"><?= $o['event_name'] ?></div>
                            </td>
                            <td><strong style="color: var(--navy)">Rp <?= number_format($o['total_price'], 0, ',', '.') ?></strong></td>
                            <td><span class="badge <?= $badge ?>"><?= strtoupper($s) ?></span></td>
                        </tr>
                    <?php endforeach; endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="card-box mb-5">
        <h5 style="font-weight: 800; color: var(--navy); margin-bottom: 25px;">Sales Trend (Last 7 Days)</h5>
        <div style="height: 350px;">
            <canvas id="salesChart"></canvas>
        </div>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function() {
    if (typeof Chart === 'undefined') {
        console.error("Chart.js belum terload!");
        return;
    }

    Chart.defaults.font.family = "'Plus Jakarta Sans', sans-serif";
    Chart.defaults.color = '#a3aed0';
    Chart.defaults.font.weight = '600';

    // 1. SALES TREND CHART
    const salesCtx = document.getElementById("salesChart");
    if (salesCtx) {
        new Chart(salesCtx, {
            type: "line",
            data: {
                labels: <?= json_encode(array_column($sales7days ?? [], 'day')) ?>,
                datasets: [{
                    label: 'Tickets Sold',
                    data: <?= json_encode(array_column($sales7days ?? [], 'total')) ?>,
                    borderColor: "#4318FF",
                    backgroundColor: 'rgba(67, 24, 255, 0.08)',
                    fill: true, 
                    tension: 0.45, 
                    borderWidth: 4, 
                    pointRadius: 5,
                    pointHoverRadius: 8,
                    pointBackgroundColor: "#4318FF",
                    pointBorderColor: "#fff",
                    pointBorderWidth: 2
                }]
            },
            options: { 
                maintainAspectRatio: false, 
                plugins: { legend: { display: false } },
                scales: {
                    y: { grid: { color: 'rgba(224, 230, 243, 0.6)', drawBorder: false }, ticks: { stepSize: 1, beginAtZero: true, padding: 10 } },
                    x: { grid: { display: false }, ticks: { padding: 10 } }
                }
            }
        });
    }

    // 2. PAYMENT ANALYSIS CHART
    const paymentCtx = document.getElementById("paymentChart");
    if (paymentCtx) {
        new Chart(paymentCtx, {
            type: "doughnut",
            data: {
                labels: <?= json_encode(array_column($paymentStatus ?? [], 'status')) ?>,
                datasets: [{
                    data: <?= json_encode(array_column($paymentStatus ?? [], 'total')) ?>,
                    backgroundColor: ["#4318FF", "#ffb814", "#ee5d50", "#a3aed0", "#05cd99"],
                    borderWidth: 0,
                    hoverOffset: 20
                }]
            },
            options: { 
                maintainAspectRatio: false, 
                cutout: '80%', 
                plugins: { 
                    legend: { 
                        position: 'bottom', 
                        labels: { usePointStyle: true, padding: 25, font: { size: 12, weight: '700' } } 
                    } 
                } 
            }
        });
    }
});
</script>

<?= $this->endSection() ?>