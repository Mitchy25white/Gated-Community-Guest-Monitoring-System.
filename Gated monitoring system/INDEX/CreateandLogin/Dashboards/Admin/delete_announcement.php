<?php
require_once "../../connect.php";

$id = $_GET['id'];
$stmt = $pdo->prepare("DELETE FROM announcements WHERE id = ?");
$stmt->execute([$id]);

header("Location: manage_announcements.php");
exit();
?>
