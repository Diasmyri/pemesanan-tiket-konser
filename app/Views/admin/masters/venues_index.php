<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Venues - Admin Panel</title>

    <link rel="stylesheet" href="/assets/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">

    <style>
/* ================= ROOT ================= */
:root{
    --bg-main:#0e1117;
    --bg-sidebar:#111423;
    --primary:#1f2a44;
    --accent:#ffd54f;

    --text-main:#ffffff;
    --text-muted:#a1a6b3;

    --border-color:rgba(255,255,255,.08);
    --hover-bg:rgba(255,255,255,.08);
    --shadow:0 18px 45px rgba(0,0,0,.55);
    --transition:all .35s ease;
}

*{box-sizing:border-box}

/* ================= BODY ================= */
body{
    margin:0;
    font-family:'Poppins',sans-serif;
    background:var(--bg-main);
    color:var(--text-main);
    overflow-x:hidden;
}

/* ================= BACKGROUND VIDEO ================= */
.bg-video{
    position:fixed;
    inset:0;
    width:100%;
    height:100%;
    object-fit:cover;
    z-index:-3;
    filter:brightness(.65) saturate(.9) blur(1.2px);
    pointer-events:none;
}

/* GLOBAL OVERLAY (LEMBUT BIAR VIDEO KELIATAN) */
body::after{
    content:"";
    position:fixed;
    inset:0;
    background:
        radial-gradient(circle at top, rgba(255,255,255,.08), transparent 45%),
        linear-gradient(rgba(10,12,20,.78), rgba(10,12,20,.85));
    z-index:-2;
    pointer-events:none;
}

