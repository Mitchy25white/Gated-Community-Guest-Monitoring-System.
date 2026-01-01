<?php
session_start();
require_once "../../connect.php";

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: ../../login.html"); // Redirect to login if not logged in
    exit();
}

// Initialize guests array
$guests = []; // Initialize to avoid undefined variable warning

// Get resident details
$stmt = $pdo->prepare("SELECT * FROM resident WHERE id = ?");
$stmt->execute([$_SESSION['user_id']]);
$resident = $stmt->fetch(PDO::FETCH_ASSOC);

if ($resident) {
    $_SESSION['courtNo'] = $resident['courtNo'];
    $_SESSION['name'] = $resident['firstName'] . ' ' . $resident['lastName'];
    $_SESSION['contact'] = $resident['phoneNo'];

    // Get guest information
    $stmt = $pdo->prepare("SELECT * FROM guest WHERE courtNo = ? ORDER BY visitTime DESC LIMIT 5");
    $stmt->execute([$resident['courtNo']]);
    $guests = $stmt->fetchAll(PDO::FETCH_ASSOC); // Fetch guests into the array
} else {
    // Handle case where resident is not found
    $_SESSION['name'] = 'Guest'; // Default name if not found
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resident Dashboard</title>
    <link rel="stylesheet" href="../dashboard.CSS"> <!-- Link to your main dashboard CSS -->
    <style>
        body {
            background-color: #1a1a2e; /* Dark background */
            color: #ffffff; /* White text */
            font-family: 'Arial', sans-serif; /* Font family */
            margin: 0;
            padding: 20px;
        }

        h1 {
            color: #9b59b6; /* Light purple for headings */
            text-align: center;
            text-shadow: 0 0 10px #9b59b6, 0 0 20px #8e44ad; /* Neon glow effect */
            margin-bottom: 20px;
        }

        .report-container {
            background-color: rgba(155, 89, 182, 0.2); /* Semi-transparent light purple */
            border: 1px solid #9b59b6; /* Light purple border */
            border-radius: 10px; /* Rounded corners */
            padding: 20px; /* Padding inside the container */
            box-shadow: 0 0 20px rgba(155, 89, 182, 0.5); /* Glow effect */
        }

        .items {
            display : flex;
            flex-direction: column;
            gap: 10px; /* Space between items */
        }

        .item1 {
            background-color: rgba(155, 89, 182, 0.3); /* Light purple for item background */
            border-radius: 8px; /* Rounded corners */
            padding: 15px; /* Padding inside items */
            transition: background-color 0.3s; /* Smooth transition for hover effect */
        }

        .item1:hover {
            background-color: rgba(155, 89, 182, 0.5); /* Darker purple on hover */
        }

        .t-op {
            font-size: 18px; /* Font size for titles */
        }

        .t-op-nextlvl {
            font-size: 16px; /* Font size for details */
        }
    </style>
</head>
<body>

<h1>Welcome to Your Dashboard, <?php echo isset($_SESSION['name']) ? htmlspecialchars($_SESSION['name']) : 'Guest'; ?></h1>

<div class="report-container">
    <h2>Recent Guests</h2>
    <div class="items">
        <?php if (!empty($guests)): // Check if guests array is not empty ?>
            <?php foreach ($guests as $guest): ?>
                <div class="item1">
                    <div class="t-op"><?php echo htmlspecialchars($guest['firstName'] . ' ' . $guest['lastName']); ?></div>
                    <div class="t-op-nextlvl">Visited on: <?php echo htmlspecialchars($guest['visitTime']); ?></div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="item1">
                <div class="t-op">No recent guests found.</div>
            </div>
        <?php endif; ?>
    </div>
</div>

</body>
</html>