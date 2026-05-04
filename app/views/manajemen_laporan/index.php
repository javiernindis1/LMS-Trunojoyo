<?php
// Laporan view
// Available: $kelasId, $seksi, $activeKelas
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
            <select class="form-select form-select-sm">
                <option><?= htmlspecialchars($activeKelas['kelas']) ?></option>
            </select>
        </div>
    </div>

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
