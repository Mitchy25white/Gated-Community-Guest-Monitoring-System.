<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'resident') {
    header("Location: ../../login.html");
    exit();
}

require_once "../../connect.php";
            // Fetch announcements
            $stmt = $pdo->prepare("
            SELECT 
                title,
                content,
                priority,
                created_at
            FROM manage_announcement
            ORDER BY 
                CASE priority
                    WHEN 'high' THEN 1
                    WHEN 'medium' THEN 2
                    WHEN 'low' THEN 3
                END,
                created_at DESC
            ");
            $stmt->execute();
            $announcements = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $stmt = $pdo->prepare("
    SELECT 
        e.title,
        e.description,
        e.event_date,
        u.username as created_by
    FROM process_event e
    JOIN users u ON e.created_by = u.id
    WHERE e.event_date >= CURDATE()
    ORDER BY e.event_date ASC
    LIMIT 5
");
$stmt->execute();
$upcomingEvents = $stmt->fetchAll(PDO::FETCH_ASSOC);

            ?>

<DoCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resident Dashboard - Gated Community</title>
    <link rel="stylesheet" href="../dashboard.CSS">
    <link rel="stylesheet" href="resident.js">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
        </head>
<body>
    <header>
        <div class="logosec">
        <div class="logo">Gated Monitoring<i class='bx bxs-cctv'></i></div>
        <div class="menu" id="menuicn"><i class='bx bx-menu'></i></div>
        </div>
        <div class="searchbar">
            <input type="text" placeholder="Search">
            <div class="searchbtn"><i class='bx bx-search-alt'></i></div>
        </div>
        <div class="profile">
      <div class="profile-name">
                <?php echo $_SESSION['username']; ?>
                </div>
                <div class="profile-info">
                <a href="profile.php">Profile</a>
            </div>
                <div class="profile-logout">
                    <a href="../../logout.php">Logout</a>
    </header>

    <div class="main-container">
        <div class="navcontainer">
            <div class="nav">
                <div class="nav-upper-options">
                    <div class="nav-option" ><a href= "dashboard.php" option1> 
                        <i class='bx bx-laptop'></i><h3>Resident Dashboard</h3></a>
                    </div>
                    <div class="nav-option"><a href="security_Alerts.php" option2>
                        <i class='bx bxs-alarm-exclamation'></i> <h3>Security Alerts</h3></a>
                    </div>
                    <div class="nav-option" ><a href= "Guest.php" option3>
                        <i class='bx bxs-plus-square'></i> <h3>Input Guest Information</h3>
                        </a>
                    </div>
                    <div class="nav-option"><a href="maintenance_request.php" option4>
                        <i class='bx bx-wrench'></i><h3>Maintenance Requests</h3>
                        </a>
                    </div>
                    <div class="nav-option"><a href="../../logout.php" option6>
                            <i class='bx bx-log-out'></i><h3>Logout</h3>
                            </a>
                    </div>
                </div>
            </div>
        </div>
        
        <main>
            <div class="main">
            <div class="report-container">
            <div class="report-header">
            <?php
// At the top with other database queries
$stmt = $pdo->prepare("SELECT username FROM users WHERE id = ?");
$stmt->execute([$_SESSION['user_id']]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

// Store username in a variable
$displayName = $user['username'];
?>

<!-- In your HTML welcome section -->
<h1 class="recent-Articles">Welcome, <?= htmlspecialchars($displayName) ?>!</h1>
            </div>
            <div class="report-body">

<!-- In your HTML where announcements are displayed -->
<div class="report-topic-heading">
    <h2 class="t-op">Announcements</h2>
<div class="announcements-list">
    <?php if (!empty($announcements)): ?>
        <?php foreach ($announcements as $announcement): ?>
            <div class="item1 priority-<?= $announcement['priority'] ?>">
                <div class="announcement-title">
                    <?= $announcement['title'] ?>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <div class="item1">
            <p>No announcements available at this time.</p>
        </div>
    <?php endif; ?>
</div>
</div>
    

    <div class="report-topic-heading">
        <h2 class="t-op">Security Alerts</h2>
        <?php if (!empty($securityAlerts)): ?>
            <?php foreach ($securityAlerts as $alert): ?>
                <div class="item1">
                    <p class="t-op-nextlvl"><?php echo htmlspecialchars($alert['message']); ?></p>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p class="t-op-nextlvl">No security alerts at this time.</p>
        <?php endif; ?>
    </div>

    <div class="report-topic-heading">
        <h2 class="t-op">Upcoming Events</h2>
        <?php if (!empty($upcomingEvents)): ?>
            <?php foreach($upcomingEvents as $event): ?>
                <div class="item1">
                    <h3><?= htmlspecialchars($event['title']) ?></h3>
                    <p class="t-op-nextlvl"><?= htmlspecialchars($event['description']) ?></p>
                    <div class="event-meta">
                        <span class="date">Date: <?= $event['event_date'] ?></span>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p class="t-op-nextlvl">No upcoming events.</p>
        <?php endif; ?>
    </div>
            
    <script>
        document.getElementById('current-date').textContent = 'Date: ' + new Date().toLocaleDateString();
    </script>
    <script src="../dashboard.js"></script>
</body>
</html>
<?php

