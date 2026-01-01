<?php
require_once "../../connect.php";

$id = $_GET['id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $pdo->prepare("UPDATE manage_complaints SET subject = ?, description = ?, status = ? WHERE id = ?");
    $stmt->execute([
        $_POST['subject'],
        $_POST['description'],
        $_POST['status'],
        $id
    ]);
    header("Location: manage_complaints.php");
    exit();
}

$stmt = $pdo->prepare("SELECT * FROM manage_complaints WHERE id = ?");
$stmt->execute([$id]);
$complaint = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Edit Complaint</title>
    <link rel="stylesheet" href="../dashboard.CSS">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
    <div class="main-container">
        <div class="main">
            <div class="report-container">
                <div class="report-header">
                    <h1>Edit Complaint</h1>
                </div>
                <div class="report-body">
                    <form method="POST" class="complaint-form">
                        <div class="form-group">
                            <label>Subject:</label>
                            <input type="text" name="subject" value="<?= htmlspecialchars($complaint['subject']) ?>" required>
                        </div>
                        <div class="form-group">
                            <label>Description:</label>
                            <textarea name="description" rows="6" required><?= htmlspecialchars($complaint['description']) ?></textarea>
                        </div>
                        <div class="form-group">
                            <label>Status:</label>
                            <select name="status">
                                <option value="pending" <?= $complaint['status'] == 'pending' ? 'selected' : '' ?>>Pending</option>
                                <option value="in-progress" <?= $complaint['status'] == 'in-progress' ? 'selected' : '' ?>>In Progress</option>
                                <option value="resolved" <?= $complaint['status'] == 'resolved' ? 'selected' : '' ?>>Resolved</option>
                            </select>
                        </div>
                        <div class="form-actions">
                            <button type="submit" class="btn-submit">Update</button>
                            <a href="manage_complaints.php" class="btn-cancel">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <style>
        .complaint-form {
            max-width: 600px;
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
            padding: 30px;
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
