<?php
require_once '../data.php';

$pageTitle = 'Buat Kuis';
$kelasId = isset($_GET['kelas_id']) ? (int)$_GET['kelas_id'] : null;
$step = isset($_GET['step']) ? (int)$_GET['step'] : 1;

$backUrl = 'asesmen.php' . ($kelasId ? '?kelas_id=' . $kelasId : '');

$headerRightContent = '
<a href="#" style="color: #1a73e8; text-decoration: none; font-size: 14px; font-weight: 500;">Simpan draf</a>
<button style="background-color: #1a73e8; color: white; border: none; padding: 8px 24px; border-radius: 6px; font-weight: 500; font-size: 14px;">Upload</button>
';

require_once 'layouts/header-tambah.php';
?>
<?php if ($step === 1): ?>
<div style="width: 100%; display: flex; justify-content: center; align-items: center; gap: 32px; padding-right: 24px;">
    <div style="display: flex; align-items: center; gap: 10px; font-size: 24px; font-weight: 1000; color: #1a73e8; margin-bottom: 8px;">
        <i class="bi bi-ui-checks-grid"></i>
        <span>Pengaturan Kuis</span>
    </div>

    <div style="display: flex; align-items: center; gap: 10px; font-size: 24px; font-weight: 500; color: #1a73e8b9; margin-bottom: 8px;">
        <i class="bi bi-question-circle"></i>
        <span>Daftar Soal</span>
    </div>
</div>

<div class="detail-card" style="padding: 24px;">
    <div style="font-size: 13px; font-weight: 500; color: #3c4043; margin-bottom: 8px;">Judul</div>
    <input type="text" placeholder="Tulis judul anda disini..." style="width: 100%; border: 1px solid #dadce0; border-radius: 8px; padding: 12px 16px; outline: none; font-size: 14px; color: #202124; background: #ffffffff;">
    <br>
    <br>
    <div style="font-size: 14px; font-weight: 500; color: #3c4043; margin-bottom: 8px;">Intruksi (opsional)</div>
    <div style="border: 1px solid #dadce0; border-radius: 8px; padding: 16px; margin-bottom: 24px; display: flex; flex-direction: column; min-height: 240px; background: #fff;">
        <textarea placeholder="Tulis deskripsi anda disini ..." style="border: none; width: 100%; outline: none; font-size: 14px; color: #202124; flex: 1; resize: none; margin-bottom: 16px;"></textarea>
        <div style="display: flex; gap: 16px; color: #5f6368; font-size: 18px; border-top: 1px solid #f1f3f4; padding-top: 12px;">
            <i class="bi bi-type-bold" style="cursor: pointer;"></i>
            <i class="bi bi-type-italic" style="cursor: pointer;"></i>
            <i class="bi bi-type-underline" style="cursor: pointer;"></i>
            <i class="bi bi-list-ul" style="cursor: pointer;"></i>
        </div>
    </div>

    <div style="font-size: 13px; font-weight: 500; color: #3c4043; margin-bottom: 8px;">Poin</div>
    <input type="text" style="width: 100%; border: 1px solid #dadce0; border-radius: 8px; padding: 12px 16px; outline: none; font-size: 14px; color: #202124; background: #f8f9fa;">
</div>

<div class="detail-card" style="padding: 24px;">
    <div style="display: flex; gap: 16px;">
         <div style="width: 33%;">
            <div style="font-size: 13px; font-weight: 500; color: #3c4043; margin-bottom: 8px;">
                Tanggal Mulai
            </div>
            <input type="date"style="width: 100%; border: 1px solid #dadce0; border-radius: 8px; padding: 12px 16px; outline: none; font-size: 14px; color: #202124; background: #f8f9fa;">
        </div>
        <div style="width: 33%;">
            <div style="font-size: 13px; font-weight: 500; color: #3c4043; margin-bottom: 8px;">
                Tenggat Waktu
            </div>
            <input type="date" style="width: 100%; border: 1px solid #dadce0; border-radius: 8px; padding: 12px 16px; outline: none; font-size: 14px; color: #202124; background: #f8f9fa;">
        </div>
        <div style="width: 33%;">
            <div style="font-size: 13px; font-weight: 500; color: #3c4043; margin-bottom: 8px;">Durasi</div>
            <input type="time" style="width: 100%; border: 1px solid #dadce0; border-radius: 8px; padding: 12px 16px; outline: none; font-size: 14px; color: #202124; background: #f8f9fa;">
        </div>
    </div>
</div>

