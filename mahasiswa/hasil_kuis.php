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
<div style="
    width: 100%;
    max-width: 1200px;
    margin: 0 auto;
    padding: 24px;
">
    <!-- BACK -->
    <a     onclick="window.location='asesmen.php<?= $kelasId ? '?kelas_id='.$kelasId : '' ?>'"
 style="
        display: inline-block;
        margin-bottom: 16px;
        padding: 6px 12px;
        background: #1a73e8;
        color: white;
        border-radius: 6px;
        font-size: 14px;
        text-decoration: none;
        cursor: pointer;
    ">
        ← Kembali
    </a>

    <!-- CARD -->
    <div style="
        background: #fff;
        border-radius: 12px;
        border: 1px solid #dadce0;
        overflow: hidden;
    ">

        <!-- HEADER -->
        <div style="padding: 20px; border-bottom: 1px solid #dadce0;">
            <div style="display: flex; justify-content: space-between; align-items: flex-start;">

                <div>
                    <div style="font-size: 20px; font-weight: 700;">
                        Kuis 1
                    </div>
                    <div style="font-size: 14px; color: #5f6368;">
                        Total Pertanyaan: 3 <br>
                        Benar: 1 &nbsp; Salah: 2
                    </div>
                </div>

                <div style="text-align: right;">
                    <div style="font-size: 12px; color: #5f6368;">Nilai</div>
                    <div style="font-size: 22px; font-weight: 700;">70</div>
                </div>

            </div>
        </div>

        <!-- PERTANYAAN -->
        <?php for ($i = 1; $i <= 2; $i++): ?>
        <div style="padding: 20px; border-bottom: 1px solid #dadce0;">

            <div style="font-weight: 600; margin-bottom: 12px;">
                Pertanyaan <?= $i ?>
            </div>

            <!-- OPSI -->
            <?php for ($j = 1; $j <= 3; $j++): 
                $checked = ($j == 2); // contoh: opsi ke-2 dipilih
            ?>
            <div style="
                border: 1px solid #dadce0;
                border-radius: 8px;
                padding: 10px 12px;
                margin-bottom: 10px;
                display: flex;
                align-items: center;
                gap: 10px;
            ">

                <!-- RADIO -->
                <div style="
                    width: 16px;
                    height: 16px;
                    border-radius: 50%;
                    border: 2px solid <?= $checked ? '#34a853' : '#9aa0a6' ?>;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                ">
                    <?php if ($checked): ?>
                        <div style="
                            width: 8px;
                            height: 8px;
                            background: #34a853;
                            border-radius: 50%;
                        "></div>
                    <?php endif; ?>
                </div>

                <!-- TEXT -->
                <div style="
                    font-size: 14px;
                    color: <?= $checked ? '#34a853' : '#5f6368' ?>;
                ">
                    Opsi <?= $j ?>
                </div>

            </div>
            <?php endfor; ?>

        </div>
        <?php endfor; ?>

    </div>

</div>



<?php require_once 'layouts/footer.php'; ?>
