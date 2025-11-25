<?php
define('ROOT_PATH', __DIR__ . '/../');
require_once ROOT_PATH . 'database.php';

class LogoutModel {
    public function logout() {
        session_start();
        session_destroy();
        return true;
    }
}
?>