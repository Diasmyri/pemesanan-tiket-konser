<?= $this->extend('admin/layout/navbar') ?>

<?= $this->section('content') ?>

<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<style>
    /* ================= THEME VARIABLES (Sesuai Index) ================= */
    :root {
        --primary: #4318FF;
        --primary-glow: rgba(67, 24, 255, 0.15);
        --secondary: #A3AED0;
        --navy: #1B2559;
        --bg-body: #F4F7FE;
        --white: #ffffff;
        --border-color: #E0E5F2;
        --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .content-wrapper-modern {
        padding: 40px 30px;
        background-color: var(--bg-body);
        min-height: 100vh;
        font-family: 'Plus Jakarta Sans', sans-serif;
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
        margin-bottom: 35px;
    }

    .page-title-modern {
        font-size: 34px;
        font-weight: 800;
        color: var(--navy);
        letter-spacing: -1.5px;
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

    /* ================= FORM CARD ================= */
    .card-box-modern {
        background: var(--white);
        border-radius: 30px;
        padding: 40px;
        border: none;
        box-shadow: 0px 20px 40px rgba(112, 144, 176, 0.1);
        max-width: 1000px;
        margin: auto;
    }

    /* ================= INPUT STYLING ================= */
    .form-label-modern {
        color: var(--navy);
        font-weight: 700;
        font-size: 14px;
        margin-bottom: 10px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .form-label-modern i {
        color: var(--primary);
    }

    .form-control-modern {
        background: #F4F7FE;
        border: 2px solid transparent;
        padding: 14px 18px;
        border-radius: 16px;
        width: 100%;
        font-weight: 600;
        transition: var(--transition);
        color: var(--navy);
    }

    .form-control-modern:focus {
        outline: none;
        background: var(--white);
        border-color: var(--primary);
        box-shadow: 0 0 0 5px var(--primary-glow);
    }

    /* Select2 Customization */
    .select2-container--default .select2-selection--multiple,
    .select2-container--default .select2-selection--single {
        background: #F4F7FE !important;
        border: 2px solid transparent !important;
        border-radius: 16px !important;
        min-height: 52px !important;
        padding: 6px !important;
    }

    .select2-container--default.select2-container--focus .select2-selection--multiple {
        border-color: var(--primary) !important;
        background: white !important;
    }

    /* ================= POSTER PREVIEW ================= */
    .poster-preview-container {
        border: 2px dashed var(--border-color);
        border-radius: 20px;
        padding: 20px;
        text-align: center;
        background: #F4F7FE;
        transition: var(--transition);
    }

    .img-preview-modern {
        width: 100%;
        max-width: 200px;
        border-radius: 15px;
        box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        display: none;
        margin-top: 15px;
    }

    /* ================= BUTTONS ================= */
    .btn-save-modern {
        background: var(--primary);
        padding: 16px 35px;
        border-radius: 18px;
        color: #fff;
        font-weight: 700;
        border: none;
        display: flex;
        align-items: center;
        gap: 12px;
        transition: var(--transition);
        box-shadow: 0px 10px 20px rgba(67, 24, 255, 0.2);
    }

    .btn-save-modern:hover {
        transform: translateY(-3px);
        box-shadow: 0px 15px 30px rgba(67, 24, 255, 0.3);
        background: #3311cc;
    }

    .btn-cancel-modern {
        background: #F4F7FE;
        color: var(--navy);
        padding: 16px 25px;
        border-radius: 18px;
        font-weight: 700;
        text-decoration: none;
        transition: var(--transition);
    }

    .btn-cancel-modern:hover {
        background: #E0E5F2;
    }
</style>

<video autoplay muted loop playsinline class="bg-video">
    <source src="https://cdn.coverr.co/videos/coverr-concert-crowd-light-show-1596/1080p.mp4" type="video/mp4">
</video>
<div class="glass-overlay"></div>

<div class="content-wrapper-modern">
    <div class="header-flex">
        <div class="breadcrumb-custom">Masters &bull; Schedule &bull; <?= isset($event) ? 'Edit' : 'Create' ?></div>
        <h1 class="page-title-modern">
            <i class="fas <?= isset($event) ? 'fa-edit' : 'fa-plus-circle' ?> text-primary"></i> 
            <?= $title ?>
        </h1>
    </div>

    <div class="card-box-modern">
        <form action="<?= $formAction ?>" method="post" enctype="multipart/form-data">
            <?= csrf_field() ?>

            <div class="row g-4">
                <div class="col-md-12">
                    <label class="form-label-modern"><i class="fas fa-heading"></i> Event Title</label>
                    <input type="text" name="title" class="form-control-modern" 
                           placeholder="Enter event name..." value="<?= old('title', $event['title'] ?? '') ?>" required>
                </div>

                <div class="col-md-6">
                    <label class="form-label-modern"><i class="fas fa-microphone"></i> Featured Artists</label>
                    <select name="artist_ids[]" id="artist_ids" class="form-control-modern" multiple="multiple" required>
                        <?php foreach ($artists as $a) : ?>
                            <option value="<?= $a['id'] ?>" <?= in_array($a['id'], $selectedArtists ?? []) ? 'selected' : '' ?>>
                                <?= esc($a['name']) ?>
                            </option>
                        <?php endforeach ?>
                    </select>
                </div>

                <div class="col-md-6">
                    <label class="form-label-modern"><i class="fas fa-map-marker-alt"></i> Venue Location</label>
                    <select name="venue_id" class="form-control-modern select2-single" required>
                        <option value="">-- Select Venue --</option>
                        <?php foreach ($venues as $v) : ?>
                            <option value="<?= $v['id'] ?>" <?= ($event['venue_id'] ?? '') == $v['id'] ? 'selected' : '' ?>>
                                <?= $v['name'] ?>
                            </option>
                        <?php endforeach ?>
                    </select>
                </div>

                <div class="col-md-4">
                    <label class="form-label-modern"><i class="fas fa-calendar-day"></i> Event Date</label>
                    <input type="date" name="date" class="form-control-modern" value="<?= old('date', $event['date'] ?? '') ?>" required>
                </div>

                <div class="col-md-4">
                    <label class="form-label-modern"><i class="fas fa-clock"></i> Start Time</label>
                    <input type="time" name="start_time" class="form-control-modern" value="<?= old('start_time', $event['start_time'] ?? '') ?>" required>
                </div>

                <div class="col-md-4">
                    <label class="form-label-modern"><i class="fas fa-history"></i> End Time</label>
                    <input type="time" name="end_time" class="form-control-modern" value="<?= old('end_time', $event['end_time'] ?? '') ?>">
                </div>

                <div class="col-md-12">
                    <label class="form-label-modern"><i class="fas fa-image"></i> Event Poster</label>
                    <div class="poster-preview-container">
                        <input type="file" name="poster" class="form-control-modern mb-2" accept="image/*" onchange="previewPoster(event)">
                        <small class="text-secondary d-block mb-3">Recommended size: 700x900px (Portrait)</small>
                        
                        <img id="preview-img" class="img-preview-modern" 
                             src="<?= isset($event['poster']) && $event['poster'] ? '/uploads/events/' . $event['poster'] : '' ?>" 
                             style="display: <?= isset($event['poster']) && $event['poster'] ? 'inline-block' : 'none' ?>;">
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-end gap-3 mt-5">
                <a href="/admin/masters/events" class="btn-cancel-modern text-center">Cancel</a>
                <button type="submit" class="btn-save-modern">
                    <i class="fas fa-save"></i> Save Event Data
                </button>
            </div>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
$(document).ready(function () {
    // Artist Select2 (Multiple)
    $('#artist_ids').select2({
        placeholder: ' Search & select artists...',
        width: '100%'
    });

    // Venue Select2 (Single)
    $('.select2-single').select2({
        width: '100%'
    });
});

// Preview Image Logic (Jangan dihapus)
function previewPoster(event) {
    const input = event.target;
    const preview = document.getElementById('preview-img');
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.src = e.target.result;
            preview.style.display = 'inline-block';
        }
        reader.readAsDataURL(input.files[0]);
    }
}

// Sidebar Script (Original)
function toggleSubmenu(element) {
    const submenu = element.nextElementSibling;
    const icon = element.querySelector('i');
    submenu.classList.toggle('open');
    icon.style.transform = submenu.classList.contains('open') ? 'rotate(180deg)' : 'rotate(0deg)';
}
</script>

<?= $this->endSection() ?>