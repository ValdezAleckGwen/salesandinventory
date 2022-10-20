<?php
session_start();
include 'database_connection.php';
include 'getdata.php';

$id = $_SESSION['uid'];
$branchid = getBranch($id);
$permission = getPermission($id);


$limit = '10';
$page = 1;

$limit = '10';
$page = 1;
if($_POST['page'] > 1)
{
  $start = (($_POST['page'] - 1) * $limit);
  $page = $_POST['page'];
}
else
{
  $start = 0;
}

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


if($_POST['query'] != '')
{
  $query .= '
  AND tblpayables.id LIKE "%'.str_replace(' ', '%', $_POST['query']).'%" 
  ';
}

$query .= 'ORDER BY tblpayables.id ASC ';

$filter_query = $query . 'LIMIT '.$start.', '.$limit.'';

$statement = $connect->prepare($query);
$statement->execute();
$total_data = $statement->rowCount();

$statement = $connect->prepare($filter_query);
$statement->execute();
$result = $statement->fetchAll();
$total_filter_data = $statement->rowCount();

$output = '
<label>Total Records - '.$total_data.'</label>
<table class="table table-striped table-bordered" style="background: #CDCDCD; border-collapse: collapse;">
  <tr>
        <th class="text-center" style="border: 1px solid;">Purchase Order ID</th>
        <th class="text-center" style="border: 1px solid;">Creator</th>
        <th class="text-center" style="border: 1px solid;">Date</th>
        <th class="text-left" style="border: 1px solid;">Total (₱)</th>
  </tr>
';
if($total_data > 0)
{
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
}
else
{
  $output .= '
  <tr>
    <td colspan="2" align="center">No Data Found</td>
  </tr>
  ';
}

$output .= '
</table>
<br />
<div align="center">
<ul class="pagination">
';

$total_links = ceil($total_data/$limit);
$previous_link = '';
$next_link = '';
$page_link = '';

//echo $total_links;
$page_array[] = null; //this is it pancit
if($total_links > 4)
{
  if($page < 10)
  {
    for($count = 1; $count <= 10; $count++)
    {
      $page_array[] = $count;
    }
    $page_array[] = '...';
    $page_array[] = $total_links;
  }
  else
  {
    $end_limit = $total_links - 10;
    if($page > $end_limit)
    {
      $page_array[] = 1;
      $page_array[] = '...';
      for($count = $end_limit; $count <= $total_links; $count++)
      {
        $page_array[] = $count;
      }
    }
    else
    {
      $page_array[] = 1;
      $page_array[] = '...';
      for($count = $page - 1; $count <= $page + 1; $count++)
      {
        $page_array[] = $count;
      }
      $page_array[] = '...';
      $page_array[] = $total_links;
    }
  }
}
else
{
  for($count = 1; $count <= $total_links; $count++)
  {
    $page_array[] = $count;
  }
}

for($count = 0; $count < count($page_array); $count++)
{
  if($page == $page_array[$count])
  {
    $page_link .= '
    <li class="page-item active">
      <a class="page-link" href="#">'.$page_array[$count].' <span class="sr-only">(current)</span></a>
    </li>
    ';

    $previous_id = $page_array[$count] - 1;
    if($previous_id > 0)
    {
      $previous_link = '<li class="page-item"><a class="page-link"  href="javascript:void(0)" data-page_number="'.$previous_id.'">Previous</a></li>';
    }
    else
    {
      $previous_link = '
      <li class="page-item disabled">
        <a class="page-link" href="#">Previous</a>
      </li>
      ';
    }
    $next_id = $page_array[$count] + 1;
    if($next_id >= $total_links)
    {
      $next_link = '
      <li class="page-item disabled">
        <a class="page-link" href="#">Next</a>
      </li>
        ';
    }
    else
    {
      $next_link = '<li class="page-item"><a class="page-link" id="itlog" href="javascript:void(0)" data-page_number="'.$next_id.'">Next</a></li>';
    }
  }
  else
  {
    if($page_array[$count] == '...')
    {
      $page_link .= '
      <li class="page-item disabled">
          <a class="page-link" href="#">...</a>
      </li>
      ';
    }
    else
    {
      // $page_link .= '
      // <li class="page-item"><a class="page-link" id="egglog" href="javascript:void(0)" data-page_number="'.$page_array[$count].'">'.$page_array[$count].'</a></li>
      // ';
    }
  }
}

$output .= $previous_link . $page_link . $next_link;
$output .= '
  </ul>

</div>
';

echo $output;

?>