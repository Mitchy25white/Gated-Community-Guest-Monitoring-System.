<?php
session_start();
require_once "../../connect.php";

// Fetch summary data
$stmt = $pdo->prepare("
    SELECT 
        COUNT(*) as total_visitors,
        COUNT(DISTINCT CONCAT(courtNo, houseNo)) as unique_residents
    FROM guest 
    WHERE DATE(visitTime) = CURDATE()
");
$stmt->execute();
$summary = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Security Reports</title>
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
                <h1>Security Reports</h1>
            </div>
            <div class="reports-summary">
                <div class="item1">
                    <h3>Today's Summary</h3>
                    <p>Total Visitors: <?= $summary['total_visitors'] ?></p>
                    <p>Residents with Visitors: <?= $summary['unique_residents'] ?></p>
                </div>
              <div class="item2">
    <h3>Visitor Distribution</h3>
    <?php
    // Fetch visitor distribution data
    $stmt = $pdo->prepare("
        SELECT 
            COUNT(CASE WHEN visitor_count BETWEEN 1 AND 2 THEN 1 END) as residents_with_1_to_2_visitors,
            COUNT(CASE WHEN visitor_count BETWEEN 3 AND 5 THEN 1 END) as residents_with_3_to_5_visitors,
            COUNT(CASE WHEN visitor_count >= 6 THEN 1 END) as residents_with_6_plus_visitors
        FROM (
            SELECT 
                COUNT(*) as visitor_count
            FROM guest 
            WHERE DATE(visitTime) = CURDATE()
            GROUP BY CONCAT(courtNo, houseNo)
        ) as subquery
    ");
    $stmt->execute();
    $visitor_distribution = $stmt->fetch(PDO::FETCH_ASSOC);
    ?>
    <p>Residents with 1-2 Visitors: <?= $visitor_distribution['residents_with_1_to_2_visitors'] ?></p>
    <p>Residents with 3-5 Visitors: <?= $visitor_distribution['residents_with_3_to_5_visitors'] ?></p>
    <p>Residents with 6+ Visitors: <?= $visitor_distribution['residents_with_6_plus_visitors'] ?></p>
</div>

            </div>
        </div>
    </div>
</body>
</html>
