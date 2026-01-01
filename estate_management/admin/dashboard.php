<?php
session_start();
require_once 'includes/db.php';  // Include your database connection

if ($_SESSION['role_id'] != 1) {  // Admin role_id should be 1
    header("Location: login.php"); // Redirect if not an admin
    exit();
}

// Fetch admin-specific data here (e.g., list of users, statistics)
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
</head>
<body>
    <h1>Admin Dashboard</h1>
    <a href="add_security.php">Add Security Guard</a><br>
    <a href="add_resident.php">Add Resident</a><br>
    <a href="logout.php">Logout</a>
</body>
</html>
