<?php
// Mock Database / Data Arrays for LMS

$kelasList = [
    [
        'id'      => 1,
        'nama'    => 'PEMROGRAMAN BERBASIS WEB DASAR',
        'kelas'   => 'Kelas SIO A',
        'icon'    => 'lock',
    ],
    [
        'id'      => 2,
        'nama'    => 'PEMROGRAMAN BERBASIS WEB DASAR',
        'kelas'   => 'Kelas SIO A',
        'icon'    => 'lock',
    ],
];

function getKelasById($id) {
    global $kelasList;
    foreach ($kelasList as $kelas) {
        if ($kelas['id'] == $id) return $kelas;
    }
    return null;
}

$pengumumanList = [
    [
        'id'      => 1,
        'tanggal' => '28 Februari 2026',
        'isi'     => 'Kelas tanggal 20 Februari di tiadakan, silahkan belajar di rumah masing-masing. Harap mempersiapkan diri untuk pertemuan berikutnya dengan membaca bahan yang sudah diberikan.',
        'status'  => 'aktif',
        'komentar' => [
            ['nama' => 'Budi Santoso', 'waktu' => '28 Feb 2026, 09:15', 'isi' => 'Baik bu, terima kasih informasinya.'],
            ['nama' => 'Siti Rahayu',  'waktu' => '28 Feb 2026, 10:02', 'isi' => 'Siap bu!'],
        ],
    ],
    [
        'id'      => 2,
        'tanggal' => '28 Februari 2026',
        'isi'     => 'Kelas tanggal 20 Februari di tiadakan, silahkan belajar di rumah masing-masing.',
        'status'  => 'draft',
        'komentar' => [],
    ],
];

function getPengumumanById($id) {
    global $pengumumanList;
    foreach ($pengumumanList as $p) {
        if ((int)$p['id'] === (int)$id) return $p;
    }
    return null;
}

$materiList = [
    [
        'id'         => 1,
        'pertemuan'  => 'Pertemuan 1',
        'tanggal'    => '28 Maret 2026',
        'tipe'       => 'Tautan Youtube',
        'tipe_icon'  => 'youtube',
        'judul'      => 'Materi UI/UX',
        'status'     => 'aktif',
        'lampiran'   => [
            [
                'tipe'  => 'youtube',
                'judul' => 'Tutorial cara menggunakan figma',
                'url'   => 'https://www.youtube.com/watch?v=yS2AEWC1JeM&list=RDyS2AEWC1JeM&start_radio=1',
            ]
        ],
    ],
    [
        'id'         => 2,
        'pertemuan'  => 'Pertemuan 2',
        'tanggal'    => '28 Februari 2026',
        'tipe'       => 'Unggahan file',
        'tipe_icon'  => 'file',
        'judul'      => 'Materi Pemrograman digital',
        'status'     => 'aktif',
        'lampiran'   => [
            [
                'tipe'  => 'file',
                'judul' => 'MATERI PERTEMUAN 1.docx',
                'url'   => '#',
            ]
        ],
    ],
    [
        'id'         => 3,
        'pertemuan'  => 'Pertemuan 3',
        'tanggal'    => '07 Maret 2026',
        'tipe'       => 'Tautan Youtube',
        'tipe_icon'  => 'youtube',
        'judul'      => 'Materi HTML Dasar',
        'status'     => 'draft',
        'lampiran'   => [
            [
                'tipe'  => 'youtube',
                'judul' => 'Belajar HTML untuk Pemula',
                'url'   => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
            ]
        ],
    ],
];

function getMateriById($id) {
    global $materiList;
    foreach ($materiList as $m) {
        if ((int)$m['id'] === (int)$id) return $m;
    }
    return null;
}

