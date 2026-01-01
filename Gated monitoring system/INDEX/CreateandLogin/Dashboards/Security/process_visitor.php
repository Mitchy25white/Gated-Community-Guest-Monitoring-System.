<?php
session_start();
require_once "../../connect.php";

// Verify security personnel access
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'security') {
    header("Location: ../../login.html");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Handle Check-in
    if ($_POST['action'] === 'checkin') {
        $stmt = $pdo->prepare("
            INSERT INTO active_visitors (
                visitor_name, 
                purpose, 
                host_resident_id, 
                expected_checkout, 
                status
            ) VALUES (?, ?, ?, ?, 'active')
        ");

        $result = $stmt->execute([
            $_POST['visitor_name'],
            $_POST['purpose'],
            $_POST['host_resident'],
            $_POST['expected_checkout']
        ]);

        if ($result) {
            // Log the check-in
            $logStmt = $pdo->prepare("
                INSERT INTO security_logs (
                    log_type, 
                    title, 
                    description, 
                    severity, 
                    logged_by
                ) VALUES (
                    'access', 
                    'Visitor Check-in', 
                    ?, 
                    'low', 
                    ?
                )
            ");
            
            $logDescription = "Visitor {$_POST['visitor_name']} checked in";
            $logStmt->execute([$logDescription, $_SESSION['user_id']]);
            
            header("Location: active_visitors.php?success=checkin");
            exit();
        }
    }

    // Handle Check-out
    if ($_POST['action'] === 'checkout') {
        $stmt = $pdo->prepare("
            UPDATE active_visitors 
            SET status = 'checked_out', 
                actual_checkout = CURRENT_TIMESTAMP 
            WHERE id = ? AND status = 'active'
        ");

        $result = $stmt->execute([$_POST['visitor_id']]);

        if ($result) {
            // Log the check-out
            $logStmt = $pdo->prepare("
                INSERT INTO security_logs (
                    log_type, 
                    title, 
                    description, 
                    severity, 
                    logged_by
                ) VALUES (
                    'access', 
                    'Visitor Check-out', 
                    ?, 
                    'low', 
                    ?
                )
            ");
            
            $logDescription = "Visitor checked out";
            $logStmt->execute([$logDescription, $_SESSION['user_id']]);
            
            header("Location: active_visitors.php?success=checkout");
            exit();
        }
    }
}

header("Location: active_visitors.php?error=1");
exit();
