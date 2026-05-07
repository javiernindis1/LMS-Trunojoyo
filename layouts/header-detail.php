<?php
if (!defined('BASE_URL')) {
define('BASE_URL', 'http://lms-trunojoyo.test');
}

$kelasId = isset($_GET['kelas_id']) ? (int)$_GET['kelas_id'] : null;
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($pageTitle ?? 'Detail') ?> | LMS</title>
    <!-- Bootstrap 5 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="<?= BASE_URL ?>/public/css/style.css">
    
</head>
<body>

<!-- DETAIL NAVBAR -->
<div class="detail-navbar">
    <div class="detail-nav-left">
        <a href="<?= isset($backUrl) ? $backUrl : 'stream.php' . ($kelasId ? '?kelas_id='.$kelasId : '') ?>" class="btn-close-detail">
            <i class="bi bi-x"></i>
        </a>
        <div class="detail-icon">
            <i class="bi bi-file-earmark-text"></i>
        </div>
        <h1 class="detail-title"><?= htmlspecialchars($pageTitle ?? 'Detail Pengumuman') ?></h1>
    </div>
    <div class="detail-nav-right">
        <?php if (isset($headerRightContent)): ?>
            <?= $headerRightContent ?>
        <?php else: ?>
            <button class="btn-hapus" id="openDeleteOverlay">Hapus</button>
            <!-- OVERLAY -->
            <div class="delete-overlay" id="deleteOverlay">

                <div class="delete-modal">

                    <!-- ICON -->
                    <div class="delete-icon-wrap">
                        <i class="bi bi-trash3-fill"></i>
                    </div>

                    <!-- TITLE -->
                    <h4 class="delete-title">
                        Hapus <?= htmlspecialchars($pageTitle ?? 'Data') ?>?
                    </h4>

                    <!-- DESC -->
                    <p class="delete-desc">
                        Apakah anda yakin ingin menghapusnya?
                    </p>

                    <!-- ACTION -->
                    <div class="delete-action">

                        <button class="btn btn-outline-secondary px-4"
                                id="closeDeleteOverlay">
                            Batal
                        </button>

                        <button class="btn btn-danger px-4">
                            Hapus
                        </button>

                    </div>

                </div>

            </div>
            <button class="btn-edit">Edit</button>
        <?php endif; ?>
    </div>
</div>

<div class="detail-content-wrapper">


<style>

.delete-overlay{
    position:fixed;
    inset:0;

    background:rgba(0,0,0,.45);

    display:none;
    align-items:center;
    justify-content:center;

    z-index:9999;

    padding:20px;
}

.delete-overlay.show{
    display:flex;
}

.delete-modal{
    width:100%;
    max-width:420px;

    background:#fff;

    border-radius:24px;

    padding:36px 32px;

    text-align:center;

    animation:fadeIn .2s ease;
}

.delete-icon-wrap{
    width:82px;
    height:82px;

    margin:0 auto 22px;

    border-radius:50%;

    background:rgba(220,53,69,.12);

    display:flex;
    align-items:center;
    justify-content:center;
}

.delete-icon-wrap i{
    font-size:38px;
    color:#dc3545;
}

.delete-title{
    font-size:28px;
    font-weight:700;

    margin-bottom:12px;

    color:#222;
}

.delete-desc{
    font-size:15px;
    color:#666;

    margin-bottom:30px;
}

.delete-action{
    display:flex;
    justify-content:center;
    gap:14px;
}

@keyframes fadeIn{
    from{
        opacity:0;
        transform:scale(.95);
    }

    to{
        opacity:1;
        transform:scale(1);
    }
}

</style>

<script>

const deleteOverlay = document.getElementById('deleteOverlay');

const openDeleteOverlay = document.getElementById('openDeleteOverlay');

const closeDeleteOverlay = document.getElementById('closeDeleteOverlay');

/* OPEN */

openDeleteOverlay.addEventListener('click', () => {

    deleteOverlay.classList.add('show');

});

/* CLOSE BUTTON */

closeDeleteOverlay.addEventListener('click', () => {

    deleteOverlay.classList.remove('show');

});

/* CLOSE OUTSIDE */

deleteOverlay.addEventListener('click', (e) => {

    if(e.target === deleteOverlay){
        deleteOverlay.classList.remove('show');
    }

});

</script>