$tugasList = [
    [
        'id'          => 1,
        'judul'       => 'Tugas 1',
        'tanggal'     => '28 Maret 2026',
        'poin'        => 100,
        'tenggat'     => '09 Mei 2026 23:59',
        'visibilitas' => 'Terlihat oleh siswa',
        'status'      => 'expired',     // expired | aktif | draft
        'file'        => 'TUGAS IF ELSE.pdf',
        'total_siswa' => 3,
        'dikumpulkan' => 3,
        'belum'       => 0,
        'dinilai'     => 3,
        'deskripsi'   => 'Kerjakan soal IF ELSE berikut menggunakan bahasa pemrograman yang telah dipelajari. Upload file dalam format PDF atau Word. Pastikan kode sudah diuji dan berjalan dengan benar sebelum dikumpulkan.',
    ],
    [
        'id'          => 2,
        'judul'       => 'Tugas 2',
        'tanggal'     => '28 Maret 2026',
        'poin'        => 100,
        'tenggat'     => '09 Mei 2026 23:59',
        'visibilitas' => 'Terlihat oleh siswa',
        'status'      => 'aktif',
        'file'        => 'TUGAS IF ELSE.pdf',
        'total_siswa' => 3,
        'dikumpulkan' => 3,
        'belum'       => 0,
        'dinilai'     => 3,
        'deskripsi'   => 'Buatlah program sederhana menggunakan struktur percabangan IF-ELSE. Program harus memiliki minimal 3 kondisi berbeda.',
    ],
    [
        'id'          => 3,
        'judul'       => 'Tugas 3',
        'tanggal'     => '28 Maret 2026',
        'poin'        => 100,
        'tenggat'     => '09 Mei 2026 23:59',
        'visibilitas' => 'Tidak terlihat oleh siswa',
        'status'      => 'draft',
        'file'        => 'TUGAS IF ELSE.pdf',
        'total_siswa' => 3,
        'dikumpulkan' => 0,
        'belum'       => 3,
        'dinilai'     => 0,
        'deskripsi'   => 'Draft tugas - belum dipublikasikan.',
    ],
];

function getTugasById($id) {
    global $tugasList;
    foreach ($tugasList as $t) {
        if ((int)$t['id'] === (int)$id) return $t;
    }
    return null;
}

$kuisList = [
    [
        'id'            => 1,
        'judul'         => 'Kuis 1',
        'status'        => 'expired',   // expired | aktif | draft
        'tgl_mulai'     => '28 Maret 2026, 12:25',
        'tenggat'       => '29 Mar 2026, 23:59',
        'durasi'        => '30 Menit',
        'total_poin'    => 100,
        'pertanyaan'    => 10,
        'rata_nilai'    => 70,
        'deskripsi'     => 'Kuis pertama mencakup materi pertemuan 1 dan 2. Kerjakan dengan jujur dan tanpa membuka buku. Setiap soal bernilai 10 poin.',
    ],
    [
        'id'            => 2,
        'judul'         => 'Kuis 2',
        'status'        => 'aktif',
        'tgl_mulai'     => '28 Maret 2026, 12:25',
        'tenggat'       => '29 Mar 2026, 23:59',
        'durasi'        => '30 Menit',
        'total_poin'    => 100,
        'pertanyaan'    => 10,
        'rata_nilai'    => 70,
        'deskripsi'     => 'Kuis kedua mencakup materi pertemuan 3 dan 4 tentang struktur kendali dan fungsi.',
    ],
    [
        'id'            => 3,
        'judul'         => 'Kuis 3',
        'status'        => 'draft',
        'tgl_mulai'     => '28 Maret 2026, 12:25',
        'tenggat'       => '29 Mar 2026, 23:59',
        'durasi'        => '30 Menit',
        'total_poin'    => 100,
        'pertanyaan'    => 10,
        'rata_nilai'    => 0,
        'deskripsi'     => 'Draft kuis - belum dipublikasikan.',
    ],
];

function getKuisById($id) {
    global $kuisList;
    foreach ($kuisList as $k) {
        if ((int)$k['id'] === (int)$id) return $k;
    }
    return null;
}

