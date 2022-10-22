<?php
session_start();
include 'getdata.php';
require_once 'DbConnect.php';

$id = $_SESSION['uid'];
$branchid = getBranch($id);

if (isset($branchid)) {
	
	$output = '';
	 
			
			$db = new DbConnect;
			$conn = $db->connect();

			$query = "SELECT tblinventory.id AS inventory, tblinventory.quantity AS count, tblproducts.id AS product, tblproducts.markupPrice AS price FROM tblinventory INNER JOIN tblproducts ON tblinventory.productId=tblproducts.id WHERE tblinventory.quantity > 0 AND tblinventory.branchid = '".$branchid."'" ;
			if (isset($_POST["item_id"])) {
				
				for($count = 0; $count < count($_POST["item_id"]); $count++) {
					$itemid = $_POST['item_id'][$count];
					$query .= " AND tblinventory.id != '".$itemid."'";

				}
			} 

			$stmt = $conn->prepare($query);
			$stmt->execute();
			$inventories = $stmt->fetchAll(PDO::FETCH_ASSOC);
				
				$output .= '<tr style="display: block;">';

				$output .= '<td width="5%"><select name="item_id[]" class="col col-sm-2 form-control selectpicker item_id" data-live-search="true"><option value="">Select Product</option>';
				foreach ($inventories as $inventory) {
				$output .= '<option value="'. $inventory['inventory'] .'">'. $inventory['product'] .'</option>';
				}
				$output .= '</select></td>';

				$output .= '<td width="40%"><input type="text" name="item_name[]" class="col col-sm-5 form-control item_name" readonly/></td>';

				$output .= '<td width="12%"><input type="text" name="item_price[]" class="col col-sm-2 form-control item_price" readonly/></td>';

				$output .= '<td width="10.05%"><input type="text" name="available_quantity[]" class="col col-sm-1 form-control available_quantity" readonly/></td>';
				$output .= '<td width="10%"><input type="text" name="item_quantity[]" class="col col-sm-1 form-control  item_quantity" /></td>';
				
				$output .= '<td width="11.22%"><input type="text" name="item_total[]" class="col col-sm-2 form-control item_total" readonly/></td>';

				$output .= '<td><button type="button" name="remove" class="btn btn-danger btn-sm remove"><i class="fas fa-minus"></i></button></td>';


} else {
	$output = 'alert("no data available")';
}

echo $output;




?>