<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

require '../src/config.php';
require '../src/db.php';
require '../src/User.php';

$user = new User($db);
$userInfo = $user->getUserById($_SESSION['user_id']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>
<?php include '../includes/nav.php'; ?>
<div class="container">
    <h1>Welcome, <?php echo htmlspecialchars($userInfo['first_name']); ?></h1>
    <div class="profile-info">
        <img src="images/profile_pics/<?php echo htmlspecialchars($userInfo['profile_pic']); ?>" alt="Profile Picture">
        <p>Name: <?php echo htmlspecialchars($userInfo['first_name'] . ' ' . $userInfo['last_name']); ?></p>
        <p>Birthdate: <?php echo htmlspecialchars($userInfo['birthdate']); ?></p>
        <p>Email: <?php echo htmlspecialchars($userInfo['email']); ?></p>
    </div>
</div>
</body>
</html>
