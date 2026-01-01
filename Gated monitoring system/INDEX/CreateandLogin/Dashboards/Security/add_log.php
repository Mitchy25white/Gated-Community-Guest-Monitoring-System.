<?php
session_start();
require_once "../../connect.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $stmt = $pdo->prepare("INSERT INTO security_logs (log_type, title, description, location, severity, logged_by) VALUES (?, ?, ?, ?, ?, ?)");
        
        $stmt->execute([
            $_POST['log_type'],
            $_POST['title'],
            $_POST['description'],
            $_POST['location'],
            $_POST['severity'],
            $_SESSION['user_id']
        ]);
        
        header("Location: security_logs.php?success=1");
    } catch(PDOException $e) {
        header("Location: security_logs.php?error=1");
    }
}
