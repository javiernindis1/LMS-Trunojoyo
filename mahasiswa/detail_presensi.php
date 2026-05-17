<?php
require_once '../data.php';

$pageTitle = 'Detail Kehadiran';
$activeNav = 'presensi';
$kelasId      = isset($_GET['kelas_id'])    ? (int)$_GET['kelas_id']    : null;
$pertemuanId  = isset($_GET['pertemuan_id']) ? (int)$_GET['pertemuan_id'] : null;

$activeKelas = $kelasId     ? getKelasById($kelasId)       : null;
$pertemuan   = $pertemuanId ? getPertemuanById($pertemuanId) : null;

if (!$kelasId || !$pertemuan) {
    header('Location: presensi.php' . ($kelasId ? '?kelas_id=' . $kelasId : ''));
    exit;
}

// NIM mahasiswa yang login (dummy — nanti ambil dari session)
$nimLogin = 'M001';
$konfirmasi = getKonfirmasiMahasiswa($pertemuanId, $nimLogin);

$status         = $pertemuan['status'];
$isBerlangsung  = $status === 'berlangsung';
$isSelesai      = $status === 'selesai';
$isBelumDimulai = !$isBerlangsung && !$isSelesai;

// Semua pertemuan untuk grid navigasi
$semuaPertemuan = getPertemuanByKelas($kelasId);

// Nomor pertemuan saat ini (urutan)
$nomorSaatIni = 0;
foreach ($semuaPertemuan as $idx => $sp) {
    if ((int)$sp['id'] === $pertemuanId) {
        $nomorSaatIni = $idx + 1;
        break;
    }
}

require_once 'layouts/header.php';
?>

