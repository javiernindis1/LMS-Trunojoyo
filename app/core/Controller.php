<?php
class Controller
{
    protected function view($view, $data = [])
    {
        extract($data);
        $viewFile = BASE_PATH . '/app/views/' . $view . '.php';
        if (file_exists($viewFile)) {
            require_once $viewFile;
        } else {
            echo "View not found: $view";
        }
    }

    protected function redirect($url)
    {
        header('Location: ' . $url);
        exit;
    }
}
