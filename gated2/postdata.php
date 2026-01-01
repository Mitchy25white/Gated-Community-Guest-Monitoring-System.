<?php
// Database configuration
$host = '127.0.0.1';
$dbname = 'estatesecurity';
$username = 'root';
$password = '';// your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Prepare and bind
$stmt = $conn->prepare("INSERT INTO guests (firstName, lastName, telephone, national_ID, vehiclePlate, purpose, courtNo, houseNo) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssissssis", $firstName, $lastName, $telephone, $national_ID, $vehiclePlate, $purpose, $courtNo, $houseNo);

// Set parameters and execute
$firstName = $_POST['firstName'];
$lastName = $_POST['lastName'];
$telephone = $_POST['telephone'];
$national_ID = $_POST['national_ID'];
$vehiclePlate = $_POST['vehiclePlate'];
$purpose = $_POST['purpose'];
$courtNo = $_POST['courtNo'];
$houseNo = $_POST['houseNo'];

if ($stmt->execute()) {
    echo "New guest registered successfully";
} else {
    echo "Error: " . $stmt->error;
}

// Close statement and connection
$stmt->close();
$conn->close();
?>