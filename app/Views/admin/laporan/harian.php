<?= $this->extend('admin/layout/navbar') ?>

<?= $this->section('content') ?>

<style>
    /* ================= THEME VARIABLES ================= */
    :root {
        --primary: #4318FF;
        --navy: #1B2559;
        --secondary: #A3AED0;
        --white: #ffffff;
        --success: #05CD99;
        --warning: #FFB800;
        --bg-soft: #F4F7FE;
        --shadow-modern: 0px 40px 80px rgba(112, 144, 176, 0.12);
        --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .content-modern {
        padding: 40px 20px;
        position: relative;
        z-index: 1;
        font-family: 'Plus Jakarta Sans', sans-serif;
    }

    /* ================= BACKGROUND ================= */
    .bg-video {
        position: fixed; inset: 0; width: 100%; height: 100%;
        object-fit: cover; z-index: -2; filter: brightness(0.5);
    }
    .glass-overlay {
        position: fixed; inset: 0;
        background: linear-gradient(135deg, rgba(244, 247, 254, 0.9), rgba(244, 247, 254, 0.95));
        z-index: -1; backdrop-filter: blur(10px);
    }

    /* ================= SUMMARY CARDS ================= */
    .summary-card {
        background: var(--white);
        border-radius: 20px;
        padding: 25px;
        border: 1px solid rgba(255,255,255,0.3);
        box-shadow: var(--shadow-modern);
        transition: var(--transition);
        display: flex;
        align-items: center;
        gap: 20px;
    }
    .summary-card:hover { transform: translateY(-5px); }
    .icon-box {
        width: 56px; height: 56px; border-radius: 15px;
        display: grid; place-items: center; font-size: 24px;
    }

    /* ================= FILTER BOX (Fixed Spacing & Smaller Button) ================= */
    .filter-card-modern {
        background: var(--white);
        border-radius: 25px;
        padding: 30px;
        margin-bottom: 35px;
        box-shadow: var(--shadow-modern);
        border: 1px solid var(--white);
    }
    .filter-group-modern {
        display: flex;
        flex-direction: column;
        gap: 12px;
    }
    .filter-label-modern {
        font-size: 11px; 
        font-weight: 800; 
        color: var(--secondary);
        text-transform: uppercase; 
        letter-spacing: 1px;
    }
    .input-modern {
        background: var(--bg-soft); 
        border: 2px solid transparent;
        border-radius: 14px; 
        padding: 10px 16px; 
        font-weight: 600;
        color: var(--navy); 
        transition: var(--transition);
        width: 160px; /* Ukuran input diperkecil agar tidak menempel */
    }
    .input-modern:focus { 
        border-color: var(--primary); 
        outline: none; 
        background: #fff;
    }

    /* ================= TABLE DESIGN ================= */
    .report-table-card {
        background: var(--white); border-radius: 30px;
        padding: 20px; box-shadow: var(--shadow-modern);
    }
    .table-modern { width: 100%; border-collapse: separate; border-spacing: 0 10px; }
    .table-modern thead th {
        color: var(--secondary); font-weight: 700; text-transform: uppercase;
        font-size: 11px; padding: 15px; border: none;
    }
    .table-modern tbody tr { transition: var(--transition); cursor: default; }
    .table-modern tbody tr:hover { transform: scale(1.005); }
    .table-modern tbody td { 
        padding: 15px; background: #F8FAFF; border: none; 
        font-weight: 600; color: var(--navy); font-size: 13px;
    }
    .table-modern tbody td:first-child { border-radius: 15px 0 0 15px; }
    .table-modern tbody td:last-child { border-radius: 0 15px 15px 0; }

    /* ================= BUTTONS ================= */
    .btn-action {
        padding: 10px 20px; border-radius: 14px; font-weight: 700;
        font-size: 13px; border: none; transition: var(--transition);
        display: inline-flex; align-items: center; gap: 8px;
        text-decoration: none;
    }
    .btn-primary-m { background: var(--primary); color: white; }
    .btn-pdf-m { background: #EE5D50; color: white; }
    .btn-excel-m { background: #05CD99; color: white; }
    .btn-action:hover { opacity: 0.9; transform: translateY(-2px); color: white; }
    
    /* Tombol Apply khusus yang lebih kecil */
    .btn-apply-small {
        padding: 12px 25px;
        width: auto;
        min-width: 150px;
    }
</style>

<video autoplay muted loop playsinline class="bg-video">
    <source src="https://cdn.coverr.co/videos/coverr-concert-crowd-light-show-1596/1080p.mp4" type="video/mp4">
</video>
<div class="glass-overlay"></div>

<div class="content-modern">
    <div class="container-fluid">
        
        <div class="d-flex justify-content-between align-items-center mb-5">
            <div>
                <h1 class="fw-800 mb-1" style="color: var(--navy); letter-spacing: -1.5px;">Sales Report</h1>
                <p class="text-secondary fw-bold mb-0"><i class="far fa-calendar-alt me-2"></i><?= $periode ?></p>
            </div>
            <div class="d-flex gap-3">
                <a href="<?= base_url('admin/laporan/harian/exportPdf?' . http_build_query($filter)) ?>" 
                   target="_blank" 
                   class="btn-action btn-pdf-m">
                    <i class="fas fa-file-pdf"></i> PDF
                </a>
                <a href="<?= base_url('admin/laporan/harian/exportExcel?' . http_build_query($filter)) ?>" class="btn-action btn-excel-m">
                    <i class="fas fa-file-excel"></i> EXCEL
                </a>
            </div>
        </div>

        <div class="row mb-5">
            <div class="col-md-4">
                <div class="summary-card">
                    <div class="icon-box" style="background: #E7E9FB; color: var(--primary);">
                        <i class="fas fa-wallet"></i>
                    </div>
                    <div>
                        <span class="filter-label-modern" style="display:block;">Total Omzet</span>
                        <h3 class="fw-800 mb-0" style="color: var(--navy);">Rp <?= number_format(array_sum(array_column($transaksi, 'total')), 0, ',', '.') ?></h3>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="summary-card">
                    <div class="icon-box" style="background: #E6FFF5; color: var(--success);">
                        <i class="fas fa-ticket-alt"></i>
                    </div>
                    <div>
                        <span class="filter-label-modern" style="display:block;">Tiket Terjual</span>
                        <h3 class="fw-800 mb-0" style="color: var(--navy);"><?= array_sum(array_column($transaksi, 'qty')) ?> <small style="font-size: 14px;">pcs</small></h3>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="summary-card">
                    <div class="icon-box" style="background: #FFF9E6; color: var(--warning);">
                        <i class="fas fa-shopping-bag"></i>
                    </div>
                    <div>
                        <span class="filter-label-modern" style="display:block;">Total Transaksi</span>
                        <h3 class="fw-800 mb-0" style="color: var(--navy);"><?= count($transaksi) ?></h3>
                    </div>
                </div>
            </div>
        </div>

        <div class="filter-card-modern">
            <form method="get">
                <div class="d-flex align-items-end flex-wrap gap-5"> <div class="filter-group-modern">
                        <label class="filter-label-modern">Range Tanggal</label>
                        <div class="d-flex gap-3">
                            <input type="date" name="tgl_awal" class="input-modern" value="<?= $filter['tgl_awal'] ?>">
                            <input type="date" name="tgl_akhir" class="input-modern" value="<?= $filter['tgl_akhir'] ?>">
                        </div>
                    </div>

                    <div class="filter-group-modern">
                        <label class="filter-label-modern">Range Bulan</label>
                        <div class="d-flex gap-3">
                            <input type="month" name="bln_awal" class="input-modern" value="<?= $filter['bln_awal'] ?>">
                            <input type="month" name="bln_akhir" class="input-modern" value="<?= $filter['bln_akhir'] ?>">
                        </div>
                    </div>

                    <div class="ms-auto"> <button type="submit" class="btn-action btn-primary-m btn-apply-small">
                            <i class="fas fa-filter"></i> Apply Filter
                        </button>
                    </div>

                </div>
            </form>
        </div>

        <div class="report-table-card">
            <div class="table-responsive">
                <table class="table-modern">
                    <thead>
                        <tr>
                            <th width="50">No</th>
                            <th>Transaction Code</th>
                            <th>Customer</th>
                            <th>Event & Type</th>
                            <th class="text-center">QTY</th>
                            <th class="text-end">Total Amount</th>
                            <th class="text-center">Transaction Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(!empty($transaksi)): $no=1; foreach($transaksi as $t): ?>
                        <tr>
                            <td class="text-secondary"><?= $no++ ?></td>
                            <td style="color: var(--primary); font-weight: 800;">TRX-<?= $t['kode'] ?></td>
                            <td><?= $t['user'] ?? 'Guest' ?></td>
                            <td>
                                <div class="fw-bold"><?= $t['event'] ?></div>
                                <small class="text-secondary"><?= $t['paket'] ?></small>
                            </td>
                            <td class="text-center"><?= $t['qty'] ?></td>
                            <td class="text-end fw-bold">Rp <?= number_format($t['total'], 0, ',', '.') ?></td>
                            <td class="text-center">
                                <span style="font-size: 12px; color: var(--secondary);">
                                    <?= date('d M Y', strtotime($t['created_at'])) ?><br>
                                    <small><?= date('H:i', strtotime($t['created_at'])) ?> WIB</small>
                                </span>
                            </td>
                        </tr>
                        <?php endforeach; else: ?>
                        <tr><td colspan="7" class="text-center py-5 text-secondary fw-bold">No transaction data found for this period.</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>