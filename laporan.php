<?php
require_once 'data.php';

$pageTitle = 'Laporan';
$activeNav = 'Laporan';
$kelasId = isset($_GET['kelas_id']) ? (int)$_GET['kelas_id'] : null;

$activeKelas = $kelasId ? getKelasById($kelasId) : null;
$seksi = $kelasId ? getSeksiByKelas($kelasId) : [];

require_once 'layouts/header.php';
?>

<?php if (!$kelasId): ?>
<div class="kelas-belum-dipilih">
    <div class="kelas-belum-icon"><i class="bi bi-file-earmark-x-fill"></i></div>
    <h4 class="kelas-belum-text">Kelas Belum Dipilih</h4>
</div>
<?php else: ?>

<div class="laporan-wrapper">
    <h5 class="laporan-title">
        LAPORAN KELAS <?= htmlspecialchars($activeKelas['nama'] . ' ' . $activeKelas['kelas']) ?>
    </h5>
    <hr class="lms-card-divider mb-4">


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
</div>

<?php endif; ?>

<?php require_once 'layouts/footer.php'; ?>
