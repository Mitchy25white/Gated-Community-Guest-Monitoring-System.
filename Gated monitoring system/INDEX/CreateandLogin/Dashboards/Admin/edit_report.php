<?php
require_once "../../connect.php";

// Get report ID from URL
$id = isset($_GET['id']) ? $_GET['id'] : null;

if (!$id) {
    header("Location: manage_reports.php");
    exit();
}

// Fetch report data
$stmt = $pdo->prepare("SELECT * FROM manage_reports WHERE id = ?");
$stmt->execute([$id]);
$report = $stmt->fetch(PDO::FETCH_ASSOC);

// Redirect if report not found
if (!$report) {
    header("Location: manage_reports.php");
    exit();
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $pdo->prepare("UPDATE reports SET title = ?, description = ?, status = ? WHERE id = ?");
    $stmt->execute([
        $_POST['title'],
        $_POST['description'],
        $_POST['status'],
        $id
    ]);
    header("Location: manage_reports.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Edit Report</title>
    <link rel="stylesheet" href="../dashboard.CSS">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
    <div class="main-container">
        <div class="main">
    <div class="report-container">
        <div class="report-header">
            <h1>Edit Report</h1>
        </div>
        <div class="report-body">
            <form method="POST">
                <div class="form-group">
                    <label>Title:</label>
                    <input type="text" name="title" value="<?= htmlspecialchars($report['title']) ?>" required>
                </div>
                <div class="form-group">
                    <label>Description:</label>
                    <textarea name="description" required><?= htmlspecialchars($report['description']) ?></textarea>
                </div>
                <div class="form-group">
                    <label>Status:</label>
                    <select name="status">
                        <option value="pending" <?= $report['status'] == 'pending' ? 'selected' : '' ?>>Pending</option>
                        <option value="reviewed" <?= $report['status'] == 'reviewed' ? 'selected' : '' ?>>Reviewed</option>
                        <option value="resolved" <?= $report['status'] == 'resolved' ? 'selected' : '' ?>>Resolved</option>
                    </select>
                </div>
                <div class="form-actions">
                    <button type="submit" class="btn-submit">Update Report</button>
                    <a href="manage_reports.php" class="btn-cancel">Cancel</a>
                </div>
            </form>
        </div>
    </div>
    <style>
        .report-form {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
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
            border: 1px solid var(--Border-color);
            background: var(--background-color3);
            color: white;
            border-radius: 4px;
        }
        .form-actions {
            display: flex;
            gap: 10px;
            justify-content: flex-end;
        }
        .btn-submit, .btn-cancel {
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .btn-submit {
            background: var(--secondary-color);
            color: white;
        }
        .btn-cancel {
            background: var(--background-color3);
            color: white;
            text-decoration: none;
        }
    </style>
</body>
</html>
