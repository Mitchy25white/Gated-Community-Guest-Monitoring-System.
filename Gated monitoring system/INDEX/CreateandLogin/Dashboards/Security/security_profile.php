<?php
session_start();
require_once "../../connect.php";

// Get security personnel details
$stmt = $pdo->prepare("SELECT * FROM security WHERE id = ?");
$stmt->execute([$_SESSION['user_id']]);
$security = $stmt->fetch(PDO::FETCH_ASSOC);

if ($security) {
    $_SESSION['name'] = $security['firstName'] . ' ' . $security['lastName'];
    $_SESSION['contact'] = $security['phoneNo'];
    $_SESSION['dateOnDuty'] = $security['dateOnDuty'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Security Profile - Gated Community</title>
    <link rel="stylesheet" href="security_profile.css">
</head>
<body>
    <h1>Security Profile</h1>
    <div class="profile-container">
        <div class="profile-details">
            <h2>Name:</h2>
            <p><?php echo isset($security['firstName']) ? $security['firstName'] : ''; ?> <?php echo isset($security['lastName']) ? $security['lastName'] : ''; ?></p>

            <h2>Contact:</h2>
            <p><?php echo isset($security['phoneNo']) ? $security['phoneNo'] : ''; ?></p>

            <h2>Date On Duty:</h2>
            <p><?php echo isset($security['dateOnDuty']) ? $security['dateOnDuty'] : ''; ?></p>
        </div>
    </div>
<style>
body {
    font-family: 'Times New Roman', Times, serif;
    background: #4a0074;
    color: #fff;
}

h1 {
    text-align: center;
    margin-top: 50px;
    color: #be58cf;
    text-shadow: 2px solid #bb58ff;
}

.profile-container {
    width: 80%;
    max-width: 600px;
    margin: 0 auto;
    background-color: rgba(30, 30, 47, 0.9);
    padding: 20px;
    border-radius: 5px;
    box-shadow: 0 0 20px rgba(155, 89, 182, 0.7);
}

.profile-details {
    text-align: center;
}

.profile-details h2 {
    color: #fff;
    margin-bottom: 5px;
}

.profile-details p {
    font-size: 18px;
    color: #fff;
}

.profile-details p:last-child {
    margin-bottom: 0;
}

input[type="text"],
input[type="password"],
input[type="email"] {
    background-color: #fff;
    color: #333;
    border: none;
    padding: 10px;
    border-radius: 5px;
    width: 100%;
    box-sizing: border-box;
}
</style>
</body>
</html>
