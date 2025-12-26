<?php include 'layout/header.php'; ?>
<?php include 'layout/navbar.php'; ?>

<div id="page-loader" class="page-shutter">
    <div class="shutter-layer layer-1"></div>
    <div class="shutter-layer layer-2"></div>
    <div class="shutter-layer layer-3"></div>
    <div class="loader-text">ACCESSING_PROFILE_MODULE...</div>
</div>

<style>
/* --- CORE BRUTALIST & ENTRY TRANSITION --- */
:root {
    --primary: #8b5cf6;
    --secondary: #ec4899;
    --accent: #00f2fe;
    --dark: #000000;
    --white: #ffffff;
    --brutal-border: 4px solid var(--white);
}

body {
    background: var(--dark);
    font-family: 'Space Grotesk', sans-serif;
    color: var(--white);
    margin: 0; overflow-x: hidden;
}

/* --- ENTRY ANIMATION ONLY --- */
#page-loader {
    position: fixed; inset: 0; z-index: 10000;
    display: flex; flex-direction: column; pointer-events: none;
}
.shutter-layer {
    flex: 1; width: 100%; background: var(--white);
    transform: translateX(0); /* Default nutup pas baru load */
    transition: transform 0.8s cubic-bezier(0.85, 0, 0.15, 1);
}
.shutter-layer.layer-2 { transition-delay: 0.1s; background: var(--primary); }
.shutter-layer.layer-3 { transition-delay: 0.2s; background: var(--dark); }

/* Triggered by JS */
body.is-loaded .shutter-layer { transform: translateX(100%); }

.loader-text {
    position: absolute; bottom: 40px; right: 40px; color: #fff;
    font-weight: 900; font-size: 0.7rem; letter-spacing: 5px;
    z-index: 10001; transition: 0.3s;
}
body.is-loaded .loader-text { opacity: 0; }

/* --- LAYOUT STRUCTURE --- */
.brutal-container {
    max-width: 1200px; margin: 0 auto;
    border-left: var(--brutal-border); border-right: var(--brutal-border);
    background: #080808; min-height: 100vh;
}

.profile-hero {
    padding: 80px 50px; border-bottom: var(--brutal-border);
    background: var(--primary); color: var(--white);
    position: relative; overflow: hidden;
}

.profile-hero h1 {
    font-size: clamp(3rem, 6vw, 5.5rem); font-weight: 900;
    line-height: 0.8; text-transform: uppercase; letter-spacing: -4px; margin: 0;
}

.hero-tag {
    display: inline-block; background: var(--dark);
    padding: 5px 12px; font-weight: 900; font-size: 0.8rem; margin-bottom: 20px;
}

.profile-content { padding: 60px 50px; position: relative; }

/* --- CARD DATA --- */
.profile-card {
    background: var(--dark); border: var(--brutal-border);
    box-shadow: 15px 15px 0px var(--secondary);
    position: relative; z-index: 1;
}

.card-header-brutal {
    border-bottom: var(--brutal-border); padding: 25px 35px;
    display: flex; justify-content: space-between; align-items: center; background: #111;
}

.info-grid { display: grid; grid-template-columns: repeat(2, 1fr); gap: 0; }
.info-item {
    padding: 30px 35px; border-bottom: 2px solid #222; border-right: 2px solid #222;
}
.info-item:nth-child(even) { border-right: none; }
.info-item label {
    display: block; font-size: 0.75rem; font-weight: 900;
    color: var(--primary); text-transform: uppercase; margin-bottom: 10px;
}
.info-item span { font-size: 1.2rem; font-weight: 600; display: block; }

.btn-edit-main {
    width: 100%; padding: 25px; background: var(--white);
    color: var(--dark); border: none; font-size: 1.2rem;
    font-weight: 900; text-transform: uppercase; cursor: pointer; transition: 0.2s;
}
.btn-edit-main:hover { background: var(--accent); letter-spacing: 5px; }

/* --- POPUP EDIT --- */
#editOverlay {
    position: fixed; inset: 0; background: rgba(0,0,0,0.95);
    backdrop-filter: blur(10px); display: flex; align-items: center;
    justify-content: center; z-index: 9999; opacity: 0;
    pointer-events: none; transition: 0.3s;
}
#editOverlay.show { opacity: 1; pointer-events: auto; }

.bank-popup {
    background: var(--dark); border: var(--brutal-border);
    width: 90%; max-width: 600px; padding: 40px;
    box-shadow: 20px 20px 0px var(--primary);
}

.form-control-brutal {
    width: 100%; background: #111; border: 2px solid #333;
    padding: 12px; color: white; font-family: inherit; margin-top: 5px;
}
.form-control-brutal:focus { border-color: var(--primary); outline: none; }
</style>

