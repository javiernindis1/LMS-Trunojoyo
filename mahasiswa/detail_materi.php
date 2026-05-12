<?php
require_once '../data.php';

$pageTitle = 'Detail Materi';
$kelasId = isset($_GET['kelas_id']) ? (int)$_GET['kelas_id'] : null;
$id = isset($_GET['id']) ? (int)$_GET['id'] : null;

$materi = getmateriById($id);

if (!$materi) {
    // Handle not found
    header('Location: stream.php' . ($kelasId ? '?kelas_id=' . $kelasId : ''));
    exit;
}

$backUrl = 'stream.php' . ($kelasId ? '?kelas_id=' . $kelasId : '');

require_once 'layouts/header-detail.php';
?>


<!-- materi Card -->
<div class="detail-card">
    <div class="row">
        <div class="col-md-6">
            <div class="detail-label">Judul</div>
            <div class="detail-text fw-bold"><?= htmlspecialchars($materi['judul']) ?></div>
        </div>

        <div class="col-md-6">
            <div class="detail-label">Deskripsi</div>
            <div class="detail-text"><?= htmlspecialchars($materi['deskripsi']) ?></div>
        </div>

        <div class="col-md-6 mt-3">
            <div class="detail-label">Dibuat pada</div>
            <div class="detail-text"><?= htmlspecialchars($materi['tanggal']) ?></div>
        </div>

        <div class="col-md-6 mt-3">
            <div class="detail-label">Jenis Lampiran</div>
            <div class="detail-text"><?= htmlspecialchars($materi['tipe']) ?></div>
        </div>
        <hr class="lms-card-divider">
        <div class="materi-lampiran-label"><i class="bi bi-paperclip me-1"></i>Lampiran</div>
        <?php foreach ($materi['lampiran'] as $lamp): ?>
        <?php if ($lamp['tipe'] === 'youtube'): ?>
        <div class="lampiran-item lampiran-youtube">
            <div class="lampiran-thumb yt-thumb">
                <i class="bi bi-youtube text-danger fs-4"></i>
            </div>
            <div class="lampiran-info">
                <p class="lampiran-title"><?= htmlspecialchars($lamp['judul']) ?></p>
                <p class="lampiran-url"><?= htmlspecialchars($lamp['url']) ?></p>
            </div>
            <a href="<?= htmlspecialchars($lamp['url']) ?>" target="_blank" class="lampiran-ext ms-auto">
                <i class="bi bi-box-arrow-up-right"></i>
            </a>
        </div>
        <?php else: ?>
        <div class="lampiran-item lampiran-file">
            <div class="lampiran-thumb file-thumb">
                <i class="bi bi-file-earmark-word text-primary fs-4"></i>
            </div>
            <div class="lampiran-info">
                <p class="lampiran-title"><?= htmlspecialchars($lamp['judul']) ?></p>
            </div>
            <a href="<?= htmlspecialchars($lamp['url']) ?>" class="lampiran-download ms-auto">
                <i class="bi bi-download"></i>
            </a>
        </div>
        <?php endif; ?>
        <?php endforeach; ?>
    </div>
</div>

<!-- Komentar Card -->
<div class="detail-card">
    <div class="komentar-header">
        <i class="bi bi-chat-left-text"></i>
        <span>Komentar Kelas</span>
    </div>
    
    <?php if (!empty($materi['komentar'])): ?>
        <?php foreach ($materi['komentar'] as $komentar): ?>
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
