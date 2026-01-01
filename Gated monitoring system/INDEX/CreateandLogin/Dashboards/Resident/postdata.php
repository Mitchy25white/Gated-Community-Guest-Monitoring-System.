<?php
require_once '../../connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        $sql = "INSERT INTO guest (firstName, lastName, telephone, national_ID, vehiclePlate, purpose, courtNo, houseNo) 
                VALUES (:firstName, :lastName, :telephone, :national_ID, :vehiclePlate, :purpose, :courtNo, :houseNo)";
        
        $stmt = $pdo->prepare($sql);
        
        $stmt->execute([
            ':firstName' => $_POST['firstName'],
            ':lastName' => $_POST['lastName'],
            ':telephone' => $_POST['telephone'],
            ':national_ID' => $_POST['national_ID'],
            ':vehiclePlate' => $_POST['vehiclePlate'],
            ':purpose' => $_POST['purpose'],
            ':courtNo' => $_POST['courtNo'],
            ':houseNo' => $_POST['houseNo']
        ]);

        // Redirect back to the form with success message
        header("Location: Guest.html?status=success");
        exit();
        
    } catch(PDOException $e) {
        // Log error and redirect with error message
        error_log("Error inserting guest: " . $e->getMessage());
        header("Location: Guest.html?status=error");
        exit();
    }
}
