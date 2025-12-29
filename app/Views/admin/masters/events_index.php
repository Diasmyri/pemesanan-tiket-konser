<?= $this->extend('admin/layout/navbar') ?>

<?= $this->section('content') ?>

<style>
    /* ================= THEME VARIABLES ================= */
    :root {
        --primary: #4318FF;
        --primary-glow: rgba(67, 24, 255, 0.15);
        --secondary: #A3AED0;
        --navy: #1B2559;
        --bg-body: #F4F7FE;
        --white: #ffffff;
        --border-color: #E0E5F2;
        --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        --danger: #EE5D50;
        --warning: #FFB547;
    }

    /* Layout Wrapper */
    .content-wrapper-modern {
        padding: 40px 30px;
        background-color: var(--bg-body);
        min-height: 100vh;
        font-family: 'Plus Jakarta Sans', 'Poppins', sans-serif;
        position: relative;
        z-index: 1;
    }

    /* ================= BACKGROUND & GLASS ================= */
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
        background: rgba(244, 247, 254, 0.88);
        z-index: -1;
        backdrop-filter: blur(12px);
    }

    /* ================= HEADER SECTION ================= */
    .header-flex {
        display: flex;
        justify-content: space-between;
        align-items: flex-end;
        margin-bottom: 35px;
    }

    .page-title-modern {
        font-size: 34px;
        font-weight: 800;
        color: var(--navy);
        letter-spacing: -1.5px;
        margin: 0;
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .breadcrumb-custom {
        color: var(--secondary);
        font-weight: 700;
        font-size: 13px;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    /* ================= CARD BOX ================= */
    .card-box-modern {
        background: var(--white);
        border-radius: 30px;
        padding: 35px;
        border: none;
        box-shadow: 0px 20px 40px rgba(112, 144, 176, 0.1);
    }

    /* ================= TOP ACTIONS ================= */
    .top-actions-bar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 30px;
        gap: 20px;
    }

    .btn-add-event {
        background: var(--primary);
        padding: 14px 28px;
        border-radius: 16px;
        color: #fff;
        font-weight: 700;
        display: flex;
        align-items: center;
        gap: 10px;
        transition: var(--transition);
        text-decoration: none;
        box-shadow: 0px 10px 20px rgba(67, 24, 255, 0.2);
    }

    .btn-add-event:hover {
        transform: translateY(-3px);
        box-shadow: 0px 15px 30px rgba(67, 24, 255, 0.3);
        color: #fff;
    }

    .search-input-group {
        position: relative;
        width: 350px;
    }

    .search-icon-inside {
        position: absolute;
        left: 18px;
        top: 50%;
        transform: translateY(-50%);
        color: var(--secondary);
    }

    .search-control-modern {
        background: #F4F7FE;
        border: 2px solid transparent;
        padding: 14px 20px 14px 48px;
        border-radius: 18px;
        width: 100%;
        font-weight: 600;
        transition: var(--transition);
        color: var(--navy);
    }

    .search-control-modern:focus {
        outline: none;
        background: var(--white);
        border-color: var(--primary);
        box-shadow: 0 0 0 5px var(--primary-glow);
    }

    /* ================= TABLE DESIGN ================= */
    .table-modern {
        border-collapse: separate;
        border-spacing: 0 15px;
    }

    .table-modern thead th {
        border: none;
        color: var(--secondary);
        font-size: 12px;
        text-transform: uppercase;
        font-weight: 800;
        padding: 10px 20px;
        letter-spacing: 1px;
    }

    .table-modern tbody tr {
        background: var(--white);
        box-shadow: 0px 5px 15px rgba(112, 144, 176, 0.08);
        transition: var(--transition);
    }

    .table-modern tbody tr:hover {
        transform: scale(1.005) translateX(5px);
        box-shadow: 0px 10px 25px rgba(112, 144, 176, 0.15);
    }

    .table-modern tbody td {
        padding: 20px;
        vertical-align: middle;
        border: none;
    }

    .table-modern tbody td:first-child { border-radius: 20px 0 0 20px; }
    .table-modern tbody td:last-child { border-radius: 0 20px 20px 0; }

    /* ================= COMPONENTS ================= */
    .event-poster-modern {
        width: 70px;
        height: 90px;
        object-fit: cover;
        border-radius: 15px;
        box-shadow: 0 8px 15px rgba(0,0,0,0.1);
        transition: var(--transition);
    }

    .event-poster-modern:hover {
        transform: scale(1.15) rotate(2deg);
        z-index: 10;
    }

    .venue-badge {
        background: #E9F3FF;
        color: #0061FF;
        padding: 6px 14px;
        border-radius: 10px;
        font-weight: 700;
        font-size: 12px;
    }

    .time-badge {
        background: #F4F7FE;
        color: var(--navy);
        padding: 5px 12px;
        border-radius: 8px;
        font-weight: 600;
        font-size: 12px;
    }

    .btn-circle-action {
        width: 40px;
        height: 40px;
        border-radius: 12px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        transition: var(--transition);
        border: none;
        text-decoration: none;
        margin-left: 5px;
    }

    .btn-edit-light { background: #E9E3FF; color: var(--primary); }
    .btn-edit-light:hover { background: var(--primary); color: #fff; }

    .btn-delete-light { background: #FFE9E9; color: var(--danger); }
    .btn-delete-light:hover { background: var(--danger); color: #fff; }

    .locked-badge {
        background: #F4F7FE;
        color: var(--secondary);
        padding: 8px 15px;
        border-radius: 12px;
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
    }

    /* PAGINATION CUSTOM */
    .pagination-wrapper {
        margin-top: 30px;
        display: flex;
        justify-content: center;
    }

    @media (max-width: 992px) {
        .header-flex { flex-direction: column; align-items: flex-start; gap: 15px; }
        .top-actions-bar { flex-direction: column; align-items: stretch; }
        .search-input-group { width: 100%; }
    }
</style>

<video autoplay muted loop playsinline class="bg-video">
    <source src="https://cdn.coverr.co/videos/coverr-concert-crowd-light-show-1596/1080p.mp4" type="video/mp4">
</video>
<div class="glass-overlay"></div>

<div class="content-wrapper-modern">
    <div class="header-flex">
        <div>
            <div class="breadcrumb-custom">Masters &bull; Schedule</div>
            <h1 class="page-title-modern">
                <i class="fas fa-calendar-alt text-primary"></i> Events Management
            </h1>
        </div>
    </div>

    <div class="card-box-modern">
        <?php if (session()->getFlashdata('success')) : ?>
            <div class="alert alert-success d-flex align-items-center border-0 mb-4 shadow-sm" style="border-radius: 15px; background: #05cd99; color: #fff;">
                <i class="fas fa-check-circle me-3 fs-5"></i>
                <div class="fw-bold"><?= session()->getFlashdata('success') ?></div>
            </div>
        <?php endif; ?>

        <?php if (session()->getFlashdata('error')) : ?>
            <div class="alert alert-danger d-flex align-items-center border-0 mb-4 shadow-sm" style="border-radius: 15px; background: #ee5d50; color: #fff;">
                <i class="fas fa-exclamation-triangle me-3 fs-5"></i>
                <div class="fw-bold"><?= session()->getFlashdata('error') ?></div>
            </div>
        <?php endif; ?>

        <div class="top-actions-bar">
            <a href="/admin/masters/events/create" class="btn-add-event">
                <i class="fas fa-plus-circle"></i> Create New Event
            </a>
            <form method="get" class="search-input-group">
                <i class="fas fa-search search-icon-inside"></i>
                <input type="text" class="search-control-modern" name="keyword"
                       placeholder="Search title, artist, or venue..." value="<?= esc($keyword ?? '') ?>">
            </form>
        </div>

        <div class="table-responsive">
            <table class="table table-modern">
                <thead>
                    <tr>
                        <th width="100">Poster</th>
                        <th>Event Details</th>
                        <th>Featured Artists</th>
                        <th>Venue Location</th>
                        <th>Schedule</th>
                        <th width="150" class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                <?php if (empty($events)) : ?>
                    <tr>
                        <td colspan="6" class="text-center py-5">
                            <i class="fas fa-calendar-times fa-3x text-light mb-3 d-block"></i>
                            <h5 class="text-secondary fw-bold">No events found</h5>
                            <p class="text-muted small">Try adjusting your search or add a new event.</p>
                        </td>
                    </tr>
                <?php else : ?>
                    <?php foreach ($events as $e) : ?>
                    <tr>
                        <td>
                            <?php if ($e['poster']) : ?>
                                <img src="/uploads/events/<?= $e['poster'] ?>" class="event-poster-modern">
                            <?php else : ?>
                                <div class="d-flex align-items-center justify-content-center bg-light text-muted fw-bold" style="width:70px; height:90px; border-radius:15px; font-size:10px; border:2px dashed #ddd;">
                                    NO POSTER
                                </div>
                            <?php endif; ?>
                        </td>
                        <td>
                            <div class="fw-800" style="font-size: 16px; color: var(--navy);"><?= esc($e['title']) ?></div>
                            <div class="text-muted small fw-600">ID: #EVT-<?= $e['id'] ?></div>
                        </td>
                        <td>
                            <?php if (!empty($e['artists'])): ?>
                                <div class="d-flex flex-wrap gap-1">
                                    <?php foreach($e['artists'] as $artist): ?>
                                        <span class="badge bg-white text-primary border border-primary-glow" style="border-radius:6px;"><?= esc($artist['name']) ?></span>
                                    <?php endforeach; ?>
                                </div>
                            <?php else: ?>
                                <span class="text-muted small">No artists assigned</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <span class="venue-badge">
                                <i class="fas fa-map-marker-alt me-1"></i> <?= esc($e['venue_name']) ?>
                            </span>
                        </td>
                        <td>
                            <div class="fw-bold text-navy" style="font-size: 14px;"><?= date('d M Y', strtotime($e['date'])) ?></div>
                            <div class="mt-1">
                                <span class="time-badge">
                                    <i class="far fa-clock me-1"></i> <?= substr($e['start_time'],0,5) ?> - <?= substr($e['end_time'],0,5) ?>
                                </span>
                            </div>
                        </td>
                        <td class="text-end">
                            <?php if($e['editable']): ?>
                                <a href="/admin/masters/events/edit/<?= $e['id'] ?>" class="btn-circle-action btn-edit-light" title="Edit Event">
                                    <i class="fas fa-pencil-alt"></i>
                                </a>
                            <?php else: ?>
                                <span class="locked-badge" title="Event has active transactions">
                                    <i class="fas fa-lock me-1"></i> Locked
                                </span>
                            <?php endif; ?>

                            <a href="/admin/masters/events/delete/<?= $e['id'] ?>"
                               onclick="return confirm('Hapus event ini? Semua data terkait akan hilang.')"
                               class="btn-circle-action btn-delete-light" title="Delete Permanent">
                                <i class="fas fa-trash-alt"></i>
                            </a>
                        </td>
                    </tr>
                    <?php endforeach ?>
                <?php endif ?>
                </tbody>
            </table>
        </div>

        <div class="pagination-wrapper">
            <?= $pager->links('default', 'default_full') ?>
        </div>
    </div>
</div>

<script>
// Logic Sidebar Toggle (Original)
function toggleSubmenu(element) {
    const submenu = element.nextElementSibling;
    const icon = element.querySelector('i');
    submenu.classList.toggle('open');
    icon.style.transform = submenu.classList.contains('open') ? 'rotate(180deg)' : 'rotate(0deg)';
}

// Auto-open submenu (Original)
document.addEventListener('DOMContentLoaded', function() {
    const activeLink = document.querySelector('.submenu a.active');
    if (activeLink) {
        const submenu = activeLink.closest('.submenu');
        const sectionTitle = submenu.previousElementSibling;
        const icon = sectionTitle.querySelector('i');
        submenu.classList.add('open');
        icon.style.transform = 'rotate(180deg)';
    }
});
</script>

<?= $this->endSection() ?>