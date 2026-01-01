<?php
require_once "../../connect.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $pdo->prepare("INSERT INTO manage_complaints (user_id, subject, description, status) VALUES (?, ?, ?, ?)");
    $stmt->execute([
        $_POST['user_id'],
        $_POST['subject'],
        $_POST['description'],
        $_POST['status']
    ]);
    header("Location: manage_complaints.php");
    exit();
}

// Fetch users for dropdown
$stmt = $pdo->query("SELECT id, username FROM users");
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Add New Complaint</title>
    <link rel="stylesheet" href="../dashboard.CSS">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

</head>
<body>
    <header>
        <div class="logsec">
            <div class="logo">Admin Dashboard<i class='bx bxs-shield-alt-2'></i></div>
        </div>
    </header>
        
    <div class="main-container">
    <div class="report-container">
        <div class="report-header">
            <h1>Add New Complaint</h1>
        </div>
        <div class="report-body">
            <form method="POST" class="complaint-form">
                <div class="form-group">
                    <label>Resident:</label>
                    <select name="user_id" required>
                        <option value="">Select Resident</option>
                        <?php foreach($users as $user): ?>
                            <option value="<?= $user['id'] ?>"><?= $user['username'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label>Subject:</label>
                    <input type="text" name="subject" required>
                </div>

                <div class="form-group">
                    <label>Description:</label>
                    <textarea name="description" rows="4" required></textarea>
                </div>

                <div class="form-group">
                    <label>Status:</label>
                    <select name="status">
                        <option value="pending">Pending</option>
                        <option value="in-progress">In Progress</option>
                        <option value="resolved">Resolved</option>
                    </select>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn-submit">Submit Complaint</button>
                    <a href="manage_complaints.php" class="btn-cancel">Cancel</a>
                </div>
            </form>
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