<div class="detail-card" style="padding: 24px; margin-bottom: 32px;">
    <div style="font-size: 18px; font-weight: 1000; color: #3c4043; margin-bottom: 8px;">Pengaturan Kuis</div>
    <div style="display: flex; gap: 16px; margin-bottom: 16px;">
        <div style="width: 50%; position: relative;">
            <i class="bi bi-ui-checks-grid" style="position: absolute; left: 14px; top: 50%; transform: translateY(-50%); color: #5f6368; font-size: 14px; pointer-events: none;"></i>
            <i class="bi bi-chevron-down" style="position: absolute; right: 14px; top: 50%; transform: translateY(-50%); color: #5f6368; font-size: 13px; pointer-events: none;"></i>
            <select style="width: 100%; border: 1px solid #dadce0; border-radius: 8px; padding: 12px 40px 12px 42px; outline: none; font-size: 14px; color: #202124; background: #f8f9fa; appearance: none; cursor: pointer;">
                <option value="essay">Essay</option>
                <option value="pilihan_ganda">Pilihan Ganda</option>
            </select>
        </div>
        <div style="width: 50%;">
            <input type="text" placeholder="Jumlah soal" style="width: 100%; border: 1px solid #dadce0; border-radius: 8px; padding: 12px 16px; outline: none; font-size: 14px; color: #202124; background: #f8f9fa;">
        </div>
    </div>
    <div style="display: flex; gap: 16px; margin-bottom: 16px;">
        <div style="width: 25%;">
            <label class="status-check-wrap">
                <input type="checkbox" class="status-checkbox" style="width: 20px; height: 20px;">
                <div style="font-size: 13px; font-weight: 500; color: #3c4043; ">Acak Pertanyaan</div>
                <div style="font-size: 13px; font-weight: 500; color: rgb(159, 166, 172); margin-bottom: 8px;">Pertanyaan akan muncul secara acak</div>
            </label>
        </div>
         <div style="width: 25%;">
            <label class="status-check-wrap">
                <input type="checkbox" class="status-checkbox" style="width: 20px; height: 20px;">
                <div style="font-size: 13px; font-weight: 500; color: #3c4043; ">Acak Opsi Jawaban</div>
                <div style="font-size: 13px; font-weight: 500; color: rgb(159, 166, 172); margin-bottom: 8px;">Opsi jawaban akan muncul secara acak</div>
            </label>
        </div>
         <div style="width: 25%;">
            <label class="status-check-wrap">
                <input type="checkbox" class="status-checkbox" style="width: 20px; height: 20px;">
                <div style="font-size: 13px; font-weight: 500; color: #3c4043; ">Tampilkan Jawaban Benar</div>
                <div style="font-size: 13px; font-weight: 500; color: rgb(159, 166, 172); margin-bottom: 8px;">Peserta bisa melihat jawaban yang benar</div>
            </label>
        </div>
         <div style="width: 25%;">
            <label class="status-check-wrap">
                <input type="checkbox" class="status-checkbox" style="width: 20px; height: 20px;">
                 <div style="font-size: 13px; font-weight: 500; color: #3c4043; ">Tampilkan Nilai</div>
                <div style="font-size: 13px; font-weight: 500; color: rgb(159, 166, 172); margin-bottom: 8px;">Peserta bisa melihat nilai yang di dapat</div>
            </label>
        </div>
    </div>
  
</div>

<div style="width: 100%; display: flex; justify-content: flex-end; padding-right: 24px; margin-bottom: 80px;">
  <a href="?step=2<?= $kelasId ? '&kelas_id=' . $kelasId : '' ?>"
       style="width: 200px; height: 44px; color: #ffffff; border:none; background-color:#1a73e8; border-radius: 8px; font-weight: 500; font-size: 14px; display: flex; align-items: center; justify-content: center; text-decoration: none; transition: all 0.2s ease;"
       
       onmouseover="this.style.backgroundColor='#ffffff'; this.style.color='#1a73e8'; this.style.border='1px solid #1a73e8';"
       onmouseout="this.style.backgroundColor='#1a73e8'; this.style.color='#fff';">
       
        Setelahnya
    </a>
</div>
<?php endif; ?>

<?php if ($step === 2): ?>
<div style="width: 100%; display: flex; justify-content: center; align-items: center; gap: 32px; padding-right: 24px;">
    <div style="display: flex; align-items: center; gap: 10px; font-size: 24px; font-weight: 500; color: #1a73e8; margin-bottom: 8px;">
        <i class="bi bi-ui-checks-grid"></i>
        <span>Pengaturan Kuis</span>
    </div>

    <div style="display: flex; align-items: center; gap: 10px; font-size: 24px; font-weight: 1000; color: #1a73e8; margin-bottom: 8px;">
        <i class="bi bi-question-circle"></i>
        <span>Daftar Soal</span>
    </div>
</div>

