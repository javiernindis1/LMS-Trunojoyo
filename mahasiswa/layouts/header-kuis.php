<?php
if (!defined('BASE_URL')) {
    // define('BASE_URL', 'http://' . $_SERVER['HTTP_HOST'] . '/Magang/LMS-Trunojoyo'); // javier
    define('BASE_URL', 'http://lms-trunojoyo.test'); // abid
}

$kelasId = isset($_GET['kelas_id']) ? (int)$_GET['kelas_id'] : null;
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($pageTitle ?? 'Kuis') ?> | LMS</title>
    <!-- Bootstrap 5 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="<?= BASE_URL ?>/mahasiswa/public/css/style.css">
    <style>
        body { background: #f1f3f4; font-family: 'Inter', sans-serif; margin: 0; padding: 0; }
    </style>
</head>
<body>

<!-- ===== NAVBAR KUIS ===== -->
<div style="
    position: sticky;
    top: 0;
    z-index: 1040;
    background: #fff;
    border-bottom: 1px solid #e0e0e0;
    padding: 10px 28px;
    display: flex;
    align-items: center;
    justify-content: space-between;
">
    <!-- Kiri: Ikon + Judul -->
    <div style="display: flex; align-items: center; gap: 10px;">
        <i class="bi bi-book-fill" style="font-size: 18px; color: #1a73e8;"></i>
        <span style="font-size: 18px; font-weight: 600; color: #202124; margin: 0;">
            <?= htmlspecialchars($pageTitle ?? 'Kuis') ?>
        </span>
    </div>

    <!-- Kanan: Timer Badge -->
    <div id="kuis-timer-badge" style="
        background: #1a73e8;
        color: white;
        border-radius: 10px;
        padding: 6px 20px;
        display: flex;
        flex-direction: column;
        align-items: center;
        line-height: 1.25;
        transition: background .3s;
    ">
        <span style="font-size: 11px; font-weight: 500; opacity: 0.85; letter-spacing: 0.3px;">Sisa waktu</span>
        <span id="kuis-timer-display" style="font-size: 22px; font-weight: 800; letter-spacing: 1px;">
            <?= isset($durasiMenit) ? str_pad($durasiMenit, 2, '0', STR_PAD_LEFT) . ':00' : '20:00' ?>
        </span>
    </div>
</div>

<!-- ===== WRAPPER KONTEN ===== -->
<div style="max-width: 1100px; margin: 28px auto; padding: 0 20px;">

<script>
var kuisDurasiDetik = <?= isset($durasiMenit) ? (int)$durasiMenit * 60 : 20 * 60 ?>;
var kuisTimerInterval = null;

// Timer langsung berjalan saat halaman dimuat
window.addEventListener('DOMContentLoaded', function() {
    startKuisTimer(kuisDurasiDetik);
});

function startKuisTimer(detik) {
    if (kuisTimerInterval) clearInterval(kuisTimerInterval);
    var sisa = detik;
    updateTimerDisplay(sisa);
    kuisTimerInterval = setInterval(function() {
        sisa--;
        if (sisa < 0) sisa = 0;
        updateTimerDisplay(sisa);
        if (sisa === 0) {
            clearInterval(kuisTimerInterval);
            alert('Waktu habis! Jawaban dikumpulkan.');
        }
    }, 1000);
}

function updateTimerDisplay(sisa) {
    var mnt = Math.floor(sisa / 60);
    var dtk = sisa % 60;
    var str = String(mnt).padStart(2, '0') + ':' + String(dtk).padStart(2, '0');
    var el = document.getElementById('kuis-timer-display');
    if (el) el.textContent = str;
    var badge = document.getElementById('kuis-timer-badge');
    if (badge) badge.style.background = sisa < 300 ? '#d93025' : '#1a73e8';
}
</script>


