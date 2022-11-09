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

function fill_unit_select_box_branch($connect)
{
  

  $output = '';

  $query = "SELECT id AS branchid, name AS branchname from tblbranch";

  $result = $connect->query($query);

  foreach($result as $row)
  {
    
      $output .= '<option value="'.$row["branchid"].'">'.$row["branchname"] . '</option>';
    
  }

  return $output;
}



?>
<!DOCTYPE html>
<html>
    <head>
      <title>Admin - Purchase Order Dashboard</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Purchase Order</title>
        <link rel="stylesheet" href="../admin/assets/style.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
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
        <div class="item"><a href="dashboard_index.php"><i class="fa-regular fa-house-blank"></i>Home</a></div>

        <!-- Analytics -->
        <div class="item"><a href="analytics_index.php"><i class="fa-solid fa-chart-mixed"></i>Analytics</a></div>

        <!-- Branch -->
        <div class="item"><a href="branch_index.php"><i class="fa-solid fa-ballot"></i>Branch</a></div>

        <!-- Category -->
        <div class="item"><a href="category_index.php"><i class="fa-regular fa-table-cells-large"></i>Category</a></div>

        <!-- Products -->
        <div class="item"><a href="product_index.php"><i class="fa-regular fa-bag-shopping"></i>Products</a></div>

        <!-- Users -->
        <div class="item"><a href="user_index.php"><i class="fa-regular fa-user"></i>Users</a></div>

        <!-- Inventory-->
        <div class="item">
         <a class="sub-btn"><i class="fa-regular fa-warehouse"></i>Inventory<i class="fas fa-angle-right dropdown"></i></a>
         <div class="sub-menu">
            <a href="inventory_index.php" class="sub-item"><i class="fa-regular fa-house-blank"></i>Dashboard</a>
            <a href="inventoryadjustment.php" class="sub-item"><i class="fa-regular fa-shelves"></i></i>Adjustment</a>
            <a href="inventoryadjustment_index.php" class="sub-item"><i class="fa-regular fa-warehouse-full"></i></i>Adjustment Index</a>
          </div>
        </div>

        <!-- Stock Transfer-->
        <div class="item">
         <a class="sub-btn"><i class="fa-regular fa-box-circle-check"></i>Stock Transfer<i class="fas fa-angle-right dropdown"></i></a>
         <div class="sub-menu">
            <a href="stocktransfer_index.php" class="sub-item"><i class="fa-regular fa-house-blank"></i>Dashboard</a>
            <a href="stocktransfer.php" class="sub-item"><i class="fa-regular fa-box-check"></i></i>Stock Transfer</a>
          </div>
        </div>
        
        <!-- Suppliers-->
        <div class="item"><a href="suppliers_index.php"><i class="fa-regular fa-tag"></i>Suppliers</a></div>

        <!-- Payables-->
        <div class="item">
         <a class="sub-btn"><i class="fa-regular fa-money-check-dollar"></i>Payables<i class="fas fa-angle-right dropdown"></i></a>
         <div class="sub-menu">
            <a href="payables_index.php" class="sub-item"><i class="fa-regular fa-house-blank"></i>Dashboard</a>
            <a href="payment.php" class="sub-item"><i class="fa-regular fa-money-check-dollar"></i></i>Payments</a>
          </div>
        </div>

        <!-- Delivery Order-->
        <div class="item">
         <a class="sub-btn"><i class="fa-regular fa-truck"></i>Delivery Order<i class="fas fa-angle-right dropdown"></i></a>
         <div class="sub-menu">
            <a href="deliveryorder_index.php" class="sub-item"><i class="fa-regular fa-house-blank"></i>Dashboard</a>
            <a href="dorder.php" class="sub-item"><i class="fa-regular fa-truck-ramp-box"></i></i>Delivery Order</a>
          </div>
        </div>

        <!--Purchase Order-->
        <div class="item">
         <a class="sub-btn"><i class="fa-regular fa-file-invoice"></i>Purchase Order<i class="fas fa-angle-right dropdown"></i></a>
         <div class="sub-menu">
            <a href="purchaseorder_index.php" class="sub-item"><i class="fa-regular fa-house-blank"></i>Dashboard</a>
            <a href="purchaseorder.php" class="sub-item"><i class="fa-regular fa-receipt"></i>Purchase Order</a>
          </div>
        </div>

        <!-- Sales-->
        <div class="item">
         <a class="sub-btn"><i class="fa-regular fa-wallet"></i>Sales<i class="fas fa-angle-right dropdown"></i></a>
         <div class="sub-menu">
            <a href="sales_index.php" class="sub-item"><i class="fa-regular fa-house-blank"></i>Dashboard</a>
            <a href="salesreturn.php" class="sub-item"><i class="fa-regular fa-arrow-turn-down-left"></i>Sales Return</a>
         </div>
        </div>

        <!-- Reports-->
        <div class="item"><a href="report.php"><i class="fa-regular fa-file-chart-column"></i></i>Reports</a></div>

        <!-- Settings-->
        <div class="item">
         <a class="sub-btn"><i class="fa-regular fa-gears"></i>Settings<i class="fas fa-angle-right dropdown"></i></a>
         <div class="sub-menu">
            <a href="settings_index.php" class="sub-item"><i class="fa-regular fa-user"></i>Account Settings</a>
            <a href="tax_index.php" class="sub-item"><i class="fa-regular fa-percent"></i>Tax Settings</a>
          </div>
        </div>

        <!-- Logout -->
        <div class="item"><a href="login.php"><i class="fa-regular fa-arrow-right-from-bracket"></i>Logout</a></div>

        </div>
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
        <h3>DELIVERY ORDER</h3>
        <div class="d-flex justify-content-between">
          <div style="max-width: 250px" class="d-flex align-items-center">
              <label for="supplier_id"><span>Branch:&nbsp;</span></label>
              <select name="branch_id" class="p-2 col col-sm-2 form-control selectpicker branch_id" id="branch_id"><option value="">Select Branch</option><?php echo fill_unit_select_box_Branch($connect); ?></select>
          </div>
            <div class="d-flex align-items-center">

                <label for="search_box"><span>Search:&nbsp;</label></span><input class="" type="text" name="search_box" id="search_box" value=""/>

            </div>
        </div>


          </div>
        </div>
       
        <div border='1' class='table-responsive' id="dynamic_content">
        <!--product content-->
        </div>
      <!-- modal start -->
        <div class="modal fade " id="pomodal" role="dialog" style="width:80%; overflow-x: auto; white-space: nowrap; margin:auto; margin-top:10%">
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

    function load_data(page = 1, query = '', branch = '')
    {
      $.ajax({
        url:"../actions/fetchdeliveryorderadmin.php",
        method:"POST",
        data:{page:page, query:query, branch: branch},
        success:function(data)
        {
          $('#dynamic_content').html(data);
        }
      });
    }

    $(document).on('click', '.page-link', function(){
      var page = $(this).data('page_number');
      var query = $('#search_box').val();
      var branch = $('#branch_id').val();
      load_data(page, query, branch);
    });

    $('#search_box').keyup(function(){
      var query = $('#search_box').val();

      var branch = $('#branch_id').val();
      load_data(1, query, branch);
    });

    $(document).on('change', '#branch_id', function(){
      var page = $(this).data('page_number');
      var query = $('#search_box').val();
      var branch = $('#branch_id').val();
      load_data(1, query, branch);

      
    });

    $(document).on('click', '.data', function() {
      var id = $(this).data('id');
      

      $.ajax({
        url: '../actions/domodal.php', //modal structure
        type: 'post',
        data: {id: id},
        success: function(response){ 
            $('.modal-body').html(response); 
            $('#pomodal').modal('show'); 
        }
    });

    });

  });
</script>