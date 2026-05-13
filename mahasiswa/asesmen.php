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
<div class="asesmen-card asesmen-card-clickable" style="border-left-color: <?= $borderColor ?>;"  onclick="openKuisOverlay('<?= htmlspecialchars($k['judul']) ?>','<?= $detailUrl ?>')"    role="link" tabindex="0">
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

    <div
        style="
            width: 440px;
            background: #fff;
            border-radius: 24px;
            padding: 28px;
            position: relative;
        "
    >

        <!-- CLOSE -->
        <button
            onclick="closeKuisOverlay()"
            style="
                position: absolute;
                top: 18px;
                right: 18px;
                border: none;
                background: transparent;
                font-size: 22px;
                color: #5f6368;
                cursor: pointer;
            "
        >
            <i class="bi bi-x-lg"></i>
        </button>

        <!-- HEADER -->
        <div
            style="
                display: flex;
                align-items: center;
                justify-content: center;
                gap: 12px;
                margin-bottom: 28px;
            "
        >

            <div
                style="
                    width: 52px;
                    height: 52px;
                    border-radius: 14px;
                    background: #e8f0fe;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                "
            >
                <i 
                    class="bi bi-book-fill"
                    style="
                        font-size: 24px;
                        color: #1a73e8;
                    "
                ></i>
            </div>

            <div
                id="overlayJudul"
                style="
                    font-size: 24px;
                    font-weight: 700;
                    color: #202124;
                "
            >
                Kuis
            </div>

        </div>

        <!-- TOP GRID -->
        <div
            style="
                display: flex;
                gap: 16px;
                margin-bottom: 16px;
            "
        >

            <!-- TOTAL PERTANYAAN -->
            <div
                style="
                    flex: 1;
                    border: 1px solid #dadce0;
                    border-radius: 16px;
                    padding: 18px;
                "
            >

                <div
                    style="
                        font-size: 13px;
                        color: #5f6368;
                        margin-bottom: 10px;
                    "
                >
                    Total Pertanyaan
                </div>

                <div
                    id="overlayPertanyaan"
                    style="
                        font-size: 26px;
                        font-weight: 700;
                        color: #202124;
                    "
                >
                    20
                </div>

            </div>

            <!-- DURASI -->
            <div
                style="
                    flex: 1;
                    border: 1px solid #dadce0;
                    border-radius: 16px;
                    padding: 18px;
                "
            >

                <div
                    style="
                        font-size: 13px;
                        color: #5f6368;
                        margin-bottom: 10px;
                    "
                >
                    Durasi
                </div>

                <div
                    id="overlayDurasi"
                    style="
                        font-size: 26px;
                        font-weight: 700;
                        color: #202124;
                    "
                >
                    60 Menit
                </div>

            </div>

        </div>

        <!-- TOTAL POIN -->
        <div
            style="
                border: 1px solid #dadce0;
                border-radius: 16px;
                padding: 18px;
                margin-bottom: 24px;
            "
        >

            <div
                style="
                    font-size: 13px;
                    color: #5f6368;
                    margin-bottom: 10px;
                "
            >
                Total Poin
            </div>

            <div
                id="overlayPoin"
                style="
                    font-size: 26px;
                    font-weight: 700;
                    color: #202124;
                "
            >
                100
            </div>

        </div>

        <!-- BUTTON -->
      <button
            id="btnMulaiKuis"         
            style="
                width: 100%;
                height: 50px;
                border: none;
                background: #1a73e8;
                color: white;
                border-radius: 14px;
                font-size: 15px;
                font-weight: 600;
                cursor: pointer;
                display: flex;
                align-items: center;
                justify-content: center;
                text-decoration: none;
            "
        >
            Mulai Kuis
        </button>

    </div>

</div>

<script>

const kuisOverlay = document.getElementById('kuisOverlay');

const overlayJudul = document.getElementById('overlayJudul');
const overlayPertanyaan = document.getElementById('overlayPertanyaan');
const overlayDurasi = document.getElementById('overlayDurasi');
const overlayPoin = document.getElementById('overlayPoin');

const btnMulaiKuis = document.getElementById('btnMulaiKuis');

function openKuisOverlay(judul, url) {

    overlayJudul.innerText = judul;

    btnMulaiKuis.onclick = function () {
        window.location.href = url;
    };

    kuisOverlay.style.display = 'flex';
}

function closeKuisOverlay() {
    kuisOverlay.style.display = 'none';
}

</script>
<?php endforeach; ?>
<?php endif; ?>

</div><!-- /tab-content-area -->
<?php endif; ?>



<?php require_once 'layouts/footer.php'; ?>
