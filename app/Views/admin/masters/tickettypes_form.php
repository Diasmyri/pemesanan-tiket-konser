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

    /* ================= BACK BUTTON ================= */
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

    /* ================= CARD FORM ================= */
    .card-form-premium {
        background: var(--white);
        border-radius: 35px;
        padding: 50px;
        box-shadow: 0px 40px 80px rgba(112, 144, 176, 0.15);
        max-width: 800px;
        margin: 0 auto;
        border: 1px solid rgba(255, 255, 255, 0.8);
    }

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

    /* ================= INPUT STYLES ================= */
    .form-label-modern {
        font-weight: 800;
        color: var(--navy);
        font-size: 13px;
        margin-bottom: 12px;
        text-transform: uppercase;
        display: block;
        letter-spacing: 0.5px;
    }

    .input-custom, .select-custom {
        background: #F4F7FE !important;
        border: 2px solid transparent !important;
        border-radius: 20px !important;
        padding: 14px 22px !important;
        font-weight: 600 !important;
        color: var(--navy) !important;
        transition: var(--transition) !important;
        height: auto !important;
    }

    .input-custom:focus, .select-custom:focus {
        background: var(--white) !important;
        border-color: var(--primary) !important;
        box-shadow: 0 10px 25px var(--primary-glow) !important;
        outline: none !important;
    }

    /* ================= ACTION BUTTONS ================= */
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
    }

    .btn-save-modern {
        background: var(--primary);
        color: #fff;
        border: none;
        border-radius: 22px;
        padding: 14px 35px;
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

    .input-group-text-modern {
        background: #F4F7FE;
        border: none;
        border-radius: 20px 0 0 20px;
        color: var(--navy);
        font-weight: 700;
        padding-left: 20px;
    }

    .has-prefix .input-custom {
        border-radius: 0 20px 20px 0 !important;
    }
</style>

<video autoplay muted loop playsinline class="bg-video">
    <source src="https://cdn.coverr.co/videos/coverr-concert-crowd-light-show-1596/1080p.mp4" type="video/mp4">
</video>
<div class="glass-overlay"></div>

<div class="content-modern">
    <div class="container">
        <div style="max-width: 800px; margin: 0 auto;">
            <div class="card-form-premium">
                <div class="text-center mb-5">
                    <div class="page-icon-wrapper">
                        <i class="fas fa-ticket-alt"></i>
                    </div>
                    <p style="color: var(--secondary); font-weight: 700; text-transform: uppercase; letter-spacing: 2px; font-size: 11px; margin-bottom: 5px;">Inventory System</p>
                    <h2 style="font-weight: 800; color: var(--navy); letter-spacing: -1px;"><?= $title ?></h2>
                    <p class="text-muted small">Define ticket tiers, pricing strategy, and stock allocation.</p>
                </div>

                <form action="<?= $formAction ?>" method="post">
                    <?= csrf_field() ?>

                    <div class="mb-4">
                        <label class="form-label-modern">Select Event</label>
                        <select name="event_id" class="form-select select-custom" required>
                            <option value="" disabled selected>-- Choose Associated Event --</option>
                            <?php foreach ($events as $e): ?>
                                <option value="<?= $e['id'] ?>"
                                    <?= old('event_id', $ticket['event_id'] ?? '') == $e['id'] ? 'selected' : '' ?>>
                                    <?= $e['title'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="row">
                        <div class="col-md-12 mb-4">
                            <label class="form-label-modern">Ticket Tier Name</label>
                            <input type="text" name="name" class="form-control input-custom"
                                   value="<?= old('name', $ticket['name'] ?? '') ?>"
                                   placeholder="e.g. VVIP Diamond, Festival A, Early Bird" required>
                        </div>

                        <div class="col-md-6 mb-4">
                            <label class="form-label-modern">Base Price</label>
                            <div class="input-group has-prefix">
                                <span class="input-group-text input-group-text-modern">Rp</span>
                                <input type="number" name="price" class="form-control input-custom"
                                       value="<?= old('price', $ticket['price'] ?? '') ?>"
                                       placeholder="0" required>
                            </div>
                        </div>

                        <div class="col-md-6 mb-4">
                            <label class="form-label-modern">Stock Allocation</label>
                            <div class="input-group has-prefix">
                                <span class="input-group-text input-group-text-modern"><i class="fas fa-boxes"></i></span>
                                <input type="number" name="stock" class="form-control input-custom"
                                       value="<?= old('stock', $ticket['stock'] ?? '') ?>"
                                       placeholder="Qty" required>
                            </div>
                        </div>
                    </div>

                    <div class="button-group-modern">
                        <a href="/admin/masters/tickettypes" class="btn-cancel-modern">Cancel</a>
                        <button type="submit" class="btn-save-modern">
                            <i class="fas fa-check-circle"></i>
                            <span>Save</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
// Sidebar Submenu Logic
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
</script>

<?= $this->endSection() ?>