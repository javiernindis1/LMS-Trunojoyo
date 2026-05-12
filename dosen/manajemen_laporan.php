<?php
require_once '../data.php';

$pageTitle = 'Manajemen Laporan';
$activeNav = 'manajemen';
$kelasId = isset($_GET['kelas_id']) ? (int)$_GET['kelas_id'] : null;

// Mengambil variabel global kelasList dari data.php
global $kelasList;

// Memilih kelas secara mandiri untuk manajemen laporan
$selectedKelasId = isset($_GET['manajemen_kelas']) ? (int)$_GET['manajemen_kelas'] : ($kelasId ?: ($kelasList[0]['id'] ?? null));
$activeKelas = $selectedKelasId ? getKelasById($selectedKelasId) : null;
$seksi = $selectedKelasId ? getSeksiByKelas($selectedKelasId) : [];

require_once 'layouts/header.php';
?>

<div class="laporan-wrapper">
    <h5 class="laporan-title">
        MANAJEMEN LAPORAN
    </h5>
    <hr class="lms-card-divider mb-4">

    <div class="row mb-4">
        <div class="col-md-5">
            <label class="form-label text-muted small mb-1">Pilih Periode</label>
            <select class="form-select form-select-sm">
                <option>2025/2026 Gasal</option>
            </select>
        </div>
        <div class="col-md-7">
            <label class="form-label text-muted small mb-1">Pilih Kelas</label>
            <select class="form-select form-select-sm" onchange="window.location.href='manajemen_laporan.php?<?= $kelasId ? "kelas_id=$kelasId&" : "" ?>manajemen_kelas=' + this.value">
                <?php foreach ($kelasList as $k): ?>
                <option value="<?= $k['id'] ?>" <?= $selectedKelasId == $k['id'] ? 'selected' : '' ?>>
                    <?= htmlspecialchars($k['nama'] . ' - ' . $k['kelas']) ?>
                </option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>

    <?php if ($selectedKelasId && !empty($seksi)): ?>
    <div class="laporan-card">
        <?php foreach ($seksi as $i => $s): ?>
        <div class="laporan-seksi <?= $i > 0 ? 'mt-4' : '' ?>">
            <p class="laporan-seksi-judul"><?= htmlspecialchars($s['judul']) ?></p>
            <?php foreach ($s['items'] as $item): ?>
            <a href="#" class="laporan-item">
                <i class="bi bi-bar-chart-line-fill me-2 text-primary"></i>
                <?= htmlspecialchars($item) ?>
            </a>
            <?php endforeach; ?>
        </div>
        <?php endforeach; ?>
    </div>
    <?php else: ?>
    <div class="alert alert-info border-0 shadow-sm" style="background-color: #f8f9fa;">
        <i class="bi bi-info-circle me-2"></i>Pilih kelas terlebih dahulu untuk melihat laporan.
    </div>
    <?php endif; ?>
</div>

<?php require_once 'layouts/footer.php'; ?>
