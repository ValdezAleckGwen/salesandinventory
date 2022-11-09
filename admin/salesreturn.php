<?php
	
session_start();
include '../actions/getdata.php';
include '../actions/adddata.php';
include '../actions/database_connection.php';


$id = $_SESSION['uid'];
$branchid = getBranch($id);


function fill_unit_select_box_sales($connect)
{
	$output = '';

	$query = "SELECT id AS salesid from tblsales";

	$result = $connect->query($query);

	foreach($result as $row)
	{
		$output .= '<option value="'.$row["salesid"].'">'.$row["salesid"] . '</option>';
	}

	return $output;
}		

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
		<title>SALES ADJUSTMENT</title>
		<link rel="stylesheet" href="../admin/assets/style.css">
		<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v6.0.0-beta3/css/all.css" type="text/css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta2/dist/css/bootstrap-select.min.css">

		<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta2/dist/js/bootstrap-select.min.js"></script>

		<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
	</head>
	<body>
<!-- Start of sidebar -->
    <div class="side-bar">
      
<!-- Start of Menu Proper -->      <div class="menu">
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
      $('.sub-btn').click(function(){
        $(this).next('.sub-menu').slideToggle();
        $(this).find('.dropdown').toggleClass('rotate');
      });
    });
    </script>
    <div class="main">
		<div class="container">
		  	<div class="table-title">
		    	<h3>SALES ADJUSTMENT</h3>
		    </div>			
			<div class="card">
				<div class="card-header">Enter Item Details</div>
				<div class="card-body">
					<form method="post" id="insert_form">
						<div class="table-repsonsive">
							<span id="error"></span>
							<table class="table table-bordered" id="item_table" style="max-height: 150px; overflow-y: scroll !important;">
							<div class="float-end">
								<label for="salesreturnid">Sales #:</label>
								<input type="text" name="salesreturnid" class="input-field" value="<?php echo createId('tblsalesreturn'); ?>" id="salesreturnid" readonly>
							</div>

							<div class="container m-1">
								<label for="salesid">Sales ID</h5>
								<select name="salesid" class="p-2 col col-sm-2 form-control selectpicker salesid" id="salesid" data-live-search="true" required><option value="">Select Sales</option><?php echo fill_unit_select_box_sales($connect); ?></select>
							</div>
								<thead style=" display: block; ">
								<tr>
									<th width="13.9%">Sales ID</th>
									<th width="15.9%">Product ID</th>
									<th width="23.6%">Product Name</th>
									<th width="11%">Price</th>
									<th width="8%">QTY</th>
									<th width="8%">Quantity Adj.</th>
									<th width="16%">Total Price</th>
									<th><button type="button" name="add" class="btn btn-success btn-sm add"><i class="fas fa-plus"></i></button></th>
								</tr>
							</thead>
								<tbody id="add-row" style="display: block; height: 500px;overflow-y: auto;overflow-x: hidden;">
								<tr></tr></tbody>
							<footer>
							<div class="row">

							</footer>
							</table>
							
							</table>
								<div class="col-sm-6" style="float: left">
									<input type="submit" name="submit" id="submit_button" class="btn btn-primary" value="Insert" />
								</div>				
							</div>
						</div>
					</form>
				</div>
								
			</div>
		</div>
	</body>
</html>
<script>

