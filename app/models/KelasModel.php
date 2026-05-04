<?php
require_once BASE_PATH . '/app/core/Model.php';

class KelasModel extends Model
{
    public function getAllKelas()
    {
        return [
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
    }

    public function getKelasById($id)
    {
        $all = $this->getAllKelas();
        foreach ($all as $kelas) {
            if ($kelas['id'] == $id) {
                return $kelas;
            }
        }
        return null;
    }
}
