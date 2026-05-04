<?php
// Main entry point - Front Controller
define('BASE_PATH', __DIR__);
define('BASE_URL', 'http://' . $_SERVER['HTTP_HOST'] . '/Projek/test');

session_start();

// Autoload
spl_autoload_register(function ($class) {
    $paths = [
        BASE_PATH . '/app/controllers/' . $class . '.php',
        BASE_PATH . '/app/models/' . $class . '.php',
        BASE_PATH . '/app/core/' . $class . '.php',
    ];
    foreach ($paths as $path) {
        if (file_exists($path)) {
            require_once $path;
            return;
        }
    }
});

// Router
$controller = isset($_GET['controller']) ? $_GET['controller'] : 'stream';
$action     = isset($_GET['action']) ? $_GET['action'] : 'index';
$kelasId    = isset($_GET['kelas_id']) ? (int)$_GET['kelas_id'] : null;

$controllerMap = [
    'stream'    => 'StreamController',
    'materi'    => 'MateriController',
    'asesmen'   => 'AsesmenController',
    'presensi'  => 'PresensiController',
    'nilai'     => 'NilaiController',
    'laporan'   => 'LaporanController',
    'manajemen' => 'ManajemenLaporanController',
];

$controllerClass = isset($controllerMap[$controller]) ? $controllerMap[$controller] : 'StreamController';
$controllerFile  = BASE_PATH . '/app/controllers/' . $controllerClass . '.php';

if (file_exists($controllerFile)) {
    require_once $controllerFile;
    $ctrl = new $controllerClass();
    if (method_exists($ctrl, $action)) {
        $ctrl->$action();
    } else {
        $ctrl->index();
    }
} else {
    require_once BASE_PATH . '/app/controllers/StreamController.php';
    $ctrl = new StreamController();
    $ctrl->index();
}
