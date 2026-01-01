<?php

if($_SERVER["REQUEST_METHOD"]=="POST"){
    $firstname = $_POST["firstname"];
    $lastname = $_POST["lastname"];
    $ID = $_POST["ID"];
    $rank = $_POST["rank"];
    $workstation = $_POST["workstation"];
    
    
    try {
        require_once "connect.php";
        $query="INSERT INTO security (firstname, lastname, national_ID, rank, workstation) VALUES (?,?,?,?,?);";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$firstname, $lastname, $ID, $rank, $workstation ]);
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
