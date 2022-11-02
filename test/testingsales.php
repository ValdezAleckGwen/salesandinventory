<?php
session_start();
include '../actions/database_connection.php';
include '../actions/getdata.php';

$id = $_SESSION['uid'];
$branchid = getBranch($id);
$permission = getPermission($id);





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

if($_POST['branch'] != '1')
{
  $branchid = $_POST['branch'];
  $query .= ' AND tblsales.branchid = "'.$branchid.'" ';
}

if($_POST['date1'] != '' && $_POST['date2'] != '')
{
  $datestart = $_POST['date1'];
  $dateend = $_POST['date2'];
  
  $query .= " AND tblsales.salesdate BETWEEN '".date('Y-m-d', strtotime($datestart))."' AND '".date('Y-m-d', strtotime($dateend))."' ";

}

$query .= ' ORDER BY salesid DESC ';

$statement = $connect->prepare($query);
$statement->execute();
$result = $statement->fetchAll();
$total_data = $statement->rowCount();

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

  foreach($result as $row)
  {
    $total = filter_var($row["total"], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    $total = number_format($total, 2);
    $output .= '
    <tr class="data" data-id="'.$row["salesid"].'">
      <td style="border: 1px solid;">'.$row["salesid"].'</td>
      <td style="border: 1px solid;">'.$row["branchname"].'</td>
      <td style="border: 1px solid;">'.$row["username"].'</td>
      <td class="text-right" style="border: 1px solid;">'.$total.'</td>
      <td style="border: 1px solid;">'.$row["calendar"].'</td>
      

    ';
	}
echo $output;

?>