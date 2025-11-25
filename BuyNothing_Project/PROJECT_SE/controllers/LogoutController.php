<?php
define('ROOT_PATH', __DIR__ . '/../');
require_once ROOT_PATH . 'models/LogoutModel.php';

class LogoutController {
    private $model;

    public function __construct() {
        $this->model = new LogoutModel();
    }

    public function logout() {
        if ($this->model->logout()) {
            header("Location: " . ROOT_PATH . "index.php");
            exit();
        }
    }
}
?>