<?php
require_once BASE_PATH . '/app/core/Controller.php';
require_once BASE_PATH . '/app/models/KelasModel.php';
require_once BASE_PATH . '/app/models/PengumumanModel.php';
require_once BASE_PATH . '/app/models/MateriModel.php';

class StreamController extends Controller
{
    private $kelasModel;
    private $pengumumanModel;
    private $materiModel;

    public function __construct()
    {
        $this->kelasModel      = new KelasModel();
        $this->pengumumanModel = new PengumumanModel();
        $this->materiModel     = new MateriModel();
    }

    public function index()
    {
        $kelasList  = $this->kelasModel->getAllKelas();
        $kelasId    = isset($_GET['kelas_id']) ? (int)$_GET['kelas_id'] : null;
        $tab        = isset($_GET['tab']) ? $_GET['tab'] : 'pengumuman';
        $activeKelas = $kelasId ? $this->kelasModel->getKelasById($kelasId) : null;

        $pengumuman = [];
        $materi     = [];

        if ($kelasId) {
            $pengumuman = $this->pengumumanModel->getPengumumanByKelas($kelasId);
            $materi     = $this->materiModel->getMateriByKelas($kelasId);
        }

        $this->view('layouts/main', [
            'kelasList'   => $kelasList,
            'activeKelas' => $activeKelas,
            'kelasId'     => $kelasId,
            'tab'         => $tab,
            'pengumuman'  => $pengumuman,
            'materi'      => $materi,
            'pageTitle'   => 'Stream',
            'activeNav'   => 'stream',
            'content'     => 'stream/index',
        ]);
    }
}
