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
	
	$stmt = $conn->prepare("SELECT tblusers.branchid AS branchid FROM tblusers WHERE id = :uid");
	$stmt->execute([
		':uid' => $uid
	]);
	$users = $stmt->fetchAll(PDO::FETCH_ASSOC);
	foreach ($users as $user) {
		$id = $user['branchid'];
	}
	return $id;
}

function displayBranch(string $uid) {
	$db = new DbConnect;
	$conn = $db->connect();
	$branchid = getBranch($uid);
	$stmt = $conn->prepare("SELECT tblbranch.name AS branchname FROM tblbranch WHERE id = :id");
	$stmt->execute([
		':id' => $branchid
	]);
	$branches = $stmt->fetchAll(PDO::FETCH_ASSOC);
	foreach ($branches as $branch) {
		$name = $branch['branchname'];
	}
	return $name;
}

function getPermission(string $uid) {
	$db = new DbConnect;
	$conn = $db->connect();
	
	$stmt = $conn->prepare("SELECT tblusers.permission AS permission FROM tblusers WHERE id = :uid");
	$stmt->execute([
		':uid' => $uid
	]);
	$users = $stmt->fetchAll(PDO::FETCH_ASSOC);
	foreach ($users as $user) {
		$id = $user['permission'];
	}
	return $id;
}

function getInventoryCount(string $inventoryid) {
	$db = new DbConnect;
	$conn = $db->connect();
	
	$stmt = $conn->prepare("SELECT tblinventory.quantity AS quantity FROM tblinventory WHERE tblinventory.id = :inventoryid");
	$stmt->execute([
		':inventoryid' => $inventoryid
	]);
	$inventories = $stmt->fetchAll(PDO::FETCH_ASSOC);
	foreach ($inventories as $inventory) {
		$count = $inventory['quantity'];
	}
	return $count;
}





 ?>