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
<!-- Unduh button di atas -->
<div class="nilai-topbar d-flex justify-content-end p-3 pb-0">
    <button class="btn btn-primary btn-tambah" id="btnUnduh">
        <i class="bi bi-download me-1"></i>Unduh
    </button>
</div>

<!-- Overlay Unduh -->
<div id="overlayUnduh" 
     style="position: fixed;
            inset: 0;
            background: rgba(32,33,36,0.6);
            display: none;
            justify-content: center;
            align-items: center;
            z-index: 9999;">

    <div style="width: 820px;
                background: #fff;
                border-radius: 14px;
                padding: 28px 36px;
                position: relative;">

        <!-- Close -->
        <button id="closeUnduhOverlay"
                style="position: absolute;
                       top: 18px;
                       right: 18px;
                       border: none;
                       background: none;
                       font-size: 28px;
                       color: #5f6368;
                       cursor: pointer;">
            <i class="bi bi-x"></i>
        </button>

        <!-- Title -->
        <div style="font-size: 24px;
                    font-weight: 700;
                    text-align: center;
                    margin-bottom: 24px;
                    color: #202124;">
            Unduh Nilai Mahasiswa
        </div>

        <!-- Box -->
        <div style="border: 1px solid #dadce0;
                    border-radius: 10px;
                    padding: 22px 24px;
                    margin-bottom: 24px;">

            <!-- Pilih semua -->
            <label style="display: flex;
                          align-items: center;
                          gap: 12px;
                          font-size: 16px;
                          color: #202124;
                          cursor: pointer;
                          margin-bottom: 14px;">

                <input type="checkbox"
                       id="checkAllNilai"
                       style="width: 20px; height: 20px;">

                Pilih Semua
            </label>

            <hr style="margin: 0 0 18px 0; border-color: #e0e0e0;">

            <!-- Tugas -->
            <div style="font-size: 15px;
                        color: #9aa0a6;
                        margin-bottom: 12px;">
                Tugas
            </div>

            <div style="display: flex;
                        flex-direction: column;
                        gap: 14px;
                        margin-bottom: 20px;">

                <label style="display:flex; align-items:center; gap:12px; cursor:pointer;">
                    <input type="checkbox" class="nilai-checkbox" style="width:20px; height:20px;">
                    <span>Tugas 1</span>
                </label>

                <label style="display:flex; align-items:center; gap:12px; cursor:pointer;">
                    <input type="checkbox" class="nilai-checkbox" style="width:20px; height:20px;">
                    <span>Tugas 2</span>
                </label>

                <label style="display:flex; align-items:center; gap:12px; cursor:pointer;">
                    <input type="checkbox" class="nilai-checkbox" style="width:20px; height:20px;">
                    <span>Tugas 3</span>
                </label>

                <label style="display:flex; align-items:center; gap:12px; cursor:pointer;">
                    <input type="checkbox" class="nilai-checkbox" style="width:20px; height:20px;">
                    <span>Tugas 4</span>
                </label>

            </div>

            <hr style="margin: 0 0 18px 0; border-color: #e0e0e0;">

            <!-- Ujian -->
            <div style="font-size: 15px;
                        color: #9aa0a6;
                        margin-bottom: 12px;">
                Ujian
            </div>

            <div style="display: flex;
                        flex-direction: column;
                        gap: 14px;">

                <label style="display:flex; align-items:center; gap:12px; cursor:pointer;">
                    <input type="checkbox" class="nilai-checkbox" style="width:20px; height:20px;">
                    <span>UAS</span>
                </label>

                <label style="display:flex; align-items:center; gap:12px; cursor:pointer;">
                    <input type="checkbox" class="nilai-checkbox" style="width:20px; height:20px;">
                    <span>UTS</span>
                </label>

            </div>

        </div>

        <!-- Button -->
        <div style="display:flex; justify-content:center;">
            <button style="width: 120px;
                           height: 48px;
                           border: none;
                           border-radius: 10px;
                           background: #1a73e8;
                           color: #fff;
                           font-size: 16px;
                           font-weight: 600;
                           cursor: pointer;">
                Unduh
            </button>
        </div>

    </div>
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



<script>

const btnUnduh = document.getElementById('btnUnduh');
const overlayUnduh = document.getElementById('overlayUnduh');
const closeUnduhOverlay = document.getElementById('closeUnduhOverlay');

btnUnduh.addEventListener('click', () => {
    overlayUnduh.style.display = 'flex';
});

closeUnduhOverlay.addEventListener('click', () => {
    overlayUnduh.style.display = 'none';
});

overlayUnduh.addEventListener('click', (e) => {

    if (e.target === overlayUnduh) {
        overlayUnduh.style.display = 'none';
    }

});

const checkAllNilai = document.getElementById('checkAllNilai');
const nilaiCheckboxes = document.querySelectorAll('.nilai-checkbox');

checkAllNilai.addEventListener('change', () => {

    nilaiCheckboxes.forEach(item => {
        item.checked = checkAllNilai.checked;
    });

});

</script>
<?php endif; ?>

<?php require_once 'layouts/footer.php'; ?>
