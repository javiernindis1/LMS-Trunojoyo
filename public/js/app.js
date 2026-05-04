// LMS App JavaScript
document.addEventListener('DOMContentLoaded', function () {

    // ---- Active Kelas highlight ----
    const kelasLinks = document.querySelectorAll('.kelas-link');
    kelasLinks.forEach(function (link) {
        if (link.classList.contains('active')) {
            link.closest('.kelas-item').classList.add('active');
        }
    });

    // ---- Smooth tab switching indicator ----
    const tabLinks = document.querySelectorAll('.lms-tab-link');
    tabLinks.forEach(function (tab) {
        tab.addEventListener('click', function () {
            tabLinks.forEach(t => t.classList.remove('active'));
            this.classList.add('active');
        });
    });

    // ---- Tambah button placeholder ----
    const btnTambah = document.getElementById('btnTambah');
    if (btnTambah) {
        btnTambah.addEventListener('click', function () {
            alert('Form Tambah akan ditampilkan di sini.');
        });
    }

    // ---- Presensi accordion toggle ----
    document.querySelectorAll('.presensi-item-header').forEach(function (header) {
        header.addEventListener('click', function () {
            const item = this.closest('.presensi-item');
            item.classList.toggle('presensi-item--open');
            // toggle body visibility
            const body = item.querySelector('.presensi-item-body');
            if (body) {
                body.style.display = item.classList.contains('presensi-item--open') ? 'block' : 'none';
            }
        });

        // Hide body initially for non-open items
        const item = header.closest('.presensi-item');
        const body = item.querySelector('.presensi-item-body');
        if (body && !item.classList.contains('presensi-item--open')) {
            body.style.display = 'none';
        }
    });

    // ---- Nilai search filter ----
    const nilaiSearch = document.getElementById('nilaiSearch');
    if (nilaiSearch) {
        nilaiSearch.addEventListener('input', function () {
            const query = this.value.toLowerCase();
            document.querySelectorAll('#nilaiTable tbody tr').forEach(function (row) {
                const nama = row.cells[0] ? row.cells[0].textContent.toLowerCase() : '';
                row.style.display = nama.includes(query) ? '' : 'none';
            });
        });
    }
});
