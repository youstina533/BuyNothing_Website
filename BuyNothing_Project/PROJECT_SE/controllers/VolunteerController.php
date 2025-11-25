<?php
define('ROOT_PATH', __DIR__ . '/../');
require_once ROOT_PATH . 'models/VolunteerModel.php';

class VolunteerController {
    private $model;

    public function __construct() {
        $this->model = new VolunteerModel();
    }

    public function apply($user_id, $motivation, $experience, $availability) {
        if ($this->model->apply($user_id, $motivation, $experience, $availability)) {
            header("Location: " . ROOT_PATH . "volunteer-dashboard.php");
            exit();
        }
    }
}
?>