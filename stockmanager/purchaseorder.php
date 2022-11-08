<?php 
session_start(); 
include '../actions/getdata.php';
include '../x-function/redirect_if_notLogin.php';
include '../actions/adddata.php';
include '../actions/database_connection.php';

$id = $_SESSION['uid'];
$branchid = getBranch($id);

function fill_unit_select_box_supplier($connect)
{
	$output = '';

	$query = "SELECT id AS supplierid, name AS suppliername from tblsupplier WHERE active = 1";

	$result = $connect->query($query);



	foreach($result as $row)
	{
		$output .= '<option value="'.$row["supplierid"].'">'.$row["suppliername"] . '</option>';
	}

	return $output;
}		

//remove this if cookie is configured

function fill_unit_select_box_branch($connect, $branchid)
{
	

	$output = '';

	$query = "SELECT id AS branchid, name AS branchname from tblbranch";

	$result = $connect->query($query);

	foreach($result as $row)
	{
		if ($branchid == $row["branchid"]) {
			$output .= '<option value="'.$row["branchid"].'" selected>'.$row["branchname"] . '</option>';
		} else {
			$output .= '<option value="'.$row["branchid"].'">'.$row["branchname"] . '</option>';
		}
		
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
		<title>Stock Manager - Purchase Order</title>
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

        <!-- Inventory-->
        <div class="item">
         <a class="sub-btn"><i class="fa-regular fa-warehouse"></i>Inventory<i class="fas fa-angle-right dropdown"></i></a>
         <div class="sub-menu">
            <a href="inventory_index.php" class="sub-item"><i class="fa-regular fa-house-blank"></i>Dashboard</a>
            <a href="inventoryadjustment.php" class="sub-item"><i class="fa-regular fa-shelves"></i>Adjustment</a>
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

        <!-- Settings-->
        <div class="item">
         <a class="sub-btn"><i class="fa-regular fa-gears"></i>Settings<i class="fas fa-angle-right dropdown"></i></a>
         <div class="sub-menu">
            <a href="settings_index.php" class="sub-item"><i class="fa-regular fa-user"></i>Account Settings</a>
          </div>
        </div>

        <!-- Logout -->
        <div class="item"><a href="login.php"><i class="fa-regular fa-arrow-right-from-bracket"></i>Logout</a></div>

      </div>
    </div>


        <!-- Logout -->
        <div class="item"><a href="login.php"><i class="fa-regular fa-arrow-right-from-bracket"></i>Logout</a></div>

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
	    	<h3>PURCHASE ORDER</h3>
	    </div>
			<div class="card">
				<div class="card-header">Enter Item Details</div>
				<div class="card-body">
					<form method="post" id="insert_form">
						<div class="table-repsonsive">
							<span id="error"></span>
							<table class="table table-bordered" id="item_table" style="max-height: 150px; overflow-y: scroll !important;">
							<div class="float-end">
								<label for="po_number">PO #:</label>
								<input type="text" name="po_number" class="input-field" value="<?php echo createId('tblpurchaseorder'); ?>" readonly>
							</div>
							<div class="container m-1">
								<label for="branch_id" id="labeler">For Branch: <?php echo displayBranch($id); ?></label>
								<select name="branch_id" class="p-2 col col-sm-2 form-control selectpicker branch_id d-none" id="branch_id"><option value="">Select Branch</option><?php echo fill_unit_select_box_branch($connect, $branchid); ?></select>
							</div>
							<div class="container m-1">
								<label for="supplier_id">Supplier:</label>
                                <select name="supplier_id" class="p-2 col col-sm-2 form-control selectpicker supplier_id" id="supplier_id"><option value="">Select Supplier</option><?php echo fill_unit_select_box_supplier($connect); ?></select>
							</div>
							

								<thead style=" display: block; ">
								<tr>
									<th width="20%">Product Code</th>
									<th width="30%">Product Name</th>
									<th width="15%">Price</th>
									<th width="15%">Enter Quantity</th>
									<th width="30%">Total Price</th>
									<th><button type="button" name="add" class="btn btn-success btn-sm add"><i class="fas fa-plus"></i></button></th>
								</tr>
								</thead>
								<tbody id="add-row" style="display: block; height: 500px;overflow-y: auto;overflow-x: hidden;">
							<tr>
								
								</tr>
							</tbody>
							</table>
							<div class="col-sm-7" style="float: left">
								<input type="submit" name="submit" id="submit_button" class="btn btn-primary" value="Insert" />
							</div>
							</div>
							<div class="col-sm-5" style="float: right">
									<div class="input-group mb-3">
									  <span class="input-group-text" id="basic-addon3">Total</span>
									  <input type="text" name="total" id="total" class="form-control total" readonly/>
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
	$(document).on('change', '#supplier_id', function() {
		supplier = $(this).val();
		branch = $('#branch_id').val();
		
		if (branch == '' || supplier == '') {
			$('.add').prop('disabled', true); //disabled if no value
			
		} else {
			$('.add').prop('disabled', false); //enabled if there is value
		}
	});


	var count = 0;
	
	$(document).on('click', '.add', function(){
		var form_data = $('#insert_form').serialize();
		console.log(form_data)
		$.ajax({
        url: "../actions/addrowpurchaseorder.php",
        method: "POST",
        data: form_data,
        success: function (data) {
            
        	
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


		//validation no duplicate product allowed



		//end of validation

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

				url:"../actions/insertpurchaseorder.php",

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
	 

  
	$(document).on("change", ".item_id", function  () {
        //computeTotal();

        var dataType = 2;
        var currentRow = $(this).closest("tr");
        var productid = $(this).val();
        var price = currentRow.find(".item_price");
        var name = currentRow.find(".item_name");
        var available = currentRow.find(".available_quantity");
        var quantity = currentRow.find(".item_quantity");
        var totalPrice = currentRow.find(".item_total");
        totalPrice.val('');
        $('#total').val('');
        quantity.val('');
        var actualPrice;

        $.ajax({
            url: "../actions/fetchproductinfo.php",
            method: "POST",
            data: {productid: productid, dataType, dataType},
            dataType: "JSON",
            success: function (data) {
                actualPrice = data.price.replace(/^/, '₱');
                available.val(data.available);
                price.val(actualPrice);
                name.val(data.name); 
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
		
		var number;
		var vatSale;
		$.ajax({
			url: "../actions/fetchtotalprice.php",
			method: "POST",
			data: {quantity: quantity, price:price },
			success	: function (totalprice) {

				totalprice = totalprice.replace(/^/, '₱ ');
				totalPrice.val(totalprice);
				
				number = totalprice;
				number = number.replace(/[^a-zA-Z0-9]/g, '');

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