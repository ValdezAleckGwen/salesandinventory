<?php 
include_once('database_connection.php');
include_once('getdata.php');

if (isset($_POST['id'])) {
    
$id = $_POST['id'];

$query = "SELECT 
tblpayables.id as payableid,
tblpayables.payabledate as datepaid,
tblpayableitem.id as itemid,
tblpayableitem.price as price,
tblpayableitem.quantity as quantity,
tblpayables.total as grandtotal,
tblpayables.userid as userid,
tblsupplier.name as suppliername,
tblsupplier.address as supaddress,
tblpayableitem.total as total,
tbldeliveryorderitem.id as doiid,
tbldeliveryorderitem.doid as doid,
tbldeliveryorderitem.productid as productid,
tblproducts.name as productname


FROM tblpayables

INNER JOIN tblpayableitem ON tblpayables.id=tblpayableitem.payableid
INNER JOIN tbldeliveryorderitem ON tblpayables.id=tbldeliveryorderitem.paymentid
INNER JOIN tblproducts ON tbldeliveryorderitem.productid=tblproducts.id
INNER JOIN tblsupplier ON tblpayableitem.supplierid=tblsupplier.id


WHERE tblpayables.id = :id";


$statement  = $connect->prepare($query);
$statement->execute([
    ':id' => $id,

]);

$payables = $statement->fetchAll();
$userid = $payables[0]['userid'];

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
                    <div style="display: inline;">
                        <button type="button" class="btn btn-dark print" style="font-size: 16px; font-weight: 700;"><i class="fa-solid fa-print"></i>Print</button>
                    </div>

                    <div class="col-sm-6 text-muted">
                        <h4 class="fs35 gorditaB text-uppercase mb-1">
                           <?php echo $payables[0]['suppliername']; ?>
                        </h4>
                        <p class="fs18 text-uppercase">
                            <?php echo substr($payables[0]['supaddress'], 0, 39); ?>
                        </p>
                    </div>

                    <div class="col-sm-6 text-muted mt-sm-0 mt-4 d-none d-sm-flex justify-content-sm-end">
                        <div>

                        </div>
                    </div>

                    <div class="col-sm-12 col-6 mt-sm-0 mt-4">
                        <h4 class="fs18 text-uppercase mb-2">
                            ISSUED BY: <?php echo getFullName($userid); ?>
                        </h4>
                        
                        <h4 class="fs22 text-uppercase mb-1 d-flex align-items-center">
                            PAYABLES ID: <?php echo $payables[0]['payableid']; ?>
                        </h4>

                            <p class="fs18">
                                Date: <?php echo $payables[0]['datepaid']; ?>
                            </p>
                    </div>

                    
                   
                            
                        
                    
                    

                    <div class="col-sm-12 pt-4 pb-5 mb-5">
                        <div class="table-responsive-sm">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th class="text-center">
                                            DELIVERY ORDER ID
                                        </th>
                                        
                                        <th class="text-center">
                                            ITEM ID
                                        </th>
                                        <th class="text-center">
                                            NAME
                                        </th>
                                        <th class="text-center">
                                            PRICE
                                        </th>
                                        <th class="text-center">
                                            QUANTITY
                                        </th>

                                        <th class="text-center">
                                            TOTAL
                                        </th>
                                    </tr>
                                    <?php
                                    $output = '';
                                        foreach ($payables as $payable) {
                                        $total = $payable['total'];
                                        $total = number_format($total, 2);
                                        $output .= '<tr>';

                                        $output .=  '<td>
                                                        <p>'.$payable['doid'].'</p>
                                                    </td>';
                                   
                                        $output .=  '<td>
                                                        <p>'.$payable['productid'].'</p>
                                                    </td>';

                                        $output .= '<td>
                                                        <p>'.substr($payable['productname'], 0, 30).'</p>
                                                    </td>';

                                        $output .= '<td>
                                                        <p>'.$payable['price'].'</p>
                                                    </td>';

                                        $output .= '<td style = "border-bottom:5px solid">
                                                        <p>'.$payable['quantity'].'</p>
                                                    </td>';
                                        
                                        $output .= '<td style = "border-bottom:5px solid">
                                                        <p>'.$total.'</p>
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
                                    id="del_<?php echo $payable['payableid'];?>"  
                                    data-id="<?php echo $payable['payableid'];?>">
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