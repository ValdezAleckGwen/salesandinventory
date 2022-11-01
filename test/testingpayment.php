<?php
session_start();
include '../actions/database_connection.php';
include '../actions/getdata.php';








$query = "
SELECT tblpayables.id AS pyid, 
tblusers.lastname as username,
tblpayables.date as calendar,
tblpayables.total as total
FROM tblpayables 
INNER JOIN tblusers
ON tblpayables.userid=tblusers.id
WHERE tblpayables.active = 1
";




$query .= 'ORDER BY tblpayables.id ASC ';

$statement = $connect->prepare($query);
$statement->execute();
$result = $statement->fetchAll();
$total_data = $statement->rowCount();

$output = '
<label>Total Records - '.$total_data.'</label>
<table class="table table-striped table-bordered" style="background: #CDCDCD; border-collapse: collapse;">
  <tr>
        <th class="text-center" style="border: 1px solid;">Payable ID</th>
        <th class="text-center" style="border: 1px solid;">Creator</th>
        <th class="text-center" style="border: 1px solid;">Date</th>
        <th class="text-left" style="border: 1px solid;">Total (₱)</th>
  </tr>
';

  foreach($result as $row)
  {
    $output .= '
    <tr class="data" data-id="'.$row["pyid"].'">
      <td style="border: 1px solid;">'.$row["pyid"].'</td>
      <td style="border: 1px solid;">'.$row["username"].'</td>
      <td style="border: 1px solid;">'.$row["calendar"].'</td>
      <td style="border: 1px solid;">'.$row["total"].'</td>
    </tr>
    ';
  }



echo $output;

?>