<?php
require_once "../../connect.php";

// Fetch active alerts
$stmt = $pdo->prepare("
    SELECT 
        sa.id,
        sa.alert_type,
        sa.description,
        sa.location,
        sa.status,
        sa.created_at,
        u.username as reported_by
    FROM alerts sa
    JOIN users u ON sa.user_id = u.id
    ORDER BY sa.created_at DESC
");$stmt->execute();
$alerts = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Security Alerts</title>
    <link rel="stylesheet" href="../dashboard.CSS">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
    <header>
        <div class="logosec">
            <div class="logo">Security Alerts<i class='bx bxs-bell-ring'></i></div>
        </div>
    </header>

    <div class="main-container">
        <div class="main">
            <div class="report-container">
                <div class="report-header">
                    <h1>Active Security Alerts</h1>
                </div>
                <div class="report-body">
                    <div class="alerts-container">
                        <?php foreach($alerts as $alert): ?>
                            <div class="alert-card <?= $alert['status'] ?>">
                                <div class="alert-header">
                                    <span class="alert-type"><?= htmlspecialchars($alert['alert_type']) ?></span>
                                    <span class="alert-status"><?= htmlspecialchars($alert['status']) ?></span>
                                </div>
                                <div class="alert-content">
                                    <p class="location"><i class='bx bxs-map'></i> <?= htmlspecialchars($alert['location']) ?></p>
                                    <p class="description"><?= htmlspecialchars($alert['description']) ?></p>
                                </div>
                                <div class="alert-footer">
                                    <span class="reported-by">Reported by: <?= htmlspecialchars($alert['reported_by']) ?></span>
                                    <span class="timestamp"><?= $alert['created_at'] ?></span>
                                </div>
                                <div class="alert-actions">
                                    <button onclick="updateStatus(<?= $alert['id'] ?>, 'resolved')" class="btn-resolve">Resolve</button>
                                    <button onclick="viewDetails(<?= $alert['id'] ?>)" class="btn-view">View Details</button>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .alerts-container {
            display: grid;
            gap: 20px;
            padding: 20px;
        }
        .alert-card {
            background: var(--background-color3);
            border-radius: 10px;
            padding: 15px;
            box-shadow: 0 0 10px rgba(155, 89, 182, 0.3);
        }
        .alert-card.active {
            border-left: 4px solid #ff4757;
        }
        .alert-card.resolved {
            border-left: 4px solid #2ed573;
        }
        .alert-header {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
        }
        .alert-type {
            color: var(--primary-color);
            font-weight: bold;
        }
        .alert-content {
            margin: 15px 0;
        }
        .alert-footer {
            display: flex;
            justify-content: space-between;
            font-size: 0.9em;
            color: #777;
        }
        .alert-actions {
            margin-top: 15px;
            display: flex;
            gap: 10px;
        }
        .btn-resolve, .btn-view {
            padding: 8px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .btn-resolve {
            background: var(--secondary-color);
            color: white;
        }
        .btn-view {
            background: var(--background-color4);
            color: white;
        }
    </style>

    <script>
        function updateStatus(alertId, status) {
            fetch('update_alert_status.php', {
                method: 'POST',
                body: JSON.stringify({ id: alertId, status: status }),
                headers: { 'Content-Type': 'application/json' }
            }).then(() => location.reload());
        }

        function viewDetails(alertId) {
            window.location.href = `view_Alert.php?id=${alertId}`;
        }
    </script>
</body>
</html>
