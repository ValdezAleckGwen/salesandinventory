<?php

include 'database_connection.php';





$limit = 7;
$start = 0;



$query = "
SELECT 
tblsales.id AS salesid,
tblbranch.name AS branchname,
tblusers.lastname as username,
tblsales.salesdate as calendar,
tblsales.total AS total
FROM tblsales 
INNER JOIN tblbranch 
ON tblsales.branchid=tblbranch.id
INNER JOIN tblusers 
ON tblsales.userid=tblusers.id
WHERE tblsales.active = 1
";



$query .= 'ORDER BY salesid DESC ';

$filter_query = $query . 'LIMIT '.$start.', '.$limit.'';

$statement = $connect->prepare($query);
$statement->execute();
$total_data = $statement->rowCount();

$statement = $connect->prepare($filter_query);
$statement->execute();
$result = $statement->fetchAll();
$total_filter_data = $statement->rowCount();

$output = '
<table class="table table-striped table-bordered" style="background: #CDCDCD; border-collapse: collapse;">
  <tr>
    <th class="text-center" style="border: 1px solid;">Sales ID</th>
    <th class="text-center" style="border: 1px solid;">Branch</th>
    <th class="text-center" style="border: 1px solid;">Creator</th>
    <th class="text-center" style="border: 1px solid;">Total (₱)</th>
    <th class="text-center" style="border: 1px solid;">Date</th>
    
  </tr>
';
if($total_data > 0)
{
  foreach($result as $row)
  {
    $total = number_format($row["total"], 2);
    $output .= '
    <tr class="data" data-id="'.$row["salesid"].'">
      <td style="border: 1px solid;">'.$row["salesid"].'</td>
      <td style="border: 1px solid;">'.$row["branchname"].'</td>
      <td style="border: 1px solid;">'.$row["username"].'</td>
      <td class="text-right" style="border: 1px solid;">'.$total.'</td>
      <td style="border: 1px solid;">'.$row["calendar"].'</td>
      
      

    ';
  }
}
else
{
  $output .= '
  <tr>
    <td colspan="2" align="center">No Data Found</td>
  </tr>
  ';
}



echo $output;

?>