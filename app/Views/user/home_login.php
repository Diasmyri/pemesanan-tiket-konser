<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KONSERKU // OFFICIAL BRUTAL STAGE</title>

    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300;400;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        /* --- RESET & VARIABLES --- */
        :root {
            --primary: #8b5cf6; 
            --secondary: #ec4899;
            --accent: #00f2fe;
            --dark: #000000;
            --white: #ffffff;
            --brutal-border: 4px solid #ffffff;
            --brutal-shadow: 6px 6px 0px #ffffff;
            --transition: all 0.25s cubic-bezier(0.165, 0.84, 0.44, 1);
        }

        * { 
            margin: 0; 
            padding: 0; 
            box-sizing: border-box; 
        }
        
        body {
            background-color: var(--dark);
            font-family: 'Space Grotesk', sans-serif;
            color: var(--white);
            overflow-x: hidden;
            line-height: 1.5;
        }

        /* --- LOADING SHUTTER --- */
        .shutter {
            position: fixed; 
            inset: 0; 
            z-index: 9999; 
            display: flex; 
            flex-direction: column; 
            pointer-events: none;
        }
        .shutter-bar {
            flex: 1; 
            background: var(--white); 
            transform: translateX(-100%);
            animation: shutterOpen 0.7s cubic-bezier(0.87, 0, 0.13, 1) forwards;
        }
        .shutter-bar:nth-child(2) { animation-delay: 0.1s; }
        .shutter-bar:nth-child(3) { animation-delay: 0.2s; }
        
        @keyframes shutterOpen { 
            100% { transform: translateX(100%); } 
        }

        /* --- NAVBAR --- */
        .navbar {
            position: sticky; 
            top: 0; 
            z-index: 1000; 
            background: var(--dark);
            border-bottom: var(--brutal-border); 
            padding: 1rem 5%;
            display: flex; 
            justify-content: space-between; 
            align-items: center;
        }
        
        .brand { 
            font-size: 1.8rem; 
            font-weight: 900; 
            letter-spacing: -2px; 
            text-transform: uppercase;
            user-select: none;
        }
        
        .nav-btn {
            text-decoration: none; 
            padding: 10px 22px; 
            border: var(--brutal-border);
            font-weight: 800; 
            text-transform: uppercase; 
            transition: var(--transition); 
            font-size: 0.85rem; 
            color: var(--white);
            display: inline-block;
        }

        .nav-btn:hover {
            background: var(--white);
            color: var(--dark);
            box-shadow: 4px 4px 0 var(--accent);
            transform: translate(-3px, -3px);
        }
        
        .btn-reg { 
            background: var(--white); 
            color: var(--dark); 
            margin-left: 12px; 
        }

        .btn-reg:hover {
            background: var(--primary);
            color: var(--white);
        }

        /* --- HERO SLIDER --- */
        .ss-container {
            height: 70vh; 
            position: relative; 
            overflow: hidden; 
            border-bottom: var(--brutal-border);
        }
        
        .ss-wrapper { 
            display: flex; 
            width: 300%; 
            height: 100%; 
            transition: transform 0.8s cubic-bezier(0.8, 0, 0.2, 1); 
        }
        
        .ss-slide { 
            width: 33.333%; 
            height: 100%; 
            display: flex; 
        }
        
        .ss-info {
            flex: 1; 
            padding: 5%; 
            display: flex; 
            flex-direction: column; 
            justify-content: center;
            background: var(--dark); 
            border-right: var(--brutal-border);
            z-index: 2;
        }
        
        .ss-visual { 
            flex: 1.5; 
            overflow: hidden; 
            background: #111; 
        }
        
        .ss-visual img { 
            width: 100%; 
            height: 100%; 
            object-fit: cover; 
            filter: grayscale(1) contrast(1.2); 
            transition: transform 1s ease, filter 0.5s ease; 
        }
        
        .ss-slide:hover .ss-visual img { 
            filter: grayscale(0) contrast(1); 
            transform: scale(1.1);
        }

        /* RADIO LOGIC */
        #s1:checked ~ .ss-wrapper { transform: translateX(0%); }
        #s2:checked ~ .ss-wrapper { transform: translateX(-33.333%); }
        #s3:checked ~ .ss-wrapper { transform: translateX(-66.666%); }

        /* NAVIGATION ARROWS */
        .arrows {
            position: absolute; 
            inset: 0; 
            display: none; 
            justify-content: space-between; 
            align-items: center; 
            padding: 0 30px; 
            pointer-events: none; 
            z-index: 100;
        }
        
        .arrows label {
            width: 60px; 
            height: 60px; 
            background: var(--white); 
            color: var(--dark);
            display: flex; 
            align-items: center; 
            justify-content: center;
            cursor: pointer; 
            pointer-events: auto; 
            border: 4px solid var(--dark);
            transition: var(--transition);
            font-size: 1.2rem;
        }

        .arrows label:hover {
            background: var(--accent);
            transform: scale(1.1) rotate(5deg);
        }
        
        #s1:checked ~ .arr-1, #s2:checked ~ .arr-2, #s3:checked ~ .arr-3 { display: flex; }

        .mega-text { 
            font-size: clamp(3rem, 8vw, 6rem); 
            font-weight: 900; 
            line-height: 0.85; 
            text-transform: uppercase; 
            letter-spacing: -4px; 
            margin-bottom: 20px; 
        }
        
        .mini-desc { 
            font-size: 1.1rem; 
            font-weight: 400; 
            max-width: 500px; 
            line-height: 1.5; 
            color: #bbb; 
            margin-bottom: 35px; 
        }

        .social-wrap { 
            display: flex; 
            gap: 15px; 
            flex-wrap: wrap;
        }
        
        .social-btn {
            text-decoration: none; 
            padding: 12px 24px; 
            border: 3px solid white;
            background: transparent; 
            color: white; 
            font-weight: 900; 
            text-transform: uppercase;
            font-size: 0.85rem; 
            transition: var(--transition);
        }
        
        .social-btn:hover { 
            background: var(--white); 
            color: black; 
            transform: translate(-5px, -5px); 
            box-shadow: 8px 8px 0 var(--primary); 
        }

        /* --- MARQUEE --- */
        .marquee {
            background: var(--accent); 
            color: #000; 
            padding: 15px 0; 
            border-bottom: var(--brutal-border); 
            overflow: hidden;
            user-select: none;
        }
        
        .marquee-content {
            display: flex; 
            white-space: nowrap; 
            font-weight: 900; 
            font-size: 1.5rem;
            animation: scroll 25s linear infinite; 
            text-transform: uppercase;
        }
        
        @keyframes scroll { 
            from { transform: translateX(0); } 
            to { transform: translateX(-50%); } 
        }

        /* --- EVENT GRID --- */
        .event-section {
            padding: 100px 5%; 
            display: flex; 
            justify-content: center; 
            background: var(--dark);
        }
        
        .event-grid { 
            display: grid; 
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            max-width: 1400px; 
            width: 100%; 
            border-top: var(--brutal-border); 
            border-left: var(--brutal-border);
        }
        
        .event-card {
            border-right: var(--brutal-border); 
            border-bottom: var(--brutal-border);
            padding: 30px; 
            background: var(--dark); 
            display: flex; 
            flex-direction: column; 
            transition: var(--transition);
        }
        
        .event-card:hover { 
            background: #111;
        }

        .event-img-wrap { 
            width: 100%; 
            aspect-ratio: 4/5; 
            border: 4px solid white; 
            margin-bottom: 25px; 
            overflow: hidden;
            box-shadow: 8px 8px 0 var(--primary);
            transition: var(--transition);
        }
        
        .event-card:hover .event-img-wrap {
            box-shadow: 12px 12px 0 var(--secondary);
            transform: translate(-4px, -4px);
        }
        
        .event-img-wrap img { 
            width: 100%; 
            height: 100%; 
            object-fit: cover; 
            filter: grayscale(1); 
            transition: transform 0.5s ease; 
        }
        
        .event-card:hover .event-img-wrap img { 
            filter: grayscale(0); 
            transform: scale(1.05); 
        }

        .event-title { 
            font-size: 1.5rem; 
            font-weight: 900; 
            text-transform: uppercase; 
            margin-bottom: 10px; 
            line-height: 1; 
            letter-spacing: -1px;
        }
        
        .event-meta { 
            font-size: 0.85rem; 
            font-weight: 700; 
            color: var(--accent); 
            margin-bottom: 25px; 
            text-transform: uppercase; 
        }

        .btn-view {
            margin-top: auto; 
            width: 100%; 
            padding: 16px; 
            background: var(--white); 
            color: var(--dark); 
            border: 4px solid var(--dark);
            font-weight: 900; 
            font-size: 0.9rem; 
            text-transform: uppercase; 
            transition: var(--transition); 
            cursor: pointer;
            outline: none;
        }
        
        .btn-view:hover { 
            background: var(--primary); 
            color: var(--white); 
            transform: translate(-4px, -4px); 
            box-shadow: 8px 8px 0 var(--secondary); 
        }

        /* --- ARTIST MODAL --- */
        .artist-modal {
            position: fixed; 
            inset: 0; 
            z-index: 2000; 
            display: none;
            background: rgba(0,0,0,0.9); 
            backdrop-filter: blur(8px);
            align-items: center; 
            justify-content: center; 
            padding: 20px;
        }
        
        .artist-box {
            background: var(--dark); 
            border: 6px solid var(--white); 
            width: 100%; 
            max-width: 1100px;
            max-height: 85vh; 
            box-shadow: 15px 15px 0 var(--primary); 
            display: flex; 
            flex-direction: column; 
            overflow: hidden;
            animation: modalPop 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }

        @keyframes modalPop {
            from { transform: scale(0.8) translateY(20px); opacity: 0; }
            to { transform: scale(1) translateY(0); opacity: 1; }
        }
        
        .modal-header {
            display: flex; 
            justify-content: space-between; 
            align-items: center;
            padding: 20px 30px; 
            border-bottom: 6px solid var(--white);
            background: var(--white); 
            color: var(--dark); 
            flex-shrink: 0;
        }
        
        .modal-header h3 { 
            font-size: 1.8rem; 
            font-weight: 900; 
        }
        
        .close-modal { 
            font-size: 1.5rem; 
            font-weight: 900; 
            border: 3px solid var(--dark); 
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer; 
            transition: var(--transition);
        }

        .close-modal:hover {
            background: var(--dark);
            color: var(--white);
            transform: rotate(90deg);
        }

        #artistContent { 
            display: grid !important; 
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            overflow-y: auto; 
            background: #000;
        }
        
        .artist-item { 
            padding: 25px; 
            text-align: center; 
            border-right: 1px solid #333; 
            border-bottom: 1px solid #333;
            transition: var(--transition);
        }

        .artist-item:hover { background: #0a0a0a; }
        
        .artist-img-container {
            width: 100%; 
            aspect-ratio: 1; 
            border: 3px solid var(--white);
            margin-bottom: 15px; 
            box-shadow: 6px 6px 0 var(--primary); 
            overflow: hidden;
            transition: var(--transition);
        }
        
        .artist-item:hover .artist-img-container {
            box-shadow: 8px 8px 0 var(--accent);
            transform: translateY(-5px);
        }
        
        .artist-item img { 
            width: 100%; height: 100%; 
            object-fit: cover; 
            filter: grayscale(1); 
            transition: 0.4s ease; 
        }
        
        .artist-item:hover img { filter: grayscale(0); transform: scale(1.1); }
        
        .artist-name { 
            font-size: 1rem; 
            font-weight: 900; 
            text-transform: uppercase; 
            background: var(--white); 
            color: var(--dark); 
            padding: 6px 12px; 
            display: inline-block;
            box-shadow: 4px 4px 0 var(--secondary);
        }

        /* --- RESPONSIVE --- */
        @media (max-width: 992px) {
            .ss-slide { flex-direction: column; }
            .ss-info { border-right: none; border-bottom: var(--brutal-border); order: 2; }
            .ss-visual { order: 1; flex: 1; }
            .ss-container { height: auto; min-height: 80vh; }
            .mega-text { font-size: 3.5rem; }
        }
        
        @media (max-width: 600px) {
            .navbar { padding: 15px 20px; }
            .brand { font-size: 1.4rem; }
            #artistContent { grid-template-columns: repeat(2, 1fr); }
            .event-grid { border: none; grid-template-columns: 1fr; }
            .event-card { border: var(--brutal-border); margin-bottom: 20px; }
            .mega-text { font-size: 2.8rem; }
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