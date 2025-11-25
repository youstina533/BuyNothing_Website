<?php
define('ROOT_PATH', __DIR__ . '/../');
require_once ROOT_PATH . 'database.php';

class PostModel {
    private $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->getConnection();
    }

    public function addPost($user_id, $group_id, $title, $description, $post_type) {
        $stmt = $this->conn->prepare("INSERT INTO posts (user_id, group_id, title, description, post_type) VALUES (:user_id, :group_id, :title, :description, :post_type)");
        return $stmt->execute(['user_id' => $user_id, 'group_id' => $group_id, 'title' => $title, 'description' => $description, 'post_type' => $post_type]);
    }

    public function updatePost($post_id, $title, $description) {
        $stmt = $this->conn->prepare("UPDATE posts SET title = :title, description = :description WHERE post_id = :post_id");
        return $stmt->execute(['post_id' => $post_id, 'title' => $title, 'description' => $description]);
    }

    public function deletePost($post_id) {
        $stmt = $this->conn->prepare("DELETE FROM posts WHERE post_id = :post_id");
        return $stmt->execute(['post_id' => $post_id]);
    }
}
?>