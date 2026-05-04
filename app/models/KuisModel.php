<?php
require_once BASE_PATH . '/app/core/Model.php';

class KuisModel extends Model
{
    public function getKuisByKelas($kelasId)
    {
        return [
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
            ],
            [
                'id'            => 2,
                'judul'         => 'Kuis 1',
                'status'        => 'aktif',
                'tgl_mulai'     => '28 Maret 2026, 12:25',
                'tenggat'       => '29 Mar 2026, 23:59',
                'durasi'        => '30 Menit',
                'total_poin'    => 100,
                'pertanyaan'    => 10,
                'rata_nilai'    => 70,
            ],
            [
                'id'            => 3,
                'judul'         => 'Kuis 1',
                'status'        => 'draft',
                'tgl_mulai'     => '28 Maret 2026, 12:25',
                'tenggat'       => '29 Mar 2026, 23:59',
                'durasi'        => '30 Menit',
                'total_poin'    => 100,
                'pertanyaan'    => 10,
                'rata_nilai'    => 0,
            ],
        ];
    }
}
