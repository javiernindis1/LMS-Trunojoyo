<?php
require_once '../data.php';

$pageTitle = 'Presensi';
$activeNav = 'presensi';
$kelasId = isset($_GET['kelas_id']) ? (int)$_GET['kelas_id'] : null;
$pertemuanId = isset($_GET['pertemuan_id']) ? (int)$_GET['pertemuan_id'] : null;

$activeKelas = $kelasId ? getKelasById($kelasId) : null;
$pertemuanList = $kelasId ? getPertemuanByKelas($kelasId) : [];
$pertemuan = null;
if ($pertemuanId) {
    foreach ($pertemuanList as $p) {
        if ($p['id'] === $pertemuanId) {
            $pertemuan = $p;
            break;
        }
    }
}

require_once 'layouts/header.php';
?>

<?php if (!$kelasId || !$pertemuan): ?>
<div class="kelas-belum-dipilih">
    <div class="kelas-belum-icon"><i class="bi bi-file-earmark-x-fill"></i></div>
    <h4 class="kelas-belum-text">Kelas atau Pertemuan Belum Dipilih</h4>
</div>
<?php else: ?>

<div class="presensi-wrapper">
    <h5 class="presensi-title">
        <?= htmlspecialchars($activeKelas['nama'] . ' ' . $activeKelas['kelas'] . ' ' . strtoupper($pertemuan['label'])) ?>
    </h5>
    <hr class="lms-card-divider mb-3">

    <?php
        $isBerlangsung  = $pertemuan['status'] === 'berlangsung';
        $isSelesai      = $pertemuan['status'] === 'selesai';
        $isBelumDimulai = !$isBerlangsung && !$isSelesai;
    ?>


    <div class="mb-4">
        <a href="presensi.php<?= $kelasId ? '?kelas_id='.$kelasId : '' ?>" class="btn btn-primary btn-sm px-3 py-1" style="font-size: 13px; font-weight: 500;">Kembali</a>
    </div>

    <div class="row">
        <!-- Kolom Kiri -->
        <div class="col-md-5 col-lg-4 mb-4">
            <div class="row g-2">
                <div class="col-6"><div class="presensi-summary-box box-peserta"><i class="bi bi-people-fill"></i><div class="box-num">31</div><div class="box-label">Peserta Kelas</div></div></div>
                <div class="col-6"><div class="presensi-summary-box box-masuk"><i class="bi bi-emoji-smile"></i><div class="box-num">31</div><div class="box-label">Masuk</div></div></div>
                <div class="col-6"><div class="presensi-summary-box box-alpha"><i class="bi bi-emoji-angry"></i><div class="box-num">31</div><div class="box-label">Alpha</div></div></div>
                <div class="col-6"><div class="presensi-summary-box box-sakit"><i class="bi bi-heart-pulse"></i><div class="box-num">31</div><div class="box-label">Sakit</div></div></div>
                <div class="col-6"><div class="presensi-summary-box box-dispensasi"><i class="bi bi-emoji-neutral"></i><div class="box-num">31</div><div class="box-label">Dispensasi</div></div></div>
                <div class="col-6"><div class="presensi-summary-box box-izin"><i class="bi bi-emoji-frown"></i><div class="box-num">31</div><div class="box-label">Izin</div></div></div>
            </div>
            
            <div class="info-list-container">
                <div class="info-list-header">Informasi</div>
                <div class="info-list-item"><i class="bi bi-heart-pulse"></i> Tidak ada mahasiswa sakit</div>
                <div class="info-list-item"><i class="bi bi-emoji-neutral"></i> Tidak ada mahasiswa dispensasi</div>
                <div class="info-list-item"><i class="bi bi-emoji-frown"></i> Tidak ada mahasiswa izin</div>
            </div>
        </div>

        <!-- Kolom Kanan -->
        <div class="col-md-7 col-lg-8">
            <div class="d-flex justify-content-center border-bottom mb-4 w-100">
                <a href="detail_presensi.php?kelas_id=<?= $kelasId ?>&pertemuan_id=<?= $pertemuanId ?>" class="text-decoration-none text-primary pb-2 fw-semibold text-center w-50" style="border-bottom: 2px solid #0d6efd; font-size: 14px;">Form Absensi</a>
                <a href="detail_presensi-2.php?kelas_id=<?= $kelasId ?>&pertemuan_id=<?= $pertemuanId ?>" class="text-decoration-none text-secondary pb-2 fw-semibold text-center w-50" style="font-size: 14px;">Mahasiswa</a>
            </div>
            
            <form>
                <div class="mb-3">
                    <label class="form-label text-muted" style="font-size: 13px;">Sub Capaian Pembelajaran</label>
                    <textarea class="form-control" rows="5"></textarea>
                </div>
                <div class="mb-4">
                    <label class="form-label text-muted" style="font-size: 13px;">Jenis</label>
                    <input type="text" class="form-control">
                </div>
                
                <div class="d-flex gap-2">
                    <button type="button" class="btn btn-primary" style="font-size: 13.5px;">Simpan Draft</button>
                    <?php if ($isBelumDimulai): ?>
                        <button type="button" class="btn btn-primary" style="font-size: 13.5px;">Mulai Perkuliahan</button>
                    <?php elseif ($isBerlangsung): ?>
                        <button type="button" class="btn btn-danger" style="font-size: 13.5px;">Akhiri Perkuliahan</button>
                    <?php elseif ($isSelesai): ?>
                        <button type="button" class="btn btn-secondary" style="font-size: 13.5px;" disabled>Kelas Telah Selesai</button>
                    <?php endif; ?>
                </div>
            </form>
        </div>
    </div>

</div>


<?php endif; ?>

<?php require_once 'layouts/footer.php'; ?>
