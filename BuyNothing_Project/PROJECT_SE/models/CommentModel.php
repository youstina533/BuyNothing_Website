<?php
define('ROOT_PATH', __DIR__ . '/../');
require_once ROOT_PATH . 'database.php';

class CommentModel {
    private $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->getConnection();
    }

    public function addComment($post_id, $user_id, $message) {
        $stmt = $this->conn->prepare("INSERT INTO post_responses (post_id, user_id, message) VALUES (:post_id, :user_id, :message)");
        return $stmt->execute(['post_id' => $post_id, 'user_id' => $user_id, 'message' => $message]);
    }

    public function deleteComment($response_id) {
        $stmt = $this->conn->prepare("DELETE FROM post_responses WHERE response_id = :id");
        return $stmt->execute(['id' => $response_id]);
    }
}
?>