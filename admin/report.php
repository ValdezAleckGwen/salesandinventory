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
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>REPORTS</title>
        <link rel="stylesheet" href="../admin/assets/style.css">
        <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v6.0.0-beta3/css/all.css" type="text/css">
        <link href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css' rel='stylesheet' type='text/css'>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js'></script> 
        <script src='https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/5.5.2/bootbox.min.js'></script>
        <script src="/path/to/cdn/jquery.min.js"></script>
        <script src="/path/to/jQuery.print.js"></script>


    </head>
    <style>
    	@media print {
    		.menu * {
    			display: none !important; 
    		}
        #usericon * {
          display: none !important;
        }
    		#print * {
    			display: none !important; 
    		}
        .branch * {
          display: none !important; 
        }
        .type * {
          display: none !important; 
        }
        #dynamic_content * {
          visibility: visible; !important;  

        }
        

        

    		

    	}

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
        <div class="type">
       	<label for="type">Type</label>
          <select name="type" id="type" class="form-select m-3">
          	<option value="0">Select a Report</option>
          	<option value="1">Inventory</option>
          	<option value="2">Sales</option>
          	<option value="3">Payments</option>
          </select>
        </div>
        <div class="branch">
        	<label for="branch">Branch</label>
        	<select class="form-select m-3 branch" id=branch>
        		<option value="1">All</option>
        		<?php echo fill_unit_select_box_branch($connect); ?>
        	</select>
        </div>
        <div class="branch">
          <label for="starting">FROM</label>
          <input type="date" name="starting" id="starting" class="date">
          <label for="ending">TO</label>
          <input type="date" name="ending" id="ending" class="date">
          </select>
        </div>
        <div style="display: inline" id="print">
            <button type="button" class="btn btn-info print"  style="font-size: 16px; font-weight: 700;"><i class="fa-solid fa-print"></i> Print</button>

          </div>
        </div>
       
        <div border='1' class="table-repsonsive" id="dynamic_content">
        <!--product content-->
       
	        
	        
	  		
        </div>
        
    </body>
</html>
<script>
  $(document).ready(function(){
    start();
   $(document).on('click', '.print', function() {
   	window.print();
   	
   });


    

    function start() {
      var type = $('#type').val();
      if (type == '0') {
        $('#branch').prop('disabled', true);
      }
      $('.date').prop('disabled', true);
    }
    
    function load_data_inventory(branch = '')
    {
      
      
      $.ajax({
        url:"../actions/reportinventory.php",
        method:"POST",
        data:{branch:branch},
        success:function(data)
        {

          $('#dynamic_content').html(data);

        }
      });
    }

    function load_data_sales(branch = '', date1 = '', date2 = '')
    {
      var branch = $('#branch').val();
      
      $.ajax({
        url:"../actions/reportsales.php",
        method:"POST",
        data:{branch:branch, date1:date1, date2:date2},
        success:function(data)
        {
          $('#dynamic_content').html(data);
        }
      });
    }

    
    function load_data_payment(date1 = '', date2 = '')
    {
      
      
      $.ajax({
        url:"../actions/reportpayment.php",
        method:"POST",
        data:{date1:date1, date2:date2},
        success:function(data)
        {

          $('#dynamic_content').html(data);
        }
      });
    }

    



    $(document).on('change', '#type', function (){
      var type = $(this).val();
      var branch = $('#branch').val();
      
      if (type != 0 ) {
        $('#branch').prop('disabled', false);
      }

      if (type == 1 ) {
        load_data_inventory(branch);

        $('.date').prop('disabled', true);
      } else if (type == 2) {
        load_data_sales(branch);
        $('.date').prop('disabled', false);
      } else if (type == 3) {
        load_data_payment();
        $('.date').prop('disabled', false);
        $('#branch').prop('disabled', true);
      }
      





    });
    //end
    $(document).on('change', '#branch', function() {
      var type = $('#type').val();
      var branch = $(this).val();
      
      if (type == 1) {
        load_data_inventory(branch);
      } else if (type == 2) {
        load_data_sales(branch);
      } 

      
      
    });
    //end

    $(document).on('change', '.date', function() {
      var date1 = $('#starting').val();
      var date2 = $('#ending').val();
      var branch = $('#branch').val();
      var type = $('#type').val();
      if (type == 2) {
        load_data_sales(branch, date1, date2);
      } else if (type == 3) {

        load_data_payment(date1, date2);
      }
      

    });




  });
</script>