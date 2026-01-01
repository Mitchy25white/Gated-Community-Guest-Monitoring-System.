<?php
session_start();
require_once "../../connect.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $alert_type = trim($_POST['alert_type']);
    $description = trim($_POST['description']);
    $location = trim($_POST['location']);
    $user_id = $_SESSION['user_id'];

    $stmt = $pdo->prepare("
        INSERT INTO alerts (alert_type, description, location, user_id)
        VALUES (?, ?, ?, ?)
    ");

    if ($stmt->execute([$alert_type, $description, $location, $user_id])) {
        header("Location: alerts_notifications.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Create Security Alert</title>
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
                    <h1>Create New Security Alert</h1>
                </div>
                <div class="report-body">
                    <form method="POST" class="alert-form">
                        <div class="form-group">
                            <label for="alert_type">Alert Type</label>
                            <select name="alert_type" id="alert_type" required>
                                <option value="">Select Alert Type</option>
                                <option value="Emergency">Emergency</option>
                                <option value="Suspicious Activity">Suspicious Activity</option>
                                <option value="Security Breach">Security Breach</option>
                                <option value="Maintenance">Maintenance</option>
                                <option value="Other">Other</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="location">Location</label>
                            <input type="text" name="location" id="location" required>
                        </div>

                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea name="description" id="description" rows="4" required></textarea>
                        </div>

                        <div class="form-actions">
                            <button type="submit" class="btn-submit">Create Alert</button>
                            <button type="button" onclick="window.location.href='alerts_notifications.php'" class="btn-cancel">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <style>
        .alert-form {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            background: var(--background-color2);
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            color: var(--font-color);
        }
        
        
        .form-group {
            margin-bottom: 20px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
            color: var(--primary-color);
        }
        .form-group input,
        .form-group select,
        .form-group textarea {
            width: 100%;
            padding: 8px;
            border: 1px solid var(--border-color);
            border-radius: 5px;
            background: var(--background-color3);
            color: var(--font-color);
        }
        .form-actions {
            display: flex;
            gap: 10px;
            justify-content: flex-end;
        }
        .btn-submit,
        .btn-cancel {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .btn-submit {
            background: var(--secondary-color);
            color: white;
        }
        .btn-cancel {
            background: var(--background-color4);
            color: white;
        }
    </style>
</body>
</html>
