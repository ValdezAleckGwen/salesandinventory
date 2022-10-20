<?php 
include('database_connection.php');
if (isset($_POST['id'])) {
    
$id = $_POST['id'];

$query = "SELECT 
tblpurchaseorder.id AS poid,
tblsupplier.name AS suppliername,
tblproducts.id AS productid,
tblproducts.name AS name,
tblpurchaseorderitem.quantity AS quantity,
tblpurchaseorderitem.total AS total,
tblpurchaseorderitem.price AS price,
tblpurchaseorder.date as purchasedate,
tblpurchaseorder.total  AS grandtotal

FROM tblpurchaseorder
INNER JOIN tblsupplier
ON tblpurchaseorder.supplierid=tblsupplier.id
INNER JOIN tblpurchaseorderitem
ON tblpurchaseorderitem.poid=tblpurchaseorder.id
INNER JOIN tblproducts
ON tblpurchaseorderitem.productid=tblproducts.id

WHERE tblpurchaseorder.id = :id";



$statement  = $connect->prepare($query);
$statement->execute([
    ':id' => $id,

]);

$purchases = $statement->fetchAll();

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

                    <div class="col-sm-12 col-6 mt-sm-0 mt-4">
                        <h4 class="fs18 text-uppercase mb-2">
                            ISSUED BY:
                        </h4>
                        <h4 class="fs22 text-uppercase mb-1 d-flex align-items-center">
                            PO ID: <?php echo $purchases[0]['poid']; ?>
                        </h4>
                    </div>

                    <div class="col-6 text-muted mt-sm-0 mt-4 d-sm-none d-flex justify-content-end">
                        <div>
                            <h4 class="fs35 gorditaB text-uppercase mb-1">
                                Invoice
                            </h4>
                            <p class="fs18">
                                Date: <?php echo $purchases[0]['purchasedate']; ?>
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
                                        foreach ($purchases as $purhcase) {
                                        $output .= '<tr>';
                                         $output .=  '<td>
                                                        <p>'.$purhcase['suppliername'].'</p>
                                                    </td>';
                                        $output .=  '<td>
                                                        <p>'.$purhcase['productid'].'</p>
                                                    </td>';
                                        $output .= '<td>
                                                <p>'.$purhcase['name'].'</p>
                                            </td>';
                                        $output .= '<td>
                                                <p>'.$purhcase['quantity'].'</p>
                                            </td>';
                                        $output .= '<td style = "border-bottom:5px solid">
                                                <p>'.$purhcase['price'].'</p>
                                            </td>';
                                        
                                        $output .= '<td style = "border-bottom:5px solid">
                                                <p>'.$purhcase['total'].'</p>
                                            </td>';
                                        $output .= '</tr>';
                                        
                                        }
                                    echo $output;

                                    ?>

                                </tbody>
                                <tfoot>

                                   
                                
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td colspan="2" class="text-end border_sm_top"></td>
                                        <td class="text-end border-top">TOTAL AMOUNT</td>
                                        <td class="border">
                                            <p><?php echo $purchases[0]['grandtotal']; ?> </p>
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                   
        <!-- invoice_page -->

        
	
    </body>

</html>