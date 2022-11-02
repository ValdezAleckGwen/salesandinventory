<?php
session_start();
include '../actions/database_connection.php';
include '../actions/getdata.php';








$query = "
SELECT tblpayables.id AS pyid, 
tblusers.lastname as username,
tblsupplier.name as suppliername,
tbldeliveryorder.id as doid,
tblpayables.total as total,
tblpayables.payabledate as calendar
FROM tblpayables 
INNER JOIN tblusers
ON tblpayables.userid=tblusers.id
INNER JOIN tblsupplier
ON tblpayables.supplierid=tblsupplier.id
INNER JOIN tbldeliveryorderitem 
ON tbldeliveryorderitem.paymentid=tblpayables.id
INNER JOIN tbldeliveryorder ON tbldeliveryorderitem.doid=tbldeliveryorder.id
WHERE tblpayables.active = 1
";

if($_POST['date1'] != '' && $_POST['date2'] != '')
{
  $datestart = $_POST['date1'];
  $dateend = $_POST['date2'];
  
  $query .= " AND tblpayables.payabledate BETWEEN '".date('Y-m-d', strtotime($datestart))."' AND '".date('Y-m-d', strtotime($dateend))."' ";

}


$query .= 'ORDER BY tblpayables.id DESC ';

$statement = $connect->prepare($query);
$statement->execute();
$result = $statement->fetchAll();
$total_data = $statement->rowCount();

$output = '
<label>Total Records - '.$total_data.'</label>
<table class="table table-striped table-bordered" style="background: #CDCDCD; border-collapse: collapse;">
  <tr>
        <th class="text-center" style="border: 1px solid;">Payable ID</th>
        <th class="text-center" style="border: 1px solid;">Delivery Order ID</th>
        <th class="text-center" style="border: 1px solid;">Supplier</th>
        <th class="text-center" style="border: 1px solid;">Creator</th>
        <th class="text-center" style="border: 1px solid;">Total (₱)</th>
        <th class="text-left" style="border: 1px solid;">Date</th>
  </tr>
';

  foreach($result as $row)
  {
    $total = filter_var($row["total"], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    $total = number_format($total, 2);
    $output .= '
    <tr class="data" data-id="'.$row["pyid"].'">
      <td style="border: 1px solid;">'.$row["pyid"].'</td>
      <td style="border: 1px solid;">'.$row["doid"].'</td>
      <td style="border: 1px solid;">'.$row["suppliername"].'</td>
      <td style="border: 1px solid;">'.$row["username"].'</td>
      <td style="border: 1px solid;">'.$total.'</td>
      <td style="border: 1px solid;">'.$row["calendar"].'</td>
    </tr>
    ';
  }



echo $output;

?>