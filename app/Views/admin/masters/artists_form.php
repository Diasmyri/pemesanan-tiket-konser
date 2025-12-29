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
        max-width: 700px;
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

    /* ================= ACTION BUTTONS (Update sesuai gambar) ================= */
    .button-group-modern {
        display: flex;
        align-items: center;
        justify-content: flex-end; /* Posisi di kanan sesuai gambar */
        gap: 15px;
        margin-top: 40px;
    }

    .btn-cancel-modern {
        background: #F4F7FE; /* Warna abu-abu pucat sesuai gambar */
        color: var(--navy);
        padding: 14px 30px;
        border-radius: 18px;
        text-decoration: none;
        font-weight: 700;
        font-size: 15px;
        transition: var(--transition);
        border: none;
    }

    .btn-cancel-modern:hover {
        background: #E0E5F2;
        color: var(--navy);
    }

    .btn-save-modern {
        background: var(--primary);
        color: #fff;
        border: none;
        border-radius: 22px; /* Lebih rounded sesuai gambar */
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

    /* ================= UPLOAD AREA ================= */
    .upload-zone {
        border: 2px dashed #D0D5DD;
        border-radius: 24px;
        padding: 40px;
        text-align: center;
        background: #F9FAFB;
        transition: var(--transition);
        cursor: pointer;
    }
    .preview-img-modern {
        width: 180px;
        height: 180px;
        object-fit: cover;
        border-radius: 30px;
        border: 8px solid var(--white);
        box-shadow: 0 15px 30px rgba(0,0,0,0.1);
        margin-top: 20px;
    }
</style>

<video autoplay muted loop playsinline class="bg-video">
    <source src="https://cdn.coverr.co/videos/coverr-concert-crowd-light-show-1596/1080p.mp4" type="video/mp4">
</video>
<div class="glass-overlay"></div>

<div class="content-modern">
    <div class="container">
        <div style="max-width: 700px; margin: 0 auto;">


            <div class="card-form-premium">
                <div class="mb-5 text-center">
                    <p style="color: var(--secondary); font-weight: 700; text-transform: uppercase; letter-spacing: 2px; font-size: 11px; margin-bottom: 5px;">Artist Management</p>
                    <h2 style="font-weight: 800; color: var(--navy); letter-spacing: -1px;"><?= (isset($artist)) ? 'Update Profile' : 'New Artist Profile' ?></h2>
                </div>

                <form action="<?= $formAction ?>" method="post" enctype="multipart/form-data">
                    <?= csrf_field() ?>

                    <div class="mb-4">
                        <label for="name" class="form-label-modern">Full Artist Name</label>
                        <input type="text" name="name" id="name"
                               class="form-control input-custom"
                               value="<?= old('name', $artist['name'] ?? '') ?>"
                               placeholder="e.g. Bruno Mars" required>
                    </div>

                    <div class="mb-2">
                        <label class="form-label-modern">Artist Portrait</label>
                        <div class="upload-zone" onclick="document.getElementById('photo').click()">
                            <i class="fas fa-cloud-upload-alt fa-2x text-primary mb-2"></i>
                            <p class="fw-bold text-navy mb-0">Choose Profile Photo</p>
                            <p class="text-muted small mb-0">PNG, JPG up to 2MB</p>
                            <input type="file" name="photo" id="photo" hidden
                                   accept="image/*" onchange="previewImage(event)">
                        </div>

                        <div class="text-center">
                            <?php if (!empty($artist['photo'])): ?>
                                <img id="preview" src="/uploads/artists/<?= $artist['photo'] ?>" class="preview-img-modern">
                            <?php else: ?>
                                <img id="preview" src="#" class="preview-img-modern" style="display:none;">
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="button-group-modern">
                        <a href="/admin/masters/artists" class="btn-cancel-modern">Cancel</a>
                        <button type="submit" class="btn-save-modern">
                            <i class="fas fa-save"></i>
                            <span>Save Artist Data</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
function previewImage(event) {
    const img = document.getElementById('preview');
    if (event.target.files && event.target.files[0]) {
        img.style.display = 'inline-block';
        img.src = URL.createObjectURL(event.target.files[0]);
    }
}
</script>

<?= $this->endSection() ?>