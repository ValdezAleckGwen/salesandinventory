<?php
session_start();
include 'DbConnect.php';
$id = $_SESSION['uid'];

	$db = new DbConnect;
	$conn = $db->connect();
	
	$stmt = $conn->prepare("SELECT tblusers.firstname AS firstname FROM tblusers WHERE id = :uid");
	$stmt->execute([
		':uid' => $id
	]);
	$users = $stmt->fetchAll(PDO::FETCH_ASSOC);
	foreach ($users as $user) {
		$firstname = $user['firstname'];
	}
	echo $firstname;



 ?>