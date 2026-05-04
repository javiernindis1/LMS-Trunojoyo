<?php
require_once BASE_PATH . '/app/core/Controller.php';
require_once BASE_PATH . '/app/models/KelasModel.php';
require_once BASE_PATH . '/app/models/LaporanModel.php';

class LaporanController extends Controller
{
    public function index()
    {
        $kelasModel  = new KelasModel();
        $laporanModel = new LaporanModel();

        $kelasList   = $kelasModel->getAllKelas();
        $kelasId     = isset($_GET['kelas_id']) ? (int)$_GET['kelas_id'] : null;
        $activeKelas = $kelasId ? $kelasModel->getKelasById($kelasId) : null;
        $seksi       = $kelasId ? $laporanModel->getSeksiByKelas($kelasId) : [];

        $this->view('layouts/main', [
            'kelasList'   => $kelasList,
            'activeKelas' => $activeKelas,
            'kelasId'     => $kelasId,
            'tab'         => 'laporan',
            'seksi'       => $seksi,
            'pageTitle'   => 'Laporan',
            'activeNav'   => 'laporan',
            'content'     => 'laporan/index',
        ]);
    }
}
