<?= $this->extend('admin/layout/navbar') ?>

<?= $this->section('content') ?>

<style>
    /* ================= GLOBAL & THEME VARIABLES ================= */
    :root {
        --primary: #4318FF;
        --primary-glow: rgba(67, 24, 255, 0.25);
        --secondary: #A3AED0;
        --navy: #1B2559;
        --bg-body: #F4F7FE;
        --white: #ffffff;
        --border-color: #E0E5F2;
        --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
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
        background: rgba(244, 247, 254, 0.88);
        z-index: -1;
        backdrop-filter: blur(12px);
    }

    /* ================= BACK BUTTON (Top Nav) ================= */
    .btn-back-modern {
        display: inline-flex;
        align-items: center;
        gap: 12px;
        padding: 12px 24px;
        background: var(--white);
        border-radius: 16px;
        color: var(--navy);
        text-decoration: none;
        font-weight: 700;
        font-size: 14px;
        border: 1px solid var(--border-color);
        box-shadow: 0 4px 12px rgba(112, 144, 176, 0.08);
        transition: var(--transition);
        margin-bottom: 30px;
    }

    .btn-back-modern i { color: var(--primary); }
    .btn-back-modern:hover {
        transform: translateX(-5px);
        background: var(--navy);
        color: #fff;
    }

    /* ================= CARD & INPUTS ================= */
    .card-form-premium {
        background: var(--white);
        border-radius: 35px;
        padding: 50px;
        box-shadow: 0px 40px 80px rgba(112, 144, 176, 0.15);
        max-width: 750px;
        margin: 0 auto;
        border: 1px solid rgba(255, 255, 255, 0.8);
    }

    .form-label-modern {
        font-weight: 800;
        color: var(--navy);
        font-size: 13px;
        margin-bottom: 12px;
        text-transform: uppercase;
        display: block;
        letter-spacing: 0.5px;
    }

    .input-custom {
        background: #F4F7FE;
        border: 2px solid transparent;
        border-radius: 20px;
        padding: 16px 22px;
        font-weight: 600;
        color: var(--navy);
        transition: var(--transition);
    }

    .input-custom:focus {
        background: var(--white);
        border-color: var(--primary);
        box-shadow: 0 10px 25px var(--primary-glow);
        outline: none;
    }

    /* ================= ACTION BUTTONS (Gaya Sesuai Gambar Sebelumnya) ================= */
    .button-group-modern {
        display: flex;
        align-items: center;
        justify-content: flex-end;
        gap: 15px;
        margin-top: 40px;
    }

    .btn-cancel-modern {
        background: #F4F7FE;
        color: var(--navy);
        padding: 14px 30px;
        border-radius: 18px;
        text-decoration: none;
        font-weight: 700;
        font-size: 15px;
        transition: var(--transition);
        border: none;
        display: inline-flex;
        align-items: center;
    }

    .btn-cancel-modern:hover {
        background: #E0E5F2;
        color: var(--navy);
    }

    .btn-save-modern {
        background: var(--primary);
        color: #fff;
        border: none;
        border-radius: 22px;
        padding: 14px 30px;
        font-weight: 700;
        font-size: 15px;
        display: flex;
        align-items: center;
        gap: 10px;
        box-shadow: 0 10px 20px var(--primary-glow);
        transition: var(--transition);
    }

    .btn-save-modern:hover {
        transform: translateY(-3px);
        box-shadow: 0 15px 30px var(--primary-glow);
        filter: brightness(1.1);
    }

    /* Icon Header Style */
    .page-icon-wrapper {
        width: 65px;
        height: 65px;
        background: var(--primary-glow);
        color: var(--primary);
        border-radius: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 26px;
        margin: 0 auto 20px;
    }
</style>

<video autoplay muted loop playsinline class="bg-video">
    <source src="https://cdn.coverr.co/videos/coverr-concert-crowd-light-show-1596/1080p.mp4" type="video/mp4">
</video>
<div class="glass-overlay"></div>

<div class="content-modern">
    <div class="container">
        <div style="max-width: 750px; margin: 0 auto;">
            
            <a href="/admin/masters/venues" class="btn-back-modern">
                <i class="fas fa-arrow-left"></i>
                <span>Back to Venue List</span>
            </a>

            <div class="card-form-premium">
                <div class="text-center mb-5">
                    <div class="page-icon-wrapper">
                        <i class="fas fa-map-location-dot"></i>
                    </div>
                    <p style="color: var(--secondary); font-weight: 700; text-transform: uppercase; letter-spacing: 2px; font-size: 11px; margin-bottom: 5px;">Venue Database</p>
                    <h2 style="font-weight: 800; color: var(--navy); letter-spacing: -1px;"><?= $title ?></h2>
                    <p class="text-muted small">Please provide accurate technical details for the venue infrastructure.</p>
                </div>

                <form action="<?= $formAction ?>" method="post">
                    <?= csrf_field() ?>

                    <div class="mb-4">
                        <label class="form-label-modern">Nama Venue</label>
                        <input type="text" name="name" class="form-control input-custom"
                               value="<?= old('name', $venue['name'] ?? '') ?>"
                               placeholder="e.g. Gelora Bung Karno Main Stadium" required>
                    </div>

                    <div class="mb-4">
                        <label class="form-label-modern">Lokasi / Alamat</label>
                        <input type="text" name="location" class="form-control input-custom"
                               value="<?= old('location', $venue['location'] ?? '') ?>"
                               placeholder="e.g. Jakarta Pusat, Indonesia" required>
                    </div>

                    <div class="mb-4">
                        <label class="form-label-modern">Kapasitas Maksimal (Pax)</label>
                        <div class="input-group">
                            <span class="input-group-text border-0 bg-transparent ps-0" style="color: var(--primary)">
                                <i class="fas fa-users"></i>
                            </span>
                            <input type="number" name="capacity" class="form-control input-custom"
                                   value="<?= old('capacity', $venue['capacity'] ?? '') ?>"
                                   placeholder="0" required>
                        </div>
                        <small class="text-muted mt-1 d-block">This determines the total ticket availability across all tiers.</small>
                    </div>

                    <div class="button-group-modern">
                        <a href="/admin/masters/venues" class="btn-cancel-modern">Cancel</a>
                        <button type="submit" class="btn-save-modern">
                            <i class="fas fa-save"></i>
                            <span>Save Venue Data</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
// Toggle Submenu Logic (Maksimalin Sidebar)
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