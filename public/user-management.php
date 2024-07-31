<?php
require_once '../includes/auth.php';
require_once '../config/database.php';
require_login();
require_super_user();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['create_user'])) {
        $username = $_POST['username'];
        $password = password_hash($_POST['password']);
        $role = $_POST['role'];

        $stmt = $pdo->prepare("INSERT INTO users (username, password, role) VALUES (?, ?, ?)");
        $stmt->execute([$username, $password, $role]);
    } elseif (isset($_POST['toggle_user'])) {
        $user_id = $_POST['user_id'];
        $is_active = $_POST['is_active'] ? 0 : 1;

        $stmt = $pdo->prepare("UPDATE users SET is_active = ? WHERE id = ?");
        $stmt->execute([$is_active, $user_id]);
    }
}

$stmt = $pdo->query("SELECT * FROM users");
$users = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="user-management-container">
        <h2>User Management</h2>
        <form method="POST">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <select name="role">
                <option value="user">User</option>
                <option value="admin">Admin</option>
            </select>
            <button type="submit" name="create_user">Create User</button>
        </form>
        <table>
            <tr>
                <th>Username</th>
                <th>Role</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
            <?php foreach ($users as $user): ?>
            <tr>
                <td><?php echo $user['username']; ?></td>
                <td><?php echo $user['role']; ?></td>
                <td><?php echo $user['is_active'] ? 'Active' : 'Inactive'; ?></td>
                <td>
                    <form method="POST">
                        <input type="hidden" name="user_id" value="<?php echo $user['id']; ?>">
                        <input type="hidden" name="is_active" value="<?php echo $user['is_active']; ?>">
                        <button type="submit" name="toggle_user">
                            <?php echo $user['is_active'] ? 'Disable' : 'Enable'; ?>
                        </button>
                    </form>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <a href="dashboard.php">Back to Dashboard</a>
    </div>
</body>
</html>
