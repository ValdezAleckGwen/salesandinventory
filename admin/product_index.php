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

function fill_unit_select_box_category($connect)
{
    $output = '';

    $query = "SELECT id AS categoryid, name AS categoryname from tblcategory WHERE active = 1";

    $result = $connect->query($query);

    foreach($result as $row)
    {
        $output .= '<option value="'.$row["categoryid"].'">'.$row["categoryname"] . '</option>';
    }

    return $output;
}   
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Admin - Products</title>

        <link rel="stylesheet" href="assets/style.css">

        <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v6.0.0-beta3/css/all.css" type="text/css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" charset="utf-8"></script>
        <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <script src='https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/5.5.2/bootbox.min.js'></script>
        <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>

        <!-- Delete Function Jquery -->
        <script>
            $(document).ready(function () {

                // Delete 
                $(document).on('click', '.delete', function () {
                    var el = this;

                    // Delete id
                    var deleteid = $(this).data('id');

                    // Confirm box
                    bootbox.confirm("Do you really want to delete record?", function (result) {

                        if (result) {
                            // AJAX Request
                            $.ajax({
                                url: '../actions/deleteproducts.php',
                                type: 'POST',
                                data: {id: deleteid},
                                success: function (response) {

                                    // Removing row from HTML Table
                                    if (response == ' ok') {
                                        bootbox.alert('Record deleted.');
                                        $(el).closest('tr').css('background', 'tomato');
                                        $(el).closest('tr').fadeOut(800, function () {
                                            $(this).remove();
                                        });

                                    } else {
                                        bootbox.alert('Record not deleted');
                                    }

                                }
                            });
                        }

                    });

                });
            });
        </script>

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
            <a href="stocktransfer.php" class="sub-item"><i class="fa-regular fa-box-check"></i>Stock Transfer</a>
          </div>
        </div>
        
        <!-- Suppliers-->
        <div class="item"><a href="suppliers_index.php"><i class="fa-regular fa-tag"></i>Suppliers</a></div>

        <!-- Payables-->
        <div class="item"><a href="payables_index.php"><i class="fa-regular fa-basket-shopping"></i>Payables</a></div>

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
            <a href="salesreturn_index.php" class="sub-item"><i class="fa-regular fa-arrow-turn-down-left"></i>Sales Return</a>
         </div>
        </div>

        <!-- Reports-->
        <div class="item"><a href="reports.php"><i class="fa-regular fa-file-chart-column"></i></i>Reports</a></div>

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
        <h3>PRODUCTS</h3>
          <div style="display: inline;">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#userAddModal" style="font-size: 16px; font-weight: 700;"> <i class="fa-regular fa-bag-shopping"></i> Add Product</button>
          </div>
          <div style="float: right;">
            <label><span>Search: </span><input type="text" name="search_box" id="search_box" value=""/></label>
          </div>
        </div>
        
        <div class="table-responsive" id="dynamic_content"></div>

     </div>
  </div>
</div>

<!-- Add Product Modal -->
<div class="modal fade" id="userAddModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add Product</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <form id="saveproduct">
            <div class="modal-body">

                <div id="errorMessage" class="alert alert-warning d-none"></div>

                <div class="mb-3">
                    <label for="">ID</label>
                    <input type="text" name="id" class="form-control" value="<?php echo createId('tblproducts');?>" readonly/>
                </div>

                <div class="mb-3">
                    <label for="">NAME</label>
                    <input type="text" name="name" class="form-control" />
                </div>

                <div class="mb-3">
                <label for="branch_id">SUPPLIER</h5>
                <select name="supplier" class="form-control supplier" id="supplier"><option value="">Select Supplier</option><?php echo fill_unit_select_box_supplier($connect); ?></select>
                </div>

                <div class="mb-3">
                <label for="branch_id">CATEGORY</h5>
                <select name="category" class="form-control category" id="category"><option value="">Select Category</option><?php echo fill_unit_select_box_category($connect); ?></select>
                </div>

                <div class="mb-3">
                    <label for="">PRICE</label>
                    <input type="text" name="price" class="form-control" />
                </div>

                <div class="mb-3">
                    <label for="">MARKUP PRICE</label>
                    <input type="text" name="markup" class="form-control" />
                </div>



            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save Product</button>
            </div>
        </form>

        </div>
    </div>
</div>

