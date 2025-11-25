<?php
define('ROOT_PATH', __DIR__ . '/../');
require_once ROOT_PATH . 'models/CommentModel.php';

class CommentController {
    private $model;

    public function __construct() {
        $this->model = new CommentModel();
    }

    public function add($post_id, $user_id, $message) {
        if ($this->model->addComment($post_id, $user_id, $message)) {
            header("Location: " . ROOT_PATH . "create-post.php?post_id=$post_id");
            exit();
        }
    }

    public function delete($response_id) {
        if ($this->model->deleteComment($response_id)) {
            header("Location: " . ROOT_PATH . "create-post.php");
            exit();
        }
    }
}
?>