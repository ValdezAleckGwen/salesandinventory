<?php
	
//index.php	

include '../actions/database_connection.php';

	
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
        <div class="item"><a href="inventory_index.php"><i class="fa-regular fa-warehouse"></i>Inventory</a></div>
       

        <!-- Orders-->
        <div class="item"><a href="orders_index.php"><i class="fa-regular fa-cart-shopping"></i>Orders</a></div>


        <!-- Point of salesv2-->
        <div class="item"><a href="posv2_index.php"><i class="fa-regular fa-calculator"></i>Point of Salesv2</a></div>

        <!-- Logout -->
        <div class="item"><a href="../admin/login.php"><i class="fa-regular fa-arrow-right-from-bracket"></i>Logout</a></div>

        <div class="clearfix"></div>
    <br/>

        </div>
    </div>
		<div class="usericon">Cashier <i class="fa-regular fa-user"></i></div>

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
							<div class="row">

								<div class="col-sm-7">
									<input type="submit" name="submit" id="submit_button" class="btn btn-primary" value="Insert" />
								</div>
							<div class="container m-1">
								<h5>Source Branch</h5>
								<select name="source_branch" class="p-2 col col-sm-2 form-control selectpicker source_branch" id="source_branch"><option value="">Select Branch</option><?php echo fill_unit_select_box_branch($connect); ?></select>
							</div>
							<div class="container m-1">
								<h5>Destination Branch</h5>
								<select name="destination_branch" class="p-2 col col-sm-2 form-control selectpicker destination_branch" id="destination_branch"><option value="">Select Unit</option></select>
							</div>
							<table class="table table-bordered" id="item_table">
								<tr>
									<th width="20%">Product Code</th>
									<th width="50%">Product Name</th>
									<th width="10%"><i class="fa-sharp fa-solid fa-minus"></i></th>
									<th width="10%"><i class="fa-sharp fa-solid fa-plus"></i></th>

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

		var id = $('#source_branch').val();
		var rowType = 1;
		count++;

		$.ajax({
        url: "../actions/addrow.php",
        method: "POST",
        data: {id: id, rowType: rowType},
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

				url:"../actions/insert.php",

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
        
        $.ajax({
            url: "../actions/fetchinventoryinfo.php",
            method: "POST",
            data: {inventoryid: inventoryid},
            dataType: "JSON",
            success: function (data) {
                name.val(data.name); 
            } 

        });
        return false;
    });
	 
});
</script>
