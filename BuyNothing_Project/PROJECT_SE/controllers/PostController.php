<?php
define('ROOT_PATH', __DIR__ . '/../');
require_once ROOT_PATH . 'models/PostModel.php';

class PostController {
    private $model;

    public function __construct() {
        $this->model = new PostModel();
    }

    public function create($user_id, $group_id, $title, $description, $post_type) {
        if ($this->model->addPost($user_id, $group_id, $title, $description, $post_type)) {
            header("Location: " . ROOT_PATH . "dashboard.php");
            exit();
        }
    }

    public function update($post_id, $title, $description) {
        if ($this->model->updatePost($post_id, $title, $description)) {
            header("Location: " . ROOT_PATH . "dashboard.php");
            exit();
        }
    }

    public function delete($post_id) {
        if ($this->model->deletePost($post_id)) {
            header("Location: " . ROOT_PATH . "dashboard.php");
            exit();
        }
    }
}
?>