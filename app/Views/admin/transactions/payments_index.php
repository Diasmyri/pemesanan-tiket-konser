<?= $this->extend('admin/layout/navbar') ?>

<?= $this->section('content') ?>

<style>
    /* ================= GLOBAL & THEME VARIABLES ================= */
    :root {
        --primary: #4318FF;
        --primary-glow: rgba(67, 24, 255, 0.15);
        --secondary: #A3AED0;
        --navy: #1B2559;
        --white: #ffffff;
        --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        --shadow-modern: 0px 40px 80px rgba(112, 144, 176, 0.12);
    }

    .content-modern {
        position: relative;
        padding: 40px 20px;
        min-height: 100vh;
        z-index: 1;
        font-family: 'Plus Jakarta Sans', sans-serif;
    }

    /* ================= BACKGROUND VIDEO & OVERLAY ================= */
    .bg-video {
        position: fixed; inset: 0; width: 100%; height: 100%;
        object-fit: cover; z-index: -2; filter: brightness(0.6);
        pointer-events: none;
    }

    .glass-overlay {
        position: fixed; inset: 0;
        background: linear-gradient(135deg, rgba(244, 247, 254, 0.85), rgba(244, 247, 254, 0.95));
        z-index: -1; backdrop-filter: blur(12px);
    }

    /* ================= PAGE HEADER ================= */
    .header-container { margin-bottom: 35px; }

    .page-title-modern {
        font-size: 36px; font-weight: 850; color: var(--navy);
        letter-spacing: -1.5px; display: flex; align-items: center;
        gap: 15px; margin-bottom: 5px;
    }

    .page-title-modern i { color: var(--primary); }

    .sub-title {
        color: var(--secondary); font-weight: 700; font-size: 14px;
        text-transform: uppercase; letter-spacing: 1.5px;
    }

    /* ================= CARD BOX ================= */
    .card-box-modern {
        background: rgba(255, 255, 255, 0.7);
        backdrop-filter: blur(10px);
        border: 1px solid var(--white);
        border-radius: 30px;
        padding: 35px;
        box-shadow: var(--shadow-modern);
    }

    /* ================= SEARCH BOX ================= */
    .search-wrapper { position: relative; width: 350px; }

    .search-input-modern {
        width: 100%; background: #F4F7FE; border: 2px solid transparent;
        padding: 14px 20px 14px 50px; border-radius: 18px;
        font-weight: 600; color: var(--navy); transition: var(--transition);
    }

    .search-input-modern:focus {
        background: var(--white); border-color: var(--primary);
        box-shadow: 0 10px 20px var(--primary-glow); outline: none;
    }

    .search-icon { position: absolute; left: 20px; top: 50%; transform: translateY(-50%); color: var(--secondary); }

    /* ================= TABLE DESIGN ================= */
    .table-modern { width: 100%; border-collapse: separate; border-spacing: 0 12px; }

    .table-modern thead th {
        color: var(--secondary); font-weight: 800; text-transform: uppercase;
        font-size: 11px; letter-spacing: 1px; padding: 15px 20px; border: none;
    }

    .table-modern tbody tr { background: var(--white); transition: var(--transition); cursor: pointer; }

    .table-modern tbody tr:hover { transform: scale(1.005); box-shadow: 0 10px 20px rgba(112, 144, 176, 0.1); }

    .table-modern tbody td { padding: 18px 20px; border: none; vertical-align: middle; font-weight: 600; color: var(--navy); }

    .table-modern tbody td:first-child { border-radius: 20px 0 0 20px; }
    .table-modern tbody td:last-child { border-radius: 0 20px 20px 0; }

    /* ================= PAYMENT SPECIFIC ================= */
    .proof-container {
        width: 60px; height: 60px; border-radius: 12px; overflow: hidden;
        border: 3px solid #F4F7FE; transition: var(--transition);
    }

    .proof-container:hover { transform: scale(1.2) rotate(3deg); border-color: var(--primary); }

    .proof-img { width: 100%; height: 100%; object-fit: cover; }

    .method-badge {
        background: #F4F7FE; color: var(--primary); padding: 5px 12px;
        border-radius: 8px; font-size: 12px; font-weight: 800;
    }

    .status-pill {
        padding: 6px 14px; border-radius: 10px; font-size: 11px;
        font-weight: 800; text-transform: uppercase; display: inline-block;
    }

    .approved { background: #E6FFF5; color: #00C56E; }
    .pending { background: #FFF9E6; color: #FFB800; }
    .refund_process { background: #F4F7FE; color: #8F9BBA; }
</style>

<video autoplay muted loop playsinline class="bg-video">
    <source src="https://cdn.coverr.co/videos/coverr-concert-crowd-light-show-1596/1080p.mp4" type="video/mp4">
</video>
<div class="glass-overlay"></div>

<div class="content-modern">
    <div class="container-fluid">
        
        <div class="header-container">
            <p class="sub-title">Payment Verification</p>
            <h1 class="page-title-modern">
                <i class="fas fa-credit-card"></i> Payments List
            </h1>
        </div>

        <div class="card-box-modern">
            <?php if (session()->getFlashdata('success')) : ?>
                <div class="alert alert-success border-0 shadow-sm mb-4" style="border-radius: 15px; background: #D1FAE5; color: #065F46;">
                    <i class="fas fa-check-circle me-2"></i> <?= session()->getFlashdata('success') ?>
                </div>
            <?php endif; ?>

            <div class="d-flex justify-content-between align-items-center mb-4">
                <h5 class="fw-bold m-0" style="color: var(--navy)">Inbound Payments</h5>
                <form method="get" class="search-wrapper">
                    <i class="fas fa-search search-icon"></i>
                    <input type="text" class="search-input-modern" name="keyword"
                           placeholder="Search user, event, or method..." value="<?= esc($keyword ?? '') ?>">
                </form>
            </div>

            <div class="table-responsive">
                <table class="table-modern">
                    <thead>
                        <tr>
                            <th width="50">#</th>
                            <th>User Account</th>
                            <th>Event & Order</th>
                            <th>Method</th>
                            <th>Amount</th>
                            <th class="text-center">Proof</th>
                            <th>Status</th>
                            <th>Timestamp</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($payments)) : ?>
                            <tr>
                                <td colspan="8" class="text-center py-5">
                                    <i class="fas fa-search-dollar fa-3x mb-3 text-light"></i>
                                    <p class="text-secondary fw-bold">No payment transactions recorded.</p>
                                </td>
                            </tr>
                        <?php else : ?>
                            <?php $no = 1; foreach ($payments as $p) : ?>
                            <tr>
                                <td class="text-secondary">#<?= $no++ ?></td>
                                <td>
                                    <div class="fw-bold"><?= esc($p['user_name']) ?></div>
                                    <small class="text-secondary"><?= esc($p['real_name']) ?></small>
                                </td>
                                <td>
                                    <div style="color: var(--primary); font-weight: 700;"><?= esc($p['event_name']) ?></div>
                                    <small class="text-secondary">Order ID: #<?= $p['order_id'] ?></small>
                                </td>
                                <td><span class="method-badge"><?= strtoupper(esc($p['method'])) ?></span></td>
                                <td>
                                    <span style="font-family: 'Plus Jakarta Sans'; font-weight: 800;">
                                        Rp<?= number_format($p['amount'], 0, ',', '.') ?>
                                    </span>
                                </td>
                                <td class="text-center">
                                    <?php if(!empty($p['payment_proof'])): ?>
                                        <div class="d-flex justify-content-center">
                                            <a href="<?= base_url('uploads/payments/' . $p['payment_proof']) ?>" target="_blank" class="proof-container">
                                                <img src="<?= base_url('uploads/payments/' . $p['payment_proof']) ?>" class="proof-img" alt="Proof">
                                            </a>
                                        </div>
                                    <?php else: ?>
                                        <span class="badge bg-light text-dark opacity-50">No Proof</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <span class="status-pill <?= strtolower($p['status']) ?>">
                                        <?= str_replace('_', ' ', $p['status']) ?>
                                    </span>
                                </td>
                                <td>
                                    <div style="font-size: 13px;"><?= date('d/m/Y', strtotime($p['payment_date'])) ?></div>
                                    <small class="text-secondary"><?= date('H:i', strtotime($p['payment_date'])) ?> WIB</small>
                                </td>
                            </tr>
                            <?php endforeach ?>
                        <?php endif ?>
                    </tbody>
                </table>
            </div>

            <div class="mt-4 d-flex justify-content-center">
                <?= $pager->links('default','default_full') ?>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>