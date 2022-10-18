<?php
require 'DbConnect.php';


if (isset($_POST['branchid'])) {
	
	$output = '';
	 
			$branchid = $_POST['branchid'];
			$db = new DbConnect;
			$conn = $db->connect();

			$stmt = $conn->prepare("SELECT tblinventory.id AS inventory, tblbranch.id AS branch FROM tblinventory INNER JOIN tblbranch ON tblbranch.id=tblinventory.branchid WHERE tblbranch.id = :branchid");
			$stmt->execute(['branchid' => $branchid]);
			$inventories = $stmt->fetchAll(PDO::FETCH_ASSOC);
				$output = '';
				$output .= '<tr>';

				$output .= '<td><select name="item_id[]" class="col col-sm-2 form-control selectpicker inventory_id" data-live-search="true"><option value="">Select Product</option>';
				foreach ($inventories as $inventory) {
				$output .= '<option value="'. $inventory['inventory'] .'">'. $inventory['inventory'] .'</option>';
				}
				$output .= '</select></td>';

				$output .= '<td><input type="text" name="item_code[]" class="col col-sm-5 form-control item_code" readonly/></td>';

				$output .= '<td><input type="text" name="item_name[]" class="col col-sm-5 form-control item_name" readonly/></td>';

				$output .= '<td><input type="text" name="item_available[]" class="col col-sm-1 form-control item_available" readonly/></td>';

				$output .= '<td><input type="text" name="item_quantity[]" class="col col-sm-1 form-control item_quantity" /></td>';

				
				$output .= '<td><button type="button" name="remove" class="btn btn-danger btn-sm remove"><i class="fas fa-minus"></i></button></td>';


} else {
	$output = 'alert("no data available")';
}

echo $output;




?>
