<?php 
include('database_connection.php');
include('getdata.php');

if (isset($_POST['id'])) {
    
$id = $_POST['id'];

$query = "SELECT 
tbldeliveryorder.id AS delivery,
tblsupplier.name AS suppliername,
tblsupplier.address AS address,
tbldeliveryorder.date AS deliverydate,
tblproducts.id AS productid,
tblproducts.name AS name,
tbldeliveryorderitem.quantity AS quantity,
tbldeliveryorderitem.price AS price,
tbldeliveryorderitem.total AS total,
tbldeliveryorder.total  AS grandtotal,
tbldeliveryorder.userid AS userid

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
$userid = $deors[0]['userid'];

}

?>

<!DOCTYPE html> 
<html lang="en">
    <head>

    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="icon" href="favicon.png" type="image/svg">
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
    </head>



    <body >


            <div class="container">
                <div class="row printme">
                    <div style="display: inline;">
                        <button type="button" class="btn btn-dark print" style="font-size: 16px; font-weight: 700;"><i class="fa-solid fa-print"></i>Print</button>
                    </div>
                    <div class="col-sm-6 text-muted">
                        <h4 class="fs35 gorditaB text-uppercase mb-1">
                           <?php echo $deors[0]['suppliername']; ?>
                        </h4>
                        <p class="fs18 text-uppercase">
                            <?php echo substr($deors[0]['address'], 0, 39); ?>
                        </p>
                    </div>

                    <div class="col-sm-12 col-6 mt-sm-0 mt-4">
                        <h4 class="fs18 text-uppercase mb-2">
                            ISSUED BY:
                            <?php echo getFullName($userid); ?>
                        </h4>

                        <h4 class="fs22 text-uppercase mb-1 d-flex align-items-center">
                            DO ID: <?php echo $deors[0]['delivery']; ?>
                        </h4>
                        
                        <p class="fs18">
                                Date: <?php echo $deors[0]['deliverydate']; ?>
                        </p>
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

                                        $output .= '<tr class class="data" data-id="'.$deor["delivery"].'">';

                                         $output .= '<td>
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

                                        $output .= '<td style = "border-bottom:4px solid">
                                                        <p>'.$deor['price'].'</p>
                                                    </td>';
                                        
                                        $output .= '<td style = "border-bottom:4px solid">
                                                        <p>'.$deor['total'].'</p>
                                                    </td>';

                                        $output .= '</tr>';
                                        
                                        }
                                    echo $output;

                                    ?>

                                </tbody>
                                <tfoot>

                                   <tr></tr>
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
                            <td class="text-center" style="border: 1px solid;"> 

                            </td>
                        </div>
                    </div>
                </div>  
            </div>     
        <!-- invoice_page -->

        
	
    </body>

</html>