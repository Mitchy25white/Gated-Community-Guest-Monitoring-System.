<?php
session_start();
require_once "../../connect.php";

// Get security personnel details
$stmt = $pdo->prepare("SELECT * FROM security WHERE id = ?");
$stmt->execute([$_SESSION['user_id']]);
$security = $stmt->fetch(PDO::FETCH_ASSOC);

if ($security) {
    $_SESSION['name'] = $security['firstName'] . ' ' . $security['lastName'];
    $_SESSION['contact'] = $security['phoneNo'];
    $_SESSION['dateOnDuty'] = $security['dateOnDuty'];

    // Get today's guest information
    $stmt = $pdo->prepare("SELECT * FROM guest WHERE DATE(visitTime) = CURDATE() ORDER BY visitTime DESC");
    $stmt->execute();
    $guests = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Security Dashboard - Gated Community</title>
    <link rel="stylesheet" href="../dashboard.CSS">
    <script src="menuandSearchbar.js"></script>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
    <header>
        <div class="logosec">
        <div class="logo">Security Dashboard<i class='bx bxs-shield'></i></div>
        <div class="menu" id="menuicn"><i class='bx bx-menu'></i></div>
        </div>
        <div class="searchbar">
            <input type="text" placeholder="Search...">
            <div class="searchbtn"><i class='bx bx-search-alt'></i></div>
        </div>
        <div class="profile">
            <div class="profilepic"><i class='bx bxs-user'></i></div>
            <div class="profile-dropdown">
                <div class="profile-dropdown-content">
                    <a href="security_profile.php">Profile</a>
                    <a href="../../logout.php">Logout</a>
                </div>
    </header>

    <div class="main-container">
        <div class="navcontainer">
            <div class="nav">
                <div class="nav-upper-options">
                    <div class="nav-option option1">
                        <a href="security_home.php">
                            <i class='bx bx-desktop'></i>
                            <h3>Security Dashboard</h3>
                        </a>
                    </div>
                    <div class="nav-option option2">
                        <a href="active_visitors.php">
                            <i class='bx bx-group'></i>
                            <h3>Active Visitors</h3>
                        </a>
                    </div>
                    <div class="nav-option option3">
                        <a href="alerts_notifications.php">
                            <i class='bx bxs-bell-ring'></i>
                            <h3>Alerts & Notifications</h3>
                        </a>
                    </div>
                    <div class="nav-option option4">
                        <a href="security_logs.php">
                            <i class='bx bx-history'></i>
                            <h3>Access Logs</h3>
                        </a>
                    </div>
                   <div class="nav-option option5">
                    <a href="visitor_checkin.php">
                        <i class='bx bx-log-in'></i>
                        <h3>Visitor Check-in</h3>
                        </a>
                   </div>
                    <div class="nav-option option6">
                        <a href="reports.php">
                            <i class='bx bx-file'></i>
                            <h3>Reports</h3>
                        </a>
                    </div>
                    <div class="nav-option logout">
                        <a href="../../logout.php">
                            <i class='bx bx-log-out'></i>
                            <h3>Logout</h3>
                        </a>
                    </div>
                </div>
            </div>
        </div>        
        <main>
            <div class="report-header">
                <h1>Security Monitoring</h1>
                <p id="current-date"></p>
            </div>
            <div class="report-1">
                <div class="report-topic-heading">Overview</div>
                <div class="items">
                    <?php
                    require_once "../../connect.php";
                    try {
                        // Fetch today's visitors
                        $stmt = $pdo->prepare("
                            SELECT COUNT(*) as visitor_count 
                            FROM guest 
                            WHERE DATE(visitTime) = CURDATE()
                        ");
                        $stmt->execute();
                        $visitorCount = $stmt->fetchColumn();

                        // Fetch active security personnel
                        $stmt = $pdo->prepare("
                            SELECT COUNT(*) as security_count 
                            FROM security 
                            WHERE DATE(dateOnDuty) = CURDATE()
                        ");
                        $stmt->execute();
                        $securityCount = $stmt->fetchColumn();

                        // Fetch recent security alerts
                        $stmt = $pdo->prepare("
                            SELECT * FROM alerts 
                            ORDER BY created_at DESC 
                            LIMIT 5
                        ");
                        $stmt->execute();
                        $recentAlerts = $stmt->fetchAll(PDO::FETCH_ASSOC);

                        // Fetch recent guest entries
                        $stmt = $pdo->prepare("
                            SELECT g.*, r.firstName as resident_name
                            FROM guest g
                            JOIN resident r ON g.courtNo = r.courtNo AND g.houseNo = r.houseNo
                            ORDER BY g.visitTime DESC 
                            LIMIT 5
                        ");
                        $stmt->execute();
                        $recentEntries = $stmt->fetchAll(PDO::FETCH_ASSOC);

                        echo "<div class='item1'>
                                <div class='t-op'>
                                    <i class='bx bx-group'></i>
                                    <h3>Today's Visitors</h3>
                                </div>
                                <div class='t-op-nextlvl'>
                                    <p>Total: $visitorCount</p>
                                </div>
                            </div>";

                        echo "<div class='item1'>
                                <div class='t-op'>
                                    <i class='bx bxs-shield'></i>
                                    <h3>Active Security</h3>
                                </div>
                                <div class='t-op-nextlvl'>
                                    <p>Personnel on Duty: $securityCount</p>
                                </div>
                            </div>";

                        foreach($recentEntries as $entry) {
                            echo "<div class='item1'>
                                    <div class='t-op'>
                                        <i class='bx bxs-user'></i>
                                        <h3>Recent Entry</h3>
                                    </div>
                                    <div class='t-op-nextlvl'>
                                        <p>{$entry['firstName']} {$entry['lastName']}</p>
                                        <p>Vehicle: {$entry['vehiclePlate']}</p>
                                        <p>Time: {$entry['visitTime']}</p>
                                        <p>Visiting: {$entry['resident_name']}</p>
                                    </div>
                                </div>";
                        }
                    } catch(PDOException $e) {
                        error_log("Error fetching security data: " . $e->getMessage());
                        echo "<p>Error loading security information</p>";
                    }
                    ?>
                </div>
            </div>
        </main>
    </div>
    <script src="../dashboard.js"></script>
    
    <script src="../script.js"></script>
</body>
</html>
<style>
.nav-option a {
    display: flex;
    align-items: center;
    color: inherit;
    text-decoration: none;
    width: 100%;
    padding: 10px;
}

.nav-option:hover {
    background-color: var(--hover-color);
    cursor: pointer;
}
.nav-option.active {
    background-color: var(--hover-color);
}
.nav-option i {
    margin-right: 10px;
}
</style>