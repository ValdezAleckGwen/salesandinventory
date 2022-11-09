<?php
session_start(); 
include('database_connection.php');
include 'getdata.php';

$id = $_SESSION['uid'];

$firstname = getFirstname($id);



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
                            ISSUED BY: <?php echo $firstname ?>
                        </h4>

                        <h4 class="fs22 text-uppercase mb-1 d-flex align-items-center d-inline">
                            Sales ID: <?php echo $_POST['salesid'] ?>
                        </h4>
                    </div>
                    <div class="col-6 text-muted mt-sm-0 mt-4 d-sm-none d-flex justify-content-end">
                        <div>
                            <h4 class="fs35 gorditaB text-uppercase mb-1">
                                Invoice
                            </h4>
                           <!--  <p class="fs18">
                                Date: <?php //echo $sales[0]['salesdate']; ?>
                            </p> -->
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
                                        for($count = 0; $count < count($_POST["item_id"]); $count++) {
                                        $output .= '<tr>';
                                        $output .=  '<td>
                                                        <p>'.echo $_POST['item_id'][$count].'</p>
                                                    </td>';
                                        $output .= '<td>
                                                <p>'.echo $_POST['item_name'][$count].'</p>
                                            </td>';
                                        $output .= '<td>
                                                <p>'.echo $_POST['item_quantity'][$count].'</p>
                                            </td>';
                                        $output .= '<td>
                                                <p>'.echo $_POST['item_price'][$count].'</p>
                                            </td>';
                                        
                                        $output .= '<td>
                                                <p>'.echo $_POST['item_total'][$count].'</p>
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
                                        <p><?php echo $_POST['vattable-sale']; ?></p>
                                    </td>

                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td class="text-end ps-4" style = "border-bottom:4px solid">
                                            VAT
                                        </td>
                                        <td class="border" style = "border-bottom:4px solid">
                                            <p><?php echo $_POST['vat']; ?></p>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td></td>
                                        <td colspan="2" class="text-end border_sm_top"></td>
                                        <td class="text-end border-top">TOTAL AMOUNT</td>
                                        <td class="border">
                                            <p><?php echo $_POST['total']; ?> </p>
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

