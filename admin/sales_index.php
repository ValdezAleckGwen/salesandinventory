<?php
session_start();
include '../actions/getdata.php';
include '../x-function/redirect_if_notLogin.php';
include '../actions/adddata.php';
include '../actions/database_connection.php';

$id = $_SESSION['uid'];
$branchid = getBranch($id);

function displayUser() {
  $output = '';
  if (isset($_SESSION['uid'])) {
    $id = $_SESSION['uid'];
    $userid = getId($id);
    $firstname = getFirstname($id);
    $output  .= '<p id="user" data-id="'.$userid.'">'.$firstname.'</p>';
  }
  return $output;
} 
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>SALES</title>
        <link rel="stylesheet" href="../admin/assets/style.css">
        <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v6.0.0-beta3/css/all.css" type="text/css">
        <link href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css' rel='stylesheet' type='text/css'>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js'></script> 
        <script src='https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/5.5.2/bootbox.min.js'></script>

    </head>
    
    </style>
    <body>
    <!-- Start of sidebar -->
    <div class="side-bar">

<!-- Start of Menu Proper -->
      <div class="menu">
        <!-- Dashboard -->
        <div class="item"><a href="dashboard_index.php"><i class="fa-regular fa-house-blank"></i>Dashboard</a></div>

        <!-- Analytics -->
        <div class="item"><a href="analytics_index.php"><i class="fa-solid fa-chart-mixed"></i>Analytics</a></div>

        <!-- Branch -->
        <div class="item">
          <a class="sub-btn"><i class="fa-solid fa-ballot"></i>Branch<i class="fas fa-angle-right dropdown"></i></a>
          <div class="sub-menu">
            <a href="branch_index.php" class="sub-item"><i class="fa-regular fa-house-blank"></i>Dashboard</a>
          </div>
        </div>      

        <!-- Products -->
        <div class="item">
          <a class="sub-btn"><i class="fa-regular fa-bag-shopping"></i>Products<i class="fas fa-angle-right dropdown"></i></a>
          <div class="sub-menu">
            <a href="product_index.php" class="sub-item"><i class="fa-regular fa-house-blank"></i>Dashboard</a>

          </div>
        </div>

        <!-- Category -->
        <div class="item">
          <a class="sub-btn"><i class="fa-regular fa-table-cells-large"></i>Category<i class="fas fa-angle-right dropdown"></i></a>
          <div class="sub-menu">
            <a href="category_index.php" class="sub-item"><i class="fa-regular fa-house-blank"></i>Dashboard</a>
          </div>
        </div>

        <!-- Inventory-->
        <div class="item">
         <a class="sub-btn"><i class="fa-regular fa-warehouse"></i>Inventory<i class="fas fa-angle-right dropdown"></i></a>
         <div class="sub-menu">
            <a href="inventoryadj_index.php" class="sub-item"><i class="fa-regular fa-house-blank"></i>Dashboard</a>
            <a href="inventoryadjustment_index.php" class="sub-item"><i class="fa-regular fa-box-circle-check"></i>Adjustment</a>
          </div>
        </div>

        <!-- Purchase Order -->
        <div class="item"><a href="purchaseorder_index.php"><i class="fa-regular fa-file-invoice"></i>Purchase Order</a></div>

        <!-- Delivery Order -->
        <div class="item"><a href="deliveryorder_index.php"><i class="fa-regular fa-truck"></i>Delivery Order</a></div>


        <!-- Suppliers-->
        <div class="item">
         <a class="sub-btn"><i class="fa-regular fa-tag"></i>Suppliers<i class="fas fa-angle-right dropdown"></i></a>
         <div class="sub-menu">
            <a href="suppliers_index.php" class="sub-item"><i class="fa-regular fa-house-blank"></i>Dashboard</a>
          </div>
        </div>

        <!-- Sales-->
        <div class="item">
         <a class="sub-btn"><i class="fa-regular fa-wallet"></i>Sales<i class="fas fa-angle-right dropdown"></i></a>
         <div class="sub-menu">
            <a href="sales_index.php" class="sub-item"><i class="fa-regular fa-house-blank"></i>Dashboard</a>
            <a href="salesreturn_index.php" class="sub-item"><i class="fa-regular fa-arrow-turn-down-left"></i>Sales Return</a>
         </div>
        </div>

        <!-- Payments -->
        <div class="item"><a href="payment_index.php"><i class="fa-solid fa-basket-shopping"></i>Payments</a></div>

        <!-- Users -->
        <div class="item">
         <a class="sub-btn"><i class="fa-regular fa-user"></i>Users<i class="fas fa-angle-right dropdown"></i></a>
         <div class="sub-menu">
            <a href="user_index.php" class="sub-item"><i class="fa-regular fa-house-blank"></i>Dashboard</a>

          </div>
        </div>
      

        <!-- Settings -->
        <div class="item">
         <a class="sub-btn"><i class="fa-regular fa-gears"></i>Settings<i class="fas fa-angle-right dropdown"></i></a>
         <div class="sub-menu">
            <a href="settings_index.php" class="sub-item"><i class="fa-regular fa-house-blank"></i>Dashboard</a>
            <a href="tax_index.php" class="sub-item"><i class="fa-solid fa-percent"></i>TAX</a>
         </div>
        </div>

        <!-- Logout -->
        <div class="item"><a href="login.php"><i class="fa-regular fa-arrow-right-from-bracket"></i>Logout</a></div>

      </div>
    </div>


    <div class="usericon"><?php echo displayUser(); ?> <i class="fa-regular fa-user"></i></div>  

    <script type="text/javascript">
    $(document).ready(function(){
      //jquery for toggle sub menus
      $('.sub-btn').click(function(){
        $(this).next('.sub-menu').slideToggle();
        $(this).find('.dropdown').toggleClass('rotate');
      });
    });

    </script>