/* ================= SIDEBAR ================= */
.sidebar{
    position:fixed;
    top:0;left:0;
    width:260px;
    height:100vh;
    background:linear-gradient(180deg,#111423,#0d101a);
    border-right:1px solid var(--border-color);
    padding:32px 24px;
    z-index:1000;
    overflow-y:auto;
}

.brand{
    font-size:22px;
    font-weight:700;
    color:var(--accent);
    text-align:center;
    margin-bottom:42px;
    letter-spacing:.5px;
}

.section-title{
    font-size:11px;
    color:var(--text-muted);
    margin:30px 0 12px;
    letter-spacing:1.6px;
    text-transform:uppercase;
    cursor:pointer;
    display:flex;
    align-items:center;
    justify-content:space-between;
    padding:8px 0;
    transition:var(--transition);
}

.section-title:hover{
    color:var(--accent);
}

.section-title i{
    transition:var(--transition);
}

.submenu{
    display:none;
    margin-left:16px;
    padding-left:0;
    list-style:none;
}

.submenu.open{
    display:block;
}

.sidebar a{
    display:flex;
    align-items:center;
    gap:12px;
    padding:12px 16px;
    margin-bottom:10px;
    font-size:14px;
    color:var(--text-main);
    text-decoration:none;
    border-radius:12px;
    transition:var(--transition);
}

.sidebar a:hover{
    background:var(--hover-bg);
    transform:translateX(6px);
}

.sidebar a.active{
    background:linear-gradient(135deg,#1f2a44,#2b3760);
    font-weight:600;
    box-shadow:var(--shadow);
}
/* ================= CONTENT ================= */
.content{
    margin-left:260px;
    padding:50px 60px;
    position:relative;
    z-index:5;
}

/* ================= PAGE HEADER ================= */
.page-title{
    font-size:38px;
    font-weight:700;
    display:flex;
    align-items:center;
    gap:14px;
    text-shadow:0 10px 40px rgba(0,0,0,.65);
}

.small-muted{
    color:var(--text-muted);
    margin-bottom:36px;
    opacity:.85;
}

/* ================= CARD (GLASS) ================= */
.card-box{
    position:relative;
    background:
        linear-gradient(
            160deg,
            rgba(26,31,46,.88),
            rgba(20,24,38,.88)
        );
    backdrop-filter: blur(16px);
    -webkit-backdrop-filter: blur(16px);

    border:1px solid var(--border-color);
    border-radius:22px;
    padding:30px;
    box-shadow:var(--shadow);
    transition:.35s;
}

.card-box:hover{
    transform:translateY(-4px);
    box-shadow:
        0 0 0 1px rgba(255,213,79,.18),
        0 30px 90px rgba(0,0,0,.75);
}

/* ================= TOP ACTION ================= */
.top-actions{
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-bottom:22px;
}

.action-btn{
    background:linear-gradient(135deg,#1f2a44,#2b3760);
    padding:12px 22px;
    border-radius:14px;
    color:#fff;
    font-weight:600;
    display:flex;
    align-items:center;
    gap:8px;
    transition:.3s;
    text-decoration:none;
    border:none;
}

.action-btn:hover{
    transform:translateY(-2px);
    box-shadow:var(--shadow);
}

/* ================= SEARCH ================= */
.search-box{
    background:rgba(17,24,41,.85);
    border:1px solid var(--border-color);
    color:#fff;
    padding:12px 16px;
    border-radius:12px;
    width:260px;
}

.search-box:focus{
    outline:none;
    border-color:var(--accent);
}

/* ================= TABLE ================= */
.table{
    background:transparent!important;
    color:#fff;
}

.table thead th{
    background:rgba(255,255,255,.06);
    font-size:11px;
    text-transform:uppercase;
    color:var(--text-muted);
    padding:14px;
}

.table tbody td{
    padding:16px;
    border-bottom:1px solid var(--border-color);
    vertical-align:middle;
}

.table tbody tr:hover{
    background:rgba(255,255,255,.05);
}

/* ================= ARTIST PHOTO ================= */
.artist-photo{
    width:80px;
    height:105px;
    object-fit:cover;
    border-radius:12px;
    border:1px solid rgba(255,255,255,.12);
}

/* ================= ACTION BUTTON ================= */
.btn-action{
    width:36px;
    height:36px;
    border-radius:10px;
    display:inline-flex;
    align-items:center;
    justify-content:center;
    transition:.25s;
    margin-right:8px;
    border:none;
    text-decoration:none;
}

.btn-edit{
    background:rgba(255,213,79,.15);
    color:#ffd54f;
}
.btn-edit:hover{background:rgba(255,213,79,.35);transform:scale(1.05)}

.btn-delete{
    background:rgba(255,90,90,.15);
    color:#ff6b6b;
}
.btn-delete:hover{background:rgba(255,90,90,.35);transform:scale(1.05)}

/* ================= RESPONSIVE ================= */
@media(max-width:768px){
    .bg-video{display:none}
    .sidebar{position:relative;width:100%;height:auto;padding:20px}
    .content{margin-left:0;padding:32px 22px}
}
</style>
</head>

<body>

<!-- BACKGROUND VIDEO -->
<video autoplay muted loop playsinline class="bg-video"
poster="https://images.unsplash.com/photo-1518972559570-7cc1309f3229?auto=format&fit=crop&w=2400&q=80">
    <source src="https://cdn.coverr.co/videos/coverr-concert-crowd-light-show-1596/1080p.mp4" type="video/mp4">
</video>


<div class="sidebar">
    <div class="brand">Admin Panel - Ticketing</div>

    <div class="section-title">MAIN</div>
    <a href="/admin/dashboard"><i class="fas fa-gauge"></i> Dashboard</a>

    <div class="section-title" onclick="toggleSubmenu(this)">
        MASTERS <i class="fas fa-chevron-down"></i>
    </div>
    <ul class="submenu">
        <li><a href="/admin/masters/artists"><i class="fas fa-microphone"></i> Artists</a></li>
        <li><a href="/admin/masters/events"><i class="fas fa-calendar"></i> Events</a></li>
        <li><a href="/admin/masters/venues" class="active"><i class="fas fa-location-dot"></i> Venues</a></li>
        <li><a href="/admin/masters/tickettypes"><i class="fas fa-ticket"></i> Ticket Types</a></li>
        <li><a href="/admin/masters/users"><i class="fas fa-users"></i> Users</a></li>
    </ul>

    <div class="section-title" onclick="toggleSubmenu(this)">
        TRANSAKSI <i class="fas fa-chevron-down"></i>
    </div>
    <ul class="submenu">
        <li><a href="/admin/transactions/orders"><i class="fas fa-receipt"></i> Orders</a></li>
        <li><a href="/admin/transactions/payments"><i class="fas fa-credit-card"></i> Payments</a></li>
        <li><a href="/admin/transactions/checkin"><i class="fas fa-qrcode"></i> Check-in</a></li>
    </ul>

    <div class="section-title" onclick="toggleSubmenu(this)">
        LAPORAN <i class="fas fa-chevron-down"></i>
    </div>
    <ul class="submenu">
        <li><a href="/admin/reports/daily"><i class="fas fa-clock"></i> Harian</a></li>
        <li><a href="/admin/reports/monthly"><i class="fas fa-calendar"></i> Bulanan</a></li>
    </ul>
</div>

<div class="content">

    <div class="page-title">
        <i class="fas fa-location-dot"></i>
        Venues
    </div>

    <p class="small-muted">Kelola data venue konser.</p>

    <div class="card-box">

        <?php if (session()->getFlashdata('success')) : ?>
            <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
        <?php endif; ?>

        <div class="top-actions">
            <a href="/admin/masters/venues/create" class="action-btn">
                <i class="fas fa-plus"></i> Tambah Venue
            </a>

            <form method="get">
                <input type="text" class="search-box"
                       name="keyword"
                       placeholder="Search venue..."
                       value="<?= $keyword ?? '' ?>">
            </form>
        </div>

        <table class="table mt-3">
            <thead>
                <tr>
                    <th width="50">#</th>
                    <th>Nama Venue</th>
                    <th>Lokasi</th>
                    <th>Kapasitas</th>
                    <th width="100">Aksi</th>
                </tr>
            </thead>

            <tbody>
            <?php if (empty($venues)) : ?>
                <tr>
                    <td colspan="5" class="text-center text-secondary py-3">Tidak ada data.</td>
                </tr>
            <?php else : ?>
                <?php $no = 1; foreach ($venues as $v) : ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $v['name'] ?></td>
                    <td><?= $v['location'] ?></td>
                    <td><?= number_format($v['capacity']) ?></td>
                    <td>
                        <a href="/admin/masters/venues/edit/<?= $v['id'] ?>" class="btn-action btn-edit">
                            <i class="fas fa-edit"></i>
                        </a>
                        <a href="/admin/masters/venues/delete/<?= $v['id'] ?>"
                           onclick="return confirm('Hapus venue ini?')"
                           class="btn-action btn-delete">
                            <i class="fas fa-trash"></i>
                        </a>
                    </td>
                </tr>
                <?php endforeach ?>
            <?php endif ?>
            </tbody>
        </table>

        <div class="mt-3">
            <?= $pager->links('default', 'default_full') ?>
        </div>

    </div>

    <script>
function toggleSubmenu(element) {
    const submenu = element.nextElementSibling;
    const icon = element.querySelector('i');
    
    if (submenu.classList.contains('open')) {
        submenu.classList.remove('open');
        icon.style.transform = 'rotate(0deg)';
    } else {
        submenu.classList.add('open');
        icon.style.transform = 'rotate(180deg)';
    }
}

// Auto-open submenu jika halaman aktif ada di dalamnya
document.addEventListener('DOMContentLoaded', function() {
    const activeLink = document.querySelector('.submenu a.active');
    if (activeLink) {
        const submenu = activeLink.closest('.submenu');
        const sectionTitle = submenu.previousElementSibling;
        const icon = sectionTitle.querySelector('i');
        submenu.classList.add('open');
        icon.style.transform = 'rotate(180deg)';
    }
});
</script>

</div>

</body>
</html>