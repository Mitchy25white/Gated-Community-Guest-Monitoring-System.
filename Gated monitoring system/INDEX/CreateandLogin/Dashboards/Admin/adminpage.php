<?php
session_start();

// Check if user is logged in and is admin
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../../login.html");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Gated Community</title>
    <link rel="stylesheet" href="../dashboard.CSS">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
    <header>
        <div class="logosec">
            <div class="logo">Admin Dashboard<i class='bx bxs-shield-alt-2'></i></div>
            <div class="menu" id="menuicn"><i class='bx bx-menu'></i></div>
        </div>
        <div class="searchbar">
            <input type="text" placeholder="Search...">
            <div class="searchbtn"><i class='bx bx-search-alt'></i></div>
        </div>
        <div class="message">
            <div class="circle"></div>
            <i class='bx bxs-bell'></i>
            <div class="dp">
                <img src="../assets/admin-avatar.png" alt="admin">
            </div>
        </div>
    </header>

    <div class="main-container">
        <div class="navcontainer">
            <nav class="nav">
                <div class="nav-upper-options">
                    <div class="nav-option"><a href="manage_users.php" option2>
                        <i class='bx bxs-user-check'></i><h3>User Management</h3>
                    </a>
                    </div>
     <div class="nav-option"><a href="manage_announcements.php" option3>
        <i class='bx bxs-bullseye'></i><h3>Manage Announcements</h3>
        </a>
        </div>
        <div class="nav-option"><a href="manage_complaints.php" option4>
            <i class='bx bxs-bug'></i><h3>Manage Complaints</h3>
            </a>
            </div>
            <div class="nav-option"><a href="manage_reports.php" option5>
                <i class='bx bxs-file'></i><h3>Manage Reports</h3>
                </a>
                </div>
                <div class="nav-option"><a href="manage_security_alerts.php" option6>
                    <i class='bx bxs-bell-ring'></i><h3>Manage Security Alerts</h3>
                    </a>
                    </div>
                    <div class="nav-option"><a href="process_event.php" option7>
                        <i class='bx bxs-calendar-event'></i><h3>Event</h3>
                        </a>
                        </div>
                        
                    <div class="nav-option" ><a href="../../logout.php" option8>
                    <i class='bx bxs-log-out'></i><h3>Logout</h3>
                        </a>
                    </div>
                </div>
            </nav>
        </div>

        <div class="main">
            <div class="report-container">
                <div class="report-header">
                    <h1>Dashboard Overview</h1>
                </div>
                <div class="report-body">
                    <?php
                    require_once "../../connect.php";
                    
                    // Get counts from database
                    try {
                        $stats = [
                            'users' => $pdo->query("SELECT COUNT(*) FROM users")->fetchColumn(),
                            'guests' => $pdo->query("SELECT COUNT(*) FROM guest")->fetchColumn(),
                            'residents' => $pdo->query("SELECT COUNT(*) FROM resident")->fetchColumn(),
                            'security' => $pdo->query("SELECT COUNT(*) FROM security")->fetchColumn()
                        ];
                    } catch(PDOException $e) {
                        error_log("Error fetching stats: " . $e->getMessage());
                        $stats = ['users' => 0, 'guests' => 0, 'residents' => 0, 'security' => 0];
                    }
                    ?>
                    
                    <div class="report-items">
                        <div class="item1">
                            <i class='bx bxs-user'></i>
                            <h3 class="items">Total Users</h3>
                            <span class="t-op-nextlvl"><?php echo $stats['users']; ?></span>
                        </div>

                        <div class="item1">
                            <i class='bx bxs-group'></i>
                            <h3 class="items">Active Guests</h3>
                            <span class="t-op-nextlvl"><?php echo $stats['guests']; ?></span>
                        </div>

                        <div class="item1">
                            <i class='bx bxs-home'></i>
                            <h3 class="items">Residents</h3>
                            <span class="t-op-nextlvl"><?php echo $stats['residents']; ?></span>
                        </div>

                        <div class="item1">
                            <i class='bx bxs-shield'></i>
                            <h3 class="items">Security Personnel</h3>
                            <span class="t-op-nextlvl"><?php echo $stats['security']; ?></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="../dashboard.js"></script>
</body>
</html>
