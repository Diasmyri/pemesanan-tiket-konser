<?php include 'layout/header.php'; ?>
<?php include 'layout/navbar.php'; ?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>KonserKu - The Immersive Experience</title>

<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800;900&family=Space+Grotesk:wght@300;400;700;900&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

<style>
/* --- THE ULTIMATE DESIGN SYSTEM --- */
:root {
  --primary: #8b5cf6; 
  --secondary: #ec4899;
  --accent: #00f2fe;
  --dark-bg: #010409;
  --card-bg: #0d1117;
  --white: #ffffff;
  --glass-border: rgba(255, 255, 255, 0.1);
}

body {
  font-family: 'Space Grotesk', sans-serif;
  background-color: var(--dark-bg);
  color: #fff;
  margin: 0; padding: 0;
  overflow-x: hidden;
}

.bg-mesh {
  position: fixed; top: 0; left: 0; width: 100%; height: 100%;
  background: 
    radial-gradient(circle at 20% 30%, rgba(139, 92, 246, 0.15) 0%, transparent 50%),
    radial-gradient(circle at 80% 70%, rgba(236, 72, 153, 0.1) 0%, transparent 50%);
  z-index: -1;
}

.container { max-width: 1400px; margin: 0 auto; padding: 0 25px; position: relative; }

