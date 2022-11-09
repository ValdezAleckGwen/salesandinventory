<?php 
include('database_connection.php');
include('getdata.php');

if (isset($_POST['id'])) {
    
$id = $_POST['id'];

$query = "SELECT 
tblinventoryadjustment.id AS inventoryadj,
tblproducts.id AS productid,
tblproducts.name AS name,
tblinventoryadjustmentitem.quantity AS quantity

FROM tblinventoryadjustment

INNER JOIN tblinventoryadjustmentitem
ON tblinventoryadjustmentitem.invadjid=tblinventoryadjustment.id
INNER JOIN tblproducts
ON tblinventoryadjustmentitem.productid=tblproducts.id

WHERE tblinventoryadjustment.id = :id";



$statement  = $connect->prepare($query);
$statement->execute([
    ':id' => $id,

]);

$invents = $statement->fetchAll();

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
                        <button type="button" class="btn btn-dark print" style="font-size: 16px; font-weight: 700;"><i class="fa-solid fa-print"></i>Print</button>
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
                        
                        <h4 class="fs22 text-uppercase mb-1 d-flex align-items-center">
                            INV ADJ ID: <?php echo $invents[0]['inventoryadj']; ?>
                        </h4>
                    </div>

                    <div class="col-6 text-muted mt-sm-0 mt-4 d-sm-none d-flex justify-content-end">
                        <div>
                            <h4 class="fs35 gorditaB text-uppercase mb-1">
                                
                            </h4>
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

                                        

                                    </tr>

                                    <?php
                                    $output = '';
                                        foreach ($invents as $invent) {
                                        $output .= '<tr>';


                                        $output .=  '<td>
                                                        <p>'.$invent['productid'].'</p>
                                                    </td>';

                                        $output .= '<td>
                                                        <p>'.$invent['name'].'</p>
                                                    </td>';

                                        $output .= '<td>
                                                        <p>'.$invent['quantity'].'</p>
                                                    </td>';

                                    
                                        
                                        
                                        $output .= '</tr>';
                                        
                                        }
                                    echo $output;

                                    ?>

                                </tbody>
                                <tfoot>

                                   
                                
                                    <tr>
                                        
                                        
                                        <td colspan="2" class="text-end border_sm_top"></td>
                                        
                                        
                                    </tr>

                                </tfoot>
                            </table>
                        </div>
                    </div>
                   
        <!-- invoice_page -->

        
    
    </body>

</html>