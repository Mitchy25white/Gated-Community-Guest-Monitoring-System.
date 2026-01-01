<?php
require_once "../../connect.php";

$id = $_GET['id'];
$stmt = $pdo->prepare("SELECT c.*, u.username FROM manage_complaints c JOIN users u ON c.user_id = u.id WHERE c.id = ?");
$stmt->execute([$id]);
$complaint = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>View Complaint</title>
    <link rel="stylesheet" href="../dashboard.CSS">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
    <div class="main-container">
        <div class="main">
            <div class="report-container">
                <div class="report-header">
                    <h1>Complaint Details</h1>
                </div>
                <div class="report-body">
                    <div class="complaint-details">
                        <p class="subject">Subject: <?= htmlspecialchars($complaint['subject']) ?></p>
                        <p class="resident">Filed by: <?= htmlspecialchars($complaint['username']) ?></p>
                        <p class="status">Status: <?= htmlspecialchars($complaint['status']) ?></p>
                        <p class="date">Date: <?= $complaint['created_at'] ?></p>
                        <div class="description">
                            <?= nl2br(htmlspecialchars($complaint['description'])) ?>
                        </div>
                        <div class="actions">
                            <a href="manage_complaints.php" class="btn-back">Back to List</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
