<?php 
include('database_connection.php');
include('getdata.php');

if (isset($_POST['id'])) {
    
$id = $_POST['id'];

$query = "SELECT 
tblpurchaseorder.id AS poid,
tblsupplier.name AS suppliername,
tblsupplier.address AS address,
tblproducts.id AS productid,
tblproducts.name AS name,
tblpurchaseorderitem.poquantity AS poquantity,
tblpurchaseorderitem.pototal AS pototal,
tblpurchaseorderitem.price AS price,
tblpurchaseorder.date as purchasedate,
tblpurchaseorder.total  AS grandtotal,
tblpurchaseorder.userid AS userid

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
$userid = $purchases[0]['userid'];




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
                                url: '../actions/deletepo.php',
                                type: 'POST',
                                data: {deleteid: deleteid},
                                success: function (response) {
                                alert(response);

                                    // Removing row from HTML Table
                                    if (response == ' ok') {
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

            <div class="container" >
                
                <div class="row printme">
                    <div style="display: inline;">
                        <button type="button" class="btn btn-dark print" style="font-size: 16px; font-weight: 700;"><i class="fa-solid fa-print"></i> Print</button>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 text-muted">
                            <h4 class="fs35 gorditaB text-uppercase mb-1">
                                <?php echo $purchases[0]['suppliername']; ?>
                            </h4>
                            <p class="fs18 text-uppercase">
                                <?php echo substr($purchases[0]['address'], 0, 39); ?>

                            </p>
                            <div class="col-sm-6 text-muted">
                                <p>Date: <?php echo $purchases[0]['purchasedate']; ?></p> 
                            </div>
                        </div>
                    </div>

                    

                    <div class="col-sm-12 col-6 mt-sm-0 mt-4" style="display: inline;">
                        <h4 class="fs18 text-uppercase mb-2">
                            ISSUED BY:
                            <?php echo getFullName($userid); ?>
                        </h4>
                        <h4 class="fs22 text-uppercase mb-1 d-flex align-items-center">
                            PO ID: <?php echo $purchases[0]['poid']; ?>
                        </h4>
                       
                        

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
                                            PO QUANTITY
                                        </th>
                                        <th class="text-center">
                                            PRICE
                                        </th>
                                        <th class="text-center">
                                            PO TOTAL
                                        </th>
                                        
                                    </tr>

                                    <?php
                                    $output = '';
                                        foreach ($purchases as $purhcase) {

                                        $output .= '<tr class class="data" data-id="'.$purhcase["poid"].'">';

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
                                                        <p>'.$purhcase['poquantity'].'</p>
                                                    </td>';

                                        $output .= '<td style = "border-bottom:5px solid">
                                                        <p>'.$purhcase['price'].'</p>
                                                    </td>';
                                        
                                        $output .= '<td style = "border-bottom:5px solid">
                                                        <p>'.$purhcase['pototal'].'</p>
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

                            <td class="text-center" style="border: 1px solid;"> 
                                <button class="delete btn btn-danger btn-sm rounded-0" 
                                    id="del_<?php echo $purhcase['poid'];?>"  data-id="<?php echo $purhcase['poid'];?>">
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