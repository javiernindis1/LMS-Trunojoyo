<?php
require_once BASE_PATH . '/app/core/Controller.php';
require_once BASE_PATH . '/app/models/KelasModel.php';
require_once BASE_PATH . '/app/models/PresensiModel.php';

class PresensiController extends Controller
{
    public function index()
    {
        $kelasModel   = new KelasModel();
        $presensiModel = new PresensiModel();

        $kelasList   = $kelasModel->getAllKelas();
        $kelasId     = isset($_GET['kelas_id']) ? (int)$_GET['kelas_id'] : null;
        $activeKelas = $kelasId ? $kelasModel->getKelasById($kelasId) : null;
        $pertemuan   = $kelasId ? $presensiModel->getPertemuanByKelas($kelasId) : [];

        $this->view('layouts/main', [
            'kelasList'   => $kelasList,
            'activeKelas' => $activeKelas,
            'kelasId'     => $kelasId,
            'tab'         => 'presensi',
            'pertemuan'   => $pertemuan,
            'pageTitle'   => 'Presensi',
            'activeNav'   => 'presensi',
            'content'     => 'presensi/index',
        ]);
    }
}
