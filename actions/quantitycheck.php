<?php

if (isset($_POST['item_id'])) {
	$output = '';
	$status = 0;
	for($count = 0; $count < count($_POST["item_id"]); $count++) {
		$availablequantity = $_POST['available_quantity'][$count];
		$inputquantity = $_POST['item_quantity'][$count];
		$row = $count + 1;
		if ($availablequantity < $inputquantity) {
			$status = 1;
			$output .= "<li>Entered quantity exceeds avaialble quantity at row ".$row."</li>";
		} else {
			$status = 2;
		}
	}

	$data['status'] = $status;
	$data['message'] = $output;
	echo json_encode($data);
} else {
	echo "no data";
}


?>