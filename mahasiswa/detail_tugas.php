<?php
require_once '../data.php';

$pageTitle = 'Pengumpulan';
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
    <div class="detail-card" style="flex: 1;">
        <div>

            <!-- Judul + nama dosen -->
            <div>
                <div class="detail-text fw-bold" style="font-size: 20px;">
                    <?= htmlspecialchars($tugas['judul']) ?>
                </div>

                <div class="detail-label" style="margin-top: -16px;">
                    Nama dosen
                </div>
            </div>

            <!-- Poin + tenggat -->
            <div style="display: flex; gap: 24px; margin-top: 16px;">
                <div class="detail-text">
                    <?= htmlspecialchars($tugas['poin']) ?> Poin
                </div>

                <div class="detail-text">
                    Tenggat Waktu: <?= htmlspecialchars($tugas['tenggat']) ?>
                </div>
            </div>

            <!-- Garis -->
            <div style="margin-top: -16px;">
                <hr class="lms-card-divider">
            </div>

            <!-- Deskripsi -->
            <div style="margin-top: 16px;">
                <div class="detail-text">
                    <?= htmlspecialchars($tugas['deskripsi']) ?>
                </div>
            </div>

        </div>
    </div>

    <!-- KANAN -->
    <div style="width: 320px; display: flex; flex-direction: column; gap: 16px;">

        <!-- CARD 1 -->
        <div class="detail-card" style="padding: 16px;">
            <div style="font-size: 20px; font-weight: 1000; color: #202124;">
                Ditugaskan
            </div>
        </div>

        <!-- CARD 2 -->
        <div class="detail-card" style="padding: 20px;">

            <div style="font-size: 16px; font-weight: 600; color: #202124; margin-bottom: 16px;">
                Tugas
            </div>

            <div style="display: flex; flex-direction: column; gap: 12px;">

                <!-- Upload -->
                <button style="
                    width: 100%;
                    height: 44px;
                    border: 1px solid #202124;
                    background: transparent;
                    color: #202124;
                    border-radius: 8px;
                    font-size: 14px;
                    font-weight: 500;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    gap: 8px;
                    cursor: pointer;
                ">
                    <i class="bi bi-plus-lg"></i>
                    Upload
                </button>

                <!-- Tandai selesai -->
                <button style="
                    width: 100%;
                    height: 44px;
                    border: none;
                    background: #1a73e8;
                    color: white;
                    border-radius: 8px;
                    font-size: 14px;
                    font-weight: 500;
                    cursor: pointer;
                ">
                    Tandai selesai
                </button>

            </div>

        </div>

        <!-- CARD 3 -->
        <div class="detail-card" style="padding: 20px;">

            <div style="font-size: 16px; font-weight: 600; color: #202124; margin-bottom: 12px;">
                Komentar pribadi
            </div>

            <textarea 
                placeholder="Tambahkan komentar..."
                style="
                    width: 100%;
                    min-height: 120px;
                    border: 1px solid #dadce0;
                    border-radius: 8px;
                    padding: 12px;
                    outline: none;
                    resize: none;
                    font-size: 14px;
                    color: #202124;
                    background: #fff;
                "></textarea>

        </div>

    </div>

</div>

<?php
require_once 'layouts/footer-detail.php';
?>
