<?php
require_once '../data.php';

$pageTitle = 'Presensi';
$activeNav = 'presensi';
$kelasId   = isset($_GET['kelas_id']) ? (int)$_GET['kelas_id'] : null;

$activeKelas = $kelasId ? getKelasById($kelasId) : null;
$pertemuan   = $kelasId ? getPertemuanByKelas($kelasId) : [];

// NIM mahasiswa yang login (dummy — nanti ambil dari session)
$nimLogin = 'M001';

require_once 'layouts/header.php';
?>

<?php if (!$kelasId): ?>
<div class="kelas-belum-dipilih">
    <div class="kelas-belum-icon"><i class="bi bi-file-earmark-x-fill"></i></div>
    <h4 class="kelas-belum-text">Kelas Belum Dipilih</h4>
</div>
<?php else: ?>

<div class="presensi-wrapper">
    <h5 class="presensi-title">
        <?= htmlspecialchars($activeKelas['nama'] . ' ' . $activeKelas['kelas']) ?>
    </h5>
    <hr class="lms-card-divider mb-3">

    <div class="presensi-list">
        <?php foreach ($pertemuan as $p):
            $status         = $p['status'];
            $isBerlangsung  = $status === 'berlangsung';
            $isSelesai      = $status === 'selesai';
            $isBelumDimulai = $status === 'belum_dimulai' || $status === '';

            // Cek status konfirmasi mahasiswa untuk pertemuan ini
            $konfirmasi = getKonfirmasiMahasiswa($p['id'], $nimLogin);

            // URL detail
            $detailUrl = "detail_presensi.php?kelas_id={$kelasId}&pertemuan_id={$p['id']}";
        ?>
        <div class="presensi-item <?= $isBerlangsung ? 'presensi-item--open' : '' ?>">
            <div class="presensi-item-header" onclick="togglePresensi(this)">
                <span class="presensi-item-label"><?= htmlspecialchars($p['label']) ?></span>
                <div class="d-flex align-items-center gap-2">

                    <?php if ($isSelesai): ?>
                        <?php if ($konfirmasi === 'hadir'): ?>
                            <span class="presensi-badge" style="background:#d4edda;color:#155724;">Hadir</span>
                        <?php elseif ($konfirmasi === 'alpha'): ?>
                            <span class="presensi-badge" style="background:#f8d7da;color:#721c24;">Alpha</span>
                        <?php else: ?>
                            <span class="presensi-badge presensi-badge--selesai">Selesai</span>
                        <?php endif; ?>

                    <?php elseif ($isBerlangsung): ?>
                        <span class="presensi-badge presensi-badge--berlangsung">Sedang berlangsung</span>

                    <?php else: ?>
                        <!-- Belum dimulai — tidak tampilkan badge -->
                    <?php endif; ?>

                    <i class="bi bi-chevron-down presensi-chevron"></i>
                </div>
            </div>

            <div class="presensi-item-body">
                <?php if ($isBerlangsung): ?>
                    <?php if ($konfirmasi === null): ?>
                        <!-- Berlangsung & belum konfirmasi → tombol Konfirmasi Kehadiran -->
                        <a href="<?= $detailUrl ?>" class="btn btn-primary btn-sm presensi-absensi-btn">
                            <i class="bi bi-clipboard-check me-1"></i>Konfirmasi Kehadiran
                        </a>

                    <?php else: ?>
                        <!-- Berlangsung & sudah konfirmasi → tampilkan status -->
                        <div class="d-flex align-items-center gap-2" style="font-size: 13px; color: #495057;">
                            <i class="bi bi-check-circle-fill text-success"></i>
                            <span>Kehadiran sudah dikonfirmasi</span>
                            <?php if ($konfirmasi === 'hadir'): ?>
                                <span class="presensi-badge" style="background:#d4edda;color:#155724;padding:2px 10px;">Hadir</span>
                            <?php else: ?>
                                <span class="presensi-badge" style="background:#f8d7da;color:#721c24;padding:2px 10px;">Alpha</span>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>

                <?php elseif ($isSelesai): ?>
                    <!-- Selesai → lihat detail absensi -->
                    <a href="<?= $detailUrl ?>" class="btn btn-outline-secondary btn-sm presensi-absensi-btn">
                        <i class="bi bi-eye me-1"></i>Lihat Detail
                    </a>

                <?php else: ?>
                    <!-- Belum dimulai → tombol nonaktif -->
                    <button class="btn btn-secondary btn-sm presensi-absensi-btn" disabled>
                        <i class="bi bi-lock me-1"></i>Kehadiran Belum Aktif
                    </button>
                <?php endif; ?>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>

<script>
function togglePresensi(header) {
    const item = header.closest('.presensi-item');
    item.classList.toggle('presensi-item--open');
}
</script>

<?php endif; ?>

<?php require_once 'layouts/footer.php'; ?>
