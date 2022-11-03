<?php
session_start();
include('database_connection.php');
include('getdata.php');

$id = $_SESSION['uid'];
$branchid = getBranch($id);
$permission = getPermission($id);

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
  SELECT 
  tblstocktransfer.id AS stid,
  tblstocktransfer.source as source,
  tblbranch.name as name,
  tblstocktransfer.destination as destination,
  tblbranch.name as name,
  tblstocktransfer.date AS stockdate,
  tblusers.id as userid

  FROM tblstocktransfer

  INNER JOIN tblbranch 
  ON tblstocktransfer.source = tblbranch.id 
  INNER JOIN tblusers
  ON tblstocktransfer.userid=tblusers.id
  ";



if($_POST['query'] != '')
{
  $query .= '
  AND tblstocktransfer.id LIKE "%'.str_replace(' ', '%', $_POST['query']).'%" 
  ';
}

$query .= 'ORDER BY tblstocktransfer.id ASC ';

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
        <th class="text-center" style="border: 1px solid;">Stock Transfer ID</th>
        <th class="text-center" style="border: 1px solid;">Source</th>
        <th class="text-center" style="border: 1px solid;">Destination</th>
        <th class="text-center" style="border: 1px solid;">Created By</th>
        <th class="text-center" style="border: 1px solid;">Date</th>
  </tr>
';
if($total_data > 0)
{
  foreach($result as $row)
  {
    $output .= '
    <tr class="data" data-id="'.$row["stid"].'">
      <td style="border: 1px solid;">'.$row["stid"].'</td>
      <td style="border: 1px solid;">'.$row["source"].'</td>
      <td style="border: 1px solid;">'.$row["destination"].'</td>
      <td style="border: 1px solid;">'.$row["userid"].'</td>
      <td style="border: 1px solid;">'.$row["stockdate"].'</td>
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
$pagination_limit = 4;

//echo $total_links;
$page_array[] = null; //this is it pancit
if($total_links > 4)
{
  if($page < $pagination_limit)
  {
    for($count = 1; $count <= $pagination_limit; $count++)
    {
      $page_array[] = $count;
    }
    $page_array[] = '...';
    $page_array[] = $total_links;
  }
  else
  {
    $end_limit = $total_links - $pagination_limit;
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
      $previous_link = '<li class="page-item"><a class="page-link"   href="javascript:void(0)" data-page_number="'.$previous_id.'">Previous</a></li>';

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
      $next_link = '<li class="page-item"><a class="page-link" href="javascript:void(0)" data-page_number="'.$next_id.'">Next</a></li>';
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
      if($page_array[$count] != ''){
        $page_link .= '
        <li class="page-item">
          <a class="page-link" href="javascript:void(0)" data-page_number="'.$page_array[$count].'">'.$page_array[$count].'</a></li>
        ';
        
      }
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