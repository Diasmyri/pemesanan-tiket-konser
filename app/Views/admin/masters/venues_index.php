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
    }

    /* Layout Content */
    .content-modern {
        position: relative;
        padding: 40px 20px;
        min-height: 100vh;
        z-index: 1;
        font-family: 'Plus Jakarta Sans', 'Poppins', sans-serif;
    }

    /* ================= BACKGROUND VIDEO & OVERLAY ================= */
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

    .page-title-modern i {
        color: var(--primary);
    }

    .sub-title {
        color: var(--secondary);
        font-weight: 700;
        font-size: 14px;
        text-transform: uppercase;
        letter-spacing: 1.5px;
    }

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

    .card-box-modern:hover {
        transform: translateY(-5px);
        background: rgba(255, 255, 255, 0.85);
    }

    /* ================= TOP ACTIONS & SEARCH ================= */
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
        box-shadow: 0 15px 25px var(--primary-glow);
        color: var(--white);
        filter: brightness(1.1);
    }

    .search-wrapper {
        position: relative;
        width: 300px;
    }

    .search-input-modern {
        width: 100%;
        background: #F4F7FE;
        border: 2px solid transparent;
        padding: 14px 20px 14px 50px;
        border-radius: 18px;
        font-weight: 600;
        color: var(--navy);
        transition: var(--transition);
    }

    .search-input-modern:focus {
        background: var(--white);
        border-color: var(--primary);
        box-shadow: 0 10px 20px var(--primary-glow);
        outline: none;
    }

    .search-icon {
        position: absolute;
        left: 20px;
        top: 50%;
        transform: translateY(-50%);
        color: var(--secondary);
        font-size: 18px;
    }

    /* ================= TABLE DESIGN ================= */
    .table-responsive-modern {
        border-radius: 20px;
        overflow: hidden;
    }

    .table-modern {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0 12px;
    }

    .table-modern thead th {
        background: transparent;
        border: none;
        color: var(--secondary);
        font-weight: 800;
        text-transform: uppercase;
        font-size: 12px;
        letter-spacing: 1px;
        padding: 15px 20px;
    }

    .table-modern tbody tr {
        background: var(--white);
        box-shadow: 0 4px 10px rgba(112, 144, 176, 0.05);
        transition: var(--transition);
    }

    .table-modern tbody tr:hover {
        transform: scale(1.01);
        box-shadow: 0 8px 20px rgba(112, 144, 176, 0.12);
    }

    .table-modern tbody td {
        padding: 20px;
        border: none;
        vertical-align: middle;
        font-weight: 600;
        color: var(--navy);
    }

    .table-modern tbody td:first-child { border-radius: 15px 0 0 15px; }
    .table-modern tbody td:last-child { border-radius: 0 15px 15px 0; }

    /* ================= BADGES & ICONS ================= */
    .capacity-badge {
        background: #E2E8F0;
        color: var(--navy);
        padding: 6px 12px;
        border-radius: 10px;
        font-size: 13px;
        font-weight: 700;
    }

    .location-text {
        color: var(--secondary);
        font-size: 14px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    /* ================= ACTION BUTTONS ================= */
    .btn-action-modern {
        width: 42px;
        height: 42px;
        border-radius: 14px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        transition: var(--transition);
        text-decoration: none;
        border: none;
        margin-right: 5px;
    }

    .btn-edit-modern {
        background: #E9E3FF;
        color: var(--primary);
    }

    .btn-edit-modern:hover {
        background: var(--primary);
        color: var(--white);
        transform: rotate(15deg);
    }

    .btn-delete-modern {
        background: #FFEBEB;
        color: #FF5A5A;
    }

    .btn-delete-modern:hover {
        background: #FF5A5A;
        color: var(--white);
        transform: scale(1.1);
    }
</style>

<video autoplay muted loop playsinline class="bg-video">
    <source src="https://cdn.coverr.co/videos/coverr-concert-crowd-light-show-1596/1080p.mp4" type="video/mp4">
</video>
<div class="glass-overlay"></div>

<div class="content-modern">
    <div class="container-fluid">
        
        <div class="header-container">
            <p class="sub-title">Location & Infrastructure</p>
            <h1 class="page-title-modern">
                <i class="fas fa-map-marked-alt"></i> Venue Master List
            </h1>
        </div>

        <div class="card-box-modern">
            <?php if (session()->getFlashdata('success')) : ?>
                <div class="alert alert-success border-0 shadow-sm mb-4" style="border-radius: 15px; background: #D1FAE5; color: #065F46;">
                    <i class="fas fa-check-circle me-2"></i> <?= session()->getFlashdata('success') ?>
                </div>
            <?php endif; ?>

            <div class="top-actions">
                <a href="/admin/masters/venues/create" class="btn-add-modern">
                    <i class="fas fa-plus-circle"></i> Add New Venue
                </a>

                <form method="get" class="search-wrapper">
                    <i class="fas fa-search search-icon"></i>
                    <input type="text" class="search-input-modern"
                           name="keyword"
                           placeholder="Search by name or city..."
                           value="<?= $keyword ?? '' ?>">
                </form>
            </div>

            <div class="table-responsive-modern">
                <table class="table-modern">
                    <thead>
                        <tr>
                            <th width="80">#</th>
                            <th>Venue Details</th>
                            <th>Location Info</th>
                            <th>Seating Capacity</th>
                            <th class="text-end" width="150">Management</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($venues)) : ?>
                            <tr>
                                <td colspan="5" class="text-center py-5">
                                    <img src="https://illustrations.popsy.co/white/location-search.svg" alt="Empty" style="width: 150px; opacity: 0.5;">
                                    <p class="mt-3 fw-bold text-secondary">No venues found in the database.</p>
                                </td>
                            </tr>
                        <?php else : ?>
                            <?php $no = 1; foreach ($venues as $v) : ?>
                            <tr>
                                <td><span class="text-secondary fw-bold">#<?= $no++ ?></span></td>
                                <td>
                                    <div class="fw-bolder fs-5"><?= $v['name'] ?></div>
                                    <small class="text-primary fw-bold">ID: VEN-<?= $v['id'] ?></small>
                                </td>
                                <td>
                                    <div class="location-text">
                                        <i class="fas fa-location-arrow text-primary"></i>
                                        <?= $v['location'] ?>
                                    </div>
                                </td>
                                <td>
                                    <span class="capacity-badge">
                                        <i class="fas fa-users me-1"></i> <?= number_format($v['capacity']) ?> Pax
                                    </span>
                                </td>
                                <td class="text-end">
                                    <a href="/admin/masters/venues/edit/<?= $v['id'] ?>" class="btn-action-modern btn-edit-modern" title="Edit Venue">
                                        <i class="fas fa-pen-nib"></i>
                                    </a>
                                    <a href="/admin/masters/venues/delete/<?= $v['id'] ?>"
                                       onclick="return confirm('Are you sure you want to delete this venue?')"
                                       class="btn-action-modern btn-delete-modern" title="Delete Venue">
                                        <i class="fas fa-trash-alt"></i>
                                    </a>
                                </td>
                            </tr>
                            <?php endforeach ?>
                        <?php endif ?>
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
// Toggle Submenu Function (Tetap Dipertahankan)
function toggleSubmenu(element) {
    const submenu = element.nextElementSibling;
    const icon = element.querySelector('i');
    
    if (submenu.classList.contains('open')) {
        submenu.classList.remove('open');
        icon.style.transform = 'rotate(0deg)';
    } else {
        submenu.classList.add('open');
        icon.style.transform = 'rotate(180deg)';
    }
}

// Auto-open active submenu (Tetap Dipertahankan)
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