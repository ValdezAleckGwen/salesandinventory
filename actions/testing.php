<?php 
include 'database_connection.php';
include 'getdata.php';

$query = "
SELECT * from tblinventory
";





$query .= 'ORDER BY quantity ASC ';



$statement = $connect->prepare($query);
$statement->execute();
$results = $statement->fetchAll();




echo '<table class="table table-striped table-bordered" style="background: #CDCDCD; border-collapse: collapse;">';  
echo '<tr class="inventoryrow">';
echo '<th class="text-center" style="border: 1px solid;">Product ID</th>';

echo '</tr>';

  foreach($results as $row)
  {
    

    echo  '
    <tr>
      <td style="border: 1px solid;">'.$row["id"].'</td>

    </tr>
    ';
}







?>