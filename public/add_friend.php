<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if (!isset($_GET['friend_id'])) {
    die("Friend ID is required.");
}

require '../src/config.php';
require '../src/db.php';
require '../src/User.php';

$user = new User($db);

$userId = $_SESSION['user_id'];
$friendId = $_GET['friend_id'];

if ($user->addFriend($userId, $friendId)) {
    echo "Friend added successfully.";
} else {
    echo "Failed to add friend.";
}
?>
