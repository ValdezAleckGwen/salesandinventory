<?php
require 'DbConnect.php';


if (isset($_POST['supplier_id'])) {
	$output = '';

			
			$supplierid = $_POST['supplier_id'];
			$db = new DbConnect;
			$conn = $db->connect();
			$query = "SELECT tbldeliveryorderitem.id AS doitemid, tbldeliveryorder.id AS doid, tbldeliveryorder.supplierid AS supplierid FROM tbldeliveryorderitem INNER JOIN tbldeliveryorder ON tbldeliveryorderitem.doid=tbldeliveryorder.id INNER JOIN tblsupplier ON tbldeliveryorder.supplierid=tblsupplier.id WHERE supplierid = '".$supplierid."' AND paid = 0";
			if (isset($_POST["item_id"])) {
				for($count = 0; $count < count($_POST["item_id"]); $count++) {
					$itemid = $_POST['item_id'][$count];
					$query .= " AND tbldeliveryorderitem.id != '".$itemid."'";
				}
			} 
			$stmt = $conn->prepare($query);
			$stmt->execute();
			$doitems = $stmt->fetchAll(PDO::FETCH_ASSOC);
				$output = '';
				$output .= '<tr style="display: block;">';

				$output .= '<td width="14.5%"><select name="item_id[]" class="col col-sm-2 form-control selectpicker item_id" data-live-search="true"><option value="">Select Unit</option>';;
				foreach ($doitems as $doitem) {
				$output .= '<option value="'. $doitem['doitemid'] .'">'. $doitem['doitemid'] .'</option>';
				}
				$output .= '</select></td>';
				$output .= '<td width="15%"><input type="text" name="do_id[]" class="col col-sm-5 form-control do_id" readonly/></td>';
				
				$output .= '<td width="12.1%"><input type="text" name="item_branch[]" class="col col-sm-5 form-control item_branch" readonly/></td>';	
				$output .= '<td width="15.2%"><input type="text" name="item_code[]" class="col col-sm-5 form-control item_code" readonly/></td>';

				

				$output .= '<td width="15%"><input type="text" name="item_price[]" class="col col-sm-1 form-control item_price" readonly/></td>';

				$output .= '<td width="15.2%"><input type="number" name="item_quantity[]" class="col col-sm-2 form-control item_quantity" readonly/></td>';

				$output .= '<td width="16.2%"><input type="text" name="item_total[]" class="col col-sm-2 form-control item_total" readonly/></td>';
			
				$output .= '<td><button type="button" name="remove" class="btn btn-danger btn-sm remove" style="background-color: #BB2D3B; padding: .25rem .5rem;"><i class="fas fa-minus"></i></button></td>';


} else {
	$output = 'alert("no data available")';
}

echo $output;


?>
