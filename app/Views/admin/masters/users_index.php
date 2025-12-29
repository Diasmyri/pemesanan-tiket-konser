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
        font-family: 'Plus Jakarta Sans', sans-serif;
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

    /* ================= TOP ACTIONS & SEARCH ================= */
    .top-actions {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 30px;
        gap: 20px;
        flex-wrap: wrap;
    }

    .search-wrapper {
        position: relative;
        width: 350px;
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
        transition: var(--transition);
    }

    .table-modern tbody tr:hover {
        transform: scale(1.01);
        box-shadow: 0 8px 20px rgba(112, 144, 176, 0.12);
    }

    .table-modern tbody td {
        padding: 15px 20px;
        border: none;
        vertical-align: middle;
        font-weight: 600;
        color: var(--navy);
    }

    .table-modern tbody td:first-child { border-radius: 20px 0 0 20px; }
    .table-modern tbody td:last-child { border-radius: 0 20px 20px 0; }

    /* ================= USER PROFILE ELEMENTS ================= */
    .user-info-flex {
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .avatar-wrapper {
        width: 48px;
        height: 48px;
        background: linear-gradient(135deg, var(--primary), #5E35FF);
        color: white;
        border-radius: 15px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 800;
        font-size: 18px;
        box-shadow: 0 8px 15px var(--primary-glow);
    }

    .username-badge {
        font-size: 12px;
        background: #F4F7FE;
        color: var(--primary);
        padding: 4px 10px;
        border-radius: 8px;
        font-weight: 700;
        margin-top: 4px;
        display: inline-block;
    }

    .contact-link {
        color: var(--navy);
        text-decoration: none;
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 14px;
        transition: var(--transition);
    }

    .contact-link:hover { color: var(--primary); }

    .address-box {
        max-width: 250px;
        font-size: 13px;
        color: var(--secondary);
        line-height: 1.4;
    }
</style>

<video autoplay muted loop playsinline class="bg-video">
    <source src="https://cdn.coverr.co/videos/coverr-concert-crowd-light-show-1596/1080p.mp4" type="video/mp4">
</video>
<div class="glass-overlay"></div>

<div class="content-modern">
    <div class="container-fluid">
        
        <div class="header-container">
            <p class="sub-title">Account & Accessibility</p>
            <h1 class="page-title-modern">
                <i class="fas fa-user-shield"></i> User Management
            </h1>
        </div>

        <div class="card-box-modern">
            <div class="top-actions">
                <h5 class="fw-bold var(--navy) m-0">System Members</h5>

                <form method="get" class="search-wrapper">
                    <i class="fas fa-search search-icon"></i>
                    <input type="text" class="search-input-modern"
                           name="keyword"
                           placeholder="Search by name, email, or user..."
                           value="<?= $keyword ?? '' ?>">
                </form>
            </div>

            <div class="table-responsive-modern">
                <table class="table-modern">
                    <thead>
                        <tr>
                            <th width="70">#</th>
                            <th>Identity & Profile</th>
                            <th>Contact Details</th>
                            <th>Home Address</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($users)) : ?>
                            <tr>
                                <td colspan="4" class="text-center py-5">
                                    <img src="https://illustrations.popsy.co/white/abstract-art-4.svg" alt="Empty" style="width: 180px; opacity: 0.6;">
                                    <p class="mt-3 fw-bold text-secondary">No users found in the system records.</p>
                                </td>
                            </tr>
                        <?php else : ?>
                            <?php $no = 1 + (($currentPage - 1) * $perPage); ?>
                            <?php foreach ($users as $u) : ?>
                            <tr>
                                <td><span class="text-secondary opacity-50">#<?= $no++ ?></span></td>
                                <td>
                                    <div class="user-info-flex">
                                        <div class="avatar-wrapper">
                                            <?= strtoupper(substr($u['nama'], 0, 1)) ?>
                                        </div>
                                        <div>
                                            <div class="fw-bolder fs-6"><?= esc($u['nama']) ?></div>
                                            <span class="username-badge">@<?= esc($u['username']) ?></span>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <a href="mailto:<?= esc($u['email']) ?>" class="contact-link mb-1">
                                        <i class="far fa-envelope text-primary"></i> <?= esc($u['email']) ?>
                                    </a>
                                    <div class="contact-link" style="cursor: default;">
                                        <i class="fas fa-phone-alt text-secondary" style="font-size: 12px;"></i> <?= esc($u['nomor_telepon']) ?>
                                    </div>
                                </td>
                                <td>
                                    <div class="address-box">
                                        <i class="fas fa-map-marker-alt text-danger opacity-75 me-1"></i>
                                        <?= esc($u['alamat'] ?? 'No address registered') ?>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach ?>
                        <?php endif ?>
                    </tbody>
                </table>
            </div>

            <div class="mt-4 d-flex justify-content-center">
                <?php if (isset($pager)) : ?>
                    <?= $pager->links('users', 'default_full') ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>