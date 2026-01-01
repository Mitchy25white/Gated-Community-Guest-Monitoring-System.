<?php
require_once '../../connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        $stmt = $pdo->prepare("INSERT INTO resident (firstName, lastName, national_ID, telephone, email, courtNo, houseNo) 
                              VALUES (:firstName, :lastName, :national_ID, :telephone, :email, :courtNo, :houseNo)");
        
        $stmt->execute([
            ':firstName' => $_POST['firstname'],
            ':lastName' => $_POST['lastname'],
            ':national_ID' => $_POST['ID'],
            ':telephone' => $_POST['telephone'],
            ':email' => $_POST['email'],
            ':courtNo' => $_POST['courtno'],
            ':houseNo' => $_POST['houseno']
        ]);

        header("Location: Resident.html?success=1");
        exit();
    } catch (PDOException $e) {
        header("Location: Resident.html?error=1");
        exit();
    }
}
?>
