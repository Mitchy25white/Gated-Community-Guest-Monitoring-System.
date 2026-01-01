<?php
require '../includes/config.php';
require '../includes/functions.php';

check_login();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = htmlspecialchars($_POST['username']);
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $role_id = (int)$_POST['role_id'];

    $stmt = $pdo->prepare("INSERT INTO users (username, password, role_id) VALUES (:username, :password, :role_id)");
    $stmt->execute([
        ':username' => $username,
        ':password' => $password,
        ':role_id' => $role_id,
    ]);

    header("Location: dashboard.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Add User</title>
</head>
<body>
    <h1>Add User</h1>
    <form method="post">
        <label>Username:</label>
        <input type="text" name="username" required><br>
        <label>Password:</label>
        <input type="password" name="password" required><br>
        <label>Role:</label>
        <select name="role_id">
            <option value="1">Admin</option>
            <option value="2">Resident</option>
            <option value="3">Security</option>
        </select><br>
        <button type="submit">Add User</button>
    </form>
</body>
</html>
