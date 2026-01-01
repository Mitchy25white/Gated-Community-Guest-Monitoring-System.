<?php
require_once "../../connect.php";

$id = $_GET['id'];
$stmt = $pdo->prepare("DELETE FROM manage_complaints WHERE id = ?");
$stmt->execute([$id]);

header("Location: manage_complaints.php");
exit();
?>
