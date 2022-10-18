<?php 
include('database_connection.php');
if (isset($_POST['id'])) {
    
$id = $_POST['id'];

$query = "SELECT 
tblsales.id AS salesid,
tblsales.date AS salesdate,
tblproducts.id AS productid,
tblproducts.name AS name,
tblsalesitem.quantity AS quantity,
tblsalesitem.price AS price,
tblsalesitem.total AS total,
tblsales.vat AS vat,
tblsales.vattablesale AS vattablesale,
tblsales.total  AS grandtotal
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
                            Company Name
                        </h4>
                        <p class="fs18 text-uppercase">
                            Address Here
                        </p>
                    </div>
                    <div class="col-sm-6 text-muted mt-sm-0 mt-4 d-none d-sm-flex justify-content-sm-end">
                        <div>
                            <h4 class="fs35 gorditaB text-uppercase mb-1">
                                Invoice
                            </h4>
                            <p class="fs18">
                                Date: 10/28/2021
                            </p>
                            <p class="fs18">
                                Invoice # 001
                            </p>
                        </div>
                    </div>
                    <div class="col-sm-12 col-6 mt-sm-0 mt-4">
                        <h4 class="fs18 text-uppercase mb-2">
                            ISSUED BY:
                        </h4>
                        <h4 class="fs22 text-uppercase mb-1 d-flex align-items-center">
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
                                        <th class="text-center">
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