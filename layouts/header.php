<?php
// Initialize settings
if (!defined('BASE_URL')) {
    // define('BASE_URL', 'http://' . $_SERVER['HTTP_HOST'] . '/Magang/LMS-Trunojoyo'); // javier
    define(define('BASE_URL', 'http://lms-trunojoyo.test');) // abid
}

// Get class ID from URL
$kelasId = isset($_GET['kelas_id']) ? (int)$_GET['kelas_id'] : null;
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="LMS - Learning Management System untuk pengelolaan kelas dan materi pembelajaran">
    <title><?= htmlspecialchars($pageTitle ?? 'LMS') ?> | LMS</title>

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

<!-- ======= NAVBAR ======= -->
<nav class="navbar navbar-expand navbar-dark lms-navbar" id="mainNavbar">
    <!-- Logo kiri -->
    <a class="navbar-brand navbar-logo-wrap" href="<?= BASE_URL ?>">
        <img src="<?= BASE_URL ?>/public/img/logo.png" alt="Logo Sekolah" class="navbar-logo" 
             onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
        <div class="navbar-logo-fallback" style="display:none;">
            <i class="bi bi-mortarboard-fill fs-4 text-warning"></i>
        </div>
    </a>

    <!-- Nav items tengah -->
    <ul class="navbar-nav navbar-nav-center">
        <?php
        $navItems = [
            ['page' => 'stream.php',    'name' => 'stream',    'label' => 'Stream',            'icon' => 'cast'],
            ['page' => 'asesmen.php',   'name' => 'asesmen',   'label' => 'Asesmen',           'icon' => 'book'],
            ['page' => 'presensi.php',  'name' => 'presensi',  'label' => 'Presensi',          'icon' => 'pencil'],
            ['page' => 'nilai.php',     'name' => 'nilai',     'label' => 'Nilai',             'icon' => 'grid'],
            ['page' => 'laporan.php',   'name' => 'laporan',   'label' => 'Laporan',           'icon' => 'file-earmark-text'],
            ['page' => 'manajemen_laporan.php', 'name' => 'manajemen', 'label' => 'Manajemen Laporan', 'icon' => 'file-earmark-bar-graph'],
        ];
        foreach ($navItems as $item):
            $isActive = ($activeNav ?? '') === $item['name'];
            $href = BASE_URL . '/' . $item['page'];
            if ($kelasId) $href .= '?kelas_id=' . $kelasId;
        ?>
        <li class="nav-item">
            <a class="nav-link lms-nav-link <?= $isActive ? 'active' : '' ?>" href="<?= $href ?>">
                <i class="bi bi-<?= $item['icon'] ?> me-1"></i><?= $item['label'] ?>
            </a>
        </li>
        <?php endforeach; ?>
    </ul>

    <!-- Spacer kanan (sama lebar dengan logo agar nav benar-benar center) -->
    <div class="navbar-right-spacer"></div>
</nav>

<!-- ======= PAGE WRAPPER ======= -->
<div class="lms-page-wrapper">

    <!-- SIDEBAR -->
    <aside class="lms-sidebar">
        <!-- Profile Card -->
        <div class="sidebar-profile-card">
            <div class="profile-avatar-wrap">
                <img src="<?= BASE_URL ?>/public/img/avatar.png" alt="Avatar"
                     onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                <div class="profile-avatar-fallback">
                    <i class="bi bi-person-fill"></i>
                </div>
            </div>
            <div class="profile-info text-center mt-2">
                <p class="profile-email">Alamat Email di sini</p>
                <p class="profile-nip">NIP di sini</p>
                <p class="profile-jurusan">Jurusan di sini</p>
            </div>
            <div class="text-center mt-2">
                <a href="#" class="btn btn-outline-danger btn-sm btn-signout">
                    <i class="bi bi-box-arrow-right me-1"></i>Sign Out
                </a>
            </div>
        </div>

        <!-- Kelas List -->
        <div class="sidebar-kelas-card">
            <p class="kelas-label">KELAS</p>
            <ul class="kelas-list list-unstyled mb-0">
                <?php foreach ($kelasList as $kelas): 
                    $isActiveKelas = ($kelasId == $kelas['id']);
                    // Get current page script name (e.g., stream.php, detail_pengumuman.php)
                    $currentPage = basename($_SERVER['PHP_SELF']);
                    // For detail pages, we might want to route back to the main tab (stream or asesmen) when changing class
                    if (strpos($currentPage, 'detail_pengumuman') !== false || strpos($currentPage, 'detail_materi') !== false) {
                        $currentPage = 'stream.php';
                    } elseif (strpos($currentPage, 'detail_tugas') !== false || strpos($currentPage, 'detail_kuis') !== false) {
                        $currentPage = 'asesmen.php';
                    }
                    if ($currentPage === 'index.php') $currentPage = 'stream.php';
                    
                    $kelasUrl = BASE_URL . '/' . $currentPage . '?kelas_id=' . $kelas['id'];
                ?>
                <li class="kelas-item <?= $isActiveKelas ? 'active' : '' ?>">
                    <a href="<?= $kelasUrl ?>" class="kelas-link <?= $isActiveKelas ? 'active' : '' ?>">
                        <span class="kelas-icon">
                            <i class="bi bi-lock-fill text-warning"></i>
                        </span>
                        <span class="kelas-info">
                            <span class="kelas-nama"><?= htmlspecialchars($kelas['nama']) ?></span>
                            <span class="kelas-sub"><?= htmlspecialchars($kelas['kelas']) ?></span>
                        </span>
                    </a>
                </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </aside>

    <!-- MAIN CONTENT -->
    <main class="lms-content" id="mainContent">
