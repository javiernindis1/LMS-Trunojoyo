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
<div style="display: flex; gap: 24px; align-items: stretch;">

    <!-- KIRI -->
    <div class="detail-card" style="flex: 1; display: flex; flex-direction: column;">
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

        <!-- CARD 1: Ditugaskan -->
        <div class="detail-card" style="padding: 16px; text-align: center;">
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

        <!-- CARD 3: Komentar Pribadi -->
        <div class="detail-card" style="padding: 20px;">

            <div style="font-size: 16px; font-weight: 600; color: #202124; margin-bottom: 12px;">
                Komentar Pribadi
            </div>

            <!-- Editor Box -->
            <div style="
                border: 1px solid #dadce0;
                border-radius: 8px;
                overflow: hidden;
                background: #fff;
            ">
                <!-- Text Input -->
                <input
                    type="text"
                    placeholder="Tambahkan komentar"
                    style="
                        width: 100%;
                        padding: 12px;
                        font-size: 14px;
                        color: #202124;
                        border: none;
                        outline: none;
                        background: transparent;
                        box-sizing: border-box;
                    "
                >

                <!-- Toolbar -->
                <div style="
                    display: flex;
                    align-items: center;
                    justify-content: space-between;
                    padding: 6px 10px;
                    background: #fff;
                ">
                    <!-- Format buttons -->
                    <div style="display: flex; gap: 4px;">
                        <button onclick="document.execCommand('bold')" title="Bold" style="
                            width: 30px; height: 30px;
                            border: none; background: transparent;
                            border-radius: 4px; cursor: pointer;
                            font-size: 14px; font-weight: 700;
                            color: #444;
                            display: flex; align-items: center; justify-content: center;
                        " onmouseover="this.style.background='#f1f3f4'" onmouseout="this.style.background='transparent'">
                            B
                        </button>
                        <button onclick="document.execCommand('italic')" title="Italic" style="
                            width: 30px; height: 30px;
                            border: none; background: transparent;
                            border-radius: 4px; cursor: pointer;
                            font-size: 14px; font-style: italic;
                            color: #444;
                            display: flex; align-items: center; justify-content: center;
                        " onmouseover="this.style.background='#f1f3f4'" onmouseout="this.style.background='transparent'">
                            I
                        </button>
                        <button onclick="document.execCommand('underline')" title="Underline" style="
                            width: 30px; height: 30px;
                            border: none; background: transparent;
                            border-radius: 4px; cursor: pointer;
                            font-size: 14px; 
                            color: #444;
                            display: flex; align-items: center; justify-content: center;
                        " onmouseover="this.style.background='#f1f3f4'" onmouseout="this.style.background='transparent'">
                            U
                        </button>
                        <button onclick="document.execCommand('insertUnorderedList')" title="List" style="
                            width: 30px; height: 30px;
                            border: none; background: transparent;
                            border-radius: 4px; cursor: pointer;
                            font-size: 16px;
                            color: #444;
                            display: flex; align-items: center; justify-content: center;
                        " onmouseover="this.style.background='#f1f3f4'" onmouseout="this.style.background='transparent'">
                            &#8801;
                        </button>
                    </div>

                    <!-- Send button -->
                    <button title="Kirim" style="
                        width: 32px; height: 32px;
                        border: none;
                        background: transparent;
                        border-radius: 50%;
                        cursor: pointer;
                        color: #444444;
                        font-size: 16px;
                        display: flex; align-items: center; justify-content: center;
                    " onmouseover="this.style.background='#e8f0fe'" onmouseout="this.style.background='transparent'">
                        <i class="bi bi-send-fill"></i>
                    </button>
                </div>
            </div>

        </div>

    </div>

</div>

<?php
require_once 'layouts/footer-detail.php';
?>
