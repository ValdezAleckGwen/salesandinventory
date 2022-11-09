<?php 
include('database_connection.php');
include('getdata.php');
// this is the file where you can design inovice.Thanks buddy :)
if (isset($_GET['id'])) { // it was post method check and i convert into Get
    
$id = ltrim($_GET['id'],' '); //same here but with ltrim method to remove space from left side

$query = "SELECT 
tblsales.id AS salesid,
tblsales.salesdate AS salesdate,
tblproducts.id AS productid,
tblproducts.name AS name,
tblsalesitem.quantity AS quantity,
tblsalesitem.price AS price,
tblsalesitem.total AS total,
tblsales.vat AS vat,
tblsales.vattablesale AS vattablesale,
tblsales.total  AS grandtotal,
tblsales.userid AS userid


FROM tblsales 

INNER JOIN tblsalesitem
ON tblsalesitem.salesid=tblsales.id
INNER JOIN tblproducts
ON tblsalesitem.productid=tblproducts.id
WHERE tblsales.id = :id";



$statement  = $connect->prepare($query);
$statement->execute([
    ':id' => $id,

]);

$sales = $statement->fetchAll();
$userid = $sales[0]['userid'];

}

?>
<!DOCTYPE html> 
<html lang="en">
    <head>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="icon" href="favicon.png" type="image/svg">
    </head>
    <body>


            <div class="container">
                <div class="row printme">
                    <div style="display: inline;">
                        <a href="../cashier/pos_index.php" style="text-decoration: none; padding:10px; border-radius:10px;background:black;color:white;">Go Back to POS</a>
                        <button onClick="window.print();" type="button" class="btn btn-dark print" style="font-size: 16px; font-weight: 700;"><i class="fa-solid fa-print"></i> Print</button>
                    <!-- the windo.print() is used to print html page -->
                    </div>
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
                            Sales ID: <?php echo $sales[0]['salesid']; ?>
                        </h4>
                    </div>
                    <div class="col-6 text-muted mt-sm-0 mt-4 d-sm-none d-flex justify-content-end">
                        <div>
                            <h4 class="fs35 gorditaB text-uppercase mb-1">
                                Invoice
                            </h4>
                            <p class="fs18">
                                Date: <?php echo $sales[0]['salesdate']; ?>
                            </p>
                        </div>
                    </div>
                    <div class="col-sm-12 pt-4 pb-5 mb-5">
                        <div class="table-responsive-sm">
                            <table class="table" style="width: 100%;">
                            <!-- made width of table to 100% -->
                                <tbody>
                                    <tr>
                                        <th style="text-align:left;">
                                        <!-- all table heading alligned to left -->
                                            ITEM ID
                                        </th>
                                        <th style="text-align:left;">
                                            NAME
                                        </th>
                                        <th style="text-align:left;">
                                            QUANTITY
                                        </th>
                                        <th style="text-align:left;">
                                            PRICE
                                        </th>
                                        <th style="text-align:left;">
                                            TOTAL
                                        </th>
                                    </tr>
                                    <?php
                                    $output = '';
                                        foreach ($sales as $sale) {
                                        $output .= '<tr>';
                                        $output .=  '<td>
                                                        <p>'.$sale['productid'].'</p>
                                                    </td>';
                                        $output .= '<td>
                                                <p>'.$sale['name'].'</p>
                                            </td>';
                                        $output .= '<td>
                                                <p>'.$sale['quantity'].'</p>
                                            </td>';
                                        $output .= '<td>
                                                <p>'.$sale['price'].'</p>
                                            </td>';
                                        
                                        $output .= '<td>
                                                <p>'.$sale['total'].'</p>
                                            </td>';
                                        $output .= '</tr>';
                                        
                                        }
                                    echo $output;

                                    ?>

                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td class="text-end ps-4">
                                        VATABLE AMOUNT
                                    </td>
                                    <td class="bg-light border">
                                        <p><?php echo $sales[0]['vattablesale']; ?></p>
                                    </td>

                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td class="text-end ps-4" style = "border-bottom:4px solid">
                                            VAT
                                        </td>
                                        <td class="border" style = "border-bottom:4px solid">
                                            <p><?php echo $sales[0]['vat']; ?></p>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td></td>
                                        <td colspan="2" class="text-end border_sm_top"></td>
                                        <td class="text-end border-top">TOTAL AMOUNT</td>
                                        <td class="border">
                                            <p><?php echo $sales[0]['grandtotal']; ?> </p>
                                        </td>
                                    </tr>

                                </tbody >
                                <tfoot>





                                </tfoot>
                            </table>
                        </div>
                    </div>
                   
        <!-- invoice_page -->

        
	
    </body>

</html>

