<?php
require_once '../data.php';

$pageTitle = 'Detail Kuis';
$kelasId = isset($_GET['kelas_id']) ? (int)$_GET['kelas_id'] : null;
$id = isset($_GET['id']) ? (int)$_GET['id'] : null;

$kuis = getKuisById($id);

if (!$kuis) {
    // Handle not found
    header('Location: stream.php' . ($kelasId ? '?kelas_id=' . $kelasId : ''));
    exit;
}

$backUrl = 'asesmen.php' . ($kelasId ? '?kelas_id=' . $kelasId : '');

require_once 'layouts/header-detail.php';
?>


<!-- tugas Card -->
<div class="detail-card">
    <div class="row">
        <div class="col-md-6">
            <div class="detail-label">Judul</div>
            <div class="detail-text fw-bold"><?= htmlspecialchars($kuis['judul']) ?></div>
        </div>

        <div class="col-md-6 mt-3">
            <div class="detail-label">Tenggat Waktu</div>
            <div class="detail-text"><?= htmlspecialchars($kuis['tenggat']) ?></div>
        </div>

        <div class="col-md-6">
            <div class="detail-label">Deskripsi</div>
            <div class="detail-text"><?= htmlspecialchars($kuis['deskripsi']) ?></div>
        </div>

        <div class="col-md-6 mt-3">
            <div class="detail-label">Poin</div>
            <div class="detail-text"><?= htmlspecialchars($kuis['total_poin']) ?></div>
        </div>
        <div class="col-md-6 mt-3">
            <div class="detail-label">Status</div>

            <label class="status-check-wrap">
                <input type="checkbox" class="status-checkbox">

                <span class="status-text">Aktif</span>
            </label>
        </div>
    </div>
</div>

<!-- Komentar Card -->
<div class="detail-card mt-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-semibold mb-0">Daftar Pengumpulan Tugas Mahasiswa</h4>

        <div class="detail-text">
            <i class="bi bi-people me-1"></i>
            25 Mahasiswa
        </div>
    </div>

    <!-- Toolbar -->
    <div class="d-flex justify-content-between align-items-center gap-3 mb-4">

        <div class="position-relative w-100" style="max-width:400px;">
            <i class="bi bi-search position-absolute top-50 start-0 translate-middle-y ms-3 text-secondary"></i>

            <input 
                type="text"
                class="form-control ps-5"
                placeholder="Cari nama mahasiswa..."
                id="mahasiswaSearch">
        </div>

        <button class="btn btn-outline-secondary" id="refreshTable">
            <i class="bi bi-arrow-clockwise me-1"></i>
            Segarkan
        </button>

    </div>

    <!-- Table -->
    <div class="table-responsive">
        <table class="table align-middle">

            <thead>
                <tr>
                    <th>Nomor Induk</th>
                    <th>Nama Mahasiswa</th>
                    <th>Status</th>
                    <th>Dikumpulkan Pada</th>
                    <th class="text-end">Nilai</th>
                </tr>
            </thead>

            <tbody id="mahasiswaTableBody">

                <!-- ROW -->
                <tr class="mahasiswa-row"
                    data-rowid="1"
                    data-nama="Muhammad Abid Ayyasy"
                    data-nim="230411100192">

                    <td class="detail-text">230411100192</td>

                    <td class="detail-text nama-mahasiswa">
                        Muhammad Abid Ayyasy
                    </td>

                    <td class="status-cell">
                        <span class="badge text-bg-primary">
                            Sudah Mengerjakan
                        </span>
                    </td>

                    <td class="detail-text">
                        12 Feb, 16.16
                    </td>

                    <td class="text-end fw-semibold text-primary nilai-cell">
                        .../100
                    </td>
                </tr>

                <!-- ROW -->
                <tr class="mahasiswa-row"
                    data-rowid="2"
                    data-nama="Fajar Ramadhan"
                    data-nim="230411100111">

                    <td class="detail-text nim-mahasiswa">
                        230411100111
                    </td>

                    <td class="detail-text nama-mahasiswa">
                        Fajar Ramadhan
                    </td>

                    <td class="status-cell">
                        <span class="badge text-bg-primary">
                            Sudah Mengerjakan
                        </span>
                    </td>

                    <td class="detail-text">
                        12 Feb, 16.16
                    </td>

                    <td class="text-end fw-semibold text-primary nilai-cell">
                        .../100
                    </td>

                </tr>

                <!-- ROW -->
                <tr class="mahasiswa-row"
                    data-rowid="3"
                    data-nama="Rizky Pratama"
                    data-nim="230411100222">

                    <td class="detail-text">230411100222</td>

                    <td class="detail-text nama-mahasiswa">
                        Rizky Pratama
                    </td>

                    <td>
                        <span class="badge text-bg-danger">
                            Belum Mengerjakan
                        </span>
                    </td>

                    <td class="detail-text">
                        -
                    </td>

                    <td class="text-end fw-semibold text-primary nilai-cell">
                        .../100
                    </td>
                </tr>

            </tbody>

        </table>
    </div>

</div>

