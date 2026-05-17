<?php
require_once '../data.php';

$pageTitle = 'Asesmen';
$activeNav = 'asesmen';
$kelasId = isset($_GET['kelas_id']) ? (int)$_GET['kelas_id'] : null;
$tab = isset($_GET['tab']) ? $_GET['tab'] : 'tugas';

// Filter data by kelasId
$tugas = $kelasId ? $tugasList : [];
$kuis  = $kelasId ? $kuisList : [];

require_once 'layouts/header.php';
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
           href="asesmen.php?kelas_id=<?= $kelasId ?>&tab=tugas" id="tab-tugas">
            <i class="bi bi-journal-text me-1"></i>Tugas
        </a>
        <a class="lms-tab-pill <?= $tab === 'kuis' ? 'active' : '' ?>"
           href="asesmen.php?kelas_id=<?= $kelasId ?>&tab=kuis" id="tab-kuis">
            <i class="bi bi-question-circle-fill me-1"></i>Kuis
        </a>
    </div>
    <?php
        $tambahUrl = ($tab === 'tugas') ? 'tambah_tugas.php?kelas_id=' . $kelasId : 'tambah_kuis.php?kelas_id=' . $kelasId;
    ?>
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
    $detailUrl   = 'detail_tugas.php?id=' . $t['id'] . '&kelas_id=' . $kelasId;
?>
<div class="asesmen-card asesmen-card-clickable" style="border-left-color: <?= $borderColor ?>;" onclick="window.location='<?= $detailUrl ?>'" role="link" tabindex="0">
    <div class="asesmen-card-header">
        <div class="d-flex align-items-center gap-3">
            <div class="asesmen-icon" style="background:<?= $iconBg ?>;">
                <i class="bi bi-journal-text text-white"></i>
            </div>
            <div>
                <div class="asesmen-judul"><?= htmlspecialchars($t['judul']) ?></div>
                <div class="asesmen-meta-row">
                    <span class="text-muted"><i class="bi bi-calendar3 me-1"></i><?= $t['tanggal'] ?></span>
                    <span class="text-muted mx-2">â€¢</span>
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
    $detailUrl   = 'detail_kuis.php?id=' . $k['id'] . '&kelas_id=' . $kelasId;
?>
<div class="asesmen-card asesmen-card-clickable" style="border-left-color: <?= $borderColor ?>;" 
    onclick="openKuisOverlay(
        '<?= htmlspecialchars($k['judul']) ?>',
        '<?= $detailUrl ?>',
        '<?= $k['pertanyaan'] ?>',
        '<?= $k['durasi'] ?>',
        '<?= $k['total_poin'] ?>'
    )"
    role="link" tabindex="0">
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

<!-- ===== MODAL OVERLAY KUIS (di luar foreach) ===== -->
<div 
    id="kuisOverlay"
    style="
        position: fixed;
        inset: 0;
        background: rgba(0,0,0,0.45);
        display: none;
        align-items: center;
        justify-content: center;
        z-index: 9999;
    "
>
    <div style="
        width: 480px;
        max-width: 95vw;
        background: #fff;
        border-radius: 20px;
        padding: 32px 28px 28px;
        position: relative;
        box-shadow: 0 8px 40px rgba(0,0,0,0.18);
    ">

        <!-- CLOSE -->
        <button onclick="closeKuisOverlay()" style="
            position: absolute;
            top: 16px; right: 18px;
            border: none; background: transparent;
            font-size: 22px; color: #5f6368;
            cursor: pointer; line-height: 1;
        ">&times;</button>

        <!-- HEADER -->
        <div style="display: flex; align-items: center; justify-content: center; gap: 12px; margin-bottom: 28px;">
            <div style="
                width: 44px; height: 44px;
                border-radius: 10px;
                background: #1a73e8;
                display: flex; align-items: center; justify-content: center;
                color: white; font-size: 20px;
            ">
                <i class="bi bi-book-fill"></i>
            </div>
            <div id="overlayJudul" style="font-size: 22px; font-weight: 700; color: #202124;">
                Kuis
            </div>
        </div>

        <!-- TOP GRID -->
        <div style="display: flex; gap: 12px; margin-bottom: 12px;">

            <!-- Total Pertanyaan -->
            <div style="flex: 1; background: #f1f3f4; border-radius: 12px; padding: 18px;">
                <div style="font-size: 12px; color: #5f6368; margin-bottom: 8px; display: flex; align-items: center; gap: 6px;">
                    <i class="bi bi-question-circle"></i> Total Pertanyaan
                </div>
                <div id="overlayPertanyaan" style="font-size: 28px; font-weight: 700; color: #202124;">—</div>
            </div>

            <!-- Durasi -->
            <div style="flex: 1; background: #f1f3f4; border-radius: 12px; padding: 18px;">
                <div style="font-size: 12px; color: #5f6368; margin-bottom: 8px; display: flex; align-items: center; gap: 6px;">
                    <i class="bi bi-clock-history"></i> Durasi
                </div>
                <div id="overlayDurasi" style="font-size: 28px; font-weight: 700; color: #202124;">—</div>
            </div>

        </div>

        <!-- Total Poin -->
        <div style="background: #f1f3f4; border-radius: 12px; padding: 18px; margin-bottom: 24px; text-align: center;">
            <div style="font-size: 12px; color: #5f6368; margin-bottom: 8px; display: flex; align-items: center; justify-content: center; gap: 6px;">
                <i class="bi bi-star"></i> Total Poin
            </div>
            <div id="overlayPoin" style="font-size: 32px; font-weight: 700; color: #202124;">—</div>
        </div>

        <!-- Tombol Mulai -->
        <button id="btnMulaiKuis" style="
            width: 100%; height: 50px;
            border: none;
            background: #1a73e8;
            color: white;
            border-radius: 12px;
            font-size: 16px; font-weight: 700;
            cursor: pointer;
            transition: background .15s;
        "
        onmouseover="this.style.background='#1557b0'"
        onmouseout="this.style.background='#1a73e8'"
        >
            Mulai
        </button>

    </div>
</div>

<script>
function openKuisOverlay(judul, url, pertanyaan, durasi, poin) {
    document.getElementById('overlayJudul').innerText     = judul;
    document.getElementById('overlayPertanyaan').innerText = pertanyaan || '—';
    document.getElementById('overlayDurasi').innerText    = (durasi || '—');
    document.getElementById('overlayPoin').innerText      = poin || '—';
    document.getElementById('btnMulaiKuis').onclick = function() {
        window.location.href = url;
    };
    var overlay = document.getElementById('kuisOverlay');
    overlay.style.display = 'flex';
}

function closeKuisOverlay() {
    document.getElementById('kuisOverlay').style.display = 'none';
}
</script>
<?php endif; // akhir: if ($tab === 'kuis') ?>

</div><!-- /tab-content-area -->
<?php endif; // akhir: if ($kelasId) ?>



<?php require_once 'layouts/footer.php'; ?>
