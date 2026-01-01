<?php
session_start();
require_once "../../connect.php";

// Get today's statistics
$stmt = $pdo->prepare("SELECT COUNT(*) FROM guest WHERE DATE(visitTime) = CURDATE()");
$stmt->execute();
$todayGuests = $stmt->fetchColumn();

// Get recent guests
$stmt = $pdo->prepare("SELECT * FROM guest ORDER BY visitTime DESC LIMIT 5");
$stmt->execute();
$guests = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Security Dashboard - Gated Community</title>
    <link rel="stylesheet" href="../dashboard.CSS">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
    <div class="main-">
        
<div class="report-container">
    <div class="report-header">
        <h1>Security Overview</h1>
    </div>
    <div class="items">
        <div class="item1">
            <i class='bx bxs-user-check'></i>
            <h3>Today's Visitors</h3>
            <span class="t-op-nextlvl"><?php echo $todayGuests; ?></span>
        </div>
        
        <h3>Recent Visitors</h3>
        <?php foreach($guests as $guest): ?>
            <div class="item1">
                <div class="t-op">
                    <i class='bx bxs-user'></i>
                    <h3><?php echo $guest['firstName'] . ' ' . $guest['lastName']; ?></h3>
                </div>
                <div class="t-op-nextlvl">
                    <p>Court No: <?php echo $guest['courtNo']; ?></p>
                    <p>Visit Time: <?php echo $guest['visitTime']; ?></p>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
    <script src="../dashboard.js"></script>
    </body>
    </html>