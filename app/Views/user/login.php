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
        overflow: hidden; /* Mencegah scroll di body jika tidak perlu */
    }

    .login-section {
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 20px;
        background: radial-gradient(circle at 10% 20%, rgba(139, 92, 246, 0.1) 0%, transparent 40%),
                    radial-gradient(circle at 90% 80%, rgba(236, 72, 153, 0.1) 0%, transparent 40%);
    }

    .login-container {
        background: var(--dark);
        border: 6px solid var(--white); /* Border dikecilin dikit */
        width: 100%;
        max-width: 380px; /* Di-press dari 480px ke 380px */
        padding: 30px; /* Padding dipangkas biar lebih pendek */
        box-shadow: 12px 12px 0 var(--primary);
        position: relative;
    }

    /* --- HEADER LOGIN COMPACT --- */
    .login-header {
        text-align: left;
        margin-bottom: 20px;
        border-bottom: 4px solid var(--white);
        padding-bottom: 15px;
    }

    .login-icon {
        font-size: 1.8rem; /* Lebih kecil */
        color: var(--accent);
        margin-bottom: 10px;
        display: inline-block;
        border: 2px solid var(--white);
        padding: 8px;
        background: #111;
    }

    .login-title {
        font-size: 2.2rem; /* Ukuran judul dipangkas */
        font-weight: 900;
        text-transform: uppercase;
        letter-spacing: -2px;
        line-height: 0.85;
        margin-bottom: 10px;
        color: var(--white);
    }

    .login-subtitle {
        font-size: 0.8rem; /* Font subtitle lebih kecil */
        font-weight: 700;
        color: var(--dark);
        background: var(--accent);
        display: inline-block;
        padding: 2px 8px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    /* --- ALERT --- */
    .alert-error {
        background: var(--secondary);
        color: white;
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

    /* --- FORM STYLING COMPACT --- */
    .form-group {
        margin-bottom: 15px; /* Jarak antar input dipersempit */
    }

    .form-label {
        display: block;
        font-weight: 900;
        text-transform: uppercase;
        font-size: 0.75rem;
        margin-bottom: 6px;
    }

    .form-input {
        width: 100%;
        padding: 12px; /* Input lebih tipis */
        background: #111;
        border: 3px solid var(--white);
        color: var(--white);
        font-family: 'Space Grotesk', sans-serif;
        font-weight: 700;
        font-size: 0.9rem;
        transition: 0.2s;
    }

    .form-input:focus {
        outline: none;
        box-shadow: 4px 4px 0 var(--accent);
        transform: translate(-2px, -2px);
    }

    .btn-submit {
        width: 100%;
        padding: 15px; /* Button lebih pendek */
        background: var(--primary);
        color: white;
        border: 3px solid var(--white);
        font-weight: 900;
        text-transform: uppercase;
        font-size: 0.95rem;
        cursor: pointer;
        transition: 0.2s;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        margin-top: 5px;
    }

    .btn-submit:hover {
        background: var(--white);
        color: var(--dark);
        transform: translate(-4px, -4px);
        box-shadow: 8px 8px 0 var(--secondary);
    }

    /* --- FOOTER GRID COMPACT --- */
    .login-footer {
        margin-top: 25px;
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 8px;
    }

    .footer-link {
        border: 2px solid var(--white);
        padding: 10px 5px;
        text-align: center;
        transition: 0.2s;
        background: #111;
    }

    .footer-link.full-width {
        grid-column: span 2;
        border-color: #333;
    }

    .footer-link a {
        color: var(--white);
        text-decoration: none;
        font-weight: 900;
        font-size: 0.7rem;
        text-transform: uppercase;
    }

    .footer-link:hover {
        background: var(--white);
        box-shadow: 4px 4px 0 var(--accent);
    }

    .footer-link:hover a { color: var(--dark); }

    @media (max-height: 700px) {
        .login-container { transform: scale(0.9); } /* Mengecil otomatis di layar pendek */
    }
</style>

<section class="login-section">
    <div class="login-container">
        <div class="login-header">
            <div class="login-icon">
                <i class="fas fa-ticket-alt"></i>
            </div>
            <h2 class="login-title">SELAMAT<br>DATANG!</h2>
            <p class="login-subtitle">Ayo pesan tiket favorit Anda</p>
        </div>

        <?php if(session()->getFlashdata('error')): ?>
            <div class="alert-error">
                <i class="fas fa-exclamation-circle"></i>
                <span><?= session()->getFlashdata('error') ?></span>
            </div>
        <?php endif; ?>

        <form action="<?= base_url('user/login') ?>" method="POST">
            <div class="form-group">
                <label class="form-label"><i class="fas fa-user"></i> Username</label>
                <input type="text" name="username" class="form-input" placeholder="USERNAME" required>
            </div>

            <div class="form-group">
                <label class="form-label"><i class="fas fa-lock"></i> Password</label>
                <input type="password" name="password" class="form-input" placeholder="********" required>
            </div>

            <button type="submit" class="btn-submit">
                <i class="fas fa-sign-in-alt"></i> LOGIN
            </button>
        </form>

        <div class="login-footer">
            <div class="footer-link">
                <a href="<?= base_url('user/register') ?>">DAFTAR</a>
            </div>
            <div class="footer-link">
                <a href="<?= base_url('user/forgot-password') ?>">RESET</a>
            </div>
            <div class="footer-link full-width">
                <a href="<?= base_url('user') ?>">
                    <i class="fas fa-arrow-left"></i> KEMBALI
                </a>
            </div>
        </div>
    </div>
</section>