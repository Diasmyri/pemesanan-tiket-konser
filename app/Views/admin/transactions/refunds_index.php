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
        --danger: #EE5D50;
        --success: #05CD99;
        --warning: #FFB800;
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

    /* ================= BACKGROUND & GLASS ================= */
    .bg-video {
        position: fixed; inset: 0; width: 100%; height: 100%;
        object-fit: cover; z-index: -2; filter: brightness(0.55);
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
        letter-spacing: -1.5px; display: flex; align-items: center; gap: 15px;
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

    /* ================= TABLE DESIGN ================= */
    .table-modern { width: 100%; border-collapse: separate; border-spacing: 0 12px; }
    .table-modern thead th {
        color: var(--secondary); font-weight: 800; text-transform: uppercase;
        font-size: 11px; padding: 15px 20px; border: none;
    }
    .table-modern tbody tr { background: var(--white); transition: var(--transition); }
    .table-modern tbody td { padding: 18px 20px; border: none; vertical-align: middle; font-weight: 600; color: var(--navy); }
    .table-modern tbody td:first-child { border-radius: 20px 0 0 20px; }
    .table-modern tbody td:last-child { border-radius: 0 20px 20px 0; }

    /* ================= STATUS PILLS ================= */
    .status-pill {
        padding: 6px 14px; border-radius: 10px; font-size: 10px;
        font-weight: 800; text-transform: uppercase; display: inline-block;
    }
    .status-pending { background: #FFF9E6; color: var(--warning); }
    .status-approved { background: #E1F5FE; color: #03A9F4; }
    .status-refunded { background: #E6FFF5; color: var(--success); }
    .status-rejected { background: #FEECEB; color: var(--danger); }

    /* ================= ACTION BUTTONS ================= */
    .btn-action-group { display: flex; gap: 8px; justify-content: center; }
    .btn-circle {
        width: 38px; height: 38px; border-radius: 12px; display: flex;
        align-items: center; justify-content: center; transition: var(--transition);
        border: none; text-decoration: none; font-size: 14px;
    }
    .btn-approve { background: #E6FFF5; color: var(--success); }
    .btn-approve:hover { background: var(--success); color: white; transform: translateY(-3px); }
    
    .btn-reject { background: #FEECEB; color: var(--danger); }
    .btn-reject:hover { background: var(--danger); color: white; transform: translateY(-3px); }
    
    .btn-pay { background: #FFF9E6; color: var(--warning); }
    .btn-pay:hover { background: var(--warning); color: white; transform: translateY(-3px); }

    /* ================= SEARCH BOX ================= */
    .search-input-modern {
        width: 300px; background: #F4F7FE; border: 2px solid transparent;
        padding: 12px 20px 12px 45px; border-radius: 15px;
        font-weight: 600; color: var(--navy); transition: var(--transition);
    }
    .search-input-modern:focus { background: var(--white); border-color: var(--primary); outline: none; }
</style>

<video autoplay muted loop playsinline class="bg-video">
    <source src="https://cdn.coverr.co/videos/coverr-concert-crowd-light-show-1596/1080p.mp4" type="video/mp4">
</video>
<div class="glass-overlay"></div>

<div class="content-modern">
    <div class="container-fluid">
        
        <div class="header-container">
            <p class="sub-title">Finance & Claims</p>
            <h1 class="page-title-modern">
                <i class="fas fa-rotate-left"></i> Refunds Management
            </h1>
        </div>

        <div class="card-box-modern">
            <?php if (session()->getFlashdata('success')) : ?>
                <div class="alert alert-success border-0 mb-4 shadow-sm" style="border-radius: 15px; background: #D1FAE5; color: #065F46;">
                    <i class="fas fa-check-circle me-2"></i> <?= session()->getFlashdata('success') ?>
                </div>
            <?php endif; ?>

            <div class="d-flex justify-content-between align-items-center mb-4">
                <h5 class="fw-bold m-0" style="color: var(--navy)">Request List</h5>
                <form method="get" style="position: relative;">
                    <i class="fas fa-search" style="position: absolute; left: 18px; top: 50%; transform: translateY(-50%); color: var(--secondary);"></i>
                    <input type="text" class="search-input-modern" name="keyword" 
                           placeholder="Search Order ID or User..." value="<?= esc($keyword ?? '') ?>">
                </form>
            </div>

            <div class="table-responsive">
                <table class="table-modern">
                    <thead>
                        <tr>
                            <th width="50">#</th>
                            <th>Customer</th>
                            <th>Order Detail</th>
                            <th>Reason</th>
                            <th>Amount</th>
                            <th class="text-center">Status</th>
                            <th>Requested At</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($refunds)) : ?>
                            <tr>
                                <td colspan="8" class="text-center py-5 text-secondary fw-bold">No refund requests found.</td>
                            </tr>
                        <?php else : ?>
                            <?php $no = 1; foreach ($refunds as $r) : ?>
                            <tr>
                                <td class="text-secondary">#<?= $no++ ?></td>
                                <td>
                                    <div class="fw-bold"><?= esc($r['customer_name']) ?></div>
                                    <small class="text-secondary">ID: #<?= esc($r['order_id']) ?></small>
                                </td>
                                <td>
                                    <div class="badge bg-light text-dark mb-1" style="font-size: 10px;"><?= $r['order_qty'] ?> Tickets</div>
                                    <br><small class="text-secondary"><?= strtoupper($r['order_status']) ?></small>
                                </td>
                                <td>
                                    <div style="font-size: 12px; max-width: 150px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;" 
                                         title="<?= esc($r['reason']) ?>">
                                        <?= esc($r['reason']) ?>
                                    </div>
                                </td>
                                <td>
                                    <span class="fw-bold" style="color: var(--navy);">
                                        Rp <?= number_format($r['refund_amount'] ?? $r['total_price'], 0, ',', '.') ?>
                                    </span>
                                </td>
                                <td class="text-center">
                                    <span class="status-pill status-<?= strtolower($r['status']) ?>">
                                        <?= $r['status'] ?>
                                    </span>
                                </td>
                                <td>
                                    <div style="font-size: 13px;"><?= date('d/m/Y', strtotime($r['created_at'])) ?></div>
                                    <small class="text-secondary"><?= date('H:i', strtotime($r['created_at'])) ?> WIB</small>
                                </td>
                                <td class="text-center">
                                    <div class="btn-action-group">
                                        <?php if($r['status'] === 'pending'): ?>
                                            <a href="/admin/transactions/refunds/approve/<?= $r['id'] ?>" class="btn-circle btn-approve" title="Approve" onclick="return confirm('Approve this refund request?')">
                                                <i class="fas fa-check"></i>
                                            </a>
                                            <a href="/admin/transactions/refunds/reject/<?= $r['id'] ?>" class="btn-circle btn-reject" title="Reject" onclick="return confirm('Reject this refund request?')">
                                                <i class="fas fa-times"></i>
                                            </a>
                                        <?php elseif($r['status'] === 'approved'): ?>
                                            <a href="/admin/transactions/refunds/refunded/<?= $r['id'] ?>" class="btn-circle btn-pay" title="Mark as Disbursed" onclick="return confirm('Confirm that funds have been manually transferred?')">
                                                <i class="fas fa-hand-holding-dollar"></i>
                                            </a>
                                        <?php else: ?>
                                            <i class="fas fa-lock text-light" style="font-size: 18px;"></i>
                                        <?php endif; ?>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach ?>
                        <?php endif ?>
                    </tbody>
                </table>
            </div>

            <div class="mt-4 d-flex justify-content-center">
                <?= $pager->links('refunds','default_full') ?>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>