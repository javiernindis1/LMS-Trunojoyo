</div> <!-- End detail-content-wrapper -->

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="<?= BASE_URL ?>/mahasiswa/public/js/app.js"></script>

<script>
// Delete overlay (hanya aktif jika elemen ada di halaman)
(function () {
    const overlay       = document.getElementById('deleteOverlay');
    const openBtn       = document.getElementById('openDeleteOverlay');
    const closeBtn      = document.getElementById('closeDeleteOverlay');
    if (!overlay || !openBtn || !closeBtn) return;

    openBtn.addEventListener('click',  () => overlay.classList.add('show'));
    closeBtn.addEventListener('click', () => overlay.classList.remove('show'));
    overlay.addEventListener('click',  (e) => { if (e.target === overlay) overlay.classList.remove('show'); });
})();
</script>
</body>
</html>
