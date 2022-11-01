<?php
session_start();
include '../actions/database_connection.php';
include '../actions/getdata.php';

$id = $_SESSION['uid'];
$branchid = getBranch($id);
$permission = getPermission($id);




$query = "
SELECT tblproducts.id AS productid, 
tblproducts.name AS productname, 
tblproducts.markupprice AS markupprice, 
tblcategory.name as categoryname,
tblinventory.id as inventoryid,
tblinventory.quantity as quantity
FROM tblproducts 
INNER JOIN tblsupplier 
ON tblproducts.supplier=tblsupplier.id
INNER JOIN tblcategory
ON tblproducts.category=tblcategory.id
INNER JOIN tblinventory
ON tblinventory.productid = tblproducts.id

";





$query .= 'ORDER BY quantity ASC ';



$statement = $connect->prepare($query);
$statement->execute();
$result = $statement->fetchAll();
$total_data = $statement->rowCount();


$output = '

<table class="table table-striped table-bordered" style="background: #CDCDCD; border-collapse: collapse;">
  <tr class="inventoryrow">
        <th class="text-center" style="border: 1px solid;">Product ID</th>
        <th class="text-center" style="border: 1px solid;">Inventory ID</th>
        <th class="text-center" style="border: 1px solid;">Product Name</th>
        <th class="text-center" style="border: 1px solid;">Category</th>
        <th class="text-left" style="border: 1px solid;">Quantity</th>
        <th class="text-left" style="border: 1px solid;">Markup Price (₱)</th>
        <th class="text-left" style="border: 1px solid;">Status </th>
        
  </tr>
';

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
      case ($quantity < 10):
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

    $output .= '
    <tr>
      <td style="border: 1px solid;">'.$row["productid"].'</td>
      <td style="border: 1px solid;">'.$row["inventoryid"].'</td>
      <td style="border: 1px solid;">'.$row["productname"].'</td>
      <td style="border: 1px solid;">'.$row["categoryname"].'</td>
      <td style="border: 1px solid;" class="quantity">'.$row["quantity"].'</td>
      <td style="border: 1px solid;">'.$row["markupprice"].'</td>
      <td style="border: 1px solid;"><p style="color: '.$color.' ; margin: 0px; font-weight: bold">'.$status.'</p></td>
    </tr>
    ';
}



echo $output;

?>