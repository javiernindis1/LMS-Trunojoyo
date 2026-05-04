<?php
// Stream content view
// Variables available: $kelasId, $tab, $pengumuman, $materi, $activeKelas
?>

<?php if (!$kelasId): ?>
<!-- ===== STATE: KELAS BELUM DIPILIH ===== -->
<div class="kelas-belum-dipilih">
    <div class="kelas-belum-icon">
        <i class="bi bi-file-earmark-x-fill"></i>
    </div>
    <h4 class="kelas-belum-text">Kelas Belum Dipilih</h4>
</div>

<?php else: ?>
<!-- ===== STATE: KELAS SUDAH DIPILIH ===== -->

<!-- Tab Navigation + Tambah Button -->
<div class="content-tab-bar d-flex align-items-center justify-content-between">
    <!-- Pill container membungkus kedua tombol tab -->
    <div class="lms-tab-pill-wrap">
        <a class="lms-tab-pill <?= $tab !== 'materi' ? 'active' : '' ?>"
           href="<?= BASE_URL ?>?controller=stream&kelas_id=<?= $kelasId ?>&tab=pengumuman"
           id="tab-pengumuman">
            <i class="bi bi-megaphone-fill me-1"></i>Pengumuman
        </a>
        <a class="lms-tab-pill <?= $tab === 'materi' ? 'active' : '' ?>"
           href="<?= BASE_URL ?>?controller=stream&kelas_id=<?= $kelasId ?>&tab=materi"
           id="tab-materi">
            <i class="bi bi-journal-bookmark-fill me-1"></i>Materi
        </a>
    </div>
    <button class="btn btn-primary btn-tambah" id="btnTambah">Tambah</button>
</div>

<!-- Tab Content -->
<div class="tab-content-area">

    <?php if ($tab !== 'materi'): ?>
    <!-- ===== PENGUMUMAN ===== -->
    <?php if (empty($pengumuman)): ?>
    <div class="empty-state text-center py-5">
        <i class="bi bi-megaphone fs-1 text-muted"></i>
        <p class="mt-2 text-muted">Belum ada pengumuman.</p>
    </div>
    <?php else: ?>
    <?php foreach ($pengumuman as $p): 
        $borderColor = isset($p['status']) && $p['status'] === 'aktif' ? '#28a745' : '#adb5bd';
    ?>
    <div class="lms-card" style="border-left-color: <?= $borderColor ?>;">
        <div class="lms-card-date">
            <i class="bi bi-calendar3 me-1"></i><?= htmlspecialchars($p['tanggal']) ?>
        </div>
        <p class="lms-card-body"><?= htmlspecialchars($p['isi']) ?></p>
        <hr class="lms-card-divider">
        <a href="#" class="lms-card-comment">
            <i class="bi bi-chat-left-text-fill me-1"></i>Lihat komentar
        </a>
    </div>
    <?php endforeach; ?>
    <?php endif; ?>

    <?php else: ?>
    <!-- ===== MATERI ===== -->
    <?php if (empty($materi)): ?>
    <div class="empty-state text-center py-5">
        <i class="bi bi-journal-x fs-1 text-muted"></i>
        <p class="mt-2 text-muted">Belum ada materi.</p>
    </div>
    <?php else: ?>
    <?php foreach ($materi as $m): 
        $borderColor = isset($m['status']) && $m['status'] === 'aktif' ? '#28a745' : '#adb5bd';
    ?>
    <div class="lms-card" style="border-left-color: <?= $borderColor ?>;">
        <h5 class="materi-pertemuan"><?= htmlspecialchars($m['pertemuan']) ?></h5>
        <div class="materi-meta">
            <span class="materi-tanggal"><i class="bi bi-calendar3 me-1"></i><?= htmlspecialchars($m['tanggal']) ?></span>
            <?php if ($m['tipe_icon'] === 'youtube'): ?>
            <span class="materi-tipe"><i class="bi bi-play-circle me-1"></i><?= htmlspecialchars($m['tipe']) ?></span>
            <?php else: ?>
            <span class="materi-tipe"><i class="bi bi-paperclip me-1"></i><?= htmlspecialchars($m['tipe']) ?></span>
            <?php endif; ?>
        </div>
        <p class="materi-judul"><?= htmlspecialchars($m['judul']) ?></p>
        <hr class="lms-card-divider">
        <div class="materi-lampiran-label"><i class="bi bi-paperclip me-1"></i>Lampiran</div>
        <?php foreach ($m['lampiran'] as $lamp): ?>
        <?php if ($lamp['tipe'] === 'youtube'): ?>
        <div class="lampiran-item lampiran-youtube">
            <div class="lampiran-thumb yt-thumb">
                <i class="bi bi-youtube text-danger fs-4"></i>
            </div>
            <div class="lampiran-info">
                <p class="lampiran-title"><?= htmlspecialchars($lamp['judul']) ?></p>
                <p class="lampiran-url"><?= htmlspecialchars($lamp['url']) ?></p>
            </div>
            <a href="<?= htmlspecialchars($lamp['url']) ?>" target="_blank" class="lampiran-ext ms-auto">
                <i class="bi bi-box-arrow-up-right"></i>
            </a>
        </div>
        <?php else: ?>
        <div class="lampiran-item lampiran-file">
            <div class="lampiran-thumb file-thumb">
                <i class="bi bi-file-earmark-word text-primary fs-4"></i>
            </div>
            <div class="lampiran-info">
                <p class="lampiran-title"><?= htmlspecialchars($lamp['judul']) ?></p>
            </div>
            <a href="<?= htmlspecialchars($lamp['url']) ?>" class="lampiran-download ms-auto">
                <i class="bi bi-download"></i>
            </a>
        </div>
        <?php endif; ?>
        <?php endforeach; ?>
    </div>
    <?php endforeach; ?>
    <?php endif; ?>
    <?php endif; ?>

</div><!-- /tab-content-area -->
<?php endif; ?>
