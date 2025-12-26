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
    }

    body {
        background-color: var(--dark);
        font-family: 'Space Grotesk', sans-serif;
        color: var(--white);
        margin: 0;
    }

    .reset-section {
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 20px;
        background: radial-gradient(circle at 50% 50%, rgba(0, 242, 254, 0.05) 0%, transparent 50%);
    }

    .reset-container {
        background: var(--dark);
        border: 6px solid var(--white);
        width: 100%;
        max-width: 380px; /* SAMA DENGAN LOGIN */
        padding: 30px; /* SAMA DENGAN LOGIN */
        box-shadow: 12px 12px 0 var(--accent);
        position: relative;
    }

    /* --- HEADER COMPACT --- */
    .reset-header {
        text-align: left;
        margin-bottom: 20px;
        border-bottom: 4px solid var(--white);
        padding-bottom: 15px;
    }

    .reset-icon {
        font-size: 1.8rem;
        color: var(--accent);
        margin-bottom: 10px;
        display: inline-block;
        border: 2px solid var(--white);
        padding: 8px;
        background: #111;
    }

    .reset-title {
        font-size: 2.2rem; /* SAMA DENGAN LOGIN */
        font-weight: 900;
        text-transform: uppercase;
        letter-spacing: -2px;
        line-height: 0.85;
        margin-bottom: 10px;
    }

    .reset-subtitle {
        font-size: 0.8rem;
        font-weight: 700;
        color: var(--dark);
        background: var(--accent);
        display: inline-block;
        padding: 2px 8px;
        text-transform: uppercase;
    }

    /* --- INFO BOX --- */
    .info-box {
        background: #111;
        border-left: 4px solid var(--accent);
        padding: 10px;
        margin-bottom: 15px;
        display: flex;
        gap: 10px;
        align-items: center;
    }
    .info-box i { color: var(--accent); font-size: 1rem; }
    .info-box-text { font-size: 0.65rem; font-weight: 600; text-transform: uppercase; color: #ccc; }

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
    .alert-error { background: var(--secondary); color: white; }
    .alert-success { background: #22c55e; color: white; }

    /* --- FORM STYLING --- */
    .form-group { margin-bottom: 15px; }

    .form-label {
        display: block;
        font-weight: 900;
        text-transform: uppercase;
        font-size: 0.75rem;
        margin-bottom: 6px;
    }

    .form-input {
        width: 100%;
        padding: 12px;
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
        box-shadow: 4px 4px 0 var(--primary);
        transform: translate(-2px, -2px);
    }

    .btn-submit {
        width: 100%;
        padding: 15px;
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
    }

    .btn-submit:hover {
        background: var(--white);
        color: var(--dark);
        transform: translate(-4px, -4px);
        box-shadow: 8px 8px 0 var(--accent);
    }

    /* --- FOOTER (DISET SAMA SEPERTI LOGIN) --- */
    .reset-footer {
        margin-top: 25px;
    }

    .footer-link {
        border: 2px solid #333;
        padding: 10px;
        text-align: center;
        transition: 0.2s;
        background: transparent;
    }

    .footer-link:hover {
        border-color: var(--white);
        background: var(--white);
        box-shadow: 4px 4px 0 var(--accent);
        transform: translate(-2px, -2px);
    }

    .footer-link a {
        color: #888;
        text-decoration: none;
        font-weight: 900;
        font-size: 0.75rem;
        text-transform: uppercase;
        display: block;
    }

    .footer-link:hover a {
        color: var(--dark);
    }
</style>

<section class="reset-section">
    <div class="reset-container">
        <div class="reset-header">
            <div class="reset-icon">
                <i class="fas fa-key"></i>
            </div>
            <h2 class="reset-title">RESET<br>PASSWORD</h2>
            <p class="reset-subtitle">Lost your access?</p>
        </div>

        <div class="info-box">
            <i class="fas fa-info-circle"></i>
            <div class="info-box-text">
                Input email & nomor telepon terdaftar untuk memulihkan akun.
            </div>
        </div>

        <?php if(session()->getFlashdata('error')): ?>
            <div class="alert alert-error">
                <i class="fas fa-exclamation-circle"></i>
                <span><?= session()->getFlashdata('error') ?></span>
            </div>
        <?php endif; ?>

        <?php if(session()->getFlashdata('success')): ?>
            <div class="alert alert-success">
                <i class="fas fa-check-circle"></i>
                <span><?= session()->getFlashdata('success') ?></span>
            </div>
        <?php endif; ?>

        <form action="<?= base_url('user/forgot-password') ?>" method="POST">
            <div class="form-group">
                <label class="form-label"><i class="fas fa-envelope"></i> Email</label>
                <input type="email" name="email" class="form-input" placeholder="EMAIL" value="<?= old('email') ?>" required>
            </div>

            <div class="form-group">
                <label class="form-label"><i class="fas fa-phone"></i> Nomor Telepon</label>
                <input type="text" name="phone" class="form-input" placeholder="NOMOR" value="<?= old('phone') ?>" required>
            </div>

            <div class="form-group">
                <label class="form-label"><i class="fas fa-lock"></i> Password Baru</label>
                <input type="password" name="password" class="form-input" placeholder="********" required>
            </div>

            <button type="submit" class="btn-submit">
                <i class="fas fa-key"></i> RESET SEKARANG
            </button>
        </form>

        <div class="reset-footer">
            <div class="footer-link">
                <a href="<?= base_url('user/login') ?>">
                    <i class="fas fa-arrow-left"></i> Kembali ke Login
                </a>
            </div>
        </div>
    </div>
</section>