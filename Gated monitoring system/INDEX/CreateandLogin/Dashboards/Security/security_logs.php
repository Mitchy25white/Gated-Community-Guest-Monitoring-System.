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
        <h1>Security Logs</h1>
    </div>
    <div class="report-body">
            <form method="POST" action="add_log.php">
                <div class="form-group">
                <label for="log_type">Log Type:</label>
                <select name="log_type" required>
                    <option value="access">Access Log</option>
                    <option value="incident">Incident Log</option>
                    <option value="patrol">Patrol Log</option>
                </select></div>
                <div class="form-group">
                    <label for="title">Log Title:</label>
                <input type="text" name="title" placeholder="Log Title" required></div>
                <div class="form-group">
                <label for="description">Detailed Description:</label>
                <textarea name="description" placeholder="Detailed Description" required></textarea></div>
                <div class="form-group">
                <label for="location">Location:</label>
                <input type="text" name="location" placeholder="Location"></div>
                <div class="form-group">
                    <label for="severity">Severity:</label>
                <select name="severity" required>
                    <option value="low">Low</option>
                    <option value="medium">Medium</option>
                    <option value="high">High</option>
                </select></div>
                <div class="form-group">
                <button type="submit" class="add">Add Log Entry</button></div>
            </form>
        </div>
        
        <div class="logs-display">
            <?php
            require_once "../../connect.php";
            
            $stmt = $pdo->query("SELECT * FROM logs ORDER BY created_at DESC LIMIT 10");
            while($log = $stmt->fetch()) {
                echo "<div class='log-entry severity-{$log['severity']}'>";
                echo "<h3>{$log['title']}</h3>";
                echo "<p>{$log['description']}</p>";
                echo "<span class='log-meta'>Type: {$log['log_type']} | Location: {$log['location']} | " . 
                     date('Y-m-d H:i', strtotime($log['created_at'])) . "</span>";
                echo "</div>";
            }
            ?>
        </div>
    </div>
</div>
</div>

<style>
    .log-entry {
    padding: 15px;
    margin: 10px 0;
    border-radius: 5px;
    border-left: 4px solid #ccc;
}


.severity-high {
    border-left-color: #ff4444;
    background: #fff5f5;
}

.severity-medium {
    border-left-color: #ffbb33;
    background: #fff9f0;
}

.severity-low {
    border-left-color: #00C851;
    background: #f0fff4;
}

.log-meta {
    font-size: 0.8em;
    color: #666;
    display: block;
    margin-top: 5px;
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
        .add {
            padding: 10px 30px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            background: var(--secondary-color);
            color: white;
            font-size: 16px;
            transition: background 0.3s ease;
        }
            .add:hover {
            background: #0056b3;
            
        }
</style>
</body>
</html>