$(document).ready(function(){
	$('.add').prop('disabled', true);
	$(document).on('change', '#salesid', function () {
		salesid = $(this).val();
		if (salesid == '') {
			$('.add').prop('disabled', true);
		} else {
			$('.add').prop('disabled', false);
		}
	});



    $(document).on("change", ".item_quantity", function  () {
        

        var currentRow = $(this).closest("tr");
        var available = currentRow.find(".available_quantity");
        var quantity = currentRow.find(".item_quantity");
        var quantityval = $(this).val();
        quantityval = parseInt(quantityval);
        var availval = available.val();
        availval = parseInt(availval);

        if (quantityval > availval || quantityval <= 0 || quantityval == availval) {
        	quantity.addClass("border border-2 border-danger");
        	alert('Invalid Quantity input');
        	quantity.val('');
        } else {
        	quantity.removeClass("border border-2 border-danger");
        }
       
        
    });


	var count = 0;
	
	$(document).on('click', '.add', function(){

		
		var form_data = $('#insert_form').serialize();
		
		$.ajax({
        url: "../actions/addrowsalesreturn.php",
        method: "POST",
        data: form_data,
        success: function (data) {
            
        	//$('#item_table').append(data);
        	$(data).insertAfter($("#add-row > tr").eq(0));
			$('.selectpicker').selectpicker('refresh');

            }
        });


		

	});


	$(document).on('change')

	$(document).on('click', '.remove', function(){

		$(this).closest('tr').remove();

	});

	$('#insert_form').on('submit', function(event){

		event.preventDefault();

		var error = '';

		


		count = 1;

		$('.item_quantity').each(function(){

			if($(this).val() == '')
			{

				error += "<li>Enter Item Quantity at Row "+count+"</li>";

			}

			count = count + 1;

		});

		count = 1;

		$("select[name='item_id[]']").each(function(){

			if($(this).val() == '')
			{

				error += "<li>Select Unit at Row "+count+"</li>";

			}

			count = count + 1;

		});





		var form_data = $(this).serialize();

		if(error == '')
		{

			$.ajax({

				url:"../actions/insertsalesreturn.php",
				

				type:"POST",

				data:form_data,

				

				beforeSend:function()
	    		{

	    			$('#submit_button').attr('disabled', 'disabled');

	    		},

				success:function(data)
				{
					alert(data)

					if(!data)
					{
						alert("ERROR");

					} else {
						$('#item_table').find('tr:gt(0)').remove();

						$('#error').html('<div class="alert alert-success">Item Details Saved</div>');

						$('#item_table').append(add_input_field(0));

						$('.selectpicker').selectpicker('refresh');

						$('#total').val('');

						$('#tax').val('');
						
						$('vatable-sale').val('');

						$('#submit_button').attr('disabled', false);
					}

				}
			})

		}
		else
		{
			$('#error').html('<div class="alert alert-danger"><ul>'+error+'</ul></div>');
		}

	});
	 
});
</script>
<script>
	
	
$(document).ready(function(){
  
	$(document).on("change", ".item_id", function  () {
		
        
        var dataType = 6;
        var currentRow = $(this).closest("tr");
        var productid = $(this).val();
        var productcode = currentRow.find(".item_code");
        var name = currentRow.find(".item_name");
        var price = currentRow.find(".item_price");
        var quantity = currentRow.find(".available_quantity");
        var total = currentRow.find(".item_total");
        var actualPrice;

        $.ajax({
            url: "../actions/fetchproductinfo.php",
            method: "POST",
            data: {productid: productid, dataType: dataType},
            dataType: "JSON",
            success: function (data) {

                actualPrice = data.price.replace(/^/, '₱');
                productcode.val(data.productid);
                name.val(data.name); 
                price.val(actualPrice);
                quantity.val(data.quantity);	
                total.val(data.total);
                
            }
        });
        return false;
    });
	//

	$(document).on("keyup", ".item_quantity", function() {
		// total_amount();
		
		var currentRow = $(this).closest("tr");
		var quantity = $(this).val();
		var price = currentRow.find(".item_price").val();
		var totalPrice = currentRow.find(".item_total");
		var tax = $('#tax').val();
		var number;
		var vatSale;
		$.ajax({
			url: "../actions/fetchtotalprice.php",
			method: "POST",
			data: {quantity: quantity, price:price },
			success	: function (totalprice) {
				totalprice = totalprice.replace(/^/, '₱ ');
				totalPrice.val(totalprice);

				// number = totalprice;
				// number = number.replace(/[^a-zA-Z0-9]/g, '');
				// vatSale = number * .88;
				// number = number * .12;
				// number = parseFloat(number).toFixed(2);
				// vatSale = parseFloat(vatSale).toFixed(2);
				// $('#vat').val(number);
				// $('#vatable-sale').val(vatSale);


			}
		});


	});


	$(document).on("change", ".item_quantity", function() {
		var form_data = $('#insert_form').serialize();
		
		console.log(form_data)
		$.ajax({
			url: "../actions/fetchtotal.php",
			method: "POST",
			data: form_data,
			dataType: "JSON",
			success	: function (data) {
				
				
				$('#total').val(data.total);

			}
		});

	});

	
	
		
		

	




});



</script>