<?php

if($_SERVER["REQUEST_METHOD"]=="POST"){
    $firstname = $_POST["firstname"];
    $lastname = $_POST["lastname"];
    $telephone = $_POST["telephone"];
    $ID = $_POST["ID"];
    $email = $_POST["email"];
    $courtno = $_POST["courtno"];
    $houseno = $_POST["houseno"];
    
    
    try {
        require_once "connect.php";
        $query="INSERT INTO resident (firstname, lastname, national_ID, telephone, email, courtno, houseno) VALUES (?,?,?,?,?,?,?);";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$firstname, $lastname, $ID, $telephone, $email, $courtno, $houseno]);
        $pdo =null;
        $stmt=null;
        header("Location: index.html");
        die();
    }catch(PDOException $e){
        die("Query failed:".$e->getMessage());

    }
}
else{
    header("Location: index.html");
}
