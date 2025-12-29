<?= $this->extend('admin/layout/navbar') ?>

<?= $this->section('content') ?>

<style>
    /* ================= GLOBAL & THEME VARIABLES ================= */
    :root {
        --primary: #4318FF;
        --primary-glow: rgba(67, 24, 255, 0.15);
        --secondary: #A3AED0;
        --navy: #1B2559;
        --bg-body: #F4F7FE;
        --white: #ffffff;
        --border-color: rgba(224, 229, 242, 0.3);
        --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        --shadow-modern: 0px 40px 80px rgba(112, 144, 176, 0.12);
        --accent-yellow: #FFB800;
    }

    .content-modern {
        position: relative;
        padding: 40px 20px;
        min-height: 100vh;
        z-index: 1;
        font-family: 'Plus Jakarta Sans', sans-serif;
    }

    /* ================= BACKGROUND & OVERLAY ================= */
    .bg-video {
        position: fixed;
        inset: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
        z-index: -2;
        filter: brightness(0.6);
        pointer-events: none;
    }

    .glass-overlay {
        position: fixed;
        inset: 0;
        background: linear-gradient(135deg, rgba(244, 247, 254, 0.85), rgba(244, 247, 254, 0.95));
        z-index: -1;
        backdrop-filter: blur(12px);
    }

    /* ================= PAGE HEADER ================= */
    .header-container {
        margin-bottom: 35px;
    }

    .page-title-modern {
        font-size: 36px;
        font-weight: 850;
        color: var(--navy);
        letter-spacing: -1.5px;
        display: flex;
        align-items: center;
        gap: 15px;
        margin-bottom: 5px;
    }

    .page-title-modern i { color: var(--primary); }

    /* ================= CARD BOX (GLASSMORPHISM) ================= */
    .card-box-modern {
        background: rgba(255, 255, 255, 0.7);
        backdrop-filter: blur(10px);
        border: 1px solid var(--white);
        border-radius: 30px;
        padding: 35px;
        box-shadow: var(--shadow-modern);
        transition: var(--transition);
    }

    /* ================= TOP ACTIONS ================= */
    .top-actions {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 30px;
        gap: 20px;
        flex-wrap: wrap;
    }

    .btn-add-modern {
        background: var(--primary);
        color: var(--white);
        padding: 14px 28px;
        border-radius: 18px;
        font-weight: 700;
        display: inline-flex;
        align-items: center;
        gap: 10px;
        text-decoration: none;
        box-shadow: 0 10px 20px var(--primary-glow);
        transition: var(--transition);
        border: none;
    }

    .btn-add-modern:hover {
        transform: translateY(-3px);
        color: var(--white);
        filter: brightness(1.1);
    }

    .search-input-modern {
        background: #F4F7FE;
        border: 2px solid transparent;
        padding: 14px 20px;
        border-radius: 18px;
        font-weight: 600;
        color: var(--navy);
        width: 300px;
        transition: var(--transition);
    }

    .search-input-modern:focus {
        background: var(--white);
        border-color: var(--primary);
        outline: none;
    }

    /* ================= TABLE DESIGN ================= */
    .table-modern {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0 12px;
    }

    .table-modern thead th {
        color: var(--secondary);
        font-weight: 800;
        text-transform: uppercase;
        font-size: 11px;
        letter-spacing: 1px;
        padding: 15px 20px;
        border: none;
    }

    .table-modern tbody tr {
        background: var(--white);
        transition: var(--transition);
        box-shadow: 0 4px 10px rgba(112, 144, 176, 0.05);
    }

    .table-modern tbody tr:hover {
        transform: scale(1.01);
        box-shadow: 0 8px 20px rgba(112, 144, 176, 0.1);
    }

    .table-modern tbody td {
        padding: 18px 20px;
        border: none;
        vertical-align: middle;
        font-weight: 600;
        color: var(--navy);
    }

    .table-modern tbody td:first-child { border-radius: 15px 0 0 15px; }
    .table-modern tbody td:last-child { border-radius: 0 15px 15px 0; }

    /* ================= BADGES & STYLES ================= */
    .event-badge {
        color: var(--primary);
        background: var(--primary-glow);
        padding: 6px 14px;
        border-radius: 10px;
        font-size: 13px;
        display: inline-block;
    }

    .price-text {
        font-family: 'Poppins', sans-serif;
        font-weight: 800;
        color: #059669; /* Green for money */
    }

    .stock-badge {
        background: #E0E7FF;
        color: #4338CA;
        padding: 4px 10px;
        border-radius: 8px;
        font-size: 12px;
    }

    .btn-action-modern {
        width: 38px;
        height: 38px;
        border-radius: 12px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        transition: var(--transition);
        text-decoration: none;
    }

    .btn-edit-modern { background: #E9E3FF; color: var(--primary); }
    .btn-delete-modern { background: #FFEBEB; color: #FF5A5A; }
    
    .btn-edit-modern:hover { background: var(--primary); color: white; }
    .btn-delete-modern:hover { background: #FF5A5A; color: white; }

</style>

<video autoplay muted loop playsinline class="bg-video">
    <source src="https://cdn.coverr.co/videos/coverr-concert-crowd-light-show-1596/1080p.mp4" type="video/mp4">
</video>
<div class="glass-overlay"></div>

<div class="content-modern">
    <div class="container-fluid">
        
        <div class="header-container">
            <p style="color: var(--secondary); font-weight: 700; text-transform: uppercase; letter-spacing: 2px; font-size: 12px; margin-bottom: 5px;">Inventory Management</p>
            <h1 class="page-title-modern">
                <i class="fas fa-ticket-alt"></i> Ticket Types
            </h1>
        </div>

        <div class="card-box-modern">
            <?php if (session()->getFlashdata('success')) : ?>
                <div class="alert alert-success border-0 shadow-sm mb-4" style="border-radius: 15px;">
                    <i class="fas fa-check-circle me-2"></i> <?= session()->getFlashdata('success') ?>
                </div>
            <?php endif; ?>

            <div class="top-actions">
                <a href="/admin/masters/tickettypes/create" class="btn-add-modern">
                    <i class="fas fa-plus"></i> New Ticket Category
                </a>
                <form method="get">
                    <input type="text" class="search-input-modern" name="keyword" 
                           placeholder="Search event or tier..." value="<?= $keyword ?? '' ?>">
                </form>
            </div>

            <div class="table-responsive">
                <table class="table-modern">
                    <thead>
                        <tr>
                            <th width="60">#</th>
                            <th>Associated Event</th>
                            <th>Ticket Tier</th>
                            <th>Base Price</th>
                            <th>Availability</th>
                            <th class="text-end">Management</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($tickettypes)) : ?>
                            <tr>
                                <td colspan="6" class="text-center py-5">
                                    <p class="text-secondary fw-bold">No ticket data available.</p>
                                </td>
                            </tr>
                        <?php else : ?>
                            <?php $no = 1 + ($page - 1) * $perPage; ?>
                            <?php foreach ($tickettypes as $t) : ?>
                                <tr>
                                    <td><span class="text-secondary">#<?= $no++ ?></span></td>
                                    <td>
                                        <span class="event-badge fw-bold">
                                            <i class="fas fa-calendar-check me-1"></i>
                                            <?= esc($t['event_title'] ?? 'N/A') ?>
                                        </span>
                                    </td>
                                    <td>
                                        <div class="fw-bold fs-6"><?= esc($t['name']) ?></div>
                                        <small class="text-muted">Tier Category</small>
                                    </td>
                                    <td>
                                        <span class="price-text">Rp <?= number_format($t['price'], 0, ',', '.') ?></span>
                                    </td>
                                    <td>
                                        <span class="stock-badge fw-bold">
                                            <?= number_format($t['stock']) ?> <small>Available</small>
                                        </span>
                                    </td>
                                    <td class="text-end">
                                        <a href="/admin/masters/tickettypes/edit/<?= $t['id'] ?>" class="btn-action-modern btn-edit-modern">
                                            <i class="fas fa-pen"></i>
                                        </a>
                                        <a href="/admin/masters/tickettypes/delete/<?= $t['id'] ?>" 
                                           onclick="return confirm('Hapus tipe tiket ini?')" 
                                           class="btn-action-modern btn-delete-modern">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <div class="mt-4 d-flex justify-content-center">
                <?= $pager->links('default', 'default_full') ?>
            </div>
        </div>
    </div>
</div>

<script>
// Sidebar Toggle Logic (Tetap dipertahankan agar tidak rusak)
function toggleSubmenu(element) {
    const submenu = element.nextElementSibling;
    const icon = element.querySelector('i.fa-chevron-down');
    if (submenu.classList.contains('open')) {
        submenu.classList.remove('open');
        if(icon) icon.style.transform = 'rotate(0deg)';
    } else {
        submenu.classList.add('open');
        if(icon) icon.style.transform = 'rotate(180deg)';
    }
}

document.addEventListener('DOMContentLoaded', function() {
    const activeLink = document.querySelector('.submenu a.active');
    if (activeLink) {
        const submenu = activeLink.closest('.submenu');
        if (submenu) {
            const sectionTitle = submenu.previousElementSibling;
            const icon = sectionTitle.querySelector('i.fa-chevron-down');
            submenu.classList.add('open');
            if (icon) icon.style.transform = 'rotate(180deg)';
        }
    }
});
</script>

<?= $this->endSection() ?>