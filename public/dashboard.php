<?php
require_once '../includes/auth.php';
require_login();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="dashboard-container">
        <h1>Welcome to the Dashboard</h1>
        <?php if (is_super_user()): ?>
            <a href="user-management.php">Manage Users</a>
        <?php endif; ?>
        <a href="logout.php">Logout</a>
    </div>
</body>
</html>
