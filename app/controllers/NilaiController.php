<?php
require_once BASE_PATH . '/app/core/Controller.php';
require_once BASE_PATH . '/app/models/KelasModel.php';
require_once BASE_PATH . '/app/models/NilaiModel.php';

class NilaiController extends Controller
{
    public function index()
    {
        $kelasModel = new KelasModel();
        $nilaiModel = new NilaiModel();

        $kelasList      = $kelasModel->getAllKelas();
        $kelasId        = isset($_GET['kelas_id']) ? (int)$_GET['kelas_id'] : null;
        $activeKelas    = $kelasId ? $kelasModel->getKelasById($kelasId) : null;
        $nilaiList      = $kelasId ? $nilaiModel->getNilaiByKelas($kelasId) : [];
        $totalMahasiswa = $kelasId ? $nilaiModel->getTotalMahasiswa($kelasId) : 0;

        $this->view('layouts/main', [
            'kelasList'      => $kelasList,
            'activeKelas'    => $activeKelas,
            'kelasId'        => $kelasId,
            'tab'            => 'nilai',
            'nilaiList'      => $nilaiList,
            'totalMahasiswa' => $totalMahasiswa,
            'pageTitle'      => 'Nilai',
            'activeNav'      => 'nilai',
            'content'        => 'nilai/index',
        ]);
    }
}