/* --- HERO & MARQUEE --- */
.hero-wrapper { min-height: 80vh; display: flex; align-items: center; position: relative; overflow: hidden; padding: 80px 0; }
.hero-visual-layer { position: absolute; right: -5%; width: 50%; height: 80%; z-index: 1; display: flex; align-items: center; justify-content: center; }
.hero-main-img { width: 100%; height: 100%; object-fit: cover; mask-image: linear-gradient(to left, black 70%, transparent 100%); -webkit-mask-image: linear-gradient(to left, black 70%, transparent 100%); border-radius: 40px; filter: saturate(1.2) contrast(1.1); animation: floatImage 6s ease-in-out infinite; }
.hero-content { position: relative; z-index: 10; width: 60%; }
.hero-badge { background: transparent; padding: 8px 18px; border-radius: 8px; border: 1px solid var(--glass-border); display: inline-flex; align-items: center; gap: 10px; font-weight: 600; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 2px; color: #888; margin-bottom: 25px; }
.hero-title { font-size: clamp(2.5rem, 8vw, 5.5rem); font-weight: 900; line-height: 1; letter-spacing: -2px; text-transform: uppercase; margin: 0; background: linear-gradient(to right, #fff, #94a3b8); -webkit-background-clip: text; -webkit-text-fill-color: transparent; }
.hero-title span { display: block; background: linear-gradient(to right, #fff, var(--primary)); -webkit-background-clip: text; -webkit-text-fill-color: transparent; font-style: normal; }

.marquee-wrapper { background: #fff; padding: 12px 0; transform: rotate(-1.5deg); width: 110%; margin-left: -5%; overflow: hidden; white-space: nowrap; display: flex; box-shadow: 0 10px 30px rgba(0,0,0,0.5); z-index: 15; }
.marquee-content { display: inline-block; animation: marquee 25s linear infinite; font-size: 1.2rem; font-weight: 900; text-transform: uppercase; color: #000; }

/* --- SEARCH & CARDS --- */
.search-container { max-width: 500px; margin: 60px auto 20px auto; position: relative; z-index: 20; }
.search-box { background: rgba(255, 255, 255, 0.05); backdrop-filter: blur(20px); border: 2px solid #fff; padding: 8px 20px; display: flex; align-items: center; transition: 0.3s; box-shadow: 8px 8px 0px var(--primary); }
.search-box:focus-within { transform: translate(-2px, -2px); box-shadow: 12px 12px 0px var(--accent); }
.search-box input { flex: 1; background: transparent; border: none; color: #fff; padding: 10px; font-size: 1rem; outline: none; font-weight: 700; text-transform: uppercase; }

.event-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(380px, 1fr)); gap: 40px; margin: 40px 0 100px 0; }
.event-card { background: var(--card-bg); border-radius: 30px; position: relative; transition: 0.4s; border: 1px solid var(--glass-border); overflow: hidden; }
.card-img-wrapper { height: 450px; position: relative; overflow: hidden; }
.card-img-wrapper img { width: 100%; height: 100%; object-fit: cover; transition: 0.8s; }
.card-info-overlay { position: absolute; bottom: 0; left: 0; width: 100%; padding: 35px; background: linear-gradient(to top, rgba(1,4,9,1) 40%, rgba(1,4,9,0) 100%); box-sizing: border-box; }
.event-title { font-size: 2rem; font-weight: 800; line-height: 1; margin: 0 0 10px 0; text-transform: uppercase; }

.venue-info { color: var(--accent); font-weight: 800; text-transform: uppercase; font-size: 0.85rem; display: flex; align-items: center; gap: 6px; }
.location-info { color: #94a3b8; font-weight: 600; text-transform: uppercase; font-size: 0.75rem; margin-top: 4px; display: flex; align-items: center; gap: 6px; }

/* --- BRUTAL BUTTONS STYLING --- */
.btn-group { display: flex; gap: 15px; margin-top: 25px; }
.btn { 
  padding: 16px 20px; 
  font-weight: 900; 
  cursor: pointer; 
  transition: 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275); 
  border: 3px solid var(--white); 
  text-transform: uppercase; 
  font-size: 0.85rem; 
  display: flex; 
  align-items: center; 
  justify-content: center; 
  gap: 8px; 
}
.btn-main { background: var(--primary); color: var(--white); flex: 2; }
.btn-main:hover {
  background: var(--white);
  color: var(--dark-bg);
  box-shadow: 6px 6px 0px var(--accent);
  transform: translate(-4px, -4px);
}
.btn-info-action { background: transparent; color: var(--white); flex: 1; border-color: #444; }
.btn-info-action:hover {
  background: var(--white);
  color: var(--dark-bg);
  border-color: var(--white);
  box-shadow: 6px 6px 0px var(--secondary);
  transform: translate(-4px, -4px);
}

/* --- MODAL SYSTEM --- */
#bankOverlay { position: fixed; inset: 0; background: rgba(0,0,0,0.95); z-index: 9999; display: none; align-items: center; justify-content: center; backdrop-filter: blur(10px); }
#bankOverlay.show { display: flex; }
.bank-popup { background: var(--dark-bg); padding: 30px; border: 6px solid var(--white); width: 90%; max-width: 380px; position: relative; box-shadow: 15px 15px 0px var(--primary); transition: max-width 0.4s ease; }
.bank-popup.large { max-width: 750px; }

.modal-footer { margin-top: 25px; }
.btn-modal-close { 
  background: var(--primary); 
  color: var(--white); 
  border: 4px solid var(--white); 
  padding: 15px; 
  font-weight: 900; 
  font-size: 0.9rem; 
  width: 100%; 
  text-transform: uppercase; 
  cursor: pointer; 
  transition: 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
  display: block;
}
.btn-modal-close:hover { 
  background: var(--white); 
  color: var(--dark-bg); 
  box-shadow: 8px 8px 0px var(--accent); 
  transform: translate(-5px, -5px); 
}

/* --- HOVER VISUAL ARTIST (IMPROVED) --- */
.artist-grid-crazy { display: grid; grid-template-columns: repeat(auto-fill, minmax(180px, 1fr)); gap: 20px; margin-top: 25px; }
.artist-crazy-card { 
  position: relative; 
  background: #111; 
  border: 4px solid var(--white); 
  aspect-ratio: 1/1; 
  box-shadow: 8px 8px 0 var(--secondary); 
  transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
  overflow: hidden;
  cursor: pointer;
}
.artist-crazy-card img { 
  width: 100%; 
  height: 100%; 
  object-fit: cover; 
  filter: grayscale(1) contrast(1.1); 
  transition: all 0.5s ease;
}
.artist-crazy-label { 
  position: absolute; 
  bottom: -10px; 
  left: 50%; 
  transform: translateX(-50%); 
  background: var(--white); 
  color: #000; 
  padding: 5px 12px; 
  font-weight: 900; 
  font-size: 0.7rem; 
  text-transform: uppercase; 
  border: 2px solid #000; 
  white-space: nowrap; 
  box-shadow: 4px 4px 0px var(--secondary); 
  z-index: 20;
  transition: all 0.3s ease;
}

/* Hover States for Artist */
.artist-crazy-card:hover {
  transform: scale(1.05) rotate(-2deg);
  border-color: var(--accent);
  box-shadow: 0 0 20px var(--accent), 10px 10px 0 var(--primary);
  z-index: 50;
}
.artist-crazy-card:hover img {
  filter: grayscale(0) saturate(1.2);
  transform: scale(1.15);
}
.artist-crazy-card:hover .artist-crazy-label {
  background: var(--secondary);
  color: #fff;
  border-color: #fff;
  bottom: 10px;
}

/* Order Form */
.compact-form-group { display: flex; flex-direction: column; gap: 8px; }
.compact-form-group input, .compact-form-group select { width: 100%; padding: 12px; background: #000; border: 3px solid var(--white); color: #fff; font-family: 'Space Grotesk'; font-weight: 700; text-transform: uppercase; }
.total-box { background: var(--secondary); padding: 15px; text-align: center; margin: 10px 0; border: 4px solid var(--white); box-shadow: 6px 6px 0 #000; }
.btn-modal-submit { background: var(--primary); color: var(--white); border: 4px solid var(--white); padding: 15px; font-weight: 900; width: 100%; text-transform: uppercase; cursor: pointer; transition: 0.3s; margin-bottom: 10px; }
.btn-modal-submit:hover { background: var(--white); color: var(--dark-bg); box-shadow: 8px 8px 0px var(--accent); transform: translate(-5px, -5px); }

@keyframes marquee { from { transform: translateX(0); } to { transform: translateX(-50%); } }
@keyframes floatImage { 0%, 100% { transform: translateY(0); } 50% { transform: translateY(-15px); } }
</style>
</head>

<body>
<div class="bg-mesh"></div>

<div class="hero-wrapper">
  <div class="container" style="display: flex; align-items: center;">
    <div class="hero-content">
      <div class="hero-badge"> THE NEXT GEN </div>
      <h1 class="hero-title"> KINI TERSEDIA DI<br>KOTA ANDA. <span>TEMUKAN IRAMANYA.</span> </h1>
    </div>
    <div class="hero-visual-layer">
      <img src="https://images.unsplash.com/photo-1540039155733-5bb30b53aa14?q=80&w=1974&auto=format&fit=crop" class="hero-main-img">
    </div>
  </div>
</div>

<div class="marquee-wrapper">
  <div class="marquee-content"> 
    &nbsp;NADIN AMIZAH • BARASUARA • THE SIGIT • HINDIA • .FEAST • REALITY CLUB • ARDHITO PRAMONO • LALAHUTA • EFEK RUMAH KACA • MALIQ & D'ESSENTIALS • 
  </div>
</div>

<div class="container">
  <div class="search-container">
    <div class="search-box"> 
      <i class="fa-solid fa-magnifying-glass"></i> 
      <input id="searchEvent" placeholder="CARI EVENT / ARTIS..."> 
    </div>
  </div>

  <div class="event-grid">
    <?php foreach($events as $e): ?>
    <div class="event-card" data-title="<?= strtolower($e['title']) ?>" data-venue="<?= strtolower($e['venue_name'] . ' ' . $e['venue_location']) ?>">
        <div class="card-img-wrapper">
            <img src="<?= base_url('uploads/events/'.($e['poster'] ?? 'default.jpg')) ?>">
            <div style="position: absolute; top: 20px; right: 20px; background: #000; padding: 8px 15px; font-weight: 900; border: 3px solid #fff; z-index: 5;">
                <?= date('d M', strtotime($e['date'])) ?>
            </div>
        </div>
        <div class="card-info-overlay">
            <h3 class="event-title"><?= esc($e['title']) ?></h3>
            <div class="venue-info"><i class="fa-solid fa-location-dot"></i> <?= esc($e['venue_name']) ?></div>
            <div class="location-info"><i class="fa-solid fa-map-pin"></i> <?= esc($e['venue_location']) ?></div>
            
            <div class="btn-group">
                <button class="btn btn-info-action" onclick="showArtists(<?= $e['id'] ?>)">INFO</button>
                <button class="btn btn-main" onclick="showOrder(<?= $e['id'] ?>)">BELI TIKET</button>
            </div>
        </div>
    </div>
    <?php endforeach; ?>
  </div>
</div>

<div id="bankOverlay" onclick="if(event.target==this)closePopup()">
  <div class="bank-popup animate__animated animate__zoomIn">
    <h2 id="popupTitle" style="margin:0 0 15px 0; font-weight:900; text-align:left; text-transform: uppercase; font-size: 1.8rem; letter-spacing: -1px; border-bottom: 5px solid #fff; padding-bottom: 10px;"></h2>
    <div id="popupBody"></div>
    <div class="modal-footer">
        <button class="btn-modal-close" onclick="closePopup()">➔ TUTUP JENDELA</button>
    </div>
  </div>
</div>

<script>
// Search Logic
document.getElementById('searchEvent').addEventListener('input', function(){
    let key = this.value.toLowerCase();
    document.querySelectorAll('.event-card').forEach(card => {
        let title = card.dataset.title, venue = card.dataset.venue;
        card.style.display = (title.includes(key) || venue.includes(key)) ? 'block' : 'none';
    });
});

// Show Artists Popup
function showArtists(id) {
    fetch('<?= base_url('user/event/getArtists') ?>/' + id)
    .then(r => r.json())
    .then(data => {
        let html = '<div class="artist-grid-crazy">';
        data.forEach(a => {
            html += `
                <div class="artist-crazy-card animate__animated animate__fadeInUp">
                    <img src="<?= base_url('uploads/artists') ?>/${a.photo}">
                    <div class="artist-crazy-label">${a.name}</div>
                </div>`;
        });
        html += '</div>';
        openPopup('THE LINEUP', html, true);
    });
}

// Show Order Popup
function showOrder(eventId) {
    fetch('<?= base_url('user/event/getTicketTypes') ?>/' + eventId)
    .then(r => r.json())
    .then(data => {
        if (data.length === 0) { 
            openPopup('ALERT', 'TIKET BELUM TERSEDIA', false); 
            return; 
        }

        // Default values from user session
        const user = <?= json_encode($user) ?>;
        let options = '';
        data.forEach(t => {
            options += `<option value="${t.id}" data-price="${t.price}">${t.name} - RP ${Number(t.price).toLocaleString('id-ID')}</option>`;
        });

        let html = `
            <form id="orderForm" class="compact-form-group">
                <input type="hidden" name="event_id" value="${eventId}">
                <input name="name" placeholder="NAMA LENGKAP" value="${user.nama}" required>
                <input type="email" name="email" placeholder="EMAIL" value="${user.email}" required>
                <input name="phone" placeholder="WHATSAPP" value="${user.nomor_telepon}" required>
                <select id="ticketSelect" name="ticket_type_id" required>${options}</select>
                <input type="number" id="ticketQty" name="qty" min="1" value="1" required>
                <div class="total-box"><span id="totalDisplay">0</span></div>
                <button type="submit" class="btn-modal-submit">➔ KONFIRMASI PESANAN</button>
            </form>`;

        openPopup('ORDER TICKET', html, false);

        const s = document.getElementById('ticketSelect'),
              q = document.getElementById('ticketQty'),
              td = document.getElementById('totalDisplay');

        const updateTotal = () => {
            const price = Number(s.selectedOptions[0].dataset.price);
            td.innerText = 'RP ' + (price * q.value).toLocaleString('id-ID');
        };

        s.onchange = updateTotal;
        q.oninput = updateTotal;
        updateTotal();

        // Handle form submit
        document.getElementById('orderForm').addEventListener('submit', function(e){
            e.preventDefault();
            const formData = new FormData(this);

            fetch('<?= base_url('user/orders/store') ?>', {
                method: 'POST',
                body: formData
            })
            .then(r => r.json())
            .then(res => {
                alert(res.message);
                if(res.status === 'success') closePopup();
            })
            .catch(err => {
                console.error(err);
                alert('Terjadi kesalahan, coba lagi.');
            });
        });
    });
}

// Popup functions
function openPopup(title, content, isLarge) {
    const popup = document.querySelector('.bank-popup');
    document.getElementById('popupTitle').innerText = title;
    document.getElementById('popupBody').innerHTML = content;
    if(isLarge) popup.classList.add('large'); else popup.classList.remove('large');
    document.getElementById('bankOverlay').classList.add('show');
}
function closePopup() { 
    document.getElementById('bankOverlay').classList.remove('show'); 
}
</script>


</body>
</html>
<?php include 'layout/footer.php'; ?>