<style>
    @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@700;800&family=Space+Mono:wght@700&display=swap');

    :root {
        --bg-nav: rgba(5, 5, 7, 0.95);
        --accent: #8b5cf6;
        --accent-alt: #00f2fe;
        --border-color: rgba(255, 255, 255, 0.08);
    }

    body { margin: 0; background: #000; padding-top: 80px; }

    /* --- FULL WIDTH ULTRA SLEEK NAV --- */
    .navbar {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 75px;
        background: var(--bg-nav);
        backdrop-filter: blur(20px);
        border-bottom: 1px solid var(--border-color);
        z-index: 9999;
        font-family: 'Plus Jakarta Sans', sans-serif;
    }

    /* Efek Garis Glitch Halus di bawah border */
    .navbar::after {
        content: '';
        position: absolute;
        bottom: -1px;
        left: 0;
        width: 100%;
        height: 1px;
        background: linear-gradient(90deg, 
            transparent, 
            var(--accent) 20%, 
            var(--accent-alt) 50%, 
            var(--accent) 80%, 
            transparent);
        opacity: 0.4;
    }

    .nav-container {
        max-width: 1440px;
        height: 100%;
        margin: 0 auto;
        padding: 0 40px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    /* --- LOGO: SHARP & MINIMAL --- */
    .nav-logo {
        display: flex;
        align-items: center;
        gap: 12px;
        text-decoration: none;
        color: #fff;
        font-weight: 800;
        font-size: 1.3rem;
        letter-spacing: -1px;
    }

    .logo-mark {
        width: 35px;
        height: 35px;
        background: #fff;
        color: #000;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 6px;
        font-size: 18px;
        box-shadow: 0 0 20px rgba(255, 255, 255, 0.2);
        position: relative;
    }

    /* --- MENU: FULL HEIGHT STYLE --- */
    .nav-menu {
        display: flex;
        list-style: none;
        height: 100%;
        margin: 0;
        padding: 0;
    }

    .nav-link {
        text-decoration: none;
        color: #666;
        font-size: 14px;
        font-weight: 700;
        padding: 0 25px;
        height: 100%;
        display: flex;
        align-items: center;
        transition: 0.3s;
        position: relative;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .nav-link:hover {
        color: #fff;
        background: rgba(255, 255, 255, 0.03);
    }

    /* Indicator Aktif yang "Rusak" tapi Rapi */
    .nav-link.active {
        color: #fff;
        background: rgba(139, 92, 246, 0.1);
    }

    .nav-link.active::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 3px;
        background: var(--accent);
        box-shadow: 0 0 15px var(--accent);
    }

    /* --- SIGN OUT: CLEAN INDUSTRIAL --- */
    .nav-right {
        display: flex;
        align-items: center;
    }

    .btn-logout {
        text-decoration: none;
        color: #fff;
        font-family: 'Space Mono', monospace;
        font-size: 12px;
        font-weight: 700;
        padding: 10px 20px;
        border: 1px solid #333;
        background: transparent;
        transition: 0.2s;
        text-transform: uppercase;
    }

    .btn-logout:hover {
        background: #fff;
        color: #000;
        border-color: #fff;
        box-shadow: 4px 4px 0px var(--accent);
    }

    /* Micro Animation: Glitch pada teks logo */
    .nav-logo:hover span {
        animation: glitch-text 0.2s infinite;
    }

    @keyframes glitch-text {
        0% { transform: translate(0); text-shadow: 2px 0 var(--accent); }
        50% { transform: translate(-2px, 1px); text-shadow: -2px 0 var(--accent-alt); }
        100% { transform: translate(0); }
    }
</style>

<nav class="navbar">
    <div class="nav-container">
        <a href="#" class="nav-logo">
            <div class="logo-mark"><i class="fas fa-bolt"></i></div>
            <span>TIXCORE<span style="color: var(--accent);">_</span></span>
        </a>

        <ul class="nav-menu">
            <li><a href="/user/home" class="nav-link">Home</a></li>
            <li><a href="/user/events" class="nav-link">Explore</a></li>
            <li><a href="/user/transactions" class="nav-link">My Tickets</a></li>
            <li><a href="/user/profile" class="nav-link active">Profile</a></li>
        </ul>

<div class="nav-right"> 
    <a href="<?= base_url('user/logout') ?>" class="btn-logout">
        <span>Sign Out</span>
        <i class="fas fa-sign-out-alt"></i>
    </a>
</div>
    </div>
</nav>