<div class="detail-card" style="padding:24px; margin-bottom:32px;">

    <!-- Judul -->
    <div style="font-size: 18px; font-weight: 700; margin-bottom: 16px;">
        Pertanyaan 1
    </div>

    <!-- Input pertanyaan -->
    <div style="display:flex; align-items:center; gap:16px; margin-bottom:20px;">

        <input 
            type="text"
            placeholder="Tulis pertanyaan..."
            style="
                flex:1;
                border:1px solid #dadce0;
                border-radius:8px;
                padding:12px 16px;
                outline:none;
                font-size:14px;
                background:#fff;
            ">

        <button style="
            width:40px;
            height:40px;
            border:none;
            background:none;
            color:#5f6368;
            font-size:28px;
            display:flex;
            align-items:center;
            justify-content:center;
            cursor:pointer;
        ">
            <i class="bi bi-image"></i>
        </button>

    </div>

    <!-- LIST OPSI -->
    <div id="opsiContainer">

        <!-- OPSI DEFAULT -->
        <div class="opsi-item" style="display:flex; align-items:center; gap:10px; margin-bottom:18px;">

            <div style="
                width:34px;
                height:34px;
                border:1.5px solid #5f6368;
                border-radius:50%;
                flex-shrink:0;
            "></div>

            <input 
                type="text"
                placeholder="Opsi 1"
                style="
                    flex:1;
                    border:1px solid #dadce0;
                    border-radius:8px;
                    padding:12px 16px;
                    outline:none;
                    font-size:14px;
                    background:#fff;
                ">

            <input 
                type="checkbox"
                style="
                    width:22px;
                    height:22px;
                    cursor:pointer;
                ">

            <button style="
                border:none;
                background:none;
                color:#5f6368;
                font-size:20px;
                cursor:pointer;
            ">
                <i class="bi bi-image"></i>
            </button>

            <button class="hapus-opsi" style="
                border:none;
                background:none;
                color:#5f6368;
                font-size:26px;
                cursor:pointer;
            ">
                <i class="bi bi-x"></i>
            </button>

        </div>

    </div>

    <!-- Tambah opsi -->
    <div style="display:flex; align-items:center; gap:10px;">

        <div style="
            width:34px;
            height:34px;
            border:1.5px solid #5f6368;
            border-radius:50%;
            flex-shrink:0;
        "></div>

        <button 
            id="tambahOpsiBtn"
            style="
                border:none;
                background:none;
                color:#80868b;
                font-size:16px;
                padding:0;
                cursor:pointer;
            ">
            Tambahkan Opsi
        </button>

    </div>

</div>

<div style="display: flex; justify-content: flex-start; margin-bottom: 80px; padding-left: 24px;">

    <a href="?step=1<?= $kelasId ? '&kelas_id=' . $kelasId : '' ?>"
       style="width: 200px; height: 44px; color: #3c4043; border:1px solid #3c4043; border-radius: 8px; font-weight: 500; font-size: 14px; display: flex; align-items: center; justify-content: center; text-decoration: none; transition: all 0.2s ease;"
       
       onmouseover="this.style.backgroundColor='#3c4043'; this.style.color='#fff';"
       onmouseout="this.style.backgroundColor='transparent'; this.style.color='#3c4043';">
       
        Sebelumnya
    </a>

</div>
<?php endif; ?>


<script>

const opsiContainer = document.getElementById('opsiContainer');
const tambahOpsiBtn = document.getElementById('tambahOpsiBtn');

let opsiCount = 1;

// TAMBAH OPSI
tambahOpsiBtn.addEventListener('click', () => {

    opsiCount++;

    const opsiHTML = `
    
    <div class="opsi-item" style="display:flex; align-items:center; gap:10px; margin-bottom:18px;">

        <div style="
            width:34px;
            height:34px;
            border:1.5px solid #5f6368;
            border-radius:50%;
            flex-shrink:0;
        "></div>

        <input 
            type="text"
            placeholder="Opsi ${opsiCount}"
            style="
                flex:1;
                border:1px solid #dadce0;
                border-radius:8px;
                padding:12px 16px;
                outline:none;
                font-size:14px;
                background:#fff;
            ">

        <input 
            type="checkbox"
            style="
                width:22px;
                height:22px;
                cursor:pointer;
            ">

        <button style="
            border:none;
            background:none;
            color:#5f6368;
            font-size:20px;
            cursor:pointer;
        ">
            <i class="bi bi-image"></i>
        </button>

        <button class="hapus-opsi" style="
            border:none;
            background:none;
            color:#5f6368;
            font-size:26px;
            cursor:pointer;
        ">
            <i class="bi bi-x"></i>
        </button>

    </div>
    
    `;

    opsiContainer.insertAdjacentHTML('beforeend', opsiHTML);

});

// HAPUS OPSI
document.addEventListener('click', function(e) {

    const tombolHapus = e.target.closest('.hapus-opsi');

    if (tombolHapus) {

        const opsiItem = tombolHapus.closest('.opsi-item');

        opsiItem.remove();

    }

});

</script>
<?php
require_once 'layouts/footer-detail.php';
?>
