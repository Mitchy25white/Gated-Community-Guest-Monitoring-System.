<?php
require_once "../../connect.php";

$id = $_GET['id'];
$stmt = $pdo->prepare("SELECT r.*, u.username FROM manage_reports r JOIN users u ON r.user_id = u.id WHERE r.id = ?");
$stmt->execute([$id]);
$report = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>View Report</title>
    <link rel="stylesheet" href="../dashboard.CSS">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
    <div class="main-container">
    <div class="main">
    <div class="report-container">
        <div class="report-header">
            <h1>Report Details</h1>
        </div>
        <div class="report-body">
            <h2><?php echo $report['title']; ?></h2>
            <p>Submitted by: <?php echo $report['username']; ?></p>
            <p>Status: <?php echo $report['status']; ?></p>
            <p>Created: <?php echo $report['created_at']; ?></p>
            <div class="description">
                <?php echo $report['description']; ?>
            </div>
            <a href="manage_reports.php" class="btn">Back to Reports</a>
        </div>
    </div>
</body>
</html>