<!-- OVERLAY -->
<div class="overlay-mahasiswa" id="overlayMahasiswa">

    <div class="overlay-content">

        <div class="d-flex justify-content-between align-items-start mb-4">

            <div>
                <div class="detail-label">Mahasiswa</div>
                <div class="detail-text fw-semibold fs-5" id="overlayNama">
                    Nama Mahasiswa
                </div>
            </div>

            <button class="overlay-close" id="closeOverlay">
                <i class="bi bi-x-lg"></i>
            </button>

        </div>
        <!-- INFO -->

        <div class="mb-4">
            <div class="detail-label">Nomor Induk</div>
            <div class="detail-text" id="overlayNim">
            </div>
        </div>

        <div class="mb-4">
            <div class="detail-label">Catatan Siswa</div>
            <div class="detail-text">
                none
            </div>
        </div>

        <!-- FILE -->
        <div class="file-preview-card mb-4">

            <div class="d-flex justify-content-between align-items-center mb-3">
                <div class="fw-semibold">1.pdf</div>

                <button class="btn btn-primary btn-sm">
                    Unduh
                </button>
            </div>

            <iframe 
                src="https://mozilla.github.io/pdf.js/web/compressed.tracemonkey-pldi-09.pdf"
                width="100%"
                height="500"
                style="border:none; border-radius:12px;">
            </iframe>

        </div>

        <!-- NILAI -->
        <div class="mb-4">
            <label class="detail-label mb-2">Nilai</label>

            <input 
                type="number"
                class="form-control"
                placeholder="Masukkan nilai"
                id="inputNilai">
        </div>

        <!-- FEEDBACK -->
        <div class="mb-4">
            <label class="detail-label mb-2">Umpan balik</label>

            <textarea 
                class="form-control"
                rows="3"
                placeholder="Berikan umpan balik kepada mahasiswa"
                id="inputFeedback"></textarea>
        </div>

        <!-- BUTTON -->
        <button class="btn btn-primary px-4" id="saveNilaiBtn">
            Simpan
        </button>

    </div>

</div>

<style>

.mahasiswa-row{
    cursor:pointer;
    transition:.2s;
}

.mahasiswa-row:hover{
    background:#f8f9fa;
}

/* OVERLAY */

.overlay-mahasiswa{
    position:fixed;
    inset:0;

    background:rgba(0,0,0,.45);

    display:none;
    align-items:center;
    justify-content:center;

    z-index:9999;

    padding:30px;
}

.overlay-mahasiswa.show{
    display:flex;
}

.overlay-content{
    width:100%;
    max-width:1100px;
    max-height:95vh;

    overflow-y:auto;

    background:#fff;
    border-radius:20px;

    padding:40px;

    position:relative;
}

.overlay-close{
    border:none;
    background:none;

    font-size:22px;
    line-height:1;

    color:#333;
}

/* FILE CARD */

.file-preview-card{
    border:1px solid #dcdcdc;
    border-radius:14px;

    padding:20px;

    background:#fafafa;
}

.pdf-preview{
    width:100%;
    height:500px;

    overflow:hidden;

    border-radius:10px;
    border:1px solid #ddd;

    background:#fff;
}


</style>

<script>

const mahasiswaSearch = document.getElementById('mahasiswaSearch');
const mahasiswaRows = document.querySelectorAll('.mahasiswa-row');

const overlayMahasiswa = document.getElementById('overlayMahasiswa');
const overlayNama = document.getElementById('overlayNama');
const overlayNim = document.getElementById('overlayNim');

const closeOverlay = document.getElementById('closeOverlay');

const inputNilai = document.getElementById('inputNilai');
const saveNilaiBtn = document.getElementById('saveNilaiBtn');


/* SEARCH */

mahasiswaSearch.addEventListener('keyup', function () {

    const keyword = this.value.toLowerCase();

    mahasiswaRows.forEach(row => {

        const nama = row.querySelector('.nama-mahasiswa')
                        .innerText
                        .toLowerCase();

        if (nama.includes(keyword)) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }

    });

});

/* REFRESH */

document.getElementById('refreshTable')
.addEventListener('click', () => {

    mahasiswaSearch.value = '';

    mahasiswaRows.forEach(row => {
        row.style.display = '';
    });

});

/* OVERLAY */
mahasiswaRows.forEach(row => {

    row.addEventListener('click', () => {

        const nama = row.dataset.nama;
        const nim = row.dataset.nim;

        overlayNama.innerText = nama;
        overlayNim.innerText = nim;

        overlayMahasiswa.classList.add('show');

        saveNilaiBtn.setAttribute(
            'data-target-row',
            row.dataset.rowid
        );

    });

});

/* CLOSE */

closeOverlay.addEventListener('click', () => {

    overlayMahasiswa.classList.remove('show');

});

overlayMahasiswa.addEventListener('click', (e) => {

    if (e.target === overlayMahasiswa) {
        overlayMahasiswa.classList.remove('show');
    }

});

/* SAVE NILAI */

saveNilaiBtn.addEventListener('click', () => {

    const nilai = inputNilai.value;

    if (nilai === '') {
        alert('Masukkan nilai dulu');
        return;
    }

    const targetRowId = saveNilaiBtn.getAttribute('data-target-row');

    const targetRow = document.querySelector(
        `.mahasiswa-row[data-rowid="${targetRowId}"]`
    );

    /* UPDATE NILAI */

    targetRow.querySelector('.nilai-cell').innerText =
        nilai + '/100';

    /* UPDATE STATUS */

    targetRow.querySelector('.status-cell').innerHTML = `
        <span class="badge text-bg-success">
            Dinilai
        </span>
    `;

    overlayMahasiswa.classList.remove('show');

});


</script>

<?php
require_once 'layouts/footer-detail.php';
?>
