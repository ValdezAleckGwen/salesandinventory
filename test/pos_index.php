<?php 
session_start();
include '../actions/getdata.php';
include '../actions/adddata.php';
include '../actions/database_connection.php';
include '../x-function/redirect_if_notLogin.php';

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





function fill_unit_select_box($connect, $branchid)
{

	$output = '';

	$query = "SELECT tblinventory.id AS inventory, tblinventory.quantity AS count, tblproducts.id AS product, tblproducts.markupPrice AS price FROM tblinventory INNER JOIN tblproducts ON tblinventory.productId=tblproducts.id WHERE tblinventory.branchid = :id ";

	$statement = $connect->prepare($query);
	$statement->execute([
        ':id' => $branchid,
    ]);

   	$result = $statement->fetchAll(PDO::FETCH_ASSOC);

	foreach($result as $row)
	{
		$output .= '<option value="'.$row["product"].'">'.$row["product"] . '</option>';
	}

	return $output;
}
		
?>
<!DOCTYPE html>
<html>
	<head>
		<title>POINT OF SALE</title>
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
    <!-- Point of salesv2-->
    <div class="item"><a href="pos_index.php"><i class="fa-regular fa-calculator"></i>Point of Sales</a></div>

    <!-- Inventory-->
        <div class="item"><a href="inventory_index.php"><i class="fa-regular fa-warehouse"></i>Inventory</a></div>
       

    <!-- Logout -->
        <div class="item"><a href="login.php"><i class="fa-regular fa-arrow-right-from-bracket"></i>Logout</a></div>

        <div class="clearfix"></div>
    <br/>

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

  
    <h3 style="margin-top: 40px; font-weight: 600;">POINT OF SALES - <?php echo displayBranch($id); ?></h3><br>
		<div class="container" style="margin-top: -39px;">
			<br />
			<div class="card">
				<div class="card-header">
					<div class="float-start"><p >Enter Item Details</p></div>
					<div class="float-end">
					<label for="salesid">Sales ID#</label>
					<input type="text" name="salesid" class="input-field float-end" value="<?php echo createId('tblsales'); ?>" id="salesid" readonly>
					</div>
					
				</div>

				<div class="card-body">

					<style>


					</style>

					<form method="post" id="insert_form">
						<div class="table-repsonsive">
							<span id="error"></span>
							<table class="table table-bordered" id="item_table" style="max-height: 150px; overflow-y: scroll !important;">
								<thead style=" display: block; ">
								<tr>
									<th width="11.45%">Product Code</th>
									<th width="40%">Product Name</th>
									<th width="12%">Price</th>
									<th width="10%">Available Quantity</th>
									<th width="10%">Enter Quantity</th>
									<th>Total Price</th>
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
							</div>
									

								<div class="col-sm-6" style="float: left;">
									<input type="submit" name="submit" id="submit_button" class="btn btn-primary" value="Insert" />
								</div>	
								<div class="col col-sm-2" style="float: left;">
									<label>Tax</label>
									<select name="tax" id="tax" class="form-control" required>
										<option value="">Select Tax</option>
										<option value="1">Regular</option>
										<option value="2">Senior Discount</option>
										
									</select>
								</div>
								<div class="col col-sm-3" style="float: right;">
									<div class="input-group mb-3">
									  <span class="input-group-text" id="basic-addon3">Vattable Sale</span>
									  <input type="text" class="form-control"name="vattable-sale" id="vattable-sale" aria-describedby="basic-addon3" readonly>
									</div>
									<div class="input-group mb-3">
									  <span class="input-group-text" id="basic-addon3">Vat</span>
									  <input type="text" name="vat" id="vat" class="form-control total" readonly/>
									</div>
									<div class="input-group mb-3">
									  <span class="input-group-text" id="basic-addon3">Total</span>
									  <input type="text" name="total" id="total" class="form-control total" readonly/>
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
        url: "../actions/addrowpos.php",
        method: "POST",
        data: form_data,
        success: function (data) {
            var printWindow = window.open('invoice.php');
        	printWindow.print();
        	

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

		var form_data = $(this).serialize();

		$.ajax({
            url: "../actions/quantitycheck.php",
            method: "POST",
            data: form_data,
            dataType: "JSON",
            success: function (data) {
                if (data.status == 1) {
                	error += data.message;
                }

            }
        });



		
        //print the window    
        

            
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
						
						$('vattable-sale').val('');

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
        //computeTotal();

        var dataType = 1;
        var currentRow = $(this).closest("tr");
        var productid = $(this).val();
        var price = currentRow.find(".item_price");
        var name = currentRow.find(".item_name");
        var available = currentRow.find(".available_quantity");
        var actualPrice;
        $.ajax({
            url: "../actions/fetchproductinfo.php",
            method: "POST",
            data: {productid: productid, dataType, dataType},
            dataType: "JSON",
            success: function (data) {
                actualPrice = data.price.replace(/^/, '???');
                available.val(data.available);
                price.val(actualPrice);
                name.val(data.name); 
            }
        });
        return false;
    });

    $(document).on("change", ".item_quantity", function  () {
        

        var currentRow = $(this).closest("tr");
        var available = currentRow.find(".available_quantity");
        var quantity = currentRow.find(".item_quantity");
        var quantityval = $(this).val();
        quantityval = parseInt(quantityval);
        var availval = available.val();
        availval = parseInt(availval);

        if (quantityval > availval) {
        	quantity.addClass("border border-2 border-danger");
        } else {
        	quantity.removeClass("border border-2 border-danger");
        }
       
        
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

				totalprice = totalprice.replace(/^/, '??? ');
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
			url: "../actions/fetchtax.php",
			method: "POST",
			data: form_data,
			dataType: "JSON",
			success	: function (data) {
			
			if (data.status = 1) {
				$('#vattable-sale').val(data.vattablesale);
				$('#vat').val(data.vat);
				$('#total').val(data.total);

			} else {
				$('#vattable-sale').val(0.0);
				$('#vat').val(0.0);
				$('#total').val(data.total);
			}
			



			}
		});

	});

		$(document).on("change", "#tax", function() {
		var form_data = $('#insert_form').serialize();
		console.log(form_data)
		$.ajax({
			url: "../actions/fetchtax.php",
			method: "POST",
			data: form_data,
			dataType: "JSON",
			success	: function (data) {
			
			if (data.status = 1) {
				$('#vattable-sale').val(data.vattablesale);
				$('#vat').val(data.vat);
				$('#total').val(data.total);

			} else {
				$('#vattable-sale').val(0.0);
				$('#vat').val(0.0);
				$('#total').val(data.total);
			}
			



			}
		});

	});

	
	
		
		

	




});



</script>
