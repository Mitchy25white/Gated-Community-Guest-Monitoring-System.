<?php
$host = '127.0.0.1';  // Database host
$dbname = 'estate_management';  // Database name
$username = 'root';  // Your DB username
$password = '';  // Your DB password

try {
    // Create a PDO instance
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>
