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
				$output .= '<tr style="display: block;">';

				$output .= '<td  width="13.9%"><select name="item_id[]" class="col col-sm-2 form-control selectpicker item_id" data-live-search="true"><option value="">Select Product</option>';
				foreach ($inventories as $inventory) {
				$output .= '<option value="'. $inventory['inventory'] .'">'. $inventory['inventory'] .'</option>';
				}
				$output .= '</select></td>';

				$output .= '<td width="15.9%"><input type="text" name="item_code[]" class="col col-sm-2 form-control item_code" readonly/></td>';

				$output .= '<td width="22.6%"><input type="text" name="item_name[]" class="col col-sm-5 form-control item_name" readonly/></td>';

				$output .= '<td width="10%"><input type="number" name="item_quantity[]" class="col col-sm form-control item_quantity" readonly/>';

				$output .= '<td width="16%"><input type="number" name="adjustment_quantityminus[]" class="col col-sm form-control adjustment_quantityminus" ></td>';

				$output .= '<td width="16%"><input type="number" name="adjustment_quantityplus[]" class="col col-sm form-control adjustment_quantityplus" ></td>';




				$output .= '<td><button type="button" name="remove" class="btn btn-danger btn-sm remove" style="background-color: #BB2D3B; padding: .25rem .5rem;"><i class="fas fa-minus"></i></button></td></tr>';


} else {
	$output = 'alert("no data available")';
}

echo $output;




?>
