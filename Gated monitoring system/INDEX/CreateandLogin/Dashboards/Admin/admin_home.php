<?php
session_start();
require_once "../../connect.php";

// Get statistics
$stmt = $pdo->prepare("SELECT COUNT(*) FROM resident");
$stmt->execute();
$totalResidents = $stmt->fetchColumn();

$stmt = $pdo->prepare("SELECT COUNT(*) FROM security");
$stmt->execute();
$totalSecurity = $stmt->fetchColumn();

$stmt = $pdo->prepare("SELECT COUNT(*) FROM guest WHERE DATE(visitTime) = CURDATE()");
$stmt->execute();
$todayGuests = $stmt->fetchColumn();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Reports - Admin Dashboard</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <style>
    body {
            background: #1a1a2e; /* Dark background */
            font-family: 'Times New Roman', Times, serif;
            color: #ffffff; /* White text */
        }
        .report-container {
            background: rgba(30, 30, 47, 0.9); /* Semi-transparent dark background */
            border: 2px solid #9b59b6; /* Neon purple border */
            border-radius: 10px; /* Rounded corners */
            padding: 20px; /* Inner padding */
            margin: 20px auto; /* Center the container */
            max-width: 600px; /* Max width for the container */
            box-shadow: 0 0 20px rgba(155, 89, 182, 0.7); /* Neon glow effect */
        }
        .report-header {
            text-align: center;
            margin-bottom: 20px;
            color: #9b59b6; /* Neon purple */
            text-shadow: 0 0 10px #9b59b6, 0 0 20px #8e44ad; /* Neon glow */
        }
        .items {
            display: flex;
            flex-direction: column;
            gap: 15px; /* Space between items */
        }
        .item1 {
            display: flex;
            align-items: center;
            background: rgba(255, 255, 255, 0.1); /* Semi-transparent item background */
            padding: 10px; /* Inner padding */
            border-radius: 8px; /* Rounded corners */
            color: #ffffff; /* Light text color */
            box-shadow: 0 0 10px rgba(155, 89, 182, 0.5); /* Neon glow effect */
            transition: transform 0.2s; /* Smooth transition */
        }
        .item1:hover {
            transform: scale(1.05); /* Slightly enlarge on hover */
        }
        .item1 i {
            font-size: 24px; /* Icon size */
            margin-right: 10px; /* Space between icon and text */
            color: #9b59b6; /* Neon purple */
        }
        .t-op {
            font-size: 18px; /* Text size */
            color: #ecf0f1; /* Light text color */
        }
        .t-op-nextlvl {
            font-size: 24px; /* Text size */
            color: #ffffff; /* Light text color */
            font-weight: bold; /* Bold text */
            margin-top: 10px; /* Space above the text */
            border-bottom: 2px solid #9b59b6; /* Neon purple line */
            display: inline-block; /* Ensure the line doesn't take full width */
            padding-bottom: 5px; /* Space between the text and the line */
            margin-bottom: 10px; /* Space below the text */
            margin-top: 10px; /* Space above the text */
          justify-content: space-between;
          align-items: center;
          gap: 10px;


        }

      </style>

<div class="report-container">
    <div class="report-header">
        <h1>Admin Dashboard</h1>
    </div>
    <div class="items">
        <div class="item1">
            <i class='bx bxs-home'></i>
            <h3>Total Residents</h3>
            <span class="t-op-nextlvl"><?php echo $totalResidents; ?></span>
        </div>
        <div class="item1">
            <i class='bx bxs-shield'></i>
            <h3>Security Personnel</h3>
            <span class="t-op-nextlvl"><?php echo $totalSecurity; ?></span>
        </div>
        <div class="item1">
            <i class='bx bxs-group'></i>
            <h3>Today's Visitors</h3>
            <span class="t-op-nextlvl"><?php echo $todayGuests; ?></span>
        </div>
    </div>
</div>
</body>
</html>
