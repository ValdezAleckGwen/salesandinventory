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
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
    </head>

        <!-- Delete Function Jquery -->
        <script>
            $(document).ready(function () {

                // Delete 
                $(document).on('click', '.delete', function () {
                    var el = this;

                    // Delete id
                    var deleteid = $(this).data('id');
                    alert(deleteid);

                    // Confirm box
                    bootbox.confirm("Do you really want to delete record?", function (result) {

                        if (result) {
                            // AJAX Request
                            $.ajax({
                                url: '../actions/deletepayment.php',
                                type: 'POST',
                                data: {deleteid: deleteid},
                                success: function (response) {
                                alert(response);

                                    // Removing row from HTML Table
                                    if (response == ' Payment Deleted') {
                                        bootbox.alert('Record deleted.');
                                        $(el).closest('tr').css('background', 'tomato');
                                        $(el).closest('tr').fadeOut(800, function () {
                                            $(this).remove();
                                        });

                                    } else {
                                        bootbox.alert('Record not deleted');
                                    }

                                }
                            });
                        }

                    });

                });
            });
        </script>



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

                                        $output .= '<tr class class="data" data-id="'.$payable["payid"].'">';

                                        $output .=  '<td>
                                                        <p>'.$payable['delivery'].'</p>
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

                                        $output .= '<td style = "border-bottom:5px solid">
                                                        <p>'.$payable['price'].'</p>
                                                    </td>';
                                        
                                        $output .= '<td style = "border-bottom:5px solid">
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
                                        <td></td>
                                        <td></td>
                                        <td colspan="2" class="text-end border_sm_top"></td>
                                        <td class="text-end border-top">TOTAL AMOUNT</td>
                                        <td class="border">
                                            <p><?php echo $payables[0]['grandtotal']; ?> </p>
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>

                             <td class="text-center" style="border: 1px solid;"> 
                                <button class="delete btn btn-danger btn-sm rounded-0" 
                                    id="del_<?php echo $payable['payid'];?>"  
                                    data-id="<?php echo $payable['payid'];?>">
                                    <i class="fa-solidfa-circle-minus">Delete</i>
                                </button>
                            </td>

                        </div>
                    </div>
                </div>
            </div>       
        <!-- invoice_page -->

        
	
    </body>

</html>