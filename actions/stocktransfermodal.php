<?php 
include('database_connection.php');
include 'getdata.php';

if (isset($_POST['id'])) {
    
$id = $_POST['id'];

$query = "SELECT 
tblstocktransfer.id  AS stockid,
tblstocktransferitem.id  AS stockitemid,
tblproducts.id as productid,
tblproducts.name as productname,
tblproducts.price as price,
tblstocktransfer.userid as userid,
tblstocktransfer.date AS stockdate,
tblstocktransferitem.quantity as quantity

FROM tblstocktransfer 

INNER JOIN tblstocktransferitem
ON tblstocktransferitem.stocktransferid = tblstocktransfer.id
INNER JOIN tblproducts
ON tblstocktransferitem.productid=tblproducts.id


WHERE tblstocktransfer.id = :id";



$statement  = $connect->prepare($query);
$statement->execute([
    ':id' => $id,

]);

$stocks = $statement->fetchAll();
$userid = $stocks[0]['userid'];

}

?>

<!DOCTYPE html> 
<html lang="en">
    <head>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="icon" href="favicon.png" type="image/svg">
    </head>
    <body>

            <div class="container" style="pointer-events: none;">
                <div class="row printme">
                    <div class="col-sm-6 text-muted">
                        <h4 class="fs35 gorditaB text-uppercase mb-1">
                            <?php echo getCompanyName(); ?>
                        </h4>
                        <p class="fs18 text-uppercase">
                            <?php echo getCompanyAddress(); ?>
                        </p>
                    </div>
                    
                    <div class="col-sm-12 col-6 mt-sm-0 mt-4">
                        <h4 class="fs18 text-uppercase mb-2">
                            ISSUED BY: <?php echo getFullName($userid); ?>

                        </h4>
                        <h4 class="fs22 text-uppercase mb-1 d-flex align-items-center d-inline">
                            Stock Transfer ID: <?php echo $stocks[0]['stockid']; ?>
                        </h4>   

                        <h4 class="fs35 gorditaB text-uppercase mb-1">
                                Date: <?php echo $stocks[0]['stockdate']; ?>
                        </h4>                     
                    </div>

                    <div class="col-6 text-muted mt-sm-0 mt-4 d-sm-none d-flex justify-content-end">
                        <div>
                            <h4 class="fs35 gorditaB text-uppercase mb-1">
                                Invoice
                            </h4>
                            <p class="fs18">
                                Date: <?php echo $stocks[0]['stockdate']; ?>
                            </p>
                        </div>
                    </div>

                    <div class="col-sm-12 pt-4 pb-5 mb-5">
                        <div class="table-responsive-sm">
                            <table class="table">
                                <tbody>

                                    <tr>
                                        <th class="text-center">
                                            ITEM ID
                                        </th>
                                        <th class="text-center">
                                            NAME
                                        </th>
                                        <th class="text-center">
                                            QUANTITY
                                        </th>
                                        <th class="text-center">
                                            PRICE
                                        </th>
                                        
                                    </tr>

                                    <?php

                                    $output = '';

                                        foreach ($stocks as $stock) {
                                        $output .= '<tr>';

                                        $output .=  '<td>
                                                        <p>'.$stock['productid'].'</p>
                                                    </td>';

                                        $output .= '<td>
                                                        <p>'.$stock['productname'].'</p>
                                                    </td>';

                                        $output .= '<td>
                                                        <p>'.$stock['quantity'].'</p>
                                                    </td>';

                                        $output .= '<td>
                                                        <p>'.$stock['price'].'</p>
                                                    </td>';   

                                        $output .= '</tr>';                                                                                                      
                                        }

                                    echo $output;

                                    ?>                            
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
                   
        <!-- invoice_page -->

        
    
    </body>

</html>

