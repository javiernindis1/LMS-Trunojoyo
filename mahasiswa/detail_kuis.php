<?php
require_once '../data.php';

$pageTitle = 'Kuis';
$kelasId = isset($_GET['kelas_id']) ? (int)$_GET['kelas_id'] : null;
$id = isset($_GET['id']) ? (int)$_GET['id'] : null;

$tugas = getTugasById($id);

if (!$tugas) {
    // Handle not found
    header('Location: stream.php' . ($kelasId ? '?kelas_id=' . $kelasId : ''));
    exit;
}

$backUrl = 'asesmen.php' . ($kelasId ? '?kelas_id=' . $kelasId : '');

require_once 'layouts/header-detail.php';
?>
<!-- tugas Card -->
<div style="display: flex; gap: 24px; align-items: flex-start;">

    <!-- KIRI -->
    <!-- WRAPPER KIRI -->
<div style="
    flex: 1;
    display: flex;
    flex-direction: column;
    gap: 16px;
">

    <!-- CARD -->
    <div class="detail-card" style="
        padding: 24px;
        min-height: 80px;
    ">

        <!-- HEADER -->
        <div style="display: flex; align-items: flex-start; gap: 16px;">

            <!-- NOMOR -->
            <div style="
                width: 40px;
                height: 40px;
                border-radius: 8px;
                background: #1a73e8;
                color: white;
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 20px;
                font-weight: 700;
                flex-shrink: 0;
            ">
                1
            </div>

            <!-- PERTANYAAN -->
            <div style="flex: 1;">

                <div style="
                    font-size: 24px;
                    font-weight: 1000;
                    color: #202124;
                ">
                    Manakah dari berikut ini yang merupakan ibu kota negara Indonesia?
                </div>

                <!-- POIN -->
                <div style="
                    margin-top: 8px;
                    display: flex;
                    align-items: center;
                    gap: 10px;
                    color: #1a73e8;
                    font-size: 16px;
                    font-weight: 600;
                ">
                    <i class="bi bi-star"></i>
                    10 Poin
                </div>

            </div>

        </div>

        <!-- GARIS -->
        <hr class="lms-card-divider" style="margin: 16px 0;">

        <!-- OPSI -->
        <div style="
            display: flex;
            flex-direction: column;
            gap: 8px;
        ">

            <label style="
                border: 1px solid #dadce0;
                border-radius: 14px;
                padding: 8px 8px;
                display: flex;
                align-items: center;
                gap: 16px;
                cursor: pointer;
            ">
                <input type="radio" name="jawaban" style="width: 16px; height: 16px;">
                <div style="font-size: 16px;">Bandung</div>
            </label>

            <label style="
                border: 1px solid #dadce0;
                border-radius: 14px;
                padding: 8px 8px;
                display: flex;
                align-items: center;
                gap: 16px;
                cursor: pointer;
            ">
                <input type="radio" name="jawaban" style="width: 16px; height: 16px;">
                <div style="font-size: 16px;">Surabaya</div>
            </label>

            <label style="
                border: 1px solid #dadce0;
                border-radius: 14px;
                padding: 8px 8px;
                display: flex;
                align-items: center;
                gap: 16px;
                cursor: pointer;
            ">
                <input type="radio" name="jawaban" style="width: 16px; height: 16px;">
                <div style="font-size: 16px;">Jakarta</div>
            </label>

            <label style="
                border: 1px solid #dadce0;
                border-radius: 14px;
                padding: 8px 8px;
                display: flex;
                align-items: center;
                gap: 16px;
                cursor: pointer;
            ">
                <input type="radio" name="jawaban" style="width: 16px; height: 16px;">
                <div style="font-size: 16px;">Yogyakarta</div>
            </label>

        </div>

    </div>

    <!-- BUTTON -->
    <div style="
        display: flex;
        justify-content: flex-end;
    ">
        <button style="
            width: 180px;
            height: 48px;
            border: none;
            background: #1a73e8;
            color: white;
            border-radius: 12px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
        ">
            Selanjutnya
        </button>
    </div>

</div>

    <!-- KANAN -->
   <div style="
    width: 320px;
    display: flex;
    flex-direction: column;
    gap: 20px;
">

    <!-- TIMER CARD -->
    <div style="
            height: 64px;
            border-radius: 16px;
            background: #1a73e8;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 28px;
            font-weight: 700;
            letter-spacing: 2px;
        ">
            59:32
        </div>

    <!-- CARD JUMLAH SOAL -->
    <div class="detail-card" style="padding: 24px;">

        <!-- TITLE -->
        <div style="
            font-size: 24px;
            font-weight: 700;
            color: #202124;
            margin-bottom: 8px;
        ">
            Jumlah Soal
        </div>

        <!-- GRID -->
        <div style="
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            gap: 12px;
            margin-bottom: 16px;
        ">

            <div style="
                height: 40px;
                border-radius: 8px;
                border: 2px solid #1a73e8;
                color: #1a73e8;
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 24px;
                font-weight: 700;
            ">
                1
            </div>

            <div style="
                height: 40px;
                border: 1px solid #dadce0;
                border-radius: 8px;
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 24px;
                font-weight: 1000;
            ">
                2
            </div>

        </div>

        <!-- TERJAWAB -->
        <div style="
            display: flex;
            align-items: center;
            gap: 14px;
            margin-bottom: 8px;
        ">

            <div style="
                width:16px;
                height:16px;
                border-radius: 2px;
                background: #1a73e8;
            "></div>

            <div style="
                font-size: 16px;
                font-weight: 500;
            ">
                Terjawab
            </div>

        </div>

        <!-- BELUM -->
        <div style="
            display: flex;
            align-items: center;
            gap: 14px;
            margin-bottom: 32px;
        ">

            <div style="
                width: 16px;
                height: 16px;
                border-radius: 2px;
                background: #d9d9d9;
            "></div>

            <div style="
                font-size: 16px;
                font-weight: 500;
            ">
                Belum Terjawab
            </div>

        </div>

        <!-- BUTTON -->
       <a
    href="<?= isset($backUrl) ? $backUrl : 'stream.php' . ($kelasId ? '?kelas_id='.$kelasId : '') ?>"
    style="
        width: 100%;
        min-height: 56px;
        background: #1a73e8;
        color: white;
        border-radius: 16px;
        font-size: 20px;
        font-weight: 700;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        text-decoration: none;
        padding: 16px 24px;
        box-sizing: border-box;
    "
>
    Kumpulkan
</a>

    </div>

</div>

</div>



<?php
require_once 'layouts/footer-detail.php';
?>
