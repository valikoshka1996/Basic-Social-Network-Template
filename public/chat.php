<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

require '../src/config.php';
require '../src/db.php';
require '../src/User.php';
require '../src/Chat.php';

$chat = new Chat($db);
$user = new User($db);

$chatMessages = [];
$recipientId = $_GET['user_id'] ?? null;

if ($recipientId) {
    $chatMessages = $chat->getMessages($_SESSION['user_id'], $recipientId);
}

$userInfo = $user->getUserById($_SESSION['user_id']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat</title>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>
<?php include '../includes/nav.php'; ?>
<div class="container">
    <h1>Chat</h1>
    <div id="chat-box" class="mb-3" style="height: 300px; overflow-y: scroll;">
        <?php if (!empty($chatMessages)): ?>
            <?php foreach ($chatMessages as $message): ?>
                <div class="message">
                    <strong><?php echo htmlspecialchars($message['sender_name']); ?>:</strong> <?php echo htmlspecialchars($message['message']); ?>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
    <form id="chat-form">
        <input type="hidden" id="sender-id" value="<?php echo htmlspecialchars($_SESSION['user_id']); ?>">
        <input type="hidden" id="recipient-id" value="<?php echo htmlspecialchars($recipientId); ?>">
        <input type="hidden" id="sender-name" value="<?php echo htmlspecialchars($userInfo['first_name'] . ' ' . $userInfo['last_name']); ?>">
        <div class="form-group">
            <textarea id="message-input" class="form-control" rows="3" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Send</button>
    </form>
</div>
<script src="../public/js/chat.js"></script>
</body>
</html>
