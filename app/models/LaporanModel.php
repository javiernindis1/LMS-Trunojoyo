<?php
require_once BASE_PATH . '/app/core/Model.php';

class LaporanModel extends Model
{
    public function getSeksiByKelas($kelasId)
    {
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
}
