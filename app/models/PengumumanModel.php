<?php
require_once BASE_PATH . '/app/core/Model.php';

class PengumumanModel extends Model
{
    public function getPengumumanByKelas($kelasId)
    {
        // Sample data – replace with DB query
        // status: aktif | draft
        return [
            [
                'id'      => 1,
                'tanggal' => '28 Februari 2026',
                'isi'     => 'Kelas tanggal  20 Februari di tiadakan, silahkan belajar di rumah masing masing',
                'status'  => 'aktif',
            ],
            [
                'id'      => 2,
                'tanggal' => '28 Februari 2026',
                'isi'     => 'Kelas tanggal  20 Februari di tiadakan, silahkan belajar di rumah masing masing',
                'status'  => 'draft',
            ],
        ];
    }
}
