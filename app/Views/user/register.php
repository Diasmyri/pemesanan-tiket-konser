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
        --transition: all 0.2s cubic-bezier(0.165, 0.84, 0.44, 1);
    }

    body {
        background-color: var(--dark);
        font-family: 'Space Grotesk', sans-serif;
        color: var(--white);
        margin: 0;
        overflow-x: hidden;
    }

    .register-section {
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 20px;
        background: 
            radial-gradient(circle at 10% 20%, rgba(139, 92, 246, 0.1) 0%, transparent 40%),
            radial-gradient(circle at 90% 80%, rgba(236, 72, 153, 0.1) 0%, transparent 40%);
    }

    .register-container {
        background: var(--dark);
        border: 6px solid var(--white);
        width: 100%;
        max-width: 380px; /* SAMA DENGAN LOGIN */
        padding: 25px; /* Padding lebih tipis */
        box-shadow: 10px 10px 0 var(--secondary);
        position: relative;
    }

    /* --- HEADER COMPACT --- */
    .register-header {
        text-align: left;
        margin-bottom: 15px;
        border-bottom: 4px solid var(--white);
        padding-bottom: 10px;
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
        font-size: 2rem;
        font-weight: 900;
        text-transform: uppercase;
        letter-spacing: -1.5px;
        line-height: 0.85;
        margin-bottom: 8px;
    }

    .register-subtitle {
        font-size: 0.7rem;
        font-weight: 700;
        color: var(--dark);
        background: var(--accent);
        display: inline-block;
        padding: 2px 8px;
        text-transform: uppercase;
    }

    /* --- ALERT --- */
    .alert {
        padding: 8px 12px;
        border: 3px solid var(--white);
        font-weight: 800;
        text-transform: uppercase;
        font-size: 0.65rem;
        margin-bottom: 15px;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .alert-error { background: var(--secondary); color: white; }

    /* --- FORM GRID COMPACT --- */
    .register-form {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 10px;
    }

    .form-group.full { grid-column: span 2; }

    .form-label {
        display: block;
        font-weight: 900;
        text-transform: uppercase;
        font-size: 0.7rem;
        margin-bottom: 4px;
        color: #ccc;
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
        transition: var(--transition);
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
        transition: var(--transition);
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        margin-top: 5px;
    }

    .btn-submit:hover {
        background: var(--white);
        color: var(--dark);
        transform: translate(-4px, -4px);
        box-shadow: 8px 8px 0 var(--primary);
    }

    /* --- FOOTER COMPACT --- */
    .register-footer {
        grid-column: span 2;
        margin-top: 15px;
        display: grid;
        grid-template-columns: 1fr;
        gap: 8px;
    }

    .footer-link {
        border: 2px solid #333;
        padding: 8px;
        text-align: center;
        transition: var(--transition);
        background: #0a0a0a;
        text-decoration: none;
    }

    .footer-link span {
        color: var(--white);
        font-weight: 900;
        font-size: 0.65rem;
        text-transform: uppercase;
    }

    .footer-link:hover {
        background: var(--white);
        border-color: var(--white);
    }
    .footer-link:hover span { color: var(--dark); }

    @media (max-height: 750px) {
        .register-container { transform: scale(0.9); }
    }
</style>

<section class="register-section">
    <div class="register-container">
        <div class="register-header">
            <div class="register-icon">
                <i class="fas fa-user-plus"></i>
            </div>
            <h2 class="register-title">JOIN THE<br>MOSH PIT!</h2>
            <p class="register-subtitle">Registrasi akun baru</p>
        </div>

        <?php if(session()->getFlashdata('error')): ?>
            <div class="alert alert-error">
                <i class="fas fa-exclamation-circle"></i>
                <span><?= session()->getFlashdata('error') ?></span>
            </div>
        <?php endif; ?>

        <form action="<?= base_url('user/register') ?>" method="POST" class="register-form">
            <div class="form-group full">
                <label class="form-label">Username</label>
                <input type="text" name="username" class="form-input" placeholder="USER123" required>
            </div>

            <div class="form-group full">
                <label class="form-label">Nama Lengkap</label>
                <input type="text" name="nama" class="form-input" placeholder="NAMA LENGKAP" required>
            </div>

            <div class="form-group">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-input" placeholder="MAIL@" required>
            </div>

            <div class="form-group">
                <label class="form-label">Telepon</label>
                <input type="text" name="nomor_telepon" class="form-input" placeholder="08..." required>
            </div>

            <div class="form-group full">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-input" placeholder="********" required>
            </div>

            <button type="submit" class="btn-submit">
                <i class="fas fa-rocket"></i> DAFTAR
            </button>

            <div class="register-footer">
                <a href="<?= base_url('user/login') ?>" class="footer-link">
                    <span>Sudah punya akun? <b>LOGIN</b></span>
                </a>
            </div>
        </form>
    </div>
</section>