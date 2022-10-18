<?php
require_once 'DbConnect.php';
require_once 'adddata.php';

function addUser() {
	if (!empty($_POST['firstname'] && $_POST['lastname'] && $_POST['email'] && $_POST['role'] && $_POST['password'])) {
		$userid = createId('tblusers');
		$firstname = ucfirst($_POST['firstname']);
		$lastname = ucfirst($_POST['lastname']);
		$email = $_POST['email'];
		$role = $_POST['role'];

		$errorMessage = "";
		$isInvalid = false;
		if (is_numeric($firstname) || is_numeric($lastname)) {
			$errorMessage .= "Numeric character is not valid for name\\n";
			$isInvalid = true;
		}
		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
	  		$errorMessage .=  "Use a valid email";
	  		$isInvalid = true;
		} 

		if ($isInvalid) {
			echo "<script>alert('$errorMessage')</script>";
		} else {
			$db = new DbConnect;
			$conn = $db->connect();

			$stmt = $conn->prepare("INSERT INTO tblusers (id, firstname, lastname, email, password, role)")
		}

	}
}






 ?>