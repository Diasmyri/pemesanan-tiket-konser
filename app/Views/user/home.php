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
    --dark: #000000;
    --white: #ffffff;
    --brutal-border: 4px solid #ffffff;
}

body, html {
    margin: 0; padding: 0;
    background-color: var(--dark);
    font-family: 'Space Grotesk', sans-serif;
    color: var(--white);
    overflow-x: hidden;
}

/* PAGE TRANSITION ANIMATION */
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

/* LAYOUT STRUCTURE */
.main-viewport {
    display: flex; flex-direction: column; min-height: 100vh;
}

/* HERO SECTION WITH PARALLAX */
.hero-parallax {
    display: flex; border-bottom: var(--brutal-border);
    height: 65vh; position: relative; overflow: hidden;
}

.hero-content {
    flex: 1.2; padding: 60px; display: flex; flex-direction: column;
    justify-content: center; border-right: var(--brutal-border);
    background: var(--dark); z-index: 2;
}

.hero-visual-wrapper {
    flex: 0.8; position: relative; background: #111;
    overflow: hidden; cursor: crosshair;
}

.parallax-img {
    width: 120%; height: 120%; object-fit: cover;
    position: absolute; top: -10%; left: -10%;
    filter: grayscale(100%) contrast(1.2);
    transition: filter 0.5s ease;
}

.hero-visual-wrapper:hover .parallax-img {
    filter: grayscale(0%) contrast(1);
}

.mega-title {
    font-size: clamp(4rem, 12vw, 10rem); font-weight: 900;
    line-height: 0.8; margin: 0; letter-spacing: -8px;
    text-transform: uppercase;
}

/* INTERACTIVE GRID NAV */
.nav-interactive-grid {
    display: grid; grid-template-columns: repeat(3, 1fr); flex: 1;
}

.nav-item {
    text-decoration: none; color: var(--white);
    padding: 60px 40px; border-right: var(--brutal-border);
    position: relative; overflow: hidden;
    display: flex; flex-direction: column; justify-content: space-between;
}

.nav-item:last-child { border-right: none; }

.nav-label {
    font-size: 4rem; font-weight: 900; line-height: 0.9;
    margin: 0; z-index: 3; position: relative; transition: 0.5s;
}

.nav-desc {
    font-size: 1rem; margin-top: 15px; z-index: 3;
    position: relative; opacity: 0.7; transition: 0.3s;
}

/* HOVER BACKGROUND REVEAL */
.hover-reveal-bg {
    position: absolute; inset: 0; z-index: 1;
    background: var(--primary);
    transform: translateY(105%);
    transition: transform 0.6s cubic-bezier(0.19, 1, 0.22, 1);
}

.item-explore:hover .hover-reveal-bg { background: var(--primary); transform: translateY(0); }
.item-orders:hover .hover-reveal-bg { background: var(--secondary); transform: translateY(0); }
.item-profile:hover .hover-reveal-bg { background: var(--accent); transform: translateY(0); }

