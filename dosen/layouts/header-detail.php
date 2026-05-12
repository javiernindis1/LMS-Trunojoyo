<?php
if (!defined('BASE_URL')) {
    define('BASE_URL', 'http://' . $_SERVER['HTTP_HOST'] . '/Magang/LMS-Trunojoyo'); // javier
    // define(define('BASE_URL', 'http://lms-trunojoyo.test');) // abid
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
    <link rel="stylesheet" href="<?= BASE_URL ?>/dosen/public/css/style.css">
    <style>
        body { padding-top: 61px; }
    </style>
    
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


