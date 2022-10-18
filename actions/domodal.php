<?php 
include('database_connection.php');
if (isset($_POST['id'])) {
    
$id = $_POST['id'];

$query = "SELECT 
tbldeliveryorder.id AS delivery,
tblsupplier.name AS suppliername,
tbldeliveryorder.date AS deliverydate,
tblproducts.id AS productid,
tblproducts.name AS name,
tbldeliveryorderitem.quantity AS quantity,
tbldeliveryorderitem.price AS price,
tbldeliveryorderitem.total AS total,
tbldeliveryorder.total  AS grandtotal
FROM tbldeliveryorder
INNER JOIN tblsupplier
ON tbldeliveryorder.supplierid=tblsupplier.id
INNER JOIN tbldeliveryorderitem
ON tbldeliveryorderitem.doid=tbldeliveryorder.id
INNER JOIN tblproducts
ON tbldeliveryorderitem.productid=tblproducts.id
WHERE tbldeliveryorder.id = :id";



$statement  = $connect->prepare($query);
$statement->execute([
    ':id' => $id,

]);

$deors = $statement->fetchAll();

}

?>
<!DOCTYPE html> 
<html lang="en">
    <head>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="icon" href="favicon.png" type="image/svg">
    </head>
    <body >


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
                                DO ID: <?php echo $deors[0]['delivery']; ?>
                            </p>
                            <p class="fs18">
                                Invoice # 001
                            </p>
                        </div>
                    </div>


                    <div class="col-sm-12 pt-4 pb-5 mb-5">
                        <div class="table-responsive-sm">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th class="text-center">
                                            SUPPLIER 
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
                                        foreach ($deors as $deor) {
                                        $output .= '<tr>';
                                         $output .=  '<td>
                                                        <p>'.$deor['suppliername'].'</p>
                                                    </td>';
                                        $output .=  '<td>
                                                        <p>'.$deor['productid'].'</p>
                                                    </td>';
                                        $output .= '<td>
                                                <p>'.$deor['name'].'</p>
                                            </td>';
                                        $output .= '<td>
                                                <p>'.$deor['quantity'].'</p>
                                            </td>';
                                        $output .= '<td style = "border-bottom:5px solid">
                                                <p>'.$deor['price'].'</p>
                                            </td>';
                                        
                                        $output .= '<td style = "border-bottom:5px solid">
                                                <p>'.$deor['total'].'</p>
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
                                        <td></td>
                                        <td></td>
                                        <td colspan="2" class="text-end border_sm_top"></td>
                                        <td class="text-end border-top">TOTAL AMOUNT</td>
                                        <td class="border">
                                            <p><?php echo $deors[0]['grandtotal']; ?> </p>
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                   
        <!-- invoice_page -->

        
	
    </body>

</html>