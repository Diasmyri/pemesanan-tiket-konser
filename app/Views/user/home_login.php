<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KONSERKU // OFFICIAL BRUTAL STAGE</title>

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

        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            background-color: var(--dark);
            font-family: 'Space Grotesk', sans-serif;
            color: var(--white);
            overflow-x: hidden;
        }

        /* SHUTTER ANIMATION */
        .shutter {
            position: fixed; inset: 0; z-index: 9999; display: flex; flex-direction: column; pointer-events: none;
        }
        .shutter-bar {
            flex: 1; background: var(--white); transform: translateX(-100%);
            animation: shutterOpen 0.6s cubic-bezier(0.87, 0, 0.13, 1) forwards;
        }
        @keyframes shutterOpen { 100% { transform: translateX(100%); } }

        /* NAVBAR */
        .navbar {
            position: sticky; top: 0; z-index: 1000; background: var(--dark);
            border-bottom: var(--brutal-border); padding: 15px 30px;
            display: flex; justify-content: space-between; align-items: center;
        }
        .brand { font-size: 1.8rem; font-weight: 900; letter-spacing: -2px; text-transform: uppercase; }
        .nav-btn {
            text-decoration: none; padding: 8px 20px; border: var(--brutal-border);
            font-weight: 900; text-transform: uppercase; transition: 0.2s; font-size: 0.8rem; color: white;
        }
        .btn-reg { background: var(--white); color: var(--dark); margin-left: 10px; }

        /* HERO SLIDER (ABOUT, TICKETS, CONTACT) */
        .ss-container {
            height: 60vh; position: relative; overflow: hidden; border-bottom: var(--brutal-border);
        }
        .ss-wrapper { display: flex; width: 300%; height: 100%; transition: transform 0.6s cubic-bezier(0.8, 0, 0.2, 1); }
        .ss-slide { width: 33.333%; height: 100%; display: flex; }
        .ss-info {
            flex: 1; padding: 40px; display: flex; flex-direction: column; justify-content: center;
            background: var(--dark); border-right: var(--brutal-border);
        }
        .ss-visual { flex: 1.2; overflow: hidden; background: #111; }
        .ss-visual img { width: 100%; height: 100%; object-fit: cover; filter: grayscale(1); transition: 0.5s; }
        .ss-slide:hover .ss-visual img { filter: grayscale(0); }

        #s1:checked ~ .ss-wrapper { transform: translateX(0%); }
        #s2:checked ~ .ss-wrapper { transform: translateX(-33.333%); }
        #s3:checked ~ .ss-wrapper { transform: translateX(-66.666%); }

        .arrows {
            position: absolute; inset: 0; display: none; justify-content: space-between; 
            align-items: center; padding: 0 20px; pointer-events: none; z-index: 100;
        }
        .arrows label {
            width: 50px; height: 50px; background: var(--white); color: var(--dark);
            display: flex; align-items: center; justify-content: center;
            cursor: pointer; pointer-events: auto; border: 3px solid var(--dark);
        }
        #s1:checked ~ .arr-1, #s2:checked ~ .arr-2, #s3:checked ~ .arr-3 { display: flex; }

        .mega-text { font-size: clamp(2.5rem, 6vw, 4.5rem); font-weight: 900; line-height: 0.85; text-transform: uppercase; letter-spacing: -4px; margin-bottom: 15px; }
        .mini-desc { font-size: 0.95rem; font-weight: 500; max-width: 450px; line-height: 1.4; color: #ccc; margin-bottom: 25px; }

        .social-wrap { display: flex; gap: 15px; }
        .social-btn {
            text-decoration: none; padding: 12px 20px; border: 3px solid white;
            background: transparent; color: white; font-weight: 900; text-transform: uppercase;
            font-size: 0.8rem; transition: 0.2s;
        }
        .social-btn:hover { background: var(--accent); color: black; transform: translate(-4px, -4px); box-shadow: 6px 6px 0 white; }

        /* MARQUEE */
        .marquee {
            background: var(--accent); color: #000; padding: 12px 0; border-bottom: var(--brutal-border); overflow: hidden;
        }
        .marquee-content {
            display: flex; white-space: nowrap; font-weight: 900; font-size: 1.2rem;
            animation: scroll 20s linear infinite; text-transform: uppercase;
        }
        @keyframes scroll { from { transform: translateX(0); } to { transform: translateX(-50%); } }

        /* EVENT GRID (CENTERED) */
        .event-section {
            padding: 80px 20px; display: flex; justify-content: center; background: var(--dark);
        }
        .event-grid { 
            display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            max-width: 1200px; width: 100%; border-top: var(--brutal-border); border-left: var(--brutal-border);
        }
        .event-card {
            border-right: var(--brutal-border); border-bottom: var(--brutal-border);
            padding: 25px; background: var(--dark); display: flex; flex-direction: column; transition: 0.3s;
        }
        .event-card:hover { background: #0a0a0a; }

        .event-img-wrap { 
            width: 100%; aspect-ratio: 1; border: 3px solid white; margin-bottom: 20px; overflow: hidden;
        }
        .event-img-wrap img { width: 100%; height: 100%; object-fit: cover; filter: grayscale(1); transition: 0.4s; }
        .event-card:hover .event-img-wrap img { filter: grayscale(0); transform: scale(1.05); }

        .event-title { font-size: 1.3rem; font-weight: 900; text-transform: uppercase; margin-bottom: 8px; line-height: 1.1; }
        .event-meta { font-size: 0.75rem; font-weight: 700; color: var(--secondary); margin-bottom: 20px; text-transform: uppercase; }

        .btn-view {
            margin-top: auto; width: 100%; padding: 14px; background: var(--primary); color: white; border: 3px solid white;
            font-weight: 900; font-size: 0.85rem; text-transform: uppercase; transition: 0.2s; cursor: pointer;
        }
        .btn-view:hover { background: var(--white); color: var(--dark); transform: translate(-3px, -3px); box-shadow: 6px 6px 0 var(--secondary); }

        /* --- ARTIST MODAL REPAIRED (GRID SYSTEM) --- */
        .artist-modal {
            position: fixed; inset: 0; z-index: 2000; display: none;
            background: rgba(0,0,0,0.98); backdrop-filter: blur(10px);
            align-items: center; justify-content: center; padding: 20px;
        }
        .artist-box {
            background: var(--dark); border: 8px solid var(--white); width: 95%; max-width: 1100px;
            max-height: 85vh; box-shadow: 20px 20px 0 var(--secondary); display: flex; flex-direction: column; overflow: hidden;
        }
        .modal-header {
            display: flex; justify-content: space-between; align-items: center;
            padding: 20px 40px; border-bottom: 8px solid var(--white);
            background: var(--white); color: var(--dark); flex-shrink: 0;
        }
        .modal-header h3 { font-size: 2rem; font-weight: 900; letter-spacing: -1px; }
        .close-modal { font-size: 2rem; font-weight: 900; border: 4px solid var(--dark); padding: 0 12px; cursor: pointer; }

        #artistContent { 
            display: grid !important; 
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); /* OTOMATIS KE BAWAH */
            gap: 0; overflow-y: auto; background: #000;
        }
        .artist-item { 
            padding: 30px; text-align: center; border-right: 2px solid #333; border-bottom: 2px solid #333;
            background: #000; transition: 0.3s;
        }
        .artist-img-container {
            width: 100%; aspect-ratio: 1; border: 4px solid var(--white);
            margin-bottom: 15px; box-shadow: 8px 8px 0 var(--primary); overflow: hidden;
        }
        .artist-item img { width: 100%; height: 100%; object-fit: cover; filter: grayscale(1); transition: 0.4s; }
        .artist-item:hover img { filter: grayscale(0); transform: scale(1.1); }
        .artist-name { 
            font-size: 1.2rem; font-weight: 900; text-transform: uppercase; 
            background: var(--white); color: var(--dark); padding: 5px 12px; display: inline-block;
        }

        @media (max-width: 900px) {
            .ss-slide { flex-direction: column; }
            .ss-info { border-right: none; border-bottom: var(--brutal-border); }
            .ss-container { height: auto; }
        }
        @media (max-width: 600px) {
            #artistContent { grid-template-columns: repeat(2, 1fr); }
            .modal-header h3 { font-size: 1.2rem; }
        }
    </style>
</head>

<body>

<div class="shutter">
    <div class="shutter-bar"></div><div class="shutter-bar"></div><div class="shutter-bar"></div>
</div>

<nav class="navbar">
    <div class="brand">KONSERKU//</div>
    <div>
        <a href="<?= base_url('user/login') ?>" class="nav-btn">Login</a>
        <a href="<?= base_url('user/register') ?>" class="nav-btn btn-reg">Join Now</a>
    </div>
</nav>

<div class="ss-container">
    <input type="radio" name="ss" id="s1" checked style="display:none">
    <input type="radio" name="ss" id="s2" style="display:none">
    <input type="radio" name="ss" id="s3" style="display:none">

    <div class="arrows arr-1"><label for="s3"><i class="fas fa-chevron-left"></i></label><label for="s2"><i class="fas fa-chevron-right"></i></label></div>
    <div class="arrows arr-2"><label for="s1"><i class="fas fa-chevron-left"></i></label><label for="s3"><i class="fas fa-chevron-right"></i></label></div>
    <div class="arrows arr-3"><label for="s2"><i class="fas fa-chevron-left"></i></label><label for="s1"><i class="fas fa-chevron-right"></i></label></div>

    <div class="ss-wrapper">
        <div class="ss-slide">
            <div class="ss-info">
                <h1 class="mega-text">TENTANG<br>KAMI</h1>
                <p class="mini-desc">Platform revolusioner para pecinta musik. Kami menghubungkan Anda dengan panggung impian secara langsung tanpa batas.</p>
            </div>
            <div class="ss-visual"><img src="https://images.unsplash.com/photo-1501281668745-f7f57925c3b4?q=80&w=2070"></div>
        </div>
        <div class="ss-slide">
            <div class="ss-info">
                <h1 class="mega-text" style="color:var(--secondary)">TEMUKAN<br>TIKET</h1>
                <p class="mini-desc">Cari jadwal konser artis favorit Anda. Proses cepat, aman, dan pastinya brutal. Jangan sampai kehabisan slot!</p>
            </div>
            <div class="ss-visual"><img src="https://images.unsplash.com/photo-1470229722913-7c0e2dbbafd3?q=80&w=2070"></div>
        </div>
        <div class="ss-slide">
            <div class="ss-info">
                <h1 class="mega-text" style="color:var(--accent)">HUBUNGI<br>KAMI</h1>
                <p class="mini-desc">Butuh bantuan? Tim kami siap melayani Anda 24/7 melalui platform sosial di bawah ini.</p>
                <div class="social-wrap">
                    <a href="https://instagram.com" target="_blank" class="social-btn"><i class="fab fa-instagram"></i> Instagram</a>
                    <a href="mailto:info@konserku.com" class="social-btn"><i class="fas fa-envelope"></i> Email</a>
                </div>
            </div>
            <div class="ss-visual"><img src="https://images.unsplash.com/photo-1516280440614-37939bbacd81?q=80&w=2070"></div>
        </div>
    </div>
</div>

<div class="marquee">
    <div class="marquee-content">
        STAY BRUTAL — GET YOUR TICKETS — 2025 WORLD TOUR — NO REFUNDS — BE THERE — STAY BRUTAL — GET YOUR TICKETS — 
    </div>
</div>

<div class="event-section">
    <section class="event-grid">
        <?php foreach($events as $event): ?>
        <div class="event-card">
            <div class="event-img-wrap">
                <img src="/uploads/events/<?= esc($event['poster']) ?>">
            </div>
            <h2 class="event-title"><?= esc($event['title']) ?></h2>
            <p class="event-meta"><?= esc($event['venue_name']) ?> // <?= esc($event['date']) ?></p>
            <button class="btn-view" onclick="openArtists(<?= $event['id'] ?>)">View Artists</button>
        </div>
        <?php endforeach ?>
    </section>
</div>

<div class="artist-modal" id="artistModal">
    <div class="artist-box">
        <div class="modal-header">
            <h3>LINEUP ARTISTS</h3>
            <span class="close-modal" onclick="closeArtists()">✕</span>
        </div>
        <div id="artistContent"></div>
    </div>
</div>

<script>
function openArtists(eventId) {
    const content = document.getElementById('artistContent');
    document.getElementById('artistModal').style.display = 'flex';
    content.innerHTML = '<div style="padding:40px; font-weight:900; grid-column: 1/-1; text-align:center;">LOADING LINEUP...</div>';
    content.scrollTop = 0;

    fetch(`/user/auth/artists/${eventId}`)
        .then(res => res.json())
        .then(data => {
            if (!data.length) {
                content.innerHTML = '<div style="padding:40px; font-weight:900; grid-column: 1/-1; text-align:center;">NO ARTISTS FOUND.</div>';
                return;
            }
            content.innerHTML = data.map(a => `
                <div class="artist-item">
                    <div class="artist-img-container">
                        <img src="/uploads/artists/${a.photo}">
                    </div>
                    <span class="artist-name">${a.name}</span>
                </div>
            `).join('');
        })
        .catch(() => { 
            content.innerHTML = '<div style="padding:40px; font-weight:900; grid-column: 1/-1; text-align:center; color:red;">ERROR.</div>'; 
        });
}
function closeArtists(){ document.getElementById('artistModal').style.display = 'none'; }
</script>

</body>
</html>

<?php include 'layout/footer.php'; ?>