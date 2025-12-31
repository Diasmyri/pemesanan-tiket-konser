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
        --transition: all 0.2s cubic-bezier(0.165, 0.84, 0.44, 1);
    }

    body {
        background-color: var(--dark);
        font-family: 'Space Grotesk', sans-serif;
        color: var(--white);
        margin: 0;
        min-height: 100vh;
    }

    /* --- LOGIN SECTION --- */
    .login-section {
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 40px 20px;
        background: 
            radial-gradient(circle at 10% 20%, rgba(139, 92, 246, 0.15) 0%, transparent 40%),
            radial-gradient(circle at 90% 80%, rgba(236, 72, 153, 0.15) 0%, transparent 40%);
        position: relative;
    }

    .login-container {
        background: var(--dark);
        border: 6px solid var(--white);
        width: 100%;
        max-width: 400px;
        padding: 40px 30px;
        box-shadow: 12px 12px 0 var(--primary);
        position: relative;
        z-index: 10;
        transition: var(--transition);
    }

    /* --- HEADER LOGIN --- */
    .login-header {
        text-align: left;
        margin-bottom: 25px;
        border-bottom: 5px solid var(--white);
        padding-bottom: 20px;
    }

    .login-icon {
        font-size: 2rem;
        color: var(--accent);
        margin-bottom: 15px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border: 3px solid var(--white);
        width: 50px;
        height: 50px;
        background: #111;
        box-shadow: 4px 4px 0 var(--white);
    }

    .login-title {
        font-size: 2.5rem;
        font-weight: 900;
        text-transform: uppercase;
        letter-spacing: -2px;
        line-height: 0.9;
        margin-bottom: 12px;
        color: var(--white);
    }

    .login-subtitle {
        font-size: 0.75rem;
        font-weight: 800;
        color: var(--dark);
        background: var(--accent);
        display: inline-block;
        padding: 4px 10px;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    /* --- ALERT --- */
    .alert-error {
        background: var(--secondary);
        color: white;
        padding: 12px;
        border: 3px solid var(--white);
        font-weight: 800;
        text-transform: uppercase;
        font-size: 0.75rem;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 10px;
        box-shadow: 4px 4px 0 rgba(0,0,0,0.5);
    }

    /* --- FORM STYLING --- */
    .form-group {
        margin-bottom: 18px;
    }

    .form-label {
        display: block;
        font-weight: 900;
        text-transform: uppercase;
        font-size: 0.8rem;
        margin-bottom: 8px;
        color: var(--accent);
    }

    .form-input {
        width: 100%;
        padding: 14px;
        background: #0a0a0a;
        border: 3px solid var(--white);
        color: var(--white);
        font-family: 'Space Grotesk', sans-serif;
        font-weight: 700;
        font-size: 1rem;
        transition: var(--transition);
    }

    .form-input:focus {
        outline: none;
        background: #111;
        box-shadow: 6px 6px 0 var(--accent);
        transform: translate(-3px, -3px);
    }

    .btn-submit {
        width: 100%;
        padding: 16px;
        background: var(--primary);
        color: white;
        border: 4px solid var(--white);
        font-weight: 900;
        text-transform: uppercase;
        font-size: 1rem;
        cursor: pointer;
        transition: var(--transition);
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 12px;
        margin-top: 10px;
    }

    .btn-submit:hover {
        background: var(--white);
        color: var(--dark);
        transform: translate(-5px, -5px);
        box-shadow: 10px 10px 0 var(--secondary);
    }

    /* --- FOOTER GRID --- */
    .login-footer {
        margin-top: 30px;
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 10px;
    }

    .footer-link {
        border: 2px solid #333;
        padding: 12px 5px;
        text-align: center;
        transition: var(--transition);
        background: #0a0a0a;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .footer-link.full-width {
        grid-column: span 2;
        border-color: #444;
    }

    .footer-link a {
        color: #888;
        text-decoration: none;
        font-weight: 800;
        font-size: 0.7rem;
        text-transform: uppercase;
        transition: var(--transition);
    }

    .footer-link:hover {
        background: var(--white);
        border-color: var(--white);
        box-shadow: 4px 4px 0 var(--accent);
        transform: translateY(-2px);
    }

    .footer-link:hover a { 
        color: var(--dark); 
    }

    /* --- RESPONSIVE --- */
    @media (max-width: 450px) {
        .login-container {
            padding: 30px 20px;
            max-width: 100%;
            border-width: 4px;
        }
        .login-title {
            font-size: 2rem;
        }
    }

    @media (max-height: 650px) {
        .login-section { padding: 20px; }
        .login-container { transform: scale(0.9); }
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
                <input type="text" name="username" class="form-input" placeholder="USERNAME" required autofocus>
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
                <a href="<?= base_url('user/register') ?>">BUAT AKUN</a>
            </div>
            <div class="footer-link">
                <a href="<?= base_url('user/forgot-password') ?>">LUPA PASSWORD?</a>
            </div>
            <div class="footer-link full-width">
                <a href="<?= base_url('user') ?>">
                    <i class="fas fa-arrow-left" style="margin-right: 5px;"></i> KEMBALI KE HOME
                </a>
            </div>
        </div>
    </div>
</section>