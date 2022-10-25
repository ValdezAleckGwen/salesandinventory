<?php 

include '../actions/database_connection.php';
include '../actions/getdata.php';

session_start();
include '../x-function/redirect_if_notLogin.php';

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
    <title>Dashboard</title>
    <link rel="stylesheet" href="assets/style.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v6.0.0-beta3/css/all.css" type="text/css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" charset="utf-8"></script>
    
  </head>
  <body>


<!-- Start of sidebar -->
    <div class="side-bar">

<!-- Start of Menu Proper -->
      <div class="menu">
        <!-- Dashboard -->
        <div class="item"><a href="dashboard_index.php"><i class="fa-regular fa-house-blank"></i>Dashboard</a></div>

        <!-- Analytics -->
        <div class="item"><a href="analytics_index.php"><i class="fa-solid fa-chart-mixed"></i>Analytics</a></div>

        <!-- Sales-->
        <div class="item">
         <a class="sub-btn"><i class="fa-regular fa-wallet"></i>Sales<i class="fas fa-angle-right dropdown"></i></a>
         <div class="sub-menu">
            <a href="sales_index.php" class="sub-item"><i class="fa-regular fa-house-blank"></i>Dashboard</a>
            <a href="salesreturn_index.php" class="sub-item"><i class="fa-regular fa-arrow-turn-down-left"></i>Sales Return</a>
         </div>
        </div>

        <!-- Products -->
        <div class="item"><a href="product_index.php"><i class="fa-regular fa-bag-shopping"></i>Products</i></a>

        <!-- Inventory-->
        <div class="item">
         <a class="sub-btn"><i class="fa-regular fa-warehouse"></i>Inventory<i class="fas fa-angle-right dropdown"></i></a>
         <div class="sub-menu">
            <a href="inventory_index.php" class="sub-item"><i class="fa-regular fa-house-blank"></i>Dashboard</a>
            <a href="inventoryadjustment.php" class="sub-item"><i class="fa-regular fa-box-circle-check"></i>Adjustment</a>
          </div>
        </div>
      </div>

        <!-- Orders-->
        <div class="item"><a href="orders_index.php"><i class="fa-regular fa-cart-shopping"></i>Orders</a></div>

        <!-- Purchase Order -->
        <div class="item"><a href="purchase_index.php"><i class="fa-regular fa-file-invoice"></i>Purchase Order</a></div>

        <!-- Delivery Order -->
        <div class="item"><a href="delivery_index.php"><i class="fa-regular fa-truck"></i>Delivery Order</a></div>

        <!-- Payments -->
        <div class="item"><a href="payment_index.php"><i class="fa-solid fa-basket-shopping"></i>Payments</a></div>

        <!-- Users -->
        <div class="item"><a href="user_index.php"><i class="fa-regular fa-user"></i>Users</a></div>
        
        <!-- Branch -->
        <div class="item">
          <a class="sub-btn"><i class="fa-solid fa-ballot"></i>Branch<i class="fas fa-angle-right dropdown"></i></a>
          <div class="sub-menu">
            <a href="branch_index.php" class="sub-item"><i class="fa-regular fa-house-blank"></i>Dashboard</a>
            <a href="addbranch_index.php" class="sub-item"><i class="fa-regular fa-circle-plus"></i>Add Branch</a>
            <a href="editbranch_index.php" class="sub-item"><i class="fa-regular fa-pen-to-square"></i>Edit Branch</a>
          </div>
        </div>

        <!-- Category -->
        <div class="item">
          <a class="sub-btn"><i class="fa-regular fa-table-cells-large"></i>Category<i class="fas fa-angle-right dropdown"></i></a>
          <div class="sub-menu">
            <a href="category_index.php" class="sub-item"><i class="fa-regular fa-house-blank"></i>Dashboard</a>
            <a href="addcategory_index.php" class="sub-item"><i class="fa-regular fa-circle-plus"></i>Add Category</a>
            <a href="editcategory_index.php" class="sub-item"><i class="fa-regular fa-pen-to-square"></i>Edit Category</a>
          </div>
        </div>

        <!-- Suppliers-->
        <div class="item">
         <a class="sub-btn"><i class="fa-regular fa-tag"></i>Suppliers<i class="fas fa-angle-right dropdown"></i></a>
         <div class="sub-menu">
            <a href="suppliers_index.php" class="sub-item"><i class="fa-regular fa-house-blank"></i>Dashboard</a>
            <a href="addsuppliers_index.php" class="sub-item"><i class="fa-regular fa-circle-plus"></i>Add Suppliers</a>
            <a href="editsuppliers_index.php" class="sub-item"><i class="fa-regular fa-pen-to-square"></i>Edit Suppliers</a>
          </div>
        </div>

        <!-- Settings -->
        <div class="item">
        <a href="settings_index.php"><i class="fa-regular fa-gears"></i>Settings</i></a>
        </div>

        <!-- Tax Settings -->
        <div class="item">
        <a href="tax_index.php"><i class="fa-regular fa-percent"></i>Tax Settings</i></a>
        </div>

        <!-- Audit Logs -->
        <div class="item"><a href="audit_index.php"><i class="fa-regular fa-file-chart-pie"></i>Audit Logs</a></div>        


        <!-- Logout -->
        <div class="item"><a href="login.php"><i class="fa-regular fa-arrow-right-from-bracket"></i>Logout</a></div>

      </div>
    </div>
    

 
    <div class="usericon"><?php echo displayUser(); ?> <i class="fa-regular fa-user"></i></div>  

    <div class="content">
        <div class="home-content">
          <h2 style="font-weight: 700">Dashboard</h2>
          <hr>
              <div class="overview-boxes">
                <div class="box">
                  <div class="right-side">
                    <div class="box-topic">Total Sales Today</div>
                    <div class="number">150</div>
                  </div>
                </div>

                <div class="box">
                  <div class="right-side">
                    <div class="box-topic">Total Orders Today</div>
                    <div class="number">161</div>
                  </div>
                </div>

                <div class="box">
                  <div class="right-side">
                    <div class="box-topic">Number of available products</div>
                    <div class="number">1029</div>
                  </div>
                </div>

                <div class="box">
                  <div class="right-side">
                    <div class="box-topic">Pending Orders</div>
                    <div class="number">44</div>
                  </div>
                  <br>
                </div>
                </div>
           <div class="home-content">
           		<h2 style="font-weight: 700">Analytics</h2>
           		<hr>
           		<br>
           		<div class="center"><img src="assets/images/graph.png" style="width: 80%; height: 80%"></div>
           	</div>
        </div>
    </div>
</div>

  </body>

</html>
    <script type="text/javascript">
    $(document).ready(function(){
      //jquery for toggle sub menus
      $('.sub-btn').click(function(){
        $(this).next('.sub-menu').slideToggle();
        $(this).find('.dropdown').toggleClass('rotate');
      });

     




    });

    </script>