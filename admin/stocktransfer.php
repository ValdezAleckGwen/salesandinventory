<?php
session_start();
include '../actions/getdata.php';
include '../x-function/redirect_if_notLogin.php';
include '../actions/adddata.php';
include '../actions/database_connection.php';

$id = $_SESSION['uid'];
$branchid = getBranch($id);
	
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
		<title>STOCK TRANSFER</title>
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
            <a href="inventory_index.php" class="sub-item"><i class="fa-regular fa-house-blank"></i>Inventory</a>
            <a href="inventoryadjustment.php" class="sub-item"><i class="fa-regular fa-house-blank"></i>Adustment</a>
            <a href="stocktransfer.php" class="sub-item"><i class="fa-regular fa-box-circle-check"></i>Stock Transfer</a>
          </div>
        </div>

         <!-- Purchase Order -->
        <div class="item"><a href="purchaseorder.php"><i class="fa-regular fa-file-invoice"></i>Purchase Order</a></div>

        <!-- Delivery Order -->
        <div class="item"><a href="dorder.php"><i class="fa-regular fa-truck"></i>Delivery Order</a></div>

        <!-- Settings -->
        <div class="item">
         <a class="sub-btn"><i class="fa-regular fa-gears"></i>Settings<i class="fas fa-angle-right dropdown"></i></a>
         <div class="sub-menu">
            <a href="settings_index.php" class="sub-item"><i class="fa-regular fa-house-blank"></i>User Info</a>
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

  
    <h3>STOCK TRANSFER</h3><br>
		<div class="container">
			<br />
			<div class="card">
				<div class="card-header">Enter Item Details</div>
				<div class="card-body">

					<form method="post" id="insert_form">
						<div class="table-repsonsive">

							<span id="error"></span>
							<table class="table table-bordered" id="item_table">
							<div class="float-end">
								<label for="po_number">ST #:</label>
								<input type="text" name="stocktransfer_number" class="input-field" value="<?php echo createId('tblstocktransfer');  ?>" readonly>
							</div>
							<div class="row">

								<div class="col-sm-7">
									<input type="submit" name="submit" id="submit_button" class="btn btn-primary" value="Insert" />
								</div>
							<div class="container m-1">
								<h5>Source Branch</label>
								<select name="source_branch" class="p-2 col col-sm-2 form-control selectpicker source_branch" id="source_branch"><option value="">Select Branch</option><?php echo fill_unit_select_box_branch($connect); ?></select>
							</div>
							<div class="container m-1">
								<h5>Destination Branch</label>
								<select name="destination_branch" class="p-2 col col-sm-2 form-control selectpicker destination_branch" id="destination_branch"><option>Select Branch</option></select>
							</div>
							
								<tr>
									<th width="15%">Inventory Code</th>
									<th width="15%">Product Code</th>
									<th width="50%">Product Name</th>
									<th width="15%">Avaible Item</th>
									<th width="15%">Item Transfer</th>
									

									<th><button type="button" name="add" class="btn btn-success btn-sm add"><i class="fas fa-plus"></i></button></th>
								</tr>
								
							</div>
							</table>
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

		var branchid = $('#source_branch').val();
		count++;

		$.ajax({
        url: "../actions/addrow.php",
        method: "POST",
        data: {branchid: branchid},
        success: function (data) {
            
        	$('#item_table').append(data);

			$('.selectpicker').selectpicker('refresh');

            }
        });


		

	});

	//remove branch

	$(document).on('change', '#source_branch', function(){

		var branchid = $('#source_branch').val();
		
		count++;

		$.ajax({
        url: "../actions/addbranch.php",
        method: "POST",
        data: {branchid: branchid},
        success: function (data) {
            
        	$('#destination_branch').html(data);

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


		count = 1;


		count = 1;

		$("select[name='inventory_id[]']").each(function(){

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

				url:"../actions/insertstocktransfer.php",

				type:"POST",

				data:form_data,

				// data:$('#insert_form').serialize(),

				beforeSend:function()
	    		{

	    			$('#submit_button').attr('disabled', 'disabled');

	    		},

				success:function(data)
				{

					if(!data)
					{
						alert("ERROR");

					} else {
						alert(data);
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

	$(document).on("change", ".inventory_id", function  () {

        var currentRow = $(this).closest("tr");
        var inventoryid = $(this).val();
        var name = currentRow.find(".item_name");
        var code = currentRow.find(".item_code");
        var quantity = currentRow.find(".item_available");
        
        $.ajax({
            url: "../actions/fetchinventoryinfo.php",
            method: "POST",
            data: {inventoryid: inventoryid},
            dataType: "JSON",
            success: function (data) {
            	quantity.val(data.quantity);
            	code.val(data.productid);
                name.val(data.name); 
            } 

        });
        return false;
    });


	$(document).on("change", "#source_branch", function  () {


        var branch = $(this).val();
        
        
        $.ajax({
            url: "../actions/branch.php",
            method: "POST",
            data: {branch: branch},
            
            success: function (data) {
            $('#destination_branch').append(data);
            } 

        });
        return false;
    });

  
    


	 
});


</script>
