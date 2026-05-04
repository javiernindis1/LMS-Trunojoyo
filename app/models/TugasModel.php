<?php
require_once BASE_PATH . '/app/core/Model.php';

class TugasModel extends Model
{
    public function getTugasByKelas($kelasId)
    {
        return [
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
            ],
        ];
    }
}
