<?php
if (isset($_POST['total'])) {
	$total = $_POST['total'];
	echo $total;
} else {
	echo "no data found";
}



?>