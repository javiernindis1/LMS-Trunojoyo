<?php
require_once BASE_PATH . '/app/core/Model.php';

class PresensiModel extends Model
{
    public function getPertemuanByKelas($kelasId)
    {
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
}