<!-- Edit User Modal -->
<div class="modal fade" id="userEditModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Edit Product</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <form id="editproduct">
            <div class="modal-body">

                <div id="errorMessageUpdate" class="alert alert-warning d-none"></div>

                <div class="mb-3">
                    <label for="">ID</label>
                    <input type="text" name="id" class="form-control" id="eid" value="" readonly/>
                </div>

                <div class="mb-3">
                    <label for="">NAME</label>
                    <input type="text" name="name" class="form-control" id="ename"/>
                </div>

                <div class="mb-3">
                <label for="branch_id">SUPPLIER</h5>
                <select name="supplier" class="form-control supplier" id="esupplier"><option value="">Select Supplier</option><?php echo fill_unit_select_box_supplier($connect); ?></select>
                </div>

                <div class="mb-3">
                <label for="branch_id">CATEGORY</h5>
                <select name="category" class="form-control category" id="ecategory" ><option value="">Select Category</option><?php echo fill_unit_select_box_category($connect); ?></select>
                </div>

                <div class="mb-3">
                    <label for="">PRICE</label>
                    <input type="text" name="price" id="eprice" class="form-control" />
                </div>

                <div class="mb-3">
                    <label for="">MARKUP PRICE</label>
                    <input type="text" name="markup" id="emarkup" class="form-control" />
                </div>

                <div class="mb-3">
                    <div class="row">
                        <div class="col-sm">
                            <input class="form-check-input" type="radio" name="active" id="active" value="1">
                            <label class="form-check-label" for="flexRadioDefault1">Active</label>
                        </div>
                        <div class="col-sm">
                            <input class="form-check-input" type="radio" name="active" id="inactive" value="0">
                            <label class="form-check-label" for="flexRadioDefault1">Inactive</label>                
                        </div>
                    </div>
                </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Update Product</button>
            </div>
        </form>
        </div>
    </div>
</div>


  </body>
</html>
<script>

    // Start of Pagination Query // 
  $(document).ready(function(){
    load_data(1);

    function load_data(page = 1, query = '')
    {
      $.ajax({
        url:"../actions/fetchproductv2.php",
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
      load_data(1, query);
    });

  });
   
        //Add Product Query //
          $(document).on('submit', '#saveproduct', function (e) {
            e.preventDefault();

            var formData = new FormData(this);
            formData.append("save_product", true);


            $.ajax({
                type: "POST",
                url: "../actions/insertproduct.php",
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                  
                    
                    var res = jQuery.parseJSON(response);
                    
                    if(res.status == 422) {
                        $('#errorMessage').removeClass('d-none');
                        $('#errorMessage').text(res.message);

                    }else if(res.status == 200){

                        $('#errorMessage').addClass('d-none');
                        $('#userAddModal').modal('hide');
                        $('#saveproduct')[0].reset();

                        alertify.set('notifier','position', 'top-right');
                        alertify.success(res.message);

                        $('#myTable').load(location.href + " #myTable");

                    }else if(res.status == 500) {
                        $('#errorMessage').removeClass('d-none');
                        $('#errorMessage').text(res.message);
                    } else if (res.status == 69) {
                        $('#errorMessage').removeClass('d-none');
                        $('#errorMessage').text(res.message);
                    }
                }
            });

        });

        // Edit User Get Data //
        $(document).on('click', '#edit', function () {

           var id = $(this).data('id');
           
           
            
            $.ajax({
                type: "GET",
                url: "../actions/editproduct.php",
                data: {id: id},
                dataType: "JSON",
                success: function (data) {
                var supplier = $.trim(data.supplier);
                var category = $.trim(data.category);
                

                // var res = jQuery.parseJSON(response)
                $('#eid').val(data.id);
                $('#ename').val(data.name);
                $('#esupplier').val(supplier);
                $('#ecategory').val(category);
                $('#eprice').val(data.price);
                $('#emarkup').val(data.markupprice);
                if (data.active == 1) {
                    $('#active').attr('checked', true);
                } else {
                    $('#inactive').attr('checked', true);
                }
                $('#userEditModal').modal('show');
                        
                }
            });
        });

        // Update User Jquery //
        $(document).on('submit', '#editproduct', function (e) {
            e.preventDefault();

            var formData = new FormData(this);
            formData.append("edit_product", true);

            $.ajax({
                type: "POST",
                url: "../actions/insertproduct.php",
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    
                    var res = jQuery.parseJSON(response);
                    
                    if(res.status == 422) {
                        $('#errorMessage').removeClass('d-none');
                        $('#errorMessage').text(res.message);

                    }else if(res.status == 200){

                        $('#errorMessage').addClass('d-none');
                        $('#userEditModal').modal('hide');
                        $('#editproduct')[0].reset();

                        alertify.set('notifier','position', 'top-right');
                        alertify.success(res.message);

                        $('#myTable').load(location.href + " #myTable");

                    }else if(res.status == 500) {
                        $('#errorMessage').removeClass('d-none');
                        $('#errorMessage').text(res.message);
                    } else if (res.status == 69) {
                        $('#errorMessage').removeClass('d-none');
                        $('#errorMessage').text(res.message);
                    }
                    
                }

            });
            location.reload();

        });
</script>