<?php
require_once "../../connect.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $pdo->prepare("INSERT INTO manage_announcement (title, content, priority, created_by) VALUES (?, ?, ?, ?)");
    $stmt->execute([
        $_POST['title'],
        $_POST['content'],
        $_POST['priority'],
        $_SESSION['user_id']
    ]);
    header("Location: manage_announcements.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Add Announcement</title>
    <link rel="stylesheet" href="../dashboard.CSS">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
    <header>
        <div class="logosec">
            <div class="logo">Add Announcement<i class='bx bxs-bell'></i></div>
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
                    <!-- Add other navigation options -->
                </div>
            </nav>
        </div>

        <div class="main">
            <div class="report-container">
                <div class="report-header">
                    <h1>Create New Announcement</h1>
                </div>
                <div class="report-body">
                    <form method="POST" class="announcement-form">
                        <div class="form-group">
                            <label>Title:</label>
                            <input type="text" name="title" required>
                        </div>

                        <div class="form-group">
                            <label>Content:</label>
                            <textarea name="content" rows="6" required></textarea>
                        </div>

                        <div class="form-group">
                            <label>Priority:</label>
                            <select name="priority">
                                <option value="low">Low</option>
                                <option value="medium">Medium</option>
                                <option value="high">High</option>
                            </select>
                        </div>

                        <div class="form-actions">
                            <button type="submit" class="btn-submit">Publish Announcement</button>
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
