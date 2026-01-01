<?php
require_once "../../connect.php";

$id = $_GET['id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $pdo->prepare("UPDATE manage_announcement SET title = ?, content = ?, priority = ? WHERE id = ?");
    $stmt->execute([
        $_POST['title'],
        $_POST['content'],
        $_POST['priority'],
        $id
    ]);
    header("Location: manage_announcements.php");
    exit();
}

$stmt = $pdo->prepare("SELECT * FROM manage_announcement WHERE id = ?");
$stmt->execute([$id]);
$announcement = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Edit Announcement</title>
    <link rel="stylesheet" href="../dashboard.CSS">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
    <div class="main-container">
        <div class="main">
            <div class="report-container">
                <div class="report-header">
                    <h1>Edit Announcement</h1>
                </div>
                <div class="report-body">
                    <form method="POST" class="announcement-form">
                        <div class="form-group">
                            <label>Title:</label>
                            <input type="text" name="title" value="<?= htmlspecialchars($announcement['title']) ?>" required>
                        </div>
                        <div class="form-group">
                            <label>Content:</label>
                            <textarea name="content" rows="6" required><?= htmlspecialchars($announcement['content']) ?></textarea>
                        </div>
                        <div class="form-group">
                            <label>Priority:</label>
                            <select name="priority">
                                <option value="low" <?= $announcement['priority'] == 'low' ? 'selected' : '' ?>>Low</option>
                                <option value="medium" <?= $announcement['priority'] == 'medium' ? 'selected' : '' ?>>Medium</option>
                                <option value="high" <?= $announcement['priority'] == 'high' ? 'selected' : '' ?>>High</option>
                            </select>
                        </div>
                        <div class="form-actions">
                            <button type="submit" class="btn-submit">Update</button>
                            <a href="manage_announcements.php" class="btn-cancel">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <style>
        .announcement-form {
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
