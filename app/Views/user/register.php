<?php include 'layout/header.php'; ?>

<link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300;400;700;900&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<style>
    :root {
        --primary: #8b5cf6; 
        --secondary: #ec4899;
        --accent: #00f2fe;
        --dark: #000000;
        --white: #ffffff;
        --brutal-border: 4px solid #ffffff;
    }

    body {
        background-color: var(--dark);
        font-family: 'Space Grotesk', sans-serif;
        color: var(--white);
        margin: 0;
    }

    .register-section {
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 20px;
        /* Gradient tipis biar layar gak hampa */
        background: radial-gradient(circle at 90% 10%, rgba(139, 92, 246, 0.1) 0%, transparent 40%),
                    radial-gradient(circle at 10% 90%, rgba(236, 72, 153, 0.1) 0%, transparent 40%);
    }

    .register-container {
        background: var(--dark);
        border: 6px solid var(--white);
        width: 100%;
        max-width: 420px; /* Sedikit lebih lebar dari login karena field banyak */
        padding: 25px 30px;
        box-shadow: 12px 12px 0 var(--secondary); /* Pakai pink biar beda sama login */
        position: relative;
    }

    /* --- HEADER COMPACT --- */
    .register-header {
        text-align: left;
        margin-bottom: 20px;
        border-bottom: 4px solid var(--white);
        padding-bottom: 12px;
    }

    .register-icon {
        font-size: 1.5rem;
        color: var(--accent);
        margin-bottom: 8px;
        display: inline-block;
        border: 2px solid var(--white);
        padding: 6px;
        background: #111;
    }

    .register-title {
        font-size: 1.8rem;
        font-weight: 900;
        text-transform: uppercase;
        letter-spacing: -2px;
        line-height: 0.9;
        margin-bottom: 8px;
    }

    .register-subtitle {
        font-size: 0.75rem;
        font-weight: 700;
        color: var(--dark);
        background: var(--accent);
        display: inline-block;
        padding: 2px 8px;
        text-transform: uppercase;
    }

    /* --- ALERTS --- */
    .alert {
        padding: 10px;
        border: 3px solid var(--white);
        font-weight: 800;
        text-transform: uppercase;
        font-size: 0.7rem;
        margin-bottom: 15px;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .alert-success { background: #22c55e; color: white; }
    .alert-error { background: var(--secondary); color: white; }

    /* --- FORM COMPACT --- */
    form {
        display: grid;
        grid-template-columns: 1fr 1fr; /* Bikin 2 kolom untuk field tertentu biar pendek */
        gap: 12px;
    }

    .form-group {
        margin-bottom: 0px;
    }

    /* Username & Nama full width */
    .form-group.full { grid-column: span 2; }

    .form-label {
        display: block;
        font-weight: 900;
        text-transform: uppercase;
        font-size: 0.7rem;
        margin-bottom: 4px;
        color: #aaa;
    }

    .form-input {
        width: 100%;
        padding: 10px;
        background: #111;
        border: 3px solid var(--white);
        color: var(--white);
        font-family: 'Space Grotesk', sans-serif;
        font-weight: 700;
        font-size: 0.85rem;
        transition: 0.15s;
    }

    .form-input:focus {
        outline: none;
        box-shadow: 4px 4px 0 var(--accent);
        transform: translate(-2px, -2px);
    }

    .btn-submit {
        grid-column: span 2;
        padding: 14px;
        background: var(--secondary);
        color: white;
        border: 3px solid var(--white);
        font-weight: 900;
        text-transform: uppercase;
        font-size: 0.9rem;
        cursor: pointer;
        transition: 0.2s;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        margin-top: 10px;
    }

    .btn-submit:hover {
        background: var(--white);
        color: var(--dark);
        transform: translate(-4px, -4px);
        box-shadow: 8px 8px 0 var(--primary);
    }

    /* --- FOOTER --- */
    .register-footer {
        grid-column: span 2;
        margin-top: 15px;
        text-align: center;
    }

    .footer-link {
        border: 2px solid #444;
        padding: 10px;
        transition: 0.2s;
    }

    .footer-link a {
        color: var(--accent);
        text-decoration: none;
        font-weight: 900;
        font-size: 0.75rem;
        text-transform: uppercase;
    }

    .footer-link:hover {
        border-color: var(--white);
        background: #111;
    }

    /* Biar gak sesek di HP */
    @media (max-width: 400px) {
        form { grid-template-columns: 1fr; }
        .form-group { grid-column: span 1 !important; }
    }
</style>

<section class="register-section">
    <div class="register-container">
        <div class="register-header">
            <div class="register-icon">
                <i class="fas fa-user-plus"></i>
            </div>
            <h2 class="register-title">JOIN THE<br>MOSH PIT!</h2>
            <p class="register-subtitle">Buat akun untuk booking tiket</p>
        </div>

        <?php if(session()->getFlashdata('success')): ?>
            <div class="alert alert-success">
                <i class="fas fa-check-circle"></i>
                <span><?= session()->getFlashdata('success') ?></span>
            </div>
        <?php endif; ?>

        <?php if(session()->getFlashdata('error')): ?>
            <div class="alert alert-error">
                <i class="fas fa-exclamation-circle"></i>
                <span><?= session()->getFlashdata('error') ?></span>
            </div>
        <?php endif; ?>

        <form action="<?= base_url('user/register') ?>" method="POST">
            <div class="form-group full">
                <label class="form-label"><i class="fas fa-user"></i> Username</label>
                <input type="text" name="username" class="form-input" placeholder="USERNAME" required>
            </div>

            <div class="form-group full">
                <label class="form-label"><i class="fas fa-id-card"></i> Nama Lengkap</label>
                <input type="text" name="nama" class="form-input" placeholder="NAMA LENGKAP" required>
            </div>

            <div class="form-group">
                <label class="form-label"><i class="fas fa-envelope"></i> Email</label>
                <input type="email" name="email" class="form-input" placeholder="EMAIL" required>
            </div>

            <div class="form-group">
                <label class="form-label"><i class="fas fa-phone"></i> Telepon</label>
                <input type="text" name="nomor_telepon" class="form-input" placeholder="NOMOR" required>
            </div>

            <div class="form-group full">
                <label class="form-label"><i class="fas fa-lock"></i> Password</label>
                <input type="password" name="password" class="form-input" placeholder="********" required>
            </div>

            <button type="submit" class="btn-submit">
                <i class="fas fa-user-plus"></i> DAFTAR SEKARANG
            </button>

            <div class="register-footer">
                <div class="footer-link">
                    <a href="<?= base_url('user/login') ?>">SUDAH PUNYA AKUN? LOGIN</a>
                </div>
            </div>
        </form>
    </div>
</section>