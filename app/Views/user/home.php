<?php include 'layout/header.php'; ?>
<?php include 'layout/navbar.php'; ?>

<div class="page-transition-shutter">
    <div class="shutter-bar"></div>
    <div class="shutter-bar"></div>
    <div class="shutter-bar"></div>
</div>

<style>
/* --- CORE STYLING --- */
:root {
    --primary: #8b5cf6; 
    --secondary: #ec4899;
    --accent: #00f2fe;
    --dark: #050505;
    --white: #ffffff;
    --brutal-border: 4px solid #ffffff;
    --transition: all 0.5s cubic-bezier(0.23, 1, 0.32, 1);
}

body, html {
    margin: 0; padding: 0;
    background-color: var(--dark);
    font-family: 'Space Grotesk', sans-serif;
    color: var(--white);
    overflow-x: hidden;
}

/* PAGE TRANSITION */
.page-transition-shutter {
    position: fixed; inset: 0; z-index: 9999;
    display: flex; flex-direction: column;
    pointer-events: none;
}
.shutter-bar {
    flex: 1; background: var(--white); width: 100%;
    transform: translateX(0);
    transition: transform 0.8s cubic-bezier(0.87, 0, 0.13, 1);
}
body.loaded .shutter-bar { transform: translateX(100%); }
body.loaded .shutter-bar:nth-child(2) { transition-delay: 0.1s; }
body.loaded .shutter-bar:nth-child(3) { transition-delay: 0.2s; }

/* MAIN VIEWPORT */
.main-viewport {
    display: flex; flex-direction: column; min-height: 100vh;
}

/* HERO SECTION */
.hero-parallax {
    display: flex; border-bottom: var(--brutal-border);
    height: 70vh; position: relative; overflow: hidden;
}

.hero-content {
    flex: 1.2; padding: 80px 60px; display: flex; flex-direction: column;
    justify-content: center; border-right: var(--brutal-border);
    background: var(--dark); z-index: 2;
}

.hero-visual-wrapper {
    flex: 0.8; position: relative; background: #000;
    overflow: hidden; cursor: crosshair;
}

.parallax-img {
    width: 110%; height: 110%; object-fit: cover;
    position: absolute; top: -5%; left: -5%;
    filter: grayscale(100%) brightness(0.7);
    transition: var(--transition);
}

.hero-visual-wrapper:hover .parallax-img {
    filter: grayscale(0%) brightness(1);
    transform: scale(1.05);
}

.mega-title {
    font-size: clamp(3.5rem, 10vw, 8rem); font-weight: 900;
    line-height: 0.85; margin: 0; letter-spacing: -5px;
    text-transform: uppercase;
}

.sub-mega {
    color: var(--primary);
    -webkit-text-stroke: 1.5px #fff;
    color: transparent;
}

/* INTERACTIVE GRID NAV */
.nav-interactive-grid {
    display: grid; grid-template-columns: repeat(3, 1fr); 
    background: var(--white); gap: 4px; /* Garis pemisah otomatis */
    border-bottom: var(--brutal-border);
}

.nav-item {
    text-decoration: none; color: var(--white);
    padding: 80px 40px; background: var(--dark);
    position: relative; overflow: hidden;
    display: flex; flex-direction: column; justify-content: space-between;
    transition: var(--transition);
}

.nav-inner { position: relative; z-index: 3; }

.nav-label {
    font-size: 3.5rem; font-weight: 900; line-height: 0.9;
    margin: 0; text-transform: uppercase; letter-spacing: -2px;
}

.nav-desc {
    font-size: 1rem; margin-top: 20px; opacity: 0.6;
    max-width: 250px; line-height: 1.4;
}

/* HOVER BACKGROUND REVEAL */
.hover-reveal-bg {
    position: absolute; inset: 0; z-index: 1;
    transform: translateY(100%);
    transition: transform 0.5s cubic-bezier(0.19, 1, 0.22, 1);
}

.item-explore:hover .hover-reveal-bg { background: var(--primary); transform: translateY(0); }
.item-orders:hover .hover-reveal-bg { background: var(--secondary); transform: translateY(0); }
.item-profile:hover .hover-reveal-bg { background: var(--accent); transform: translateY(0); }

