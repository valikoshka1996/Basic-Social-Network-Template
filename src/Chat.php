<?php

class Chat {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getMessages($userId, $recipientId) {
        $stmt = $this->db->prepare("
            SELECT messages.*, users.first_name, users.last_name
            FROM messages
            JOIN users ON messages.sender_id = users.id
            WHERE (sender_id = ? AND recipient_id = ?)
               OR (sender_id = ? AND recipient_id = ?)
            ORDER BY messages.timestamp ASC
        ");
        $stmt->execute([$userId, $recipientId, $recipientId, $userId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function sendMessage($senderId, $recipientId, $message) {
        $stmt = $this->db->prepare("INSERT INTO messages (sender_id, recipient_id, message) VALUES (?, ?, ?)");
        return $stmt->execute([$senderId, $recipientId, $message]);
    }
}
?>
