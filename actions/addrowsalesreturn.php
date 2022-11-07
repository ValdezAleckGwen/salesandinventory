<?php
require 'DbConnect.php';

 
if (isset($_POST['salesid'])) {
	$output = '';

			$salesid = $_POST['salesid'];
			
			$db = new DbConnect;
			$conn = $db->connect();
			$salesreturnquery = "SELECT tblsalesitem.id AS salesitemid FROM tblsalesitem WHERE tblsalesitem.salesid = '".$salesid."' ";
			if (isset($_POST["item_id"])) {
				for($count = 0; $count < count($_POST["item_id"]); $count++) {
					$itemid = $_POST['item_id'][$count];
					$salesreturnquery .= " AND tblsalesitem.id != '".$itemid."'";
				}
			} 
			$stmt = $conn->prepare($salesreturnquery);
			$stmt->execute();
			$sale = $stmt->fetchAll(PDO::FETCH_ASSOC);
				$output = '';
				$output .= '<tr style="display: block;">';

				$output .= '<td width="14%"><select name="item_id[]" class="col col-sm-2 form-control selectpicker item_id" data-live-search="true"><option value="">Select Unit</option>';;
				foreach ($sale as $sales) {
				$output .= '<option value="'. $sales['salesitemid'] .'">'. $sales['salesitemid'] .'</option>';
				}
				$output .= '</select></td>';

				$output .= '<td width="15.75%"><input type="text" name="item_code[]" class="col col-sm-5 form-control item_code" readonly/></td>';

				$output .= '<td width="23.6%"><input type="text" name="item_name[]" class="col col-sm-2 form-control item_name" readonly/></td>';

				$output .= '<td width="11%"><input type="text" name="item_price[]" class="col col-sm-1 form-control item_price" readonly/></td>';

				$output .= '<td width="16%"><input type="number" name="item_quantity[]" class="col col-sm-2 form-control item_quantity"/>';

				$output .= '<td width="16%"><input type="text" name="item_total[]" class="col col-sm-2 form-control item_total" readonly/></td>';
			
				$output .= '<td><button type="button" name="remove" class="btn btn-danger btn-sm remove" style="background-color: #BB2D3B; padding: .25rem .5rem;"><i class="fas fa-minus"></i></button></td>';


} else {
	$output = '<script>alert("no data available")</script>';
}

echo $output;


?>