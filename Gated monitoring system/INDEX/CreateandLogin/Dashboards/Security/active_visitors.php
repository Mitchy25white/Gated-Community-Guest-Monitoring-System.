<?php
session_start();
require_once "../../connect.php";

$stmt = $pdo->prepare("
    SELECT g.*, r.firstName as resident_name 
    FROM active_guests g
    JOIN resident r ON g.courtNo = r.courtNo AND g.houseNo = r.houseNo
    WHERE DATE(g.visitTime) = CURDATE()
    ORDER BY g.visitTime DESC
");
$stmt->execute();
$activeVisitors = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Active Visitors</title>
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
            <h1>Active Visitors</h1>
        </div>
        <div class="active-visitors">
            <h2>Currently Active Visitors</h2>
            <div class="visitors-list">
                <?php
                // Check if the query execution was successful
                if ($stmt->execute()) {
                    $activeVisitors = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    // Display the results in a structured way
                    echo "<div class='visitor-container'>";
                    if (count($activeVisitors) > 0) {
                        foreach($activeVisitors as $visitor) {
                            echo "<div class='visitor-card'>";
                            echo "<h3>Visitor: {$visitor['visitorName']}</h3>";
                            echo "<p>Visiting: {$visitor['resident_name']}</p>";
                            echo "<p>Court: {$visitor['courtNo']}, House: {$visitor['houseNo']}</p>";
                            echo "<p>Visit Time: " . date('Y-m-d H:i', strtotime($visitor['visitTime'])) . "</p>";
                            echo "<p>Purpose: {$visitor['purpose']}</p>";
                            echo "</div>";
                        }
                    } else {
                        echo "<p>No active visitors found</p>";
                    }
                    echo "</div>";
                } else {
                    echo "<p>Error fetching active visitors</p>";
                }
                ?>
            </div>
        </div>
    </div>
</div>
</body>
</html>

