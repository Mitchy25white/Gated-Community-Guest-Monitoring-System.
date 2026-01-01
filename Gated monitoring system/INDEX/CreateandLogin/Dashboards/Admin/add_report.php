<?php
require_once "../../connect.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $pdo->prepare("INSERT INTO manage_reports (user_id, title, description, status) VALUES (?, ?, ?, ?)");
    $stmt->execute([
        $_SESSION['user_id'],
        $_POST['title'],
        $_POST['description'],
        $_POST['status']
    ]);
    header("Location: manage_reports.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Add Report</title>
    <link rel="stylesheet" href="../dashboard.CSS">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
    <header>
        <div class="logosec">
            <div class="logo">Add Report<i class='bx bxs-file'></i></div>
            <div class="menu" id="menuicn"><i class='bx bx-menu'></i></div>
        </div>
    </header>

    <div class="main-container">
        <div class="navcontainer">
            <nav class="nav">
                <div class="nav-upper-options">
                    <div class="nav-option">
                        <a href="adminpage.php">
                            <i class='bx bxs-dashboard'></i>
                            <h3>Dashboard</h3>
                        </a>
                    </div>
                </div>
            </nav>
        </div>

        <div class="main">
            <div class="report-container">
                <div class="report-header">
                    <h1>Create New Report</h1>
                </div>
                <div class="report-body">
                    <form method="POST" class="report-form">
                        <div class="form-group">
                            <label>Title:</label>
                            <input type="text" name="title" required>
                        </div>

                        <div class="form-group">
                            <label>Description:</label>
                            <textarea name="description" rows="6" required></textarea>
                        </div>

                        <div class="form-group">
                            <label>Status:</label>
                            <select name="status">
                                <option value="pending">Pending</option>
                                <option value="reviewed">Reviewed</option>
                                <option value="resolved">Resolved</option>
                            </select>
                        </div>

                        <div class="form-actions">
                            <button type="submit" class="btn-submit">Submit Report</button>
                            <a href="manage_reports.php" class="btn-cancel">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
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
