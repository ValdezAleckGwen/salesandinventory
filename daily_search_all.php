<head>
	<!--FOR ICONS-->
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

	<!--SALES SEARCH STYLE-->
	<link rel="stylesheet" type="text/css" href="sales_search.css">

	<title>Daily Sales</title>
</head>

<body>
	<!--DATABASE CONNECTION-->
	<?php include "config.php"; ?>

	<!--ADMIN SIDEBAR-->
	<?php include "sidebar.php"; ?>

    <!--SEARCH SALES-->
    <div class="content" id="content">
		<?php 
	      	$date = $_POST['date_from'];
	    ?>

	    <table id="salesinfo">
    		<thead>
    			<tr class="center">
    				<th colspan="12">DIAMOND COLOURS DRY GOODS</th>
    			</tr>

    			<tr class="center">
    				<th colspan="12">
		    			<p> Daily Sales Report </p>
    				</th>
    			</tr>
				
				<tr id="left">
    				<th colspan="6"> <p> Employee: </p> </th>
    			</tr>

    			<tr id="left">
    				<th colspan="6"> Date: <?php echo $date; ?>  </th>

    				<th colspan="6"> <p>Branch: All</p> </th>
    			</tr>
    		</thead>
    	</table>

		<table class="table-striped" id="salesreport">
	      <thead>
	        <tr>
		        <th colspan="2">PRODUCT ID</th>
		        <th colspan="4">DESCRIPTION</th>
		        <th colspan="2">PRICE</th>
		        <th colspan="2">QUANTITY</th>
		        <th colspan="2">TOTAL</th>
		    </tr>
	      </thead>

	      <tbody>
	        <?php 
	        	$result = mysqli_query($con, "SELECT product.product_id, product.product_name, product.product_price, sum(sales_transac.quantity) as quantity, sum(sales_transac.amount) as total FROM sales_activity INNER JOIN sales_transac ON sales_activity.invoice = sales_transac.invoice INNER JOIN product ON sales_transac.barcode = product.barcode WHERE (sales_activity.sales_date like '%$date%') GROUP BY product.barcode");

	          	$count = 1;
	              while ($row = mysqli_fetch_assoc($result)) {
	        ?>

	        <tr>
		       	<td scope='row' colspan="2" id="left_align"><?= $row["product_id"] ?></td>
		        <td scope='row' colspan="4" id="left_align"><?= $row["prod_name"] ?></td>
		        <td scope='row' colspan="2">₱ <?= $row["prod_price"] ?></td>
		        <td scope='row' colspan="2"><?= $row["quantity"] ?></td>
		        <td scope='row' colspan="2" id="right_align">₱ <?= $row["total"] ?></td>
		    </tr>
	            <?php
	              $count++;
	            }
	            ?>
	        </tbody>
	    </table>

	    <div class="row" id="row-foot">
	    	<?php 
	            $result2 = mysqli_query($con, "SELECT sum(total_amount) as total FROM sales WHERE sales_date like '%$date%'");
	            $total_sales = mysqli_fetch_assoc($result2);
	        ?>
	    	<div class="col col-12">
	    		<p>
	    			Total Sales: ₱ <?= $total_sales["total"] ?>
	    		</p>
	    	</div>
	    </div>
    </div>    

    <!--BUTTONS-->
	<div class="btn-options">
		<a href="daily_sales.php" style="text-decoration:none;">
			<button type="submit">Back</button>
		</a>

		<button id="download-button">
			<i class="material-icons">print</i> CSV
		</button>

		<button id="export" onclick="createPDF()">
			<i class="material-icons">print</i> PDF
		</button>

		<button id="export" onclick="exportTableToExcel('content')">
			<i class="material-icons">print</i> Excel
		</button>
	</div>

    <!--FOR CSV DOWNLOAD-->
	<?php include "csv.php"; ?> 

	<!--FOR PDF DOWNLOAD-->
	<?php include "pdf.php"; ?>

	<!--FOR EXCEL DOWNLOAD-->
	<?php include "excel.php"; ?> 
</body>