<div class="brutal-container">
    <section class="profile-hero">
        <div class="hero-tag">IDENTITY_VAULT_v1.0</div>
        <h1>PRIVATE<br>PROFILE_</h1>
    </section>

    <section class="profile-content">
        <?php if(session()->getFlashdata('success')): ?>
            <div style="background: #10b981; padding: 20px; font-weight: 900; border: var(--brutal-border); margin-bottom: 40px; position: relative; z-index: 1;">
                ✓ <?= session()->getFlashdata('success') ?>
            </div>
        <?php endif; ?>

    <?php if(empty($user)): ?>
    <div style="text-align: center; padding: 50px; border: 2px dashed #444; color: #444; font-weight: 900;">
        NO_DATA_DETECTED
    </div>
<?php else: ?>
    <div class="profile-card">
        <div class="card-header-brutal">
            <h2 style="margin:0; font-weight: 900; text-transform: uppercase;">Credentials</h2>
            <span style="font-weight: 900; color: var(--secondary);">
                <?= esc($user['id']) ?>
            </span>
        </div>

        <div class="info-grid">
            <div class="info-item">
                <label>Username</label>
                <span><?= esc($user['username']) ?></span>
            </div>
            <div class="info-item">
                <label>Full Name</label>
                <span><?= esc($user['nama']) ?></span>
            </div>
            <div class="info-item">
                <label>Email Address</label>
                <span><?= esc($user['email']) ?></span>
            </div>
            <div class="info-item">
                <label>Phone Number</label>
                <span><?= esc($user['nomor_telepon']) ?></span>
            </div>
            <div class="info-item" style="grid-column: span 2; border-bottom: none;">
                <label>Home Address</label>
                <span><?= esc($user['alamat']) ?></span>
            </div>
        </div>

        <button class="btn-edit-main" onclick="openEdit()">
            Modify Account Info <i class="fa-solid fa-arrow-right"></i>
        </button>
    </div>
<?php endif; ?>


    </section>
</div>

<div id="editOverlay">
    <div class="bank-popup">
        <h2 style="font-weight: 900; margin-bottom: 30px; text-transform: uppercase; border-bottom: var(--brutal-border); padding-bottom: 10px;">Edit_Profile</h2>
        <form id="editForm" method="post" enctype="multipart/form-data">
            <?= csrf_field() ?>
            <input type="hidden" name="user_id" id="userId">
            <div style="margin-bottom: 20px;">
                <label style="font-weight: 900; font-size: 0.8rem;">USERNAME</label>
                <input type="text" name="username" id="username" class="form-control-brutal" required>
            </div>
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 20px;">
                <div>
                    <label style="font-weight: 900; font-size: 0.8rem;">NAMA</label>
                    <input type="text" name="nama" id="nama" class="form-control-brutal" required>
                </div>
                <div>
                    <label style="font-weight: 900; font-size: 0.8rem;">EMAIL</label>
                    <input type="email" name="email" id="email" class="form-control-brutal" required>
                </div>
            </div>
            <div style="margin-bottom: 20px;">
                <label style="font-weight: 900; font-size: 0.8rem;">PHONE</label>
                <input type="text" name="nomor_telepon" id="nomor_telepon" class="form-control-brutal" required>
            </div>
            <div style="margin-bottom: 20px;">
                <label style="font-weight: 900; font-size: 0.8rem;">ADDRESS</label>
                <textarea name="alamat" id="alamat" class="form-control-brutal" rows="3"></textarea>
            </div>
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px;">
                <button type="submit" class="btn-edit-main" style="padding: 15px; font-size: 1rem; background: var(--primary); color: white;">Update</button>
                <button type="button" class="btn-edit-main" onclick="closeEdit()" style="padding: 15px; font-size: 1rem; background: #222; color: white;">Discard</button>
            </div>
        </form>
    </div>
</div>

<?php include 'layout/footer.php'; ?>

<script>
// SCRIPTS LOGIC
const user = <?= json_encode($user) ?>;

function openEdit() {
    document.getElementById('username').value = user.username;
    document.getElementById('nama').value = user.nama;
    document.getElementById('email').value = user.email;
    document.getElementById('nomor_telepon').value = user.nomor_telepon;
    document.getElementById('alamat').value = user.alamat;

    document.getElementById('editForm').action = "<?= base_url('user/profile/update') ?>";
    document.getElementById('editOverlay').classList.add('show');
}

function closeEdit(){
    document.getElementById('editOverlay').classList.remove('show');
}



// ONLY ENTRY TRANSITION
window.addEventListener('load', () => {
    setTimeout(() => {
        document.body.classList.add('is-loaded');
    }, 100);
});
</script>