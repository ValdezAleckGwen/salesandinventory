<?php
include 'DbConnect.php';


function getFirstName(string $uid) {
	$db = new DbConnect;
	$conn = $db->connect();
	
	$stmt = $conn->prepare("SELECT tblusers.firstname AS firstname FROM tblusers WHERE id = :uid");
	$stmt->execute([
		':uid' => $uid
	]);
	$users = $stmt->fetchAll(PDO::FETCH_ASSOC);
	foreach ($users as $user) {
		$firstname = $user['firstname'];
	}
	return $firstname;
}

function getId(string $uid) {
	$db = new DbConnect;
	$conn = $db->connect();
	
	$stmt = $conn->prepare("SELECT tblusers.id AS userid FROM tblusers WHERE id = :uid");
	$stmt->execute([
		':uid' => $uid
	]);
	$users = $stmt->fetchAll(PDO::FETCH_ASSOC);
	foreach ($users as $user) {
		$id = $user['userid'];
	}
	return $id;
}

function getBranch(string $uid) {
	$db = new DbConnect;
	$conn = $db->connect();
	
	$stmt = $conn->prepare("SELECT tblusers.branch AS userid FROM tblusers WHERE id = :uid");
	$stmt->execute([
		':uid' => $uid
	]);
	$users = $stmt->fetchAll(PDO::FETCH_ASSOC);
	foreach ($users as $user) {
		$id = $user['userid'];
	}
	return $id;
}



 ?>