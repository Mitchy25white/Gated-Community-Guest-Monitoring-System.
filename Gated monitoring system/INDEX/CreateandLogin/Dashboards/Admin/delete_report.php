<?php
require_once "../../connect.php";

$id = $_GET['id'];
$stmt = $pdo->prepare("DELETE FROM manage_reports WHERE id = ?");
$stmt->execute([$id]);

header("Location: manage_reports.php");
exit();
?>
