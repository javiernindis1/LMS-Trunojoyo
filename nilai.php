<?php
require_once 'data.php';

$pageTitle = 'Nilai';
$activeNav = 'nilai';
$kelasId = isset($_GET['kelas_id']) ? (int)$_GET['kelas_id'] : null;

$activeKelas = $kelasId ? getKelasById($kelasId) : null;
$nilaiList = $kelasId ? getNilaiByKelas($kelasId) : [];
$totalMahasiswa = $kelasId ? getTotalMahasiswa($kelasId) : 0;

require_once 'layouts/header.php';
?>

<?php if (!$kelasId): ?>
<div class="kelas-belum-dipilih">
    <div class="kelas-belum-icon"><i class="bi bi-file-earmark-x-fill"></i></div>
    <h4 class="kelas-belum-text">Kelas Belum Dipilih</h4>
</div>
<?php else: ?>

<!-- Unduh button di atas -->
<div class="nilai-topbar d-flex justify-content-end p-3 pb-0">
    <button class="btn btn-primary btn-tambah" id="btnUnduh">
        <i class="bi bi-download me-1"></i>Unduh
    </button>
</div>

<!-- Tabel Nilai -->
<div class="nilai-card">
    <h6 class="nilai-card-title">Daftar Nilai Mahasiswa</h6>
    <div class="nilai-count">
        <i class="bi bi-people-fill me-1"></i><?= $totalMahasiswa ?> Mahasiswa
    </div>
    <hr class="lms-card-divider my-3">

    <!-- Search -->
    <div class="nilai-search-wrap mb-3">
        <div class="input-group">
            <span class="input-group-text bg-white border-end-0">
                <i class="bi bi-search text-muted"></i>
            </span>
            <input type="text" class="form-control border-start-0" placeholder="Cari" id="nilaiSearch">
        </div>
    </div>

    <!-- Table -->
    <div class="table-responsive">
        <table class="table table-bordered nilai-table" id="nilaiTable">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th class="text-center">Tugas 1</th>
                    <th class="text-center">Tugas 2</th>
                    <th class="text-center">UTS</th>
                    <th class="text-center">Tugas 3</th>
                    <th class="text-center">Tugas 4</th>
                    <th class="text-center">UAS</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($nilaiList as $n): ?>
                <tr>
                    <td><?= htmlspecialchars($n['nama']) ?></td>
                    <td class="text-center"><?= $n['tugas1'] ?></td>
                    <td class="text-center"><?= $n['tugas2'] ?></td>
                    <td class="text-center"><?= $n['uts'] ?></td>
                    <td class="text-center"><?= $n['tugas3'] ?></td>
                    <td class="text-center"><?= $n['tugas4'] ?></td>
                    <td class="text-center"><?= $n['uas'] ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<?php endif; ?>

<?php require_once 'layouts/footer.php'; ?>
