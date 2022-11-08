<?php
	
//index.php	
session_start();
include '../actions/getdata.php';
include '../x-function/redirect_if_notLogin.php';
include '../actions/adddata.php';
include '../actions/database_connection.php';


$id = $_SESSION['uid'];
$branchid = getBranch($id);

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
		<title>Stock Manager - Invetory Adjustment</title>
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
      
<!-- Start of Menu Proper -->
      <div class="menu">

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
	    	<h3>INVENTORY ADJUSTMENT</h3>
	    </div>		
			<div class="card">
				<div class="card-header">Enter Item Details</div>
				<div class="card-body">
					<form method="post" id="insert_form">
						<div class="table-repsonsive">
							<span id="error"></span>
							<table class="table table-bordered" id="item_table" style="max-height: 150px; overflow-y: scroll !important;">
							<div class="float-end">
								<label for="po_number">INVENTORY ADJUSTMENT #:</label>
								<input type="text" name="ia_number" class="input-field" value="<?php echo createId('tblinventoryadjustment'); ?>" id="ia_number" readonly>
							</div>

							<!--remove this if cookie is configured-->
							<div class="container m-1">
                                <label>For Branch: <?php echo displayBranch($id); ?></label>
								<select name="branch_id" class="p-2 col col-sm-2 form-control selectpicker branch_id d-none" id="branch_id" readonly><?php echo fill_unit_select_box_branch($connect, $branchid); ?></select>
							</div>
								<thead style=" display: block; ">
								<tr>
									<th width="13.9%">Inventory ID</th>
									<th width="15.9%">Product Code</th>
									<th width="22.6%">Product Name</th>
									<th width="10%">Available Quantity</th>
									<th width="16%">Adjustment Quantity -</th>
									<th width="16%">Adjustment Quantity +</th>
									<th><button type="button" name="add" class="btn btn-success btn-sm add"><i class="fas fa-plus"></i></button></th>
								</tr>
							</thead>
								<tbody id="add-row" style="display: block; height: 500px;overflow-y: auto;overflow-x: hidden;">
								<tr>
									
								</tr>
							</tbody>
							<footer>
							</footer>
							</table>
								<div class="col-sm-6" style="float: left">
									<input type="submit" name="submit" id="submit_button" class="btn btn-primary" value="Insert" />
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

	

	var count = 0;
	
	$(document).on('click', '.add', function(){

		
		var form_data = $('#insert_form').serialize();
		console.log(form_data)
		$.ajax({
        url: "../actions/addrowinventoryadjustment.php",
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

				url:"../actions/insertinvenadjustment.php",

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
		
        
        var dataType = 5;
        var currentRow = $(this).closest("tr");
        var productid = $(this).val();
        var itemid = currentRow.find(".item_code");
        var name = currentRow.find(".item_name");
        var quantity = currentRow.find(".item_quantity")
        $.ajax({
            url: "../actions/fetchproductinfo.php",
            method: "POST",
            data: {productid: productid, dataType: dataType},
            dataType: "JSON",
            success: function (data) {
            	itemid.val(data.productid);
            	name.val(data.name);
                quantity.val(data.quantity);	
                
                
            }
        });
        return false;
    });




	 
});

</script>
