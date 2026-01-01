<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Security Dashboard - Gated Community</title>
    <link rel="stylesheet" href="../dashboard.CSS">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
    <header>
        <div class="logosec">
            <div class="logo">Security Dashboard<i class='bx bxs-shield'></i></div>
            <div class="menu" id="menuicn"><i class='bx bx-menu'></i></div>
        </div>
        </header>
        <div class="main-container">
            <div class="main">
<div class="report-container">
    <div class="report-header">
        <h1>Visitor Check-In</h1>
    </div>
    <div class="report-body">
        <form method="POST" action="process_visitor.php">
            <div class="form-group">
                <label for="visitor_name">Visitor Name:</label>
                <input type="text" name="visitor_name" placeholder="Visitor Name" required>
            </div>

            <div class="form-group">
                <label for="purpose">Purpose of Visit:</label>
                <input type="text" name="purpose" placeholder="Purpose of Visit" required>
            </div>

            <div class="form-group">
                <label for="host_resident">Host Resident:</label>
                <select name="host_resident" required>
                    <?php
                    require_once "../../connect.php";
                    $stmt = $pdo->query("SELECT id, firstName, lastName FROM resident ORDER BY firstName");
                    while($resident = $stmt->fetch()) {
                        $fullName = $resident['firstName'] . ' ' . $resident['lastName'];
                        echo "<option value='{$resident['id']}'>{$fullName}</option>";
                    }
                    ?>
                </select>
            </div>

            <div class="form-group">
                <label for="expected_checkout">Expected Checkout Time:</label>
                <input type="datetime-local" name="expected_checkout" required>
            </div>

            <div class="form-group">
                <button type="submit" class="add" name="action" value="checkin">Check In Visitor</button>
            </div>
        </form>
    </div>
</div>
        </div>
                </div>
<style>
    .form-group {
            margin-bottom: 20px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
            color: var(--primary-color);
        }
        .form-group input,
        .form-group select {
            width: 100%;
            padding: 8px;
            border: 1px solid var(--border-color);
            border-radius: 5px;
            background: var(--background-color3);
            color: var(--font-color);
        }
        .form-actions {
            display: flex;
            gap: 10px;
            justify-content: flex-end;
        }
        .button {
            padding: 10px 30px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            background: var(--secondary-color);
            color: white;
            font-size: 16px;
            transition: background 0.3s ease;
        }
            .button:hover {
            background: #0056b3;
            
        }
</style>
</body>
</html>
