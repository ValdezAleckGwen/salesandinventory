<?php
require 'DbConnect.php';



if (isset($_POST['id'])) {
	$output = '';

			$supplierid = $_POST['id'];
			$db = new DbConnect;
			$conn = $db->connect();
			$query = "SELECT tblproducts.id AS productid, tblsupplier.name as suppliername FROM tblproducts INNER JOIN tblsupplier ON tblproducts.supplier=tblsupplier.id WHERE tblsupplier.id = :supplierid ";

			//check if the id is selected
			// if (isset($_POST['item_id'])) {
			// 	for($count = 0; $count < count($_POST["item_id"]); $count++)
			// 	{
			// 		$query .= 'AND  tblproducts.id != '.$_POST['item_id'][$count].' ';

			// 	}
			// }
			$stmt = $conn->prepare($query);

			$stmt->execute(['supplierid' => $supplierid]);
			$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
				$output = '';
				$output .= '<tr style="display: block;">';

				$output .= '<td width="19.36%"><select name="item_id[]" class="col col-sm-2 form-control selectpicker item_id" data-live-search="true"><option value="">Select Unit</option>';;
				foreach ($products as $product) {
				$output .= '<option value="'. $product['productid'] .'">'. $product['productid'] .'</option>';
				}
				$output .= '</select></td>';
				$output .= '<td width="28.7%"><input type="text" name="item_name[]" class="col col-sm-5 form-control item_name" readonly/></td>';

				$output .= '<td width="14.52%"><input type="text" name="item_price[]" class="col col-sm-2 form-control item_price" readonly/></td>';

				$output .= '<td width="14.52%"	><input type="text" name="item_quantity[]" class="col col-sm-1 form-control item_quantity" /></td>';

				$output .= '<td><input type="text" name="item_total[]" class="col col-sm-2 form-control item_total" readonly/></td>';
			
				$output .= '<td><button type="button" name="remove" class="btn btn-danger btn-sm remove" style="background-color: #BB2D3B; padding: .25rem .5rem;"><i class="fas fa-minus"></i></button></td>';



} else {
	$output = 'alert("no data available")';
}

echo $output;


?>
