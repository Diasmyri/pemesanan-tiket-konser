<?= $this->extend('admin/layout/navbar') ?>

<?= $this->section('content') ?>

<style>
    /* ================= THEME VARIABLES ================= */
    :root {
        --primary: #4318FF;
        --primary-glow: rgba(67, 24, 255, 0.15);
        --secondary: #A3AED0;
        --navy: #1B2559;
        --bg-body: #F4F7FE;
        --white: #ffffff;
        --border-color: #E0E5F2;
        --danger: #EE5D50;
        --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    /* Layout Wrapper */
    .content-wrapper-modern {
        padding: 40px 30px;
        background-color: var(--bg-body);
        min-height: 100vh;
        font-family: 'Plus Jakarta Sans', sans-serif;
        position: relative;
        z-index: 1;
    }

    /* ================= BACKGROUND & GLASS ================= */
    .bg-video {
        position: fixed;
        inset: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
        z-index: -2;
        filter: brightness(0.6);
        pointer-events: none;
    }

    .glass-overlay {
        position: fixed;
        inset: 0;
        background: rgba(244, 247, 254, 0.88);
        z-index: -1;
        backdrop-filter: blur(12px);
    }

    /* ================= HEADER SECTION ================= */
    .header-flex {
        display: flex;
        justify-content: space-between;
        align-items: flex-end;
        margin-bottom: 35px;
    }

    .page-title-modern {
        font-size: 34px;
        font-weight: 800;
        color: var(--navy);
        letter-spacing: -1.5px;
        margin: 0;
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .breadcrumb-custom {
        color: var(--secondary);
        font-weight: 700;
        font-size: 13px;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    /* ================= CARD BOX ================= */
    .card-box-modern {
        background: var(--white);
        border-radius: 30px;
        padding: 35px;
        border: none;
        box-shadow: 0px 20px 40px rgba(112, 144, 176, 0.1);
    }

    /* ================= TOP ACTIONS ================= */
    .top-actions-bar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 30px;
        gap: 20px;
    }

    .btn-add-modern {
        background: var(--primary);
        padding: 14px 28px;
        border-radius: 16px;
        color: #fff;
        font-weight: 700;
        display: flex;
        align-items: center;
        gap: 10px;
        transition: var(--transition);
        text-decoration: none;
        box-shadow: 0px 10px 20px rgba(67, 24, 255, 0.2);
    }

    .btn-add-modern:hover {
        transform: translateY(-3px);
        box-shadow: 0px 15px 30px rgba(67, 24, 255, 0.3);
        color: #fff;
    }

    .search-input-group {
        position: relative;
        width: 350px;
    }

    .search-icon-inside {
        position: absolute;
        left: 18px;
        top: 50%;
        transform: translateY(-50%);
        color: var(--secondary);
    }

    .search-control-modern {
        background: #F4F7FE;
        border: 2px solid transparent;
        padding: 14px 20px 14px 48px;
        border-radius: 18px;
        width: 100%;
        font-weight: 600;
        transition: var(--transition);
        color: var(--navy);
    }

    .search-control-modern:focus {
        outline: none;
        background: var(--white);
        border-color: var(--primary);
        box-shadow: 0 0 0 5px var(--primary-glow);
    }

    /* ================= TABLE DESIGN ================= */
    .table-modern {
        border-collapse: separate;
        border-spacing: 0 15px;
    }

    .table-modern thead th {
        border: none;
        color: var(--secondary);
        font-size: 12px;
        text-transform: uppercase;
        font-weight: 800;
        padding: 10px 20px;
        letter-spacing: 1px;
    }

    .table-modern tbody tr {
        background: var(--white);
        box-shadow: 0px 5px 15px rgba(112, 144, 176, 0.08);
        transition: var(--transition);
    }

    .table-modern tbody tr:hover {
        transform: scale(1.005) translateX(5px);
        box-shadow: 0px 10px 25px rgba(112, 144, 176, 0.15);
    }

    .table-modern tbody td {
        padding: 20px;
        vertical-align: middle;
        border: none;
    }

    .table-modern tbody td:first-child { border-radius: 20px 0 0 20px; }
    .table-modern tbody td:last-child { border-radius: 0 20px 20px 0; }

    /* ================= AVATAR & BADGE ================= */
    .artist-portrait-modern {
        width: 70px;
        height: 70px;
        object-fit: cover;
        border-radius: 20px;
        border: 4px solid #F4F7FE;
        box-shadow: 0 8px 15px rgba(0,0,0,0.1);
        transition: var(--transition);
    }

    .artist-portrait-modern:hover {
        transform: scale(1.1) rotate(3deg);
    }

    .placeholder-portrait {
        width: 70px;
        height: 70px;
        border-radius: 20px;
        background: #F4F7FE;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        color: var(--secondary);
        font-size: 10px;
        font-weight: 800;
        border: 2px dashed var(--border-color);
    }

    .btn-circle-action {
        width: 44px;
        height: 44px;
        border-radius: 14px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        transition: var(--transition);
        margin-left: 8px;
        border: none;
        text-decoration: none;
    }

    .btn-edit-light { background: #E9E3FF; color: var(--primary); }
    .btn-edit-light:hover { background: var(--primary); color: #fff; }

    .btn-delete-light { background: #FFE9E9; color: var(--danger); }
    .btn-delete-light:hover { background: var(--danger); color: #fff; }

    .loading-fade { opacity: 0.4; filter: grayscale(1); transition: 0.3s; }
</style>

<video autoplay muted loop playsinline class="bg-video">
    <source src="https://cdn.coverr.co/videos/coverr-concert-crowd-light-show-1596/1080p.mp4" type="video/mp4">
</video>
<div class="glass-overlay"></div>

<div class="content-wrapper-modern">
    <div class="header-flex">
        <div>
            <div class="breadcrumb-custom">Masters &bull; Production</div>
            <h1 class="page-title-modern">
                <i class="fas fa-users text-primary"></i> Artists Database
            </h1>
        </div>
    </div>

    <div class="card-box-modern">
        <?php if (session()->getFlashdata('success')) : ?>
            <div class="alert alert-success d-flex align-items-center border-0 mb-4 shadow-sm" style="border-radius: 15px; background: #05cd99; color: #fff;">
                <i class="fas fa-check-circle me-3 fs-5"></i>
                <div class="fw-bold"><?= session()->getFlashdata('success') ?></div>
            </div>
        <?php endif; ?>

        <div class="top-actions-bar">
            <a href="/admin/masters/artists/create" class="btn-add-modern">
                <i class="fas fa-plus-circle"></i> Add New Artist
            </a>

            <div class="search-input-group">
                <i class="fas fa-search search-icon-inside"></i>
                <input type="text" class="search-control-modern" id="ajaxSearch" 
                       placeholder="Search artist name..." value="<?= $keyword ?? '' ?>" autocomplete="off">
            </div>
        </div>

        <div id="artistContainer">
            <div class="table-responsive">
                <table class="table table-modern">
                    <thead>
                        <tr>
                            <th width="80" class="ps-4">No</th>
                            <th width="120">Portrait</th>
                            <th>Artist Information</th>
                            <th width="180" class="text-end pe-4">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="artistTableBody">
                        <?php if (empty($artists)) : ?>
                            <tr>
                                <td colspan="4" class="text-center py-5">
                                    <i class="fas fa-user-slash fa-3x text-light mb-3 d-block"></i>
                                    <h5 class="text-secondary fw-bold">No artists found</h5>
                                    <p class="text-muted small">Try a different keyword or add a new artist.</p>
                                </td>
                            </tr>
                        <?php else : ?>
                            <?php $no = 1 + ($page - 1) * $perPage; ?>
                            <?php foreach ($artists as $a) : ?>
                            <tr>
                                <td class="ps-4">
                                    <span class="fw-800 text-secondary">#<?= str_pad($no++, 2, '0', STR_PAD_LEFT) ?></span>
                                </td>
                                <td>
                                    <?php if ($a['photo']) : ?>
                                        <img src="/uploads/artists/<?= $a['photo'] ?>" class="artist-portrait-modern">
                                    <?php else : ?>
                                        <div class="placeholder-portrait">
                                            <i class="fas fa-image mb-1 opacity-25"></i>
                                            <span>EMPTY</span>
                                        </div>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <div class="fw-800" style="font-size: 18px; color: var(--navy);"><?= esc($a['name']) ?></div>
                                    <div class="text-muted small fw-600">Verified Artist Profile</div>
                                </td>
                                <td class="text-end pe-4">
                                    <a href="/admin/masters/artists/edit/<?= $a['id'] ?>" class="btn-circle-action btn-edit-light" title="Edit Profile">
                                        <i class="fas fa-user-edit"></i>
                                    </a>
                                    <a href="/admin/masters/artists/delete/<?= $a['id'] ?>"
                                       onclick="return confirm('Hapus artis ini secara permanen?')"
                                       class="btn-circle-action btn-delete-light" title="Delete Artist">
                                        <i class="fas fa-trash-alt"></i>
                                    </a>
                                </td>
                            </tr>
                            <?php endforeach ?>
                        <?php endif ?>
                    </tbody>
                </table>
            </div>

            <div id="paginationLinks" class="d-flex justify-content-between align-items-center mt-4 px-2">
                <div class="text-muted small fw-bold">
                    Showing result for <span class="text-primary">"<?= esc($keyword ?? 'All Artists') ?>"</span>
                </div>
                <div>
                    <?= $pager->links('default','default_full') ?>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    let searchTimer;

    $('#ajaxSearch').on('keyup', function() {
        let keyword = $(this).val();
        clearTimeout(searchTimer);
        searchTimer = setTimeout(function() {
            fetchArtists(keyword);
        }, 300);
    });

    function fetchArtists(keyword) {
        $('#artistContainer').addClass('loading-fade');
        $.ajax({
            url: "<?= base_url('admin/masters/artists') ?>",
            type: 'GET',
            data: { keyword: keyword, is_ajax: 1 },
            success: function(response) {
                let newHtml = $(response).find('#artistContainer').html();
                $('#artistContainer').html(newHtml).removeClass('loading-fade');
            }
        });
    }

    $(document).on('click', '.pagination a', function(e) {
        e.preventDefault();
        let url = $(this).attr('href');
        $('#artistContainer').addClass('loading-fade');
        $.ajax({
            url: url,
            type: 'GET',
            success: function(response) {
                let newHtml = $(response).find('#artistContainer').html();
                $('#artistContainer').html(newHtml).removeClass('loading-fade');
                $('html, body').animate({ scrollTop: $(".card-box-modern").offset().top - 100 }, 200);
            }
        });
    });
});
</script>

<?= $this->endSection() ?>