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
tblsales.date as calendar,
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

$query .= 'ORDER BY salesid ASC ';

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
    <th class="text-center" style="border: 1px solid;">Date</th>
    <th class="text-center" style="border: 1px solid;">Total (₱)</th>
  </tr>
';

  foreach($result as $row)
  {
    $output .= '
    <tr class="data" data-id="'.$row["salesid"].'">
      <td style="border: 1px solid;">'.$row["salesid"].'</td>
      <td style="border: 1px solid;">'.$row["branchname"].'</td>
      <td style="border: 1px solid;">'.$row["username"].'</td>
      <td style="border: 1px solid;">'.$row["calendar"].'</td>
      <td class="text-right" style="border: 1px solid;">'.$row["total"].'</td>
      

    ';
	}
echo $output;

?>