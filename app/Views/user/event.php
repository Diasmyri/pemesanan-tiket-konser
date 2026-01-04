<?php include 'layout/header.php'; ?>
<?php include 'layout/navbar.php'; ?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>KonserKu - Sonic Rebellion</title>

<link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300;400;700;900&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

<style>
    /* --- CORE SYSTEM --- */
    * { margin: 0; padding: 0; box-sizing: border-box; } 
    
    body {
        background-color: #000;
        color: #fff;
        font-family: 'Space Grotesk', sans-serif;
        overflow-x: hidden;
        line-height: 1.2;
    }

    /* --- HERO SECTION --- */
    .hero-wrapper {
        display: grid;
        grid-template-columns: 1.2fr 0.8fr;
        border-bottom: 1px solid #fff;
    }

    .hero-info {
        padding: 60px 40px;
        border-right: 1px solid #fff;
        display: flex;
        flex-direction: column;
        justify-content: center;
        background: linear-gradient(45deg, #050505 0%, #000 100%);
        position: relative;
    }

    .status-badge {
        background: #fff;
        color: #000;
        padding: 6px 14px;
        font-weight: 900;
        font-size: 11px;
        width: fit-content;
        text-transform: uppercase;
        letter-spacing: 2px;
        margin-bottom: 40px;
        box-shadow: 0 0 15px rgba(255,255,255,0.2);
        animation: pulse 2s infinite;
    }

    @keyframes pulse {
        0% { opacity: 1; }
        50% { opacity: 0.6; }
        100% { opacity: 1; }
    }

    .hero-title {
        font-size: clamp(3rem, 8vw, 6rem);
        font-weight: 900;
        line-height: 0.8;
        text-transform: uppercase;
    }

    .hero-title span {
        display: block;
        color: transparent;
        -webkit-text-stroke: 1.5px #fff;
        transition: 0.5s;
    }

    .hero-wrapper:hover .hero-title span {
        color: #fff;
        -webkit-text-stroke: 1.5px transparent;
        text-shadow: 0 0 20px #8e44ad;
    }

    .hero-desc {
        max-width: 500px;
        margin-top: 30px;
        font-size: 15px;
        line-height: 1.5;
        font-weight: 400;
        color: rgba(255,255,255,0.7);
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .hero-visual {
        background: #111;
        overflow: hidden;
        position: relative;
    }

    .hero-visual img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        filter: grayscale(1) contrast(1.1);
        transition: 1.5s cubic-bezier(0.16, 1, 0.3, 1);
    }

    .hero-wrapper:hover .hero-visual img { 
        filter: grayscale(0) contrast(1.2); 
        transform: scale(1.1) rotate(1deg); 
    }

    /* --- MARQUEE SECTION --- */
    .marquee-container {
        background: #00ecff;
        color: #000;
        overflow: hidden;
        white-space: nowrap;
        padding: 15px 0;
        border-bottom: 1px solid #fff;
        display: flex;
    }

    .marquee-content {
        display: inline-block;
        font-weight: 900;
        font-size: 1.2rem;
        text-transform: uppercase;
        animation: marquee 30s linear infinite;
    }

    @keyframes marquee {
        from { transform: translateX(0); }
        to { transform: translateX(-50%); }
    }

    /* --- SEARCH SECTION --- */
    .search-area {
        display: flex;
        border-bottom: 1px solid #fff;
        position: relative;
    }

    .search-area input {
        flex: 1;
        background: transparent;
        border: none;
        color: #fff;
        padding: 30px 40px;
        font-size: 1.4rem;
        font-family: inherit;
        text-transform: uppercase;
        font-weight: 900;
        outline: none;
        transition: 0.4s;
    }

    .search-area input:focus { 
        background: #fff; 
        color: #000;
    }

    /* --- EVENT GRID --- */
    .event-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(360px, 1fr));
    }

    .event-card {
        border-right: 1px solid #fff;
        border-bottom: 1px solid #fff;
        padding: 40px;
        transition: 0.5s ease;
        display: flex;
        flex-direction: column;
        position: relative;
        overflow: hidden;
    }

    .event-card:hover { background: #0c0c0c; }

    .card-img-container {
        position: relative;
        padding: 10px;
        margin-bottom: 30px;
    }

    .card-img-container::before {
        content: '';
        position: absolute;
        inset: 0;
        z-index: 1;
        transform: translate(0px, 0px);
        transition: 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        opacity: 0.5;
    }

    .event-card:hover .card-img-container::before {
        transform: translate(10px, 10px);
        opacity: 1;
    }

    .event-card:nth-child(4n+1) .card-img-container::before { background: #8e44ad; }
    .event-card:nth-child(4n+2) .card-img-container::before { background: #00ecff; }
    .event-card:nth-child(4n+3) .card-img-container::before { background: #e91e63; }
    .event-card:nth-child(4n+4) .card-img-container::before { background: #2ecc71; }

    .card-img-container img {
        width: 100%;
        aspect-ratio: 1/1;
        object-fit: cover;
        position: relative;
        z-index: 2;
        border: 1px solid #fff;
        filter: grayscale(1);
        transition: 0.5s;
    }

    .event-card:hover img {
        filter: grayscale(0);
        transform: scale(0.98);
    }

    .info-box {
        margin-bottom: 30px;
        border-left: 3px solid #fff;
        padding-left: 20px;
        transition: 0.3s;
    }

    .event-card:hover .info-box {
        border-left-color: #00ecff;
        transform: translateX(5px);
    }

    .event-title {
        font-size: 1.8rem;
        font-weight: 900;
        text-transform: uppercase;
        margin-bottom: 8px;
        letter-spacing: -1px;
    }

    .event-venue {
        color: #00ecff;
        font-weight: 900;
        text-transform: uppercase;
        font-size: 14px;
        margin-bottom: 4px;
    }

    .event-date-badge {
        background: #fff;
        color: #000;
        font-weight: 900;
        font-size: 12px;
        padding: 4px 10px;
        width: fit-content;
        text-transform: uppercase;
        transition: 0.3s;
    }

    .event-card:hover .event-date-badge { background: #00ecff; }

    /* --- BUTTONS --- */
    .btn-view-artists, .btn-buy-ticket {
        width: 100%;
        text-transform: uppercase;
        font-weight: 900;
        cursor: pointer;
        transition: 0.3s;
    }

    .btn-view-artists {
        padding: 16px;
        background: #fff;
        color: #000;
        border: 2px solid #fff;
        margin-bottom: 10px;
    }

    .btn-view-artists:hover {
        background: #000;
        color: #fff;
        letter-spacing: 2px;
    }

    .btn-buy-ticket {
        padding: 12px;
        background: transparent;
        color: rgba(255,255,255,0.6);
        border: 1px solid rgba(255,255,255,0.2);
    }

    /* --- NEW INTERACTIVE LINEUP GRID --- */
    .lineup-container {
        display: grid; 
        grid-template-columns: repeat(auto-fill, minmax(160px, 1fr)); 
        gap: 20px; 
        padding: 10px 0;
    }

    .artist-box {
        border: 2px solid #222;
        background: #050505;
        padding: 10px;
        text-align: center;
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        cursor: crosshair;
        position: relative;
        overflow: hidden;
    }

    .artist-box:hover {
        border-color: #00ecff;
        transform: translateY(-10px) scale(1.05);
        box-shadow: 0 10px 30px rgba(0, 236, 255, 0.2);
        background: #111;
        z-index: 10;
    }

    .artist-box img {
        width: 100%;
        aspect-ratio: 1/1;
        object-fit: cover;
        filter: grayscale(1);
        margin-bottom: 10px;
        border: 1px solid #333;
        transition: 0.5s ease;
    }

    .artist-box:hover img {
        filter: grayscale(0) contrast(1.2);
        transform: rotate(-2deg) scale(1.1);
        border-color: #00ecff;
    }

    .artist-name {
        font-weight: 900;
        font-size: 14px;
        text-transform: uppercase;
        transition: 0.3s;
    }

    .artist-box:hover .artist-name {
        color: #00ecff;
        letter-spacing: 1px;
    }

    /* --- MODAL SYSTEM --- */
    #bankOverlay {
        position: fixed; inset: 0;
        background: rgba(0,0,0,0.98);
        display: none; align-items: center; justify-content: center;
        z-index: 9999; backdrop-filter: blur(15px);
        padding: 20px;
    }

    #bankOverlay.show { display: flex; }

    .modal-content {
        background: #000;
        border: 2px solid #fff;
        width: 100%;
        max-width: 380px; 
        max-height: 90vh;
        overflow-y: auto;
        padding: 30px;
        position: relative;
        box-shadow: 10px 10px 0px #8e44ad;
        transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
    }

    .modal-wide { max-width: 800px !important; }

    .modal-label-box {
        background: #00ecff;
        color: #000;
        padding: 4px 12px;
        font-weight: 900;
        font-size: 10px;
        text-transform: uppercase;
        margin-bottom: 12px;
        display: inline-block;
    }

    .modal-title {
        font-size: 2rem;
        font-weight: 900;
        text-transform: uppercase;
        margin-bottom: 25px;
        letter-spacing: -1px;
        line-height: 1;
    }

    /* --- INTERACTIVE FORM STYLES --- */
    .form-group { margin-bottom: 20px; position: relative; }
    .form-group label {
        display: block;
        color: rgba(255,255,255,0.5);
        font-weight: 900;
        font-size: 10px;
        text-transform: uppercase;
        margin-bottom: 6px;
        transition: 0.3s;
    }

    .form-input-custom {
        width: 100%;
        padding: 12px;
        background: #0a0a0a;
        border: 1px solid #333;
        color: #fff;
        font-family: inherit;
        font-weight: 700;
        outline: none;
        box-shadow: 4px 4px 0px #222;
        transition: 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    }

    .form-input-custom:focus {
        border-color: #00ecff;
        box-shadow: 6px 6px 0px #00ecff;
        transform: translate(-2px, -2px);
        background: #111;
    }

    .form-group:focus-within label {
        color: #00ecff;
        transform: translateX(5px);
    }

    .total-display {
        font-size: 2.2rem;
        font-weight: 900;
        text-align: right;
        color: #00ecff;
        padding-top: 15px;
        border-top: 1px solid #222;
        margin-top: 15px;
        text-shadow: 0 0 10px rgba(0, 236, 255, 0.3);
    }

    .btn-submit-order {
        width: 100%;
        padding: 18px;
        background: #8e44ad;
        color: #fff;
        border: 2px solid #fff;
        font-weight: 900;
        text-transform: uppercase;
        margin-top: 15px;
        cursor: pointer;
        font-size: 14px;
        transition: 0.3s;
    }

    .btn-submit-order:hover {
        background: #fff;
        color: #000;
        box-shadow: 0 0 20px #8e44ad;
        transform: scale(1.02);
    }
</style>
</head>

<body>

<div class="hero-wrapper">
    <div class="hero-info">
        <div class="status-badge">GATEWAY // LIVE_STAGE_01</div>
        <h1 class="hero-title">GRAB THE<br><span>NOISE.</span></h1>
        <p class="hero-desc">Amankan barisan lineup paling liar musim ini tanpa basa-basi.</p>
    </div>
    <div class="hero-visual">
        <img src="https://images.unsplash.com/photo-1540039155733-5bb30b53aa14?q=80&w=1974&auto=format&fit=crop">
    </div>
</div>

<div class="marquee-container">
    <div class="marquee-content">
        STAY BRUTAL — 
        <?php foreach($events as $ev): ?>
            <?= strtoupper(esc($ev['title'])) ?> — 
        <?php endforeach; ?>
        STAY BRUTAL —
    </div>
</div>

<div class="search-area">
    <input id="searchEvent" placeholder="➔ SEARCH ARTIST OR VENUE...">
</div>

<div class="event-grid">
    <?php foreach($events as $e): ?>
    <div class="event-card" data-title="<?= strtolower($e['title']) ?>" data-venue="<?= strtolower($e['venue_name'] . ' ' . $e['venue_location']) ?>">
        <div class="card-img-container">
            <img src="<?= base_url('uploads/events/'.($e['poster'] ?? 'default.jpg')) ?>">
        </div>
        <div class="info-box">
            <h3 class="event-title"><?= esc($e['title']) ?></h3>
            <p class="event-venue"><i class="fa-solid fa-location-dot"></i> <?= esc($e['venue_name']) ?></p>
            <span style="color:rgba(255,255,255,0.4); font-size:11px; text-transform:uppercase; display:block; margin-bottom:15px;"><?= esc($e['venue_location']) ?></span>
            <div class="event-date-badge"><?= date('D, d M Y', strtotime($e['date'])) ?></div>
        </div>
        <button class="btn-view-artists" onclick="showArtists(<?= $e['id'] ?>)">REVEAL LINEUP</button>
        <button class="btn-buy-ticket" onclick="showOrder(<?= $e['id'] ?>)">SECURE ACCESS</button>
    </div>
    <?php endforeach; ?>
</div>

<div id="bankOverlay" onclick="if(event.target==this)closePopup()">
    <div class="modal-content" id="modalMain">
        <div class="modal-label-box" id="popupLabel">REGISTRATION</div>
        <h2 class="modal-title" id="popupTitle"></h2>
        <div id="popupBody"></div>
        <button onclick="closePopup()" style="margin-top:20px; background:none; color:rgba(255,255,255,0.4); border:1px solid #222; padding:10px; width:100%; cursor:pointer; font-weight:900; text-transform:uppercase; font-size:10px;">[ RETURN_TO_BASE ]</button>
    </div>
</div>

<script>
document.getElementById('searchEvent').addEventListener('input', function(){
    let k = this.value.toLowerCase();
    document.querySelectorAll('.event-card').forEach(c => {
        let match = c.dataset.title.includes(k) || c.dataset.venue.includes(k);
        c.style.display = match ? 'flex' : 'none';
    });
});

function showArtists(id) {
    document.getElementById('modalMain').classList.add('modal-wide');
    fetch('<?= base_url('user/event/getArtists') ?>/' + id)
    .then(r => r.json()).then(data => {
        let h = '<div class="lineup-container">';
        data.forEach((a, i) => {
            h += `
                <div class="artist-box animate__animated animate__fadeInUp" style="animation-delay: ${i*0.1}s;">
                    <img src="<?= base_url('uploads/artists') ?>/${a.photo}" onerror="this.src='<?= base_url('uploads/artists/default.jpg') ?>'">
                    <p class="artist-name">${a.name}</p>
                </div>`;
        });
        h += '</div>';
        openPopup('STAGE_LINEUP', 'LINEUP_REVEALED', h);
    });
}

function showOrder(eventId) {
    document.getElementById('modalMain').classList.remove('modal-wide');
    fetch('<?= base_url('user/event/getTicketTypes') ?>/' + eventId)
    .then(r => r.json()).then(data => {
        if (!data.length) return;
        const u = <?= json_encode($user) ?>;
        let opt = data.map(t => `<option value="${t.id}" data-price="${t.price}">${t.name.toUpperCase()}</option>`).join('');
        let h = `
        <form id="orderForm">
            <input type="hidden" name="event_id" value="${eventId}">
            <div class="form-group"><label>Identification</label><input class="form-input-custom" name="name" value="${u.nama || ''}" placeholder="Enter Name"></div>
            <div class="form-group"><label>Email Address</label><input class="form-input-custom" type="email" name="email" value="${u.email || ''}" placeholder="Enter Email"></div>
            <div style="display:grid; grid-template-columns: 2fr 1fr; gap:10px;">
                <div class="form-group"><label>Category</label><select id="sT" class="form-input-custom" name="ticket_type_id">${opt}</select></div>
                <div class="form-group"><label>Qty</label><input id="qT" class="form-input-custom" type="number" name="qty" value="1" min="1"></div>
            </div>
            <div id="total" class="total-display">RP 0</div>
            <button type="submit" class="btn-submit-order">CONFIRM_ACCESS</button>
        </form>`;
        openPopup('REGISTRATION', 'GET TICKETS', h);
        const s = document.getElementById('sT'), q = document.getElementById('qT'), t = document.getElementById('total');
        const upd = () => { t.innerText = 'RP ' + (Number(s.selectedOptions[0].dataset.price) * q.value).toLocaleString('id-ID'); };
        s.onchange = upd; q.oninput = upd; upd();
        document.getElementById('orderForm').onsubmit = function(e){
            e.preventDefault();
            fetch('<?= base_url('user/orders/store') ?>', { method: 'POST', body: new FormData(this) })
            .then(r => r.json()).then(res => { alert(res.message); if(res.status === 'success') closePopup(); });
        };
    });
}

function openPopup(label, title, content) {
    document.getElementById('popupLabel').innerText = label;
    document.getElementById('popupTitle').innerText = title;
    document.getElementById('popupBody').innerHTML = content;
    document.getElementById('bankOverlay').classList.add('show');
}
function closePopup() { document.getElementById('bankOverlay').classList.remove('show'); }
</script>

</body>
</html>
<?php include 'layout/footer.php'; ?>