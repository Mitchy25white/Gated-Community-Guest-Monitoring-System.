<?php
session_start();
require_once "../../connect.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Surveillance</title>
    <link rel="stylesheet" href="../dashboard.CSS">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
    <div class="main">
        <div class="report-container">
            <div class="report-header">
                <h1>Surveillance System</h1>
            </div>
            <div class="surveillance-grid">
                <!-- Add your surveillance camera feeds or monitoring system here -->
                <div class="camera-feed">
                    <h3>Main Gate</h3>
                    <!-- Camera feed placeholder -->
                </div>
                <div class="camera-feed">
                    <h3>Back Gate</h3>
                    <!-- Camera feed placeholder -->
                </div>
                <!-- Add more camera feeds as needed -->
            </div>
        </div>
    </div>
</body>
</html>
