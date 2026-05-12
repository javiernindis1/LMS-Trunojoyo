<?php
require_once '../data.php';

$pageTitle = 'Buat Materi';
$kelasId = isset($_GET['kelas_id']) ? (int)$_GET['kelas_id'] : null;

$backUrl = 'stream.php' . ($kelasId ? '?kelas_id=' . $kelasId : '');

$headerRightContent = '
<a href="#" style="color: #1a73e8; text-decoration: none; font-size: 14px; font-weight: 500;">Simpan draf</a>
<button style="background-color: #1a73e8; color: white; border: none; padding: 8px 24px; border-radius: 6px; font-weight: 500; font-size: 14px;">Upload</button>
';

require_once 'layouts/header-tambah.php';
?>

<div class="detail-card" style="padding: 24px; margin-bottom: 80px;">
    <div style="font-size: 13px; font-weight: 500; color: #3c4043; margin-bottom: 8px;">Judul</div>
    <input type="text" placeholder="Tulis judul anda disini..." style="width: 100%; border: 1px solid #dadce0; border-radius: 8px; padding: 12px 16px; outline: none; font-size: 14px; color: #202124; background: #ffffffff;">
    <br>
    <br>
    <div style="font-size: 14px; font-weight: 500; color: #3c4043; margin-bottom: 8px;">Deskripsi</div>
    <div style="border: 1px solid #dadce0; border-radius: 8px; padding: 16px; margin-bottom: 24px; display: flex; flex-direction: column; min-height: 240px; background: #fff;">
        <textarea placeholder="Tulis deskripsi anda disini ..." style="border: none; width: 100%; outline: none; font-size: 14px; color: #202124; flex: 1; resize: none; margin-bottom: 16px;"></textarea>
        <div style="display: flex; gap: 16px; color: #5f6368; font-size: 18px; border-top: 1px solid #f1f3f4; padding-top: 12px;">
            <i class="bi bi-type-bold" style="cursor: pointer;"></i>
            <i class="bi bi-type-italic" style="cursor: pointer;"></i>
            <i class="bi bi-type-underline" style="cursor: pointer;"></i>
            <i class="bi bi-list-ul" style="cursor: pointer;"></i>
        </div>
    </div>

    <div style="font-size: 13px; font-weight: 500; color: #3c4043; margin-bottom: 8px;">Komentar (opsional)</div>
    <input type="text" placeholder="Tambahkan komentar" style="width: 100%; border: 1px solid #dadce0; border-radius: 8px; padding: 12px 16px; outline: none; font-size: 14px; color: #202124; background: #f8f9fa;">
</div>

<?php
require_once 'layouts/footer-detail.php';
?>
