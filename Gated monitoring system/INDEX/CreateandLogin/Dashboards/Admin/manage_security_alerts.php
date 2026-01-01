<?php
session_start();
require_once "../../connect.php";

// Check if user is logged in and is admin
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../../login.html");
    exit();
}

// Fetch all security alerts
$stmt = $pdo->prepare("
    SELECT sa.*, u.username
    FROM alerts sa
    JOIN users u ON sa.user_id = u.id
    ORDER BY sa.created_at DESC
");
$stmt->execute();
$alerts = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Handle alert status update
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_status'])) {
    $alert_id = $_POST['alert_id'];
    $new_status = $_POST['new_status'];

    $update_stmt = $pdo->prepare("UPDATE alerts SET status = ? WHERE id = ?");
    $update_stmt->execute([$new_status, $alert_id]);

    // Redirect to refresh the page
    header("Location: manage_security_alerts.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Security Alerts - Admin Dashboard</title>
    <link rel="stylesheet" href="../dashboard.CSS">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <style>
        .alerts-container {
            background-color: #2c3e50;
            padding: 20px;
            border-radius: 10px;
            margin-top: 20px;
        }
        .alert-card {
            background-color: #34495e;
            border-radius: 5px;
            padding: 15px;
            margin-bottom: 15px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        }
        .alert-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
        }
        .alert-type {
            font-weight: bold;
            color: #e74c3c;
        }
        .alert-status {
            padding: 5px 10px;
            border-radius: 3px;
            font-size: 0.9em;
        }
        .status-active { background-color: #e74c3c; color: white; }
        .status-resolved { background-color: #2ecc71; color: white; }
        .alert-content {
            margin-bottom: 10px;
        }
        .alert-footer {
            display: flex;
            justify-content: space-between;
            font-size: 0.9em;
            color: #bdc3c7;
        }
        .update-form {
            margin-top: 10px;
        }
        .update-form select, .update-form button {
            padding: 5px 10px;
            border-radius: 3px;
            border: none;
        }
        .update-form button {
            background-color: #3498db;
            color: white;
            cursor: pointer;
        }
        .update-form button:hover {
            background-color: #2980b9;
        }
    </style>
</head>
<body>
    <header>
        <div class="logosec">
            <div class="logo">Admin Dashboard<i class='bx bxs-shield-alt-2'></i></div>
            <div class="menu" id="menuicn"><i class='bx bx-menu'></i></div>
        </div>
    </header>

    <div class="main-container">
        <div class="navcontainer">
            <nav class="nav">
                <div class="nav-upper-options">
                    <!-- Add navigation menu items here -->
                </div>
            </nav>
        </div>

        <div class="main">
            <div class="report-container">
                <div class="report-header">
                    <h1>Manage Security Alerts</h1>
                </div>
                <div class="alerts-container">
                    <?php foreach ($alerts as $alert): ?>
                        <div class="alert-card">
                            <div class="alert-header">
                                <span class="alert-type"><?= htmlspecialchars($alert['alert_type']) ?></span>
                                <span class="alert-status status-<?= $alert['status'] ?>"><?= ucfirst($alert['status']) ?></span>
                            </div>
                            <div class="alert-content">
                                <p><?= htmlspecialchars($alert['description']) ?></p>
                                <p>Location: <?= htmlspecialchars($alert['location']) ?></p>
                            </div>
                            <div class="alert-footer">
                                <span>Reported by: <?= htmlspecialchars($alert['username']) ?></span>
                                <span>Date: <?= $alert['created_at'] ?></span>
                            </div>
                            <form class="update-form" method="POST">
                                <input type="hidden" name="alert_id" value="<?= $alert['id'] ?>">
                                <select name="new_status">
                                    <option value="active" <?= $alert['status'] == 'active' ? 'selected' : '' ?>>Active</option>
                                    <option value="resolved" <?= $alert['status'] == 'resolved' ? 'selected' : '' ?>>Resolved</option>
                                </select>
                                <button type="submit" name="update_status">Update Status</button>
                            </form>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>

    <script src="../dashboard.js"></script>
</body>
</html>