$presensiList = [
    [
        'pertemuan' => 'Pertemuan 1',
        'status' => 'selesai',
        'tanggal' => '07 Maret 2026',
        'buka_absen' => '12:20 - 15:20',
        'absensi_siswa' => 'Hadir',
    ],
    [
        'pertemuan' => 'Pertemuan 2',
        'status' => 'berlangsung',
        'tanggal' => '14 Maret 2026',
        'buka_absen' => '12:20 - 15:20',
        'absensi_siswa' => 'Tidak Hadir',
    ]
];

function getPertemuanByKelas($kelasId) {
    return [
        ['id' => 1,  'label' => 'Pertemuan 1',  'status' => 'selesai'],
        ['id' => 2,  'label' => 'Pertemuan 2',  'status' => 'berlangsung'],
        ['id' => 3,  'label' => 'Pertemuan 3',  'status' => ''],
        ['id' => 4,  'label' => 'Pertemuan 4',  'status' => ''],
        ['id' => 5,  'label' => 'Pertemuan 5',  'status' => ''],
        ['id' => 6,  'label' => 'Pertemuan 6',  'status' => ''],
        ['id' => 7,  'label' => 'Pertemuan 7',  'status' => ''],
        ['id' => 8,  'label' => 'Pertemuan 8',  'status' => ''],
        ['id' => 9,  'label' => 'Pertemuan 9',  'status' => ''],
        ['id' => 10, 'label' => 'Pertemuan 10', 'status' => ''],
        ['id' => 11, 'label' => 'Pertemuan 11', 'status' => ''],
        ['id' => 12, 'label' => 'Pertemuan 12', 'status' => ''],
        ['id' => 13, 'label' => 'Pertemuan 13', 'status' => ''],
        ['id' => 14, 'label' => 'Pertemuan 14', 'status' => ''],
    ];
}

function getNilaiByKelas($kelasId) {
    $mahasiswa = [];
    for ($i = 0; $i < 25; $i++) {
        $mahasiswa[] = [
            'nama'    => 'Nama Mahasiswa',
            'tugas1'  => $i === 0 ? 100 : '...',
            'tugas2'  => 90,
            'uts'     => 90,
            'tugas3'  => 90,
            'tugas4'  => 90,
            'uas'     => $i === 0 ? 90 : '...',
        ];
    }
    return $mahasiswa;
}

function getTotalMahasiswa($kelasId) {
    return 25;
}

function getSeksiByKelas($kelasId) {
    return [
        [
            'judul' => 'Presensi',
            'items' => ['Daftar Hadir', 'Berita Acara'],
        ],
        [
            'judul' => 'Ujian Tengah Semester',
            'items' => ['Daftar Hadir', 'Berita Acara'],
        ],
        [
            'judul' => 'Ujian Akhir Semester',
            'items' => ['Daftar Hadir', 'Berita Acara'],
        ],
    ];
}

$laporanList = [
    [
        'title' => 'Cetak Presensi',
        'subtitle' => 'Mencetak laporan presensi per mahasiswa, yang berisi detail kehadiran, ketidakhadiran, izin, dll dalam satu periode tertentu.',
        'icon' => 'printer'
    ],
    [
        'title' => 'Cetak BAP (Berita Acara Perkuliahan)',
        'subtitle' => 'Mencetak laporan BAP per pertemuan, yang berisi detail laporan kehadiran mahasiswa, rangkuman materi dll.',
        'icon' => 'file-earmark-text'
    ],
    [
        'title' => 'Cetak Laporan UTS/UAS',
        'subtitle' => 'Mencetak laporan hasil ujian mahasiswa dalam bentuk rekapitulasi nilai untuk periode tertentu.',
        'icon' => 'graph-up'
    ],
    [
        'title' => 'Rekap Nilai Akhir',
        'subtitle' => 'Mencetak laporan rekapitulasi nilai akhir mahasiswa setelah diakumulasi dari seluruh komponen penilaian.',
        'icon' => 'calculator'
    ],
];
?>
