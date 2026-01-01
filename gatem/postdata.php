<?php
// Database connection settings
$host = '127.0.0.1'; // Change if your database server is different
$dbname = 'estatesecurity';
$username = 'root'; // Replace with your database username
$password = ''; // Replace with your database password

try {
    // Establish a PDO connection
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Check if form data is submitted
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Retrieve form data and sanitize inputs
        $firstName = htmlspecialchars($_POST['firstName']);
        $lastName = htmlspecialchars($_POST['lastName']);
        $national_ID = htmlspecialchars($_POST['national_ID']);
        $telephone = htmlspecialchars($_POST['telephone']);
        $vehiclePlate = htmlspecialchars($_POST['vehiclePlate']);
        $purpose = htmlspecialchars($_POST['purpose']);
        $courtNo = htmlspecialchars($_POST['courtNo']);
        $houseNo = htmlspecialchars($_POST['houseNo']);

        // Prepare an SQL statement to insert the data
        $sql = "INSERT INTO visitors (firstName, lastName, national_ID, telephone, vehiclePlate, purpose, courtNo, houseNo)
                VALUES (:firstName, :lastName, :national_ID, :telephone, :vehiclePlate, :purpose, :courtNo, :houseNo)";

        $stmt = $pdo->prepare($sql);

        // Bind the parameters
        $stmt->bindParam(':firstName', $firstName);
        $stmt->bindParam(':lastName', $lastName);
        $stmt->bindParam(':national_ID', $national_ID);
        $stmt->bindParam(':telephone', $telephone);
        $stmt->bindParam(':vehiclePlate', $vehiclePlate);
        $stmt->bindParam(':purpose', $purpose);
        $stmt->bindParam(':courtNo', $courtNo);
        $stmt->bindParam(':houseNo', $houseNo);

        // Execute the query
        if ($stmt->execute()) {
            echo "Form data successfully submitted!";
        } else {
            echo "An error occurred while submitting the form.";
        }
    }
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
?>
