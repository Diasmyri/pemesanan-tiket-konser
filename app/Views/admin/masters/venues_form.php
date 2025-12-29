<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= $title ?></title>

    <link rel="stylesheet" href="/assets/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">

<style>
/* GLOBAL */
body {
    font-family: 'Poppins', sans-serif;
    background: #0d0f18;
    color: #e9ecf6;
    margin: 0;
}

/* SIDEBAR */
.sidebar {
    position: fixed;
    width: 240px;
    height: 100vh;
    background: linear-gradient(180deg, #0f1326, #0b0e1a);
    border-right: 1px solid rgba(255,255,255,0.05);
    padding: 24px 18px;
}

.brand {
    font-size: 18px;
    font-weight: 600;
    color: #ffd54f;
    margin-bottom: 30px;
}

.section-title {
    font-size: 10px;
    color: #6f7592;
    margin: 22px 0 8px;
    letter-spacing: 1.4px;
}

.sidebar a {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 11px 14px;
    margin-bottom: 6px;
    font-size: 13px;
    color: #cfd5f0;
    text-decoration: none;
    border-radius: 10px;
    transition: .25s;
}

.sidebar a:hover {
    background: rgba(255,255,255,.06);
    color: #fff;
    transform: translateX(4px);
}

.sidebar a.active {
    background: linear-gradient(135deg, #223669, #1b2b52);
    color: #fff;
    box-shadow: 0 4px 14px rgba(40,80,255,.25);
}

/* CONTENT */
.content {
    margin-left: 240px;
    padding: 45px;
}

/* PAGE HEADER (Tambah Event Style) */
.page-header {
    text-align: center;
    margin-bottom: 36px;
}

.page-icon {
    width: 58px;
    height: 58px;
    border-radius: 16px;
    background: linear-gradient(135deg, #223669, #1b2b52);
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 14px;
    box-shadow: 0 10px 30px rgba(40,80,255,.35);
}

.page-icon i {
    font-size: 22px;
    color: #fff;
}

.page-title {
    font-size: 34px;
    font-weight: 700;
    margin-bottom: 6px;
}

.page-subtitle {
    color: #9aa4c7;
    font-size: 15px;
}

/* CARD */
.card-box {
    background: linear-gradient(160deg, rgba(30,37,58,.85), rgba(14,17,32,.85));
    border: 1px solid rgba(255,255,255,.06);
    box-shadow: 0 14px 40px rgba(0,0,0,.45);
    padding: 36px;
    border-radius: 20px;
    max-width: 820px;
    margin: auto;
}

/* FORM */
label {
    font-size: 13px;
    font-weight: 500;
    color: #d9e2ff;
    margin-bottom: 6px;
}

.form-control {
    background: #0f1629;
    border: 1px solid rgba(255,255,255,.12);
    color: #fff;
    height: 48px;
    border-radius: 12px;
    padding: 0 16px;
}

.form-control::placeholder {
    color: #6f7aa5;
}

.form-control:focus {
    border-color: #506eff;
    box-shadow: 0 0 0 3px rgba(80,110,255,.25);
    background: #141d36;
}

/* BUTTON */
.btn-save {
    background: linear-gradient(135deg, #223669, #1b2b52);
    padding: 13px 26px;
    border-radius: 14px;
    color: #fff;
    border: none;
    font-size: 14px;
    font-weight: 500;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    transition: .25s;
}

.btn-save:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 22px rgba(40,80,255,.45);
}

/* RESPONSIVE */
@media (max-width: 768px) {
    .sidebar {
        position: relative;
        width: 100%;
        height: auto;
    }
    .content {
        margin-left: 0;
        padding: 30px 20px;
    }
}
</style>
</head>

<body>

<!-- SIDEBAR -->
<div class="sidebar">
    <div class="brand">Admin Panel - Ticketing</div>

    <div class="section-title">MAIN</div>
    <a href="/admin/dashboard"><i class="fas fa-gauge"></i> Dashboard</a>

    <div class="section-title">MASTERS</div>
    <a href="/admin/masters/events"><i class="fas fa-calendar-days"></i> Events</a>
    <a href="/admin/masters/venues" class="active"><i class="fas fa-map-location-dot"></i> Venues</a>

    <div class="section-title">TRANSAKSI</div>
    <a href="/admin/transactions/orders"><i class="fas fa-receipt"></i> Orders</a>
    <a href="/admin/transactions/payments"><i class="fas fa-credit-card"></i> Payments</a>
    <a href="/admin/transactions/checkin"><i class="fas fa-qrcode"></i> Check-in</a>
    <a href="/admin/transactions/refunds"><i class="fas fa-plus"></i> Ajukan Refund</a>

</div>

<!-- CONTENT -->
<div class="content">

    <div class="page-header">
        <div class="page-icon">
            <i class="fas fa-map-location-dot"></i>
        </div>
        <h1 class="page-title"><?= $title ?></h1>
        <p class="page-subtitle">Isi data venue dengan lengkap.</p>
    </div>

    <div class="card-box">
        <form action="<?= $formAction ?>" method="post">
            <?= csrf_field() ?>

            <div class="mb-3">
                <label>Nama Venue</label>
                <input type="text" name="name" class="form-control"
                       value="<?= old('name', $venue['name'] ?? '') ?>"
                       placeholder="Masukkan nama venue..." required>
            </div>

            <div class="mb-3">
                <label>Lokasi</label>
                <input type="text" name="location" class="form-control"
                       value="<?= old('location', $venue['location'] ?? '') ?>"
                       placeholder="Masukkan lokasi venue..." required>
            </div>

            <div class="mb-4">
                <label>Kapasitas</label>
                <input type="number" name="capacity" class="form-control"
                       value="<?= old('capacity', $venue['capacity'] ?? '') ?>"
                       placeholder="Masukkan kapasitas venue..." required>
            </div>

            <button class="btn-save">
                <i class="fas fa-save"></i> Simpan Venue
            </button>
        </form>
    </div>

</div>

</body>
</html>
