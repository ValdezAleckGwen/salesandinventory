<?php
require 'DbConnect.php';


if (isset($_POST['source_branch'])) {
	
	$output = '';
	 
			$branchid = $_POST['source_branch'];
			$db = new DbConnect;
			$conn = $db->connect();

			$query = "SELECT tblinventory.id AS inventory, tblbranch.id AS branch FROM tblinventory INNER JOIN tblbranch ON tblbranch.id=tblinventory.branchid WHERE tblbranch.id = '".$branchid."' AND tblinventory.quantity >= 1";
			if (isset($_POST["item_id"])) {
				for($count = 0; $count < count($_POST["item_id"]); $count++) {
					$itemid = $_POST['item_id'][$count];
					$query .= " AND tblinventory.id != '".$itemid."'";
				}
			} 

			$stmt = $conn->prepare($query);
			$stmt->execute();
			$inventories = $stmt->fetchAll(PDO::FETCH_ASSOC);
				
				$output .= '<tr>';

				$output .= '<td width="14.6%"><select name="item_id[]" class="col col-sm-2 form-control selectpicker inventory_id" data-live-search="true"><option value="">Select Product</option>';
				foreach ($inventories as $inventory) {
				$output .= '<option value="'. $inventory['inventory'] .'">'. $inventory['inventory'] .'</option>';
				}
				$output .= '</select></td>';

				
				$output .= '<td width="39.8%"><input type="text" name="item_name[]" class="col col-sm-5 form-control item_name" readonly/></td>';

				$output .= '<td width="15%"><input type="text" name="item_available[]" class="col col-sm-1 form-control item_available" readonly/></td>';

				$output .= '<td width="15%"><input type="text" name="item_quantity[]" class="col col-sm-1 form-control item_quantity" /></td>';

				
				$output .= '<td><button type="button" name="remove" class="btn btn-danger btn-sm remove"><i class="fas fa-minus"></i></button></td>';


} else {
	$output = 'alert("no data available")';
}

echo $output;




?>
