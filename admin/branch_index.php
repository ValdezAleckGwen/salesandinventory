<?php
session_start();
include '../actions/getdata.php';
include '../x-function/redirect_if_notLogin.php';
include '../actions/adddata.php';
include '../actions/database_connection.php';
include_once '../x-function/redirect_admin.php';
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

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Branch</title>

        <link rel="stylesheet" href="assets/style.css">

        <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v6.0.0-beta3/css/all.css" type="text/css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" charset="utf-8"></script>
        <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <script src='https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/5.5.2/bootbox.min.js'></script>
        <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>

        <script>

    // Delete Function Jquery //
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
                                url: '../actions/deletebranch.php',
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
<body style="overflow-y: hidden">

<!-- Start of sidebar -->
    <div class="side-bar">

<!-- Start of Menu Proper -->
      <div class="menu">
<!-- Dashboard -->
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
        
        <h3>BRANCH</h3>

          <div style="display: inline;">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#userAddModal" style="font-size: 16px; font-weight: 700;"> <i class="fa-solid fa-ballot"></i> Add Branch</button>
          </div>
           
          <div style="float: right;">
            <label><span>Search: </span><input type="text" name="search_box" id="search_box" value="" placeholder="Search Branch Name" /></label>
          </div>
           
        </div>
        

        <div class="table-responsive" id="dynamic_content"></div>
    </div>
  </div>
</div>

<!-- Add branch modal -->
<div class="modal fade" id="userAddModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Branch</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form id="savebranch">
                <div class="modal-body">

                    <div id="errorMessage" class="alert alert-warning d-none"></div>

                    <div class="mb-3">
                        <label for="">ID</label>
                        <input type="text" name="id" class="form-control" value="<?php echo createId('tblbranch');?>" readonly/>
                    </div>

                    <div class="mb-3">
                        <label for="">NAME</label>
                        <input type="text" name="name" class="form-control" />
                    </div>

                    <div class="mb-3">
                        <label for="">BRANCH ADDRESS</label>
                        <input type="text" name="address" class="form-control" />
                    </div>

                    <div class="mb-3">
                        <label for="">CONTACT NUMBER</label>
                        <input type="text" name="contact" class="form-control" />
                    </div>
                </div>


                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save Branch</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit branch Modal -->
<div class="modal fade" id="userEditModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Edit Branch</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <form id="editbranch">
            <div class="modal-body">

                <div id="errorMessageUpdate" class="alert alert-warning d-none"></div>

                <div class="mb-3">
                    <label for="">ID</label>
                    <input type="text" name="id" class="form-control id"   id="eid" value="" readonly/>
                </div>

                <div class="mb-3">
                    <label for="">NAME</label>
                    <input type="text" name="name" class="form-control name" id="ename" />
                </div>

                <div class="mb-3">
                    <label for="">ADDRESS</label>
                    <input type="text" name="address" class="form-control name" id="eaddress" />
                </div>

                <div class="mb-3">
                    <label for="">CONTACT</label>
                    <input type="text" name="contact" class="form-control name" id="econtact" />
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
                <button type="submit" class="btn btn-primary">Update Branch</button>
            </div>
        </form>
        </div>
    </div>
</div>

</body>
</html>

<script>

  
  $(document).ready(function(){
    load_data(1);

    function load_data(page = 1, query = '')
    {
      $.ajax({
        url:"../actions/fetchbranch.php",
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

    // Add Function//
    $(document).on('submit', '#savebranch', function (e) {
    e.preventDefault();

    var formData = new FormData(this);
    formData.append("save_branch", true);


    $.ajax({
        type: "POST",
        url: "../actions/insertbranch.php",
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
                $('#savebranch')[0].reset();

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
                url: "../actions/editbranch.php",
                data: {id: id},
                dataType: "JSON",
                success: function (data) {
                
                // var res = jQuery.parseJSON(response)
                $('#eid').val(data.id);
                $('#ename').val(data.name);
                $('#eaddress').val(data.branchaddress);
                $('#econtact').val(data.contactnumber);
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
        $(document).on('submit', '#editbranch', function (e) {
            e.preventDefault();

            var formData = new FormData(this);
            formData.append("edit_branch", true);

            $.ajax({
                type: "POST",
                url: "../actions/insertbranch.php",
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
                        $('#editbranch')[0].reset();

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