<div class="main">
  <div class="flex-container">
     <div class="flex-items">
       <div class="table-title">
        <h3>SALES</h3>
        <div style="display: inline">
            <button type="button" class="btn btn-dark" style="font-size: 16px; font-weight: 700;"><i class="fa-solid fa-print"></i> Print</button>
        <div style="float: right;">
            <label><span>Search: </span><input type="text" name="search_box" id="search_box" value=""/></label>       
        </div>
          </div>
        </div>
       
        <div border='1' class='table-responsive' id="dynamic_content">
        <!--product content-->
        </div>
        
      <!-- modal start -->
        <div class="modal fade " id="salesmodal" role="dialog" style="width:80%; overflow-x: auto; white-space: nowrap; margin:auto; margin-top:10%">
              <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">×</button>
                  </div>
                    <style>
                        #model-body-container > .container{
                            width: 100% !important;}
                        #model-body-container .col-sm-6
                        {
                            width: 25% !important;
                        }
                    </style>
                  <div class="modal-body" id='model-body-container'>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  </div>
              </div>      
        </div>
        <!-- modal end -->
  </body>
</html>
<script>

   // Start of Pagination Query // 
  $(document).ready(function(){
        load_data(1);

    function load_data(page = 1, query = '')
    {
      $.ajax({
        url:"../actions/fetchsales.php",
        method:"POST",
        data:{page:page, query:query},
        success:function(data)
        {
          $('#dynamic_content').html(data);
        }
      });
    }

    $(document).on('click', '.page-link', function(){
      var page = $(this).data('page_number');
      var query = $('#search_box').val();
      load_data(page, query);
    });

    $('#search_box').keyup(function(){
      var query = $('#search_box').val();
      load_data(2, query);
    });

  });

    //Start of DO Modal
    $(document).on('click', '.data', function() {
      var id = $(this).data('id');
      

      $.ajax({
        url: '../actions/salesmodal.php', //modal structure
        type: 'post',
        data: {id: id},
        success: function(response){ 
            $('.modal-body').html(response); 
            $('#salesmodal').modal('show'); 
        }
    });

    });
    //modal end



   
 

</script>