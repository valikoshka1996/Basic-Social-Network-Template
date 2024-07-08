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
$searchResults = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $searchResults = $user->searchUsers($_POST['search_query']);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Users</title>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>
<?php include '../includes/nav.php'; ?>
<div class="container">
    <h1>Search Users</h1>
    <form action="search.php" method="POST">
        <div class="form-group">
            <input type="text" class="form-control" name="search_query" placeholder="Search for users..." required>
        </div>
        <button type="submit" class="btn btn-primary">Search</button>
    </form>
    <?php if (!empty($searchResults)): ?>
        <h2>Search Results</h2>
        <ul class="list-group">
            <?php foreach ($searchResults as $result): ?>
                <li class="list-group-item">
                    <?php echo htmlspecialchars($result['first_name'] . ' ' . $result['last_name']); ?>
                    <a href="chat.php?user_id=<?php echo $result['id']; ?>" class="btn btn-primary btn-sm">Chat</a>

                </li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
</div>
</body>
</html>
