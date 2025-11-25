<?php
define('ROOT_PATH', __DIR__ . '/../');
require_once ROOT_PATH . 'models/UserModel.php';

// controllers/UserController.php
class UserController {
    private $model;

    public function __construct() {
        $this->model = new UserModel();
    }

    public function register($username, $email, $password) {
        if ($this->model->register($username, $email, $password)) {
            session_start(); // Ensure session is started
            $user = $this->model->login($email, $password); // Log in immediately after registration
            if ($user) {
                $_SESSION['user_id'] = $user['user_id'];
                $_SESSION['username'] = $user['username'];
                header("Location: " . ROOT_PATH . "views/dashboard.php");
                exit();
            }
        }
    }

    public function login($email, $password) {
        $user = $this->model->login($email, $password);
        if ($user) {
            session_start();
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['username'] = $user['username'];
            header("Location: " . ROOT_PATH . "views/dashboard.php");
            exit();
        } else {
            header("Location: " . ROOT_PATH . "views/login.php?error=invalid");
            exit();
        }
    }
}
?>