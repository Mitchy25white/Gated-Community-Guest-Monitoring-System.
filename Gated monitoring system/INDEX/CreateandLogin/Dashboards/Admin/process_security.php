<?php
require_once "../../connect.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $staffNo = $_POST['staffNo'];
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $national_ID = $_POST['national_ID'];
    $rank = $_POST['rank'];
    $workStation = $_POST['workStation'];

    try {
        $sql = "INSERT INTO security (staffNo, firstName, lastName, national_ID, rank, workStation) 
                VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$staffNo, $firstName, $lastName, $national_ID, $rank, $workStation]);

        header("Location: security.html?success=1");
    } catch(PDOException $e) {
        header("Location: security.html?error=1");
    }
}
?>
