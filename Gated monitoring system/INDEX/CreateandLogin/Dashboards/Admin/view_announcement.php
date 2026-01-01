<?php
require_once "../../connect.php";

$id = $_GET['id'];
$stmt = $pdo->prepare("SELECT a.*, u.username FROM manage_announcement a JOIN users u ON a.created_by = u.id WHERE a.id = ?");
$stmt->execute([$id]);
$announcement = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>View Announcement</title>
    <link rel="stylesheet" href="../dashboard.CSS">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
    <div class="main-container">
        <div class="main">
            <div class="report-container">
                <div class="report-header">
                    <h1><?= htmlspecialchars($announcement['title']) ?></h1>
                </div>
                <div class="report-body">
                    <div class="announcement-details">
                        <p class="priority">Priority: <?= htmlspecialchars($announcement['priority']) ?></p>
                        <p class="author">Posted by: <?= htmlspecialchars($announcement['username']) ?></p>
                        <p class="date">Date: <?= $announcement['created_at'] ?></p>
                        <div class="content">
                            <?= nl2br(htmlspecialchars($announcement['content'])) ?>
                        </div>
                        <div class="actions">
                            <a href="manage_announcements.php" class="btn-back">Back to List</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
