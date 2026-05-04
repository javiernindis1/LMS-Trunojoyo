<?php
require_once BASE_PATH . '/app/core/Model.php';

class NilaiModel extends Model
{
    public function getNilaiByKelas($kelasId)
    {
        $mahasiswa = [];
        $names = ['Nama Mahasiswa'];
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

    public function getTotalMahasiswa($kelasId)
    {
        return 25;
    }
}