.nav-item:hover .nav-label { transform: skewX(-3deg); color: #000; }
.nav-item:hover .nav-desc { color: #000; opacity: 0.8; }
.nav-item:hover .nav-index { color: #000; }

.nav-index {
    font-weight: 900; z-index: 3; font-family: 'Space Mono', monospace;
    font-size: 1.2rem;
}

/* ICON FLOATING */
.float-icon {
    position: absolute; top: 50%; right: -10%;
    font-size: 12rem; opacity: 0.03; z-index: 2;
    transition: var(--transition);
    transform: translateY(-50%);
}
.nav-item:hover .float-icon {
    right: 5%; opacity: 0.15; color: #000; transform: translateY(-50%) rotate(-15deg);
}

/* MARQUEE FOOTER */
.marquee-bar {
    background: var(--white); color: #000; padding: 20px 0;
    overflow: hidden; display: flex;
}
.marquee-text {
    display: inline-block; white-space: nowrap; font-weight: 900;
    text-transform: uppercase; font-size: 1.5rem;
    animation: scroll-text 30s linear infinite;
}

@keyframes scroll-text {
    from { transform: translateX(0); }
    to { transform: translateX(-50%); }
}

/* RESPONSIVE */
@media (max-width: 1024px) {
    .hero-parallax { height: auto; flex-direction: column; }
    .hero-content { border-right: none; border-bottom: var(--brutal-border); padding: 60px 30px; }
    .nav-interactive-grid { grid-template-columns: 1fr; gap: 0; }
    .nav-item { border-bottom: 2px solid var(--white); padding: 60px 30px; }
}
</style>

<div class="main-viewport">
    <section class="hero-parallax">
        <div class="hero-content">
            <div style="background: var(--white); color: #000; display: inline-block; padding: 4px 12px; font-weight: 900; margin-bottom: 25px; font-size: 0.75rem; letter-spacing: 3px; border-radius: 2px;">
                STATUS: SYSTEM ACTIVE // 2025
            </div>
            <h1 class="mega-title">
                BOOK YOUR<br>
                <span class="sub-mega">EXPERIENCE.</span>
            </h1>
            <p style="margin-top: 20px; font-size: 1.1rem; opacity: 0.7; max-width: 400px; font-weight: 500;">
                Platform tiket konser tercepat dengan akses eksklusif ke berbagai event musik nasional dan internasional.
            </p>
        </div>
        <div class="hero-visual-wrapper">
            <img src="https://images.unsplash.com/photo-1470229722913-7c0e2dbbafd3?q=80&w=2070&auto=format&fit=crop" class="parallax-img">
        </div>
    </section>

    <nav class="nav-interactive-grid">
        <a href="<?= base_url('user/events') ?>" class="nav-item item-explore">
            <div class="hover-reveal-bg"></div>
            <i class="fa-solid fa-bolt-lightning float-icon"></i>
            <div class="nav-inner">
                <div class="nav-index">/01</div>
                <h2 class="nav-label">EXPLORE<br>EVENTS</h2>
                <p class="nav-desc">Cari jadwal konser dan festival musik terbaru bulan ini.</p>
            </div>
        </a>

        <a href="<?= base_url('user/transactions') ?>" class="nav-item item-orders">
            <div class="hover-reveal-bg"></div>
            <i class="fa-solid fa-ticket float-icon"></i>
            <div class="nav-inner">
                <div class="nav-index">/02</div>
                <h2 class="nav-label">MY<br>TICKETS</h2>
                <p class="nav-desc">Lihat status pesanan dan simpan tiket digital kamu.</p>
            </div>
        </a>

        <a href="<?= base_url('user/profile') ?>" class="nav-item item-profile">
            <div class="hover-reveal-bg"></div>
            <i class="fa-solid fa-user-gear float-icon"></i>
            <div class="nav-inner">
                <div class="nav-index">/03</div>
                <h2 class="nav-label">USER<br>SETTINGS</h2>
                <p class="nav-desc">Atur profil, alamat pengiriman, dan keamanan akun.</p>
            </div>
        </a>
    </nav>

    <div class="marquee-bar">
        <div class="marquee-text">
            KONSERKU EXPERIENCE • SECURE CHECKOUT • VERIFIED TICKETS • NO HIDDEN FEES • 24/7 SUPPORT • LIVE YOUR MUSIC • KONSERKU EXPERIENCE • SECURE CHECKOUT • VERIFIED TICKETS • NO HIDDEN FEES • 24/7 SUPPORT • LIVE YOUR MUSIC •
        </div>
    </div>
</div>

<script>
    // Trigger Page Transition
    window.addEventListener('load', () => {
        setTimeout(() => {
            document.body.classList.add('loaded');
        }, 300);
    });

    // Enhanced Mouse Follow Parallax
    const heroWrapper = document.querySelector('.hero-visual-wrapper');
    const heroImg = document.querySelector('.parallax-img');

    heroWrapper.addEventListener('mousemove', (e) => {
        const { left, top, width, height } = heroWrapper.getBoundingClientRect();
        const x = (e.clientX - left) / width;
        const y = (e.clientY - top) / height;
        
        const moveX = (x - 0.5) * 40; 
        const moveY = (y - 0.5) * 40; 
        
        heroImg.style.transform = `translate(${moveX}px, ${moveY}px) scale(1.15)`;
    });

    heroWrapper.addEventListener('mouseleave', () => {
        heroImg.style.transform = `translate(0, 0) scale(1.1)`;
    });
</script>

<?php include 'layout/footer.php'; ?>