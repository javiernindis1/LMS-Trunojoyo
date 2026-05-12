<?php
require_once '../data.php';

$pageTitle = 'Presensi';
$activeNav = 'presensi';
$kelasId = isset($_GET['kelas_id']) ? (int)$_GET['kelas_id'] : null;

$activeKelas = $kelasId ? getKelasById($kelasId) : null;
$pertemuan = $kelasId ? getPertemuanByKelas($kelasId) : [];

require_once 'layouts/header.php';
?>

<?php if (!$kelasId): ?>
<div class="kelas-belum-dipilih">
    <div class="kelas-belum-icon"><i class="bi bi-file-earmark-x-fill"></i></div>
    <h4 class="kelas-belum-text">Kelas Belum Dipilih</h4>
</div>
<?php else: ?>

<div class="presensi-wrapper">
    <h5 class="presensi-title">
        <?= htmlspecialchars($activeKelas['nama'] . ' ' . $activeKelas['kelas']) ?>
    </h5>
    <hr class="lms-card-divider mb-3">

    <div class="presensi-list">
        <?php foreach ($pertemuan as $index => $p):
            $isBerlangsung  = $p['status'] === 'berlangsung';
            $isSelesai      = $p['status'] === 'selesai';
            $isBelumDimulai = !$isBerlangsung && !$isSelesai;
        ?>
        <div class="presensi-item <?= $isBerlangsung ? 'presensi-item--open' : '' ?>">
            <div class="presensi-item-header">
                <span class="presensi-item-label"><?= htmlspecialchars($p['label']) ?></span>
                <div class="d-flex align-items-center gap-3">
                    <?php if ($isSelesai): ?>
                    <span class="presensi-badge presensi-badge--selesai">Selesai</span>
                    <?php elseif ($isBerlangsung): ?>
                    <span class="presensi-badge presensi-badge--berlangsung">Sedang berlangsung</span>
                    <?php endif; ?>
                    <i class="bi bi-chevron-down presensi-chevron"></i>
                </div>
            </div>
            <div class="presensi-item-body">
                <?php if ($isBerlangsung || $isBelumDimulai): ?>
                <a href="detail_presensi.php?kelas_id=<?= $kelasId?>&pertemuan_id=<?= $p['id'] ?>" class="btn btn-success btn-sm presensi-absensi-btn">
                    <i class="bi bi-clipboard-check me-1"></i>Mulai Absensi
                </a>
                <?php elseif ($isSelesai): ?>
                <a href="detail_presensi.php?kelas_id=<?= $kelasId?>&pertemuan_id=<?= $p['id'] ?>" class="btn btn-primary btn-sm presensi-absensi-btn">
                    <i class="bi bi-eye me-1"></i>Lihat Absensi
                </a>
                <?php endif; ?>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>

<?php endif; ?>

<?php require_once 'layouts/footer.php'; ?>
