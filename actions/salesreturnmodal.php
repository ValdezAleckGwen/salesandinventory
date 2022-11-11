<?php 
include('database_connection.php');
include('getdata.php');

if (isset($_POST['id'])) {
    
$id = $_POST['id'];

$query = "SELECT 
tblsalesreturn.id AS srid, 
tblsalesreturn.userid AS userid, 
tblsalesreturn.date AS srdate, 
tblsalesreturnitem.id as sriid, 
tblsalesreturnitem.quantity as quantity, 
tblsalesreturnitem.totalprice as total, 
tblsalesitem.id as salesitemid, 
tblsalesitem.price as price, 
tblsalesitem.productid as productid 

FROM tblsalesreturn 

INNER JOIN tblsalesreturnitem 
ON tblsalesreturnitem.salesreturnid = tblsalesreturn.id 
INNER JOIN tblsalesitem 
ON tblsalesreturnitem.salesitemid = tblsalesitem.id;


WHERE tblsalesreturn.id = :id";


$statement  = $connect->prepare($query);
$statement->execute([
    ':id' => $id,

]);

$salesreturn = $statement->fetchAll();
$userid = $salesreturn[0]['userid'];

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
                            ISSUED BY:
                            <?php echo getFullName($userid); ?>
                        </h4>
                        <h4 class="fs22 text-uppercase mb-1 d-flex align-items-center">
                            SALES RETURN ID: <?php echo $salesreturn[0]['srid']; ?>
                        </h4>
                    </div>

                    <div>
                        <div>
                            <h4 class="fs35 gorditaB text-uppercase mb-1">
                                Invoice
                            </h4>
                            <p class="fs18">
                                Date: <?php echo $salesreturn[0]['srdate']; ?>
                            </p>
                        </div>
                    </div>


                    <div class="col-sm-12 pt-4 pb-5 mb-5">
                        <div class="table-responsive-sm">
                            <table class="table">
                                <tbody>

                                    <tr>

                                        <th class="text-center">
                                            SALES ITEM ID 
                                        </th>
                                        <th class="text-center">
                                            ITEM ID
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
                                        foreach ($salesreturn as $salesreturns) {

                                        $output .= '<tr class class="data" data-id="'.$salesreturns["srid"].'">';

                                         $output .= '<td>
                                                        <p>'.$salesreturns['salesitemid'].'</p>
                                                    </td>';

                                        $output .=  '<td>
                                                        <p>'.$salesreturns['productid'].'</p>
                                                    </td>';

                                        $output .= '<td>
                                                        <p>'.$salesreturns['quantity'].'</p>
                                                    </td>';

                                        $output .= '<td>
                                                        <p>'.$salesreturns['price'].'</p>
                                                    </td>';
                                        
                                        $output .= '<td>
                                                        <p>'.$salesreturns['total'].'</p>
                                                    </td>';

                                        $output .= '</tr>';
                                        
                                        }
                                    echo $output;

                                    ?>

                                </tbody>
                                <tfoot>

                                   <tr></tr>
                                   
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>  
            </div>     
        <!-- invoice_page -->

        
	
    </body>

</html>