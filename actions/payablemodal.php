<?php 
include('database_connection.php');
if (isset($_POST['id'])) {
    
$id = $_POST['id'];

$query = "SELECT 
tblpayables.id AS payid,
tbldeliveryorder.id as delivery,
tblproducts.id AS productid,
tblproducts.name AS name,
tblpayableitem.quantity AS quantity,
tblpayableitem.total AS total,
tblpayableitem.price AS price,
tblpayables.date as datepaid,
tblpayables.total  AS grandtotal
FROM tblpayables
INNER JOIN tblpayableitem
ON tblpayableitem.payableid=tblpayables.id
INNER JOIN tblproducts
ON tblpayableitem.productid=tblproducts.id
INNER JOIN tbldeliveryorder
ON tblpayableitem.doid=tbldeliveryorder.id


WHERE tblpayables.id = :id";



$statement  = $connect->prepare($query);
$statement->execute([
    ':id' => $id,

]);

$payables = $statement->fetchAll();

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
                            PAYABLES ID: <?php echo $payables[0]['payid']; ?>
                        </h4>
                    </div>
                    <div class="col-6 text-muted mt-sm-0 mt-4 d-sm-none d-flex justify-content-end">
                        <div>
                            <h4 class="fs35 gorditaB text-uppercase mb-1">
                                Invoice
                            </h4>
                            <p class="fs18">
                                Date: <?php echo $payables[0]['datepaid']; ?>
                            </p>
                        </div>
                    </div>
                    <div class="col-sm-12 pt-4 pb-5 mb-5">
                        <div class="table-responsive-sm">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th class="text-center">
                                            DELIVERY ID
                                        </th>
                                        
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
                                        foreach ($payables as $payable) {
                                        $output .= '<tr>';
                                         $output .=  '<td>
                                                        <p>'.$payable['deliveryid'].'</p>
                                                    </td>';
                                   
                                        $output .=  '<td>
                                                        <p>'.$payable['productid'].'</p>
                                                    </td>';
                                        $output .= '<td>
                                                <p>'.$payable['name'].'</p>
                                            </td>';
                                        $output .= '<td>
                                                <p>'.$payable['quantity'].'</p>
                                            </td>';
                                        $output .= '<td>
                                                <p>'.$payable['price'].'</p>
                                            </td>';
                                        
                                        $output .= '<td>
                                                <p>'.$payable['total'].'</p>
                                            </td>';
                                        $output .= '</tr>';
                                        
                                        }
                                    echo $output;

                                    ?>

                                </tbody>
                                <tfoot>

                                   
                                    <tr>

                                    </tr>
                                    <tr>
                                        <td colspan="2" class="text-end border_sm_top"></td>
                                        <td class="text-end border-top">TOTAL AMOUNT</td>
                                        <td class="border">
                                            <p><?php echo $payables[0]['grandtotal']; ?> </p>
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                   
        <!-- invoice_page -->

        
	
    </body>

</html>