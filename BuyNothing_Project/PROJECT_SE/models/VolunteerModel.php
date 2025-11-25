<?php
define('ROOT_PATH', __DIR__ . '/../');
require_once ROOT_PATH . 'database.php';

class VolunteerModel {
    private $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->getConnection();
    }

    public function apply($user_id, $motivation, $experience, $availability) {
        $stmt = $this->conn->prepare("INSERT INTO volunteer_applications (user_id, motivation, experience, availability) VALUES (:user_id, :motivation, :experience, :availability)");
        return $stmt->execute(['user_id' => $user_id, 'motivation' => $motivation, 'experience' => $experience, 'availability' => $availability]);
    }
}
?>