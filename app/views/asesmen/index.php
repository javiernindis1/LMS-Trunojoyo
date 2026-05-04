<?php
// Asesmen view - Tugas & Kuis tabs
// Available: $kelasId, $tab, $tugas, $kuis, $activeKelas
?>

<?php if (!$kelasId): ?>
<div class="kelas-belum-dipilih">
    <div class="kelas-belum-icon"><i class="bi bi-file-earmark-x-fill"></i></div>
    <h4 class="kelas-belum-text">Kelas Belum Dipilih</h4>
</div>
<?php else: ?>

<!-- Tab Bar -->
<div class="content-tab-bar d-flex align-items-center justify-content-between">
    <div class="lms-tab-pill-wrap">
        <a class="lms-tab-pill <?= $tab !== 'kuis' ? 'active' : '' ?>"
           href="<?= BASE_URL ?>?controller=asesmen&kelas_id=<?= $kelasId ?>&tab=tugas" id="tab-tugas">
            <i class="bi bi-journal-text me-1"></i>Tugas
        </a>
        <a class="lms-tab-pill <?= $tab === 'kuis' ? 'active' : '' ?>"
           href="<?= BASE_URL ?>?controller=asesmen&kelas_id=<?= $kelasId ?>&tab=kuis" id="tab-kuis">
            <i class="bi bi-question-circle-fill me-1"></i>Kuis
        </a>
    </div>
    <button class="btn btn-primary btn-tambah" id="btnTambah">Tambah</button>
</div>

<div class="tab-content-area">

<?php if ($tab !== 'kuis'): ?>
<!-- ===== TUGAS ===== -->
<?php foreach ($tugas as $t):
    $borderColor = $t['status'] === 'aktif' ? '#28a745' : ($t['status'] === 'expired' ? '#dc3545' : '#adb5bd');
    $iconBg      = $t['status'] === 'aktif' ? '#28a745' : ($t['status'] === 'expired' ? '#dc3545' : '#6c757d');
    $badgeClass  = $t['status'] === 'aktif' ? 'badge-aktif' : ($t['status'] === 'expired' ? 'badge-expired' : 'badge-draft');
    $badgeLabel  = $t['status'] === 'aktif' ? 'Aktif' : ($t['status'] === 'expired' ? 'Melewati Batas Waktu' : 'Draft');
    $visClass    = $t['visibilitas'] === 'Terlihat oleh siswa' ? 'text-success' : 'text-muted';
?>
<div class="asesmen-card" style="border-left-color: <?= $borderColor ?>;">
    <div class="asesmen-card-header">
        <div class="d-flex align-items-center gap-3">
            <div class="asesmen-icon" style="background:<?= $iconBg ?>;">
                <i class="bi bi-journal-text text-white"></i>
            </div>
            <div>
                <div class="asesmen-judul"><?= htmlspecialchars($t['judul']) ?></div>
                <div class="asesmen-meta-row">
                    <span class="text-muted"><i class="bi bi-calendar3 me-1"></i><?= $t['tanggal'] ?></span>
                    <span class="text-muted mx-2">•</span>
                    <span class="text-muted"><?= $t['poin'] ?> Poin</span>
                    <span class="<?= $visClass ?> ms-3"><?= htmlspecialchars($t['visibilitas']) ?></span>
                </div>
            </div>
        </div>
        <div class="d-flex flex-column align-items-end gap-1">
            <span class="text-muted small">Tenggat Waktu <?= $t['tenggat'] ?></span>
            <span class="asesmen-badge <?= $badgeClass ?>"><?= $badgeLabel ?></span>
        </div>
    </div>
    <div class="asesmen-file">
        <i class="bi bi-paperclip me-1 text-muted"></i><?= htmlspecialchars($t['file']) ?>
    </div>
    <hr class="lms-card-divider">
    <div class="asesmen-footer">
        <span>Total Siswa: <strong><?= $t['total_siswa'] ?></strong></span>
        <span>Dikumpulkan: <strong class="text-success"><?= $t['dikumpulkan'] ?></strong></span>
        <span>Belum Dikumpulkan: <strong class="text-danger"><?= $t['belum'] ?></strong></span>
        <span>Dinilai: <strong class="text-primary"><?= $t['dinilai'] ?></strong></span>
    </div>
</div>
<?php endforeach; ?>

<?php else: ?>
<!-- ===== KUIS ===== -->
<?php foreach ($kuis as $k):
    $borderColor = $k['status'] === 'aktif' ? '#28a745' : ($k['status'] === 'expired' ? '#dc3545' : '#adb5bd');
    $iconBg      = $k['status'] === 'aktif' ? '#28a745' : ($k['status'] === 'expired' ? '#dc3545' : '#6c757d');
    $badgeClass  = $k['status'] === 'aktif' ? 'badge-aktif' : ($k['status'] === 'expired' ? 'badge-expired' : 'badge-draft');
    $badgeLabel  = $k['status'] === 'aktif' ? 'Aktif' : ($k['status'] === 'expired' ? 'Melewati Batas Waktu' : 'Draft');
?>
<div class="asesmen-card" style="border-left-color: <?= $borderColor ?>;">
    <div class="d-flex align-items-start gap-3 mb-3">
        <div class="asesmen-icon kuis-icon" style="background:<?= $iconBg ?>;">
            <i class="bi bi-question-lg text-white fs-5"></i>
        </div>
        <div>
            <div class="asesmen-judul"><?= htmlspecialchars($k['judul']) ?></div>
            <span class="asesmen-badge <?= $badgeClass ?>"><?= $badgeLabel ?></span>
        </div>
    </div>
    <div class="kuis-grid">
        <div class="kuis-grid-item">
            <span class="kuis-grid-label">Tanggal Mulai</span>
            <span class="kuis-grid-value"><?= $k['tgl_mulai'] ?></span>
        </div>
        <div class="kuis-grid-item">
            <span class="kuis-grid-label">Tenggat Waktu</span>
            <span class="kuis-grid-value"><?= $k['tenggat'] ?></span>
        </div>
        <div class="kuis-grid-item">
            <span class="kuis-grid-label">Durasi</span>
            <span class="kuis-grid-value"><strong><?= $k['durasi'] ?></strong></span>
        </div>
        <div class="kuis-grid-item">
            <span class="kuis-grid-label">Total Poin</span>
            <span class="kuis-grid-value"><strong><?= $k['total_poin'] ?></strong></span>
        </div>
        <div class="kuis-grid-item">
            <span class="kuis-grid-label">Pertanyaan</span>
            <span class="kuis-grid-value"><strong><?= $k['pertanyaan'] ?></strong></span>
        </div>
        <div class="kuis-grid-item">
            <span class="kuis-grid-label">Rata-Rata Nilai</span>
            <span class="kuis-grid-value"><strong><?= $k['rata_nilai'] ?></strong></span>
        </div>
    </div>
</div>
<?php endforeach; ?>
<?php endif; ?>

</div><!-- /tab-content-area -->
<?php endif; ?>
