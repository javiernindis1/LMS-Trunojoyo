<?php
require_once '../data.php';

$pageTitle = 'Detail Pengumuman';
$kelasId = isset($_GET['kelas_id']) ? (int)$_GET['kelas_id'] : null;
$id = isset($_GET['id']) ? (int)$_GET['id'] : null;

$pengumuman = getPengumumanById($id);

if (!$pengumuman) {
    // Handle not found
    header('Location: stream.php' . ($kelasId ? '?kelas_id=' . $kelasId : ''));
    exit;
}

$backUrl = 'stream.php' . ($kelasId ? '?kelas_id=' . $kelasId : '');

require_once 'layouts/header-detail.php';
?>

<!-- Pengumuman Card -->
<div class="detail-card">
    <div class="detail-label">Dibuat pada</div>
    <div class="detail-text"><?= htmlspecialchars($pengumuman['tanggal']) ?></div>
    
    <div class="detail-label mt-3">Deskripsi</div>
    <div class="detail-text"><?= htmlspecialchars($pengumuman['isi']) ?></div>
</div>

<!-- Komentar Card -->
<div class="detail-card">
    <div class="komentar-header">
        <i class="bi bi-chat-left-text"></i>
        <span>Komentar Kelas</span>
    </div>
    
    <?php if (!empty($pengumuman['komentar'])): ?>
        <?php foreach ($pengumuman['komentar'] as $komentar): ?>
            <div class="komentar-item">
                <div class="komentar-avatar"></div>
                <div class="komentar-body">
                    <div class="komentar-meta">
                        23-001 <?= htmlspecialchars($komentar['nama']) ?> &bull; <?= htmlspecialchars(explode(', ', $komentar['waktu'])[1] ?? $komentar['waktu']) ?>
                    </div>
                    <div class="komentar-text"><?= htmlspecialchars($komentar['isi']) ?></div>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p class="text-muted" style="font-size: 13px;">Belum ada komentar.</p>
    <?php endif; ?>
    
    <!-- Comment Input -->
    <div class="komentar-input-wrap">
        <div class="komentar-avatar"></div>
        <div class="komentar-box">
            <input type="text" placeholder="Tambahkan komentar">
            <div class="komentar-toolbar">
                <div class="komentar-tools">
                    <i class="bi bi-type-bold"></i>
                    <i class="bi bi-type-italic"></i>
                    <i class="bi bi-type-underline"></i>
                    <i class="bi bi-list-ul"></i>
                </div>
                <div class="komentar-send">
                    <i class="bi bi-send-fill"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
require_once 'layouts/footer-detail.php';
?>
