<?php
class User {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function register($data) {
        $stmt = $this->db->prepare('INSERT INTO users (first_name, last_name, birthdate, email, password, profile_pic) VALUES (?, ?, ?, ?, ?, ?)');
        $password = password_hash($data['password'], PASSWORD_DEFAULT);
        $profilePic = $this->uploadProfilePic();
        return $stmt->execute([$data['first_name'], $data['last_name'], $data['birthdate'], $data['email'], $password, $profilePic]);
    }

    public function getUserById($id) {
        $stmt = $this->db->prepare('SELECT * FROM users WHERE id = ?');
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function searchUsers($query) {
        $stmt = $this->db->prepare('SELECT * FROM users WHERE first_name LIKE ? OR last_name LIKE ?');
        $stmt->execute(['%' . $query . '%', '%' . $query . '%']);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addFriend($userId, $friendId) {
    	if (!isset($_GET['friend_id'])) {
    die("Friend ID is required.");
}
$friendId = $_GET['friend_id'];
    $stmt = $this->db->prepare("INSERT INTO friendships (user_id, friend_id) VALUES (?, ?)");
    return $stmt->execute([$userId, $friendId]);
}


    private function uploadProfilePic() {
        $targetDir = "../public/images/profile_pics/";
        $targetFile = $targetDir . basename($_FILES["profile_pic"]["name"]);
        move_uploaded_file($_FILES["profile_pic"]["tmp_name"], $targetFile);
        return basename($_FILES["profile_pic"]["name"]);
    }
}
?>
