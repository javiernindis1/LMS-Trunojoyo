<?php
require_once '../data.php';

$pageTitle = 'Kuis';
$kelasId = isset($_GET['kelas_id']) ? (int)$_GET['kelas_id'] : null;
$id = isset($_GET['id']) ? (int)$_GET['id'] : null;

$tugas = getTugasById($id);

if (!$tugas) {
    header('Location: stream.php' . ($kelasId ? '?kelas_id=' . $kelasId : ''));
    exit;
}

$backUrl    = 'asesmen.php' . ($kelasId ? '?kelas_id=' . $kelasId : '');
$totalSoal  = 5;     // dummy
$durasiMenit = 20;  // dummy
$totalPoin  = 100;  // dummy

require_once 'layouts/header-kuis.php';
?>

<!-- KUIS LAYOUT -->
<div style="display: flex; gap: 24px; align-items: flex-start;">

    <!-- ==================== KIRI ==================== -->
    <div style="flex: 1; display: flex; flex-direction: column; gap: 16px;">

        <!-- CARD SOAL -->
        <div class="detail-card" style="padding: 24px;">

            <!-- HEADER SOAL -->
            <div style="display: flex; align-items: flex-start; gap: 16px;">

                <!-- Nomor Soal -->
                <div style="
                    width: 40px; height: 40px;
                    border-radius: 8px;
                    background: #1a73e8;
                    color: white;
                    display: flex; align-items: center; justify-content: center;
                    font-size: 18px; font-weight: 700;
                    flex-shrink: 0;
                ">
                    1
                </div>

                <!-- Teks Pertanyaan -->
                <div style="flex: 1;">
                    <div style="font-size: 18px; font-weight: 700; color: #202124; line-height: 1.4;">
                        Pertanyaan 1
                    </div>
                    <div style="font-size: 13px; color: #5f6368; margin-top: 4px;">
                        Poinnya
                    </div>
                </div>

            </div>

            <!-- GARIS -->
            <hr class="lms-card-divider" style="margin: 16px 0;">

            <!-- OPSI JAWABAN -->
            <div style="display: flex; flex-direction: column; gap: 10px;">

                <label class="kuis-opsi-label">
                    <input type="radio" name="jawaban" class="kuis-opsi-radio">
                    <span>Opsi 1</span>
                </label>

                <label class="kuis-opsi-label">
                    <input type="radio" name="jawaban" class="kuis-opsi-radio">
                    <span>Opsi 1</span>
                </label>

                <label class="kuis-opsi-label">
                    <input type="radio" name="jawaban" class="kuis-opsi-radio">
                    <span>Opsi 1</span>
                </label>

            </div>

        </div>

        <!-- TOMBOL SELANJUTNYA -->
        <div style="display: flex; justify-content: center;">
            <button class="kuis-btn-selanjutnya">
                Selanjutnya
            </button>
        </div>

    </div>
    <!-- ==================== /KIRI ==================== -->

    <!-- ==================== KANAN ==================== -->
    <div style="width: 280px; display: flex; flex-direction: column; gap: 16px;">

        <!-- CARD JUMLAH SOAL -->
        <div class="detail-card" style="padding: 20px;">

            <!-- Judul -->
            <div style="font-size: 18px; font-weight: 700; color: #202124; margin-bottom: 14px;">
                Jumlah soal
            </div>

            <!-- Grid Nomor -->
            <div style="
                display: flex;
                flex-wrap: wrap;
                gap: 8px;
                margin-bottom: 16px;
            ">
                <!-- Soal aktif (biru border) -->
                <div class="kuis-soal-btn kuis-soal-btn--active">1</div>
                <div class="kuis-soal-btn">2</div>
                <div class="kuis-soal-btn">3</div>
                <div class="kuis-soal-btn">4</div>
                <div class="kuis-soal-btn">5</div>
            </div>

            <!-- Legend -->
            <div style="display: flex; flex-direction: column; gap: 6px; margin-bottom: 20px;">
                <div style="display: flex; align-items: center; gap: 8px;">
                    <div style="width:14px;height:14px;border-radius:3px;background:#1a73e8;flex-shrink:0;"></div>
                    <span style="font-size:13px;color:#202124;">Terjawab</span>
                </div>
                <div style="display: flex; align-items: center; gap: 8px;">
                    <div style="width:14px;height:14px;border-radius:3px;background:#e0e0e0;flex-shrink:0;"></div>
                    <span style="font-size:13px;color:#202124;">Belum Terjawab</span>
                </div>
            </div>

            <!-- Tombol Kumpulkan -->
            <a
                href="<?= isset($backUrl) ? $backUrl : 'asesmen.php' . ($kelasId ? '?kelas_id='.$kelasId : '') ?>"
                style="
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    width: 100%;
                    height: 44px;
                    background: #1a73e8;
                    color: white;
                    border-radius: 8px;
                    font-size: 16px;
                    font-weight: 600;
                    text-decoration: none;
                    transition: background .15s;
                "
                onmouseover="this.style.background='#1557b0'"
                onmouseout="this.style.background='#1a73e8'"
            >
                Kumpulkan
            </a>

        </div>

    </div>
    <!-- ==================== /KANAN ==================== -->

</div>

<?php
require_once 'layouts/footer-detail.php';
?>
