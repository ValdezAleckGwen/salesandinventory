<?php
session_start();
include 'database_connection.php';
include 'getdata.php';

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
SELECT tblproducts.id AS productid, 
tblproducts.name AS productname, 
tblproducts.markupprice AS markupprice, 
tblcategory.name as categoryname,
tblinventory.branchid as branch,
tblinventory.id as inventoryid,
tblinventory.quantity as quantity
FROM tblproducts 
INNER JOIN tblsupplier 
ON tblproducts.supplier=tblsupplier.id
INNER JOIN tblcategory
ON tblproducts.category=tblcategory.id
INNER JOIN tblinventory
ON tblinventory.productid = tblproducts.id
WHERE tblproducts.active = 1
";


if($_POST['branch'] != '')
{
  $query .= '
   AND tblinventory.branchid = "'.$_POST['branch'].'" 
  ';
}


if($_POST['query'] != '')
{
  $query .= '
  AND tblproducts.name LIKE "%'.str_replace(' ', '%', $_POST['query']).'%" 
  ';
}

$query .= 'ORDER BY quantity ASC ';

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
  <tr class="inventoryrow">
        <th class="text-center" style="border: 1px solid;">Product ID</th>
        <th class="text-center" style="border: 1px solid;">Inventory ID</th>
        <th class="text-center" style="border: 1px solid;">Product Name</th>
        <th class="text-center" style="border: 1px solid;">Category</th>
        <th class="text-left" style="border: 1px solid;">Quantity</th>
        <th class="text-left" style="border: 1px solid;">Markup Price (₱)</th>
        <th class="text-left" style="border: 1px solid;">Branch</th>
        <th class="text-left" style="border: 1px solid;">Status </th>
        
  </tr>
';
if($total_data > 0)
{
  foreach($result as $row)
  {
    $quantity = $row['quantity'];
    $status = '';
    $color = '';
    switch ($quantity) {
      case ($quantity == null):
        $status = 'OUT OF STOCK';
        $color = 'red';
        break;
      case ($quantity <= 10):
        $status = 'NEED TO ORDER';
        $color = 'orange';
        break;
      case ($quantity > 10):
        $status = 'IN STOCK';
        $color = 'green';
        break;
      default:
        // code...
        break;
    }
    $branchname = branchName($row['branch']);
    $branchname = trim($branchname, 'Branch');
    $branchname = trim($branchname, 'branch');
    $output .= '
    <tr>
      <td style="border: 1px solid;">'.$row["productid"].'</td>
      <td style="border: 1px solid;">'.$row["inventoryid"].'</td>
      <td style="border: 1px solid;">'.$row["productname"].'</td>
      <td style="border: 1px solid;">'.$row["categoryname"].'</td>
      <td style="border: 1px solid;" class="quantity">'.$row["quantity"].'</td>
      <td style="border: 1px solid;">'.$row["markupprice"].'</td>
      <td style="border: 1px solid;">'.$branchname.'</td>
      <td style="border: 1px solid;"><p style="color: '.$color.' ; margin: 0px; font-weight: bold">'.$status.'</p></td>
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