.nav-item:hover .nav-label { transform: skewX(-5deg) translateX(10px); color: #000; }
.nav-item:hover .nav-desc { color: #000; opacity: 1; transform: translateX(10px); }

/* ICON FLOATING */
.float-icon {
    position: absolute; bottom: 20px; right: 20px;
    font-size: 6rem; opacity: 0.05; z-index: 2;
    transition: 0.6s cubic-bezier(0.175, 0.885, 0.32, 1.275);
}
.nav-item:hover .float-icon {
    transform: scale(1.8) rotate(-20deg); opacity: 0.2; color: #000;
}

/* MARQUEE FOOTER */
.marquee-bar {
    background: var(--white); color: #000; padding: 15px 0;
    border-top: var(--brutal-border); overflow: hidden;
}
.marquee-text {
    display: inline-block; white-space: nowrap; font-weight: 900;
    text-transform: uppercase; font-size: 1.2rem;
    animation: scroll-text 20s linear infinite;
}
@keyframes scroll-text {
    from { transform: translateX(0); }
    to { transform: translateX(-50%); }
}

@media (max-width: 992px) {
    .hero-parallax { flex-direction: column; height: auto; }
    .hero-content { border-right: none; border-bottom: var(--brutal-border); }
    .nav-interactive-grid { grid-template-columns: 1fr; }
    .nav-item { border-right: none; border-bottom: var(--brutal-border); }
}
</style>

<div class="main-viewport">
    <section class="hero-parallax">
        <div class="hero-content">
            <div style="background: var(--primary); color: #fff; display: inline-block; padding: 5px 15px; font-weight: 900; margin-bottom: 20px; font-size: 0.8rem; letter-spacing: 2px;">
                DASHBOARD // V.03
            </div>
            <h1 class="mega-title">TICKET<br><span style="color: var(--primary); -webkit-text-stroke: 1.5px #fff; color: transparent;">REVOLUTION.</span></h1>
        </div>
        <div class="hero-visual-wrapper">
            <img src="https://images.unsplash.com/photo-1533174072545-7a4b6ad7a6c3?q=80&w=2070&auto=format&fit=crop" class="parallax-img">
        </div>
    </section>

    <nav class="nav-interactive-grid">
        <a href="<?= base_url('user/events') ?>" class="nav-item item-explore">
            <div class="hover-reveal-bg"></div>
            <i class="fa-solid fa-bolt-lightning float-icon"></i>
            <div class="nav-inner">
                <h2 class="nav-label">EXPLORE<br>EVENTS</h2>
                <p class="nav-desc">Temukan panggung favoritmu sekarang.</p>
            </div>
            <div style="font-weight: 900; z-index: 3;">[ 01 ]</div>
        </a>

        <a href="<?= base_url('user/orders') ?>" class="nav-item item-orders">
            <div class="hover-reveal-bg"></div>
            <i class="fa-solid fa-ticket float-icon"></i>
            <div class="nav-inner">
                <h2 class="nav-label">MY<br>TICKETS</h2>
                <p class="nav-desc">Kelola tiket digital dalam satu akses.</p>
            </div>
            <div style="font-weight: 900; z-index: 3;">[ 02 ]</div>
        </a>

        <a href="<?= base_url('user/profile') ?>" class="nav-item item-profile">
            <div class="hover-reveal-bg"></div>
            <i class="fa-solid fa-user-gear float-icon"></i>
            <div class="nav-inner">
                <h2 class="nav-label">USER<br>PROFILE</h2>
                <p class="nav-desc">Update identitas dan keamanan akun.</p>
            </div>
            <div style="font-weight: 900; z-index: 3;">[ 03 ]</div>
        </a>
    </nav>

    <div class="marquee-bar">
        <div class="marquee-text">
            SYSTEM ONLINE • SECURE ACCESS • NO REFUNDS • LIVE EXPERIENCE • SYSTEM ONLINE • SECURE ACCESS • NO REFUNDS • LIVE EXPERIENCE •
        </div>
    </div>
</div>

<script>
    // 1. Trigger Page Transition pas halaman kelar loading
    window.addEventListener('load', () => {
        document.body.classList.add('loaded');
    });

    // 2. Parallax Effect buat gambar Hero
    const heroWrapper = document.querySelector('.hero-visual-wrapper');
    const heroImg = document.querySelector('.parallax-img');

    heroWrapper.addEventListener('mousemove', (e) => {
        const { left, top, width, height } = heroWrapper.getBoundingClientRect();
        const x = (e.clientX - left) / width;
        const y = (e.clientY - top) / height;
        
        const moveX = (x - 0.5) * 30; // sensitivitas gerakan horizontal
        const moveY = (y - 0.5) * 30; // sensitivitas gerakan vertikal
        
        heroImg.style.transform = `translate(${moveX}px, ${moveY}px) scale(1.1)`;
    });

    heroWrapper.addEventListener('mouseleave', () => {
        heroImg.style.transform = `translate(0, 0) scale(1)`;
    });
</script>

<?php include 'layout/footer.php'; ?>