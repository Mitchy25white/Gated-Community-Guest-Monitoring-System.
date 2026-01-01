<?php
session_start();
require_once "../../connect.php";

$stmt = $pdo->prepare("
    SELECT sa.*, u.username
    FROM alerts sa
    JOIN users u ON sa.user_id = u.id
    ORDER BY sa.created_at DESC
");
$stmt->execute();
$alerts = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Alerts & Notifications</title>
    <link rel="stylesheet" href="../dashboard.CSS">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
<header>
        <div class="logosec">
        <div class="logo">Security Dashboard<i class='bx bxs-shield'></i></div>
        <div class="menu" id="menuicn"><i class='bx bx-menu'></i></div>
        </div>
        
    </header>
    <div class="main-container">
    <div class="main">
        <div class="report-container">
            <div class="report-header">
                <h1>Security Alerts</h1>
                <button onclick="location.href='create_alert.php'" class="btn-new">New Alert</button>
            </div>
            <div class="alerts-list">
                <?php foreach($alerts as $alert): ?>
                    <div class="item1">
                        <div class="alert-type"><?= htmlspecialchars($alert['alert_type']) ?></div>
                        <p><?= htmlspecialchars($alert['description']) ?></p>
                        <div class="alert-meta">
                            <span>Location: <?= htmlspecialchars($alert['location']) ?></span>
                            <span>Status: <?= htmlspecialchars($alert['status']) ?></span>
                            <span>Reported by: <?= htmlspecialchars($alert['username']) ?></span>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    
</body>
</html>
