<?php
require_once BASE_PATH . '/app/core/Controller.php';
require_once BASE_PATH . '/app/models/KelasModel.php';
require_once BASE_PATH . '/app/models/TugasModel.php';
require_once BASE_PATH . '/app/models/KuisModel.php';

class AsesmenController extends Controller
{
    public function index()
    {
        $kelasModel = new KelasModel();
        $tugasModel = new TugasModel();
        $kuisModel  = new KuisModel();

        $kelasList   = $kelasModel->getAllKelas();
        $kelasId     = isset($_GET['kelas_id']) ? (int)$_GET['kelas_id'] : null;
        $tab         = isset($_GET['tab']) ? $_GET['tab'] : 'tugas';
        $activeKelas = $kelasId ? $kelasModel->getKelasById($kelasId) : null;

        $tugas = $kelasId ? $tugasModel->getTugasByKelas($kelasId) : [];
        $kuis  = $kelasId ? $kuisModel->getKuisByKelas($kelasId)   : [];

        $this->view('layouts/main', [
            'kelasList'   => $kelasList,
            'activeKelas' => $activeKelas,
            'kelasId'     => $kelasId,
            'tab'         => $tab,
            'tugas'       => $tugas,
            'kuis'        => $kuis,
            'pageTitle'   => 'Asesmen',
            'activeNav'   => 'asesmen',
            'content'     => 'asesmen/index',
        ]);
    }
}
