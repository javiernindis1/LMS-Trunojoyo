<?php
require_once BASE_PATH . '/app/core/Controller.php';
require_once BASE_PATH . '/app/models/KelasModel.php';
require_once BASE_PATH . '/app/models/LaporanModel.php';

class ManajemenLaporanController extends Controller
{
    public function index()
    {
        $kelasModel   = new KelasModel();
        $laporanModel = new LaporanModel();

        $kelasList   = $kelasModel->getAllKelas();
        $kelasId     = isset($_GET['kelas_id']) ? (int)$_GET['kelas_id'] : null;
        $activeKelas = $kelasId ? $kelasModel->getKelasById($kelasId) : $kelasList[0];
        $seksi       = $laporanModel->getSeksiByKelas($activeKelas['id']);

        $this->view('layouts/main', [
            'kelasList'   => $kelasList,
            'activeKelas' => $activeKelas,
            'kelasId'     => $kelasId,
            'tab'         => 'manajemen',
            'seksi'       => $seksi,
            'pageTitle'   => 'Manajemen Laporan',
            'activeNav'   => 'manajemen',
            'content'     => 'manajemen_laporan/index',
        ]);
    }
}
