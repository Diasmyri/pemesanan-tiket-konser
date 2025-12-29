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
        --success: #05CD99;
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
        object-fit: cover; z-index: -2; filter: brightness(0.5);
        pointer-events: none;
    }

    .glass-overlay {
        position: fixed; inset: 0;
        background: linear-gradient(135deg, rgba(244, 247, 254, 0.8), rgba(244, 247, 254, 0.9));
        z-index: -1; backdrop-filter: blur(15px);
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

    /* ================= TICKET BOX (SCANNER STYLE) ================= */
    .ticket-code-wrapper {
        background: var(--navy);
        color: #00F2FE;
        padding: 8px 15px;
        border-radius: 12px;
        font-family: 'JetBrains Mono', monospace;
        font-size: 14px;
        font-weight: 700;
        border: 1px solid rgba(0, 242, 254, 0.3);
        display: inline-block;
        position: relative;
        overflow: hidden;
    }

    .ticket-code-wrapper::after {
        content: "";
        position: absolute;
        top: 0; left: -100%;
        width: 100%; height: 100%;
        background: linear-gradient(90deg, transparent, rgba(0, 242, 254, 0.2), transparent);
        animation: scan 3s infinite;
    }

    @keyframes scan {
        0% { left: -100%; }
        100% { left: 100%; }
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

    /* ================= BUTTONS & BADGES ================= */
    .btn-checkin-modern {
        background: linear-gradient(135deg, var(--primary), #5E3AFF);
        color: white !important;
        border: none;
        padding: 10px 20px;
        border-radius: 15px;
        font-size: 12px;
        font-weight: 700;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: var(--transition);
        box-shadow: 0 10px 20px var(--primary-glow);
    }

    .btn-checkin-modern:hover {
        transform: translateY(-3px);
        box-shadow: 0 15px 25px var(--primary-glow);
    }

    .status-pill {
        padding: 6px 14px; border-radius: 10px; font-size: 11px;
        font-weight: 800; display: inline-flex; align-items: center; gap: 6px;
    }
    .pill-in { background: #E6FFF5; color: #00C56E; }
    .pill-out { background: #F4F7FE; color: #8F9BBA; }

    /* ================= SEARCH BOX ================= */
    .search-input-modern {
        width: 100%; background: #F4F7FE; border: 2px solid transparent;
        padding: 14px 20px 14px 50px; border-radius: 18px;
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
            <p class="sub-title">On-site Verification</p>
            <h1 class="page-title-modern">
                <i class="fas fa-qrcode"></i> Check-in Gate
            </h1>
        </div>

        <div class="card-box-modern">
            <?php if(session()->getFlashdata('success')): ?>
                <div class="alert alert-success border-0 mb-4 shadow-sm" style="border-radius: 18px;">
                    <i class="fas fa-check-double me-2"></i> <?= session()->getFlashdata('success') ?>
                </div>
            <?php endif; ?>

            <div class="d-flex justify-content-between align-items-center mb-4">
                <h5 class="fw-bold m-0" style="color: var(--navy)">Live Entry List</h5>
                <div style="position: relative; width: 350px;">
                    <i class="fas fa-search" style="position: absolute; left: 20px; top: 50%; transform: translateY(-50%); color: var(--secondary);"></i>
                    <input type="text" id="checkinSearch" class="search-input-modern" placeholder="Quick search ticket or name...">
                </div>
            </div>

            <div class="table-responsive">
                <table class="table-modern" id="checkinTable">
                    <thead>
                        <tr>
                            <th>Ticket Code</th>
                            <th>Attendee</th>
                            <th>Event Detail</th>
                            <th>Check-in Time</th>
                            <th>Status</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(empty($checkins)): ?>
                            <tr class="no-data"><td colspan="6" class="text-center py-5 text-secondary">No tickets available.</td></tr>
                        <?php else: ?>
                            <?php foreach ($checkins as $c): ?>
                            <tr>
                                <td>
                                    <div class="ticket-code-wrapper">
                                        <?= $c['ticket_code'] ?>
                                    </div>
                                </td>
                                <td>
                                    <div class="fw-bold"><?= esc($c['user_name']) ?></div>
                                    <small class="text-secondary">#ORD-<?= $c['order_id'] ?></small>
                                </td>
                                <td>
                                    <div style="color: var(--primary); font-weight: 700;"><?= esc($c['event_name']) ?></div>
                                    <small class="text-secondary"><?= esc($c['ticket_type_name']) ?></small>
                                </td>
                                <td>
                                    <div style="font-size: 13px;">
                                        <?= $c['checked_in_at'] ? date('d M, H:i', strtotime($c['checked_in_at'])) : '<span class="opacity-50 text-secondary">— Not Scanned —</span>' ?>
                                    </div>
                                </td>
                                <td>
                                    <?php if($c['checkin_status'] == 'checked_in'): ?>
                                        <span class="status-pill pill-in"><i class="fas fa-check-circle"></i> INSIDE</span>
                                    <?php else: ?>
                                        <span class="status-pill pill-out"><i class="fas fa-clock"></i> WAITING</span>
                                    <?php endif; ?>
                                </td>
                                <td class="text-center">
                                    <?php if(!$c['checkin_status']): ?>
                                        <a href="/admin/transactions/checkin/process/<?= $c['order_id'] ?>" 
                                           class="btn-checkin-modern" onclick="return confirm('Confirm entry for this ticket?')">
                                            <i class="fas fa-bolt"></i> VERIFY ENTRY
                                        </a>
                                    <?php else: ?>
                                        <div class="text-success fw-bold" style="font-size: 12px;">
                                            <i class="fas fa-shield-check"></i> ACCESS GRANTED
                                        </div>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <?php endforeach ?>
                        <?php endif ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('checkinSearch');
    const tableRows = document.querySelectorAll('#checkinTable tbody tr:not(.no-data)');

    searchInput.addEventListener('input', function() {
        const query = this.value.toLowerCase();
        tableRows.forEach(row => {
            const text = row.innerText.toLowerCase();
            row.style.display = text.includes(query) ? '' : 'none';
        });
    });
});
</script>

<?= $this->endSection() ?>