<!-- DETAIL KEHADIRAN -->
<div class="presensi-wrapper">

    <h5 class="presensi-title" style="font-size: 18px; font-weight: 700; margin-bottom: 0;">
        Detail Kehadiran
    </h5>
    <hr class="lms-card-divider" style="margin: 10px 0 20px;">

    <!-- CARD INFO -->
    <div class="detail-card" style="margin-bottom: 20px; padding: 24px;">

        <!-- Baris 1: Mata Kuliah + Kelas -->
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-bottom: 16px;">
            <div>
                <div class="detail-label">Mata Kuliah</div>
                <div class="detail-text" style="margin-bottom: 0; font-weight: 500;">
                    <?= htmlspecialchars($activeKelas['nama'] ?? 'Pemrograman Berbasis Web Dasar') ?>
                </div>
            </div>
            <div>
                <div class="detail-label">Kelas</div>
                <div class="detail-text" style="margin-bottom: 0; font-weight: 500;">
                    <?= htmlspecialchars($activeKelas['kelas'] ?? 'SIO A') ?>
                </div>
            </div>
        </div>

        <!-- Baris 2: Tanggal + Pertemuan Ke- -->
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-bottom: 20px;">
            <div>
                <div class="detail-label">Tanggal Kehadiran</div>
                <div class="detail-text" style="margin-bottom: 0; font-weight: 500;">
                    <?= $isBerlangsung || $isSelesai
                        ? htmlspecialchars($pertemuan['tanggal'])
                        : '<span style="color:#adb5bd;">—</span>' ?>
                </div>
            </div>
            <div>
                <div class="detail-label">Pertemuan Ke -</div>
                <div class="detail-text" style="margin-bottom: 0; font-weight: 500;">
                    <?= $nomorSaatIni ?>
                </div>
            </div>
        </div>

        <!-- BARIS AKSI UTAMA -->
        <?php if ($isBerlangsung && $konfirmasi === null): ?>
            <!-- Berlangsung + Belum Konfirmasi → Tombol Konfirmasi -->
            <a href="?kelas_id=<?= $kelasId ?>&pertemuan_id=<?= $pertemuanId ?>&aksi=konfirmasi"
               class="btn btn-primary"
               style="width: 100%; font-weight: 600; font-size: 15px; height: 44px; border-radius: 8px;">
                Konfirmasi Kehadiran
            </a>

        <?php elseif ($isBerlangsung && $konfirmasi !== null): ?>
            <!-- Berlangsung + Sudah Konfirmasi → Status -->
            <div>
                <div class="detail-label" style="margin-bottom: 6px;">Status</div>
                <?php if ($konfirmasi === 'hadir'): ?>
                    <span class="presensi-badge" style="background:#d4edda;color:#155724;font-size:13px;padding:4px 14px;">
                        Hadir
                    </span>
                <?php else: ?>
                    <span class="presensi-badge" style="background:#f8d7da;color:#721c24;font-size:13px;padding:4px 14px;">
                        Alpha
                    </span>
                <?php endif; ?>
            </div>

        <?php elseif ($isSelesai): ?>
            <!-- Selesai → Tampilkan status akhir -->
            <div>
                <div class="detail-label" style="margin-bottom: 6px;">Status</div>
                <?php if ($konfirmasi === 'hadir'): ?>
                    <span class="presensi-badge" style="background:#d4edda;color:#155724;font-size:13px;padding:4px 14px;">
                        Hadir
                    </span>
                <?php elseif ($konfirmasi === 'alpha'): ?>
                    <span class="presensi-badge" style="background:#f8d7da;color:#721c24;font-size:13px;padding:4px 14px;">
                        Alpha
                    </span>
                <?php else: ?>
                    <span class="presensi-badge" style="background:#e9ecef;color:#495057;font-size:13px;padding:4px 14px;">
                        Tidak Ada Data
                    </span>
                <?php endif; ?>
            </div>

        <?php else: ?>
            <!-- Belum Dimulai → Tombol Nonaktif -->
            <button class="btn btn-secondary" disabled
                    style="width: 100%; font-weight: 600; font-size: 15px; height: 44px; border-radius: 8px; opacity: 0.65;">
                <i class="bi bi-lock me-2"></i>Kehadiran Belum Aktif !
            </button>
        <?php endif; ?>

    </div>

    <!-- GRID NAVIGASI PERTEMUAN -->
    <div class="detail-card" style="padding: 24px;">

        <div style="font-size: 16px; font-weight: 700; color: #202124; margin-bottom: 16px;">
            Pertemuan Ke -
        </div>

        <!-- Baris atas: pertemuan 1–7 -->
        <div style="display: flex; gap: 8px; margin-bottom: 8px; flex-wrap: wrap;">
            <?php foreach ($semuaPertemuan as $idx => $sp):
                $num = $idx + 1;
                if ($num > 7) break;
                $isAktif = (int)$sp['id'] === $pertemuanId;
                $url = "detail_presensi.php?kelas_id={$kelasId}&pertemuan_id={$sp['id']}";
            ?>
            <a href="<?= $url ?>"
               style="
                   width: 44px; height: 44px;
                   border-radius: 8px;
                   border: <?= $isAktif ? '2px solid #1a73e8' : '1px solid #dadce0' ?>;
                   display: flex; align-items: center; justify-content: center;
                   font-size: 15px; font-weight: <?= $isAktif ? '700' : '500' ?>;
                   color: <?= $isAktif ? '#1a73e8' : '#202124' ?>;
                   text-decoration: none;
                   transition: background .1s;
               "
               onmouseover="this.style.background='#f1f3f4'"
               onmouseout="this.style.background='transparent'"
            >
                <?= $num ?>
            </a>
            <?php endforeach; ?>
        </div>

        <!-- Baris bawah: pertemuan 8–14 -->
        <div style="display: flex; gap: 8px; flex-wrap: wrap;">
            <?php foreach ($semuaPertemuan as $idx => $sp):
                $num = $idx + 1;
                if ($num <= 7) continue;
                $isAktif = (int)$sp['id'] === $pertemuanId;
                $url = "detail_presensi.php?kelas_id={$kelasId}&pertemuan_id={$sp['id']}";
            ?>
            <a href="<?= $url ?>"
               style="
                   width: 44px; height: 44px;
                   border-radius: 8px;
                   border: <?= $isAktif ? '2px solid #1a73e8' : '1px solid #dadce0' ?>;
                   display: flex; align-items: center; justify-content: center;
                   font-size: 15px; font-weight: <?= $isAktif ? '700' : '500' ?>;
                   color: <?= $isAktif ? '#1a73e8' : '#202124' ?>;
                   text-decoration: none;
                   transition: background .1s;
               "
               onmouseover="this.style.background='#f1f3f4'"
               onmouseout="this.style.background='transparent'"
            >
                <?= $num ?>
            </a>
            <?php endforeach; ?>
        </div>

    </div>

</div>

<?php require_once 'layouts/footer.php'; ?>
