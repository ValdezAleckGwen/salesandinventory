<?php 
session_start();
include '../actions/getdata.php';
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
    <title>Analytics</title>
    <link rel="stylesheet" href="analytics_style.css">

    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v6.0.0-beta3/css/all.css" type="text/css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" charset="utf-8"></script>
    
  </head>
  <body>
    <script src="analytics_script.js" defer>
    </script>

<!-- Start of sidebar -->
    <div class="side-bar">
    

<!-- Start of Menu Proper -->
      <div class="menu">
        <!-- Dashboard -->
        <div class="item"><a href="dashboard_index.php"><i class="fa-regular fa-house-blank"></i>Dashboard</a></div>

        <!-- Analytics -->
        <div class="item"><a href="analytics_index.php"><i class="fa-solid fa-chart-mixed"></i>Analytics</a></div>

        <!-- Branch -->
        <div class="item">
          <a class="sub-btn"><i class="fa-solid fa-ballot"></i>Branch<i class="fas fa-angle-right dropdown"></i></a>
          <div class="sub-menu">
            <a href="branch_index.php" class="sub-item"><i class="fa-regular fa-house-blank"></i>Dashboard</a>
          </div>
        </div>      

        <!-- Products -->
        <div class="item">
          <a class="sub-btn"><i class="fa-regular fa-bag-shopping"></i>Products<i class="fas fa-angle-right dropdown"></i></a>
          <div class="sub-menu">
            <a href="product_index.php" class="sub-item"><i class="fa-regular fa-house-blank"></i>Dashboard</a>

          </div>
        </div>

        <!-- Category -->
        <div class="item">
          <a class="sub-btn"><i class="fa-regular fa-table-cells-large"></i>Category<i class="fas fa-angle-right dropdown"></i></a>
          <div class="sub-menu">
            <a href="category_index.php" class="sub-item"><i class="fa-regular fa-house-blank"></i>Dashboard</a>
          </div>
        </div>

        <!-- Inventory-->
        <div class="item">
         <a class="sub-btn"><i class="fa-regular fa-warehouse"></i>Inventory<i class="fas fa-angle-right dropdown"></i></a>
         <div class="sub-menu">
            <a href="inventory_index.php" class="sub-item"><i class="fa-regular fa-house-blank"></i>Inventory</a>
            <a href="inventoryadj_index.php" class="sub-item"><i class="fa-regular fa-house-blank"></i>Dashboard</a>
            <a href="inventoryadjustment_index.php" class="sub-item"><i class="fa-regular fa-box-circle-check"></i>Adjustment</a>
          </div>
        </div>
        
        <!-- Stock Transfer-->
        <div class="item">
         <a class="sub-btn"><i class="fa-regular fa-box-circle-check"></i>Stock Transfer<i class="fas fa-angle-right dropdown"></i></a>
         <div class="sub-menu">
            <a href="stocktransfer_index.php" class="sub-item"><i class="fa-regular fa-house-blank"></i>Dashboard</a>
            <a href="stocktransfer.php" class="sub-item"><i class="fa-regular fa-box-circle-check"></i>Stock Transfer</a>
          </div>
        </div>

        <!-- Purchase Order -->
        <div class="item"><a href="purchaseorder_index.php"><i class="fa-regular fa-file-invoice"></i>Purchase Order</a></div>

        <!-- Delivery Order -->
        <div class="item"><a href="deliveryorder_index.php"><i class="fa-regular fa-truck"></i>Delivery Order</a></div>


        <!-- Suppliers-->
        <div class="item">
         <a class="sub-btn"><i class="fa-regular fa-tag"></i>Suppliers<i class="fas fa-angle-right dropdown"></i></a>
         <div class="sub-menu">
            <a href="suppliers_index.php" class="sub-item"><i class="fa-regular fa-house-blank"></i>Dashboard</a>
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

        <!-- Payments -->
        <div class="item"><a href="payables_index.php"><i class="fa-solid fa-basket-shopping"></i>Payments</a></div>

        <!-- Users -->
        <div class="item">
         <a class="sub-btn"><i class="fa-regular fa-user"></i>Users<i class="fas fa-angle-right dropdown"></i></a>
         <div class="sub-menu">
            <a href="user_index.php" class="sub-item"><i class="fa-regular fa-house-blank"></i>Dashboard</a>

          </div>
        </div>
      

        <!-- Settings -->
        <div class="item">
         <a class="sub-btn"><i class="fa-regular fa-gears"></i>Settings<i class="fas fa-angle-right dropdown"></i></a>
         <div class="sub-menu">
            <a href="settings_index.php" class="sub-item"><i class="fa-regular fa-house-blank"></i>Dashboard</a>
            <a href="tax_index.php" class="sub-item"><i class="fa-solid fa-percent"></i>TAX</a>
         </div>
        </div>

        <!-- Logout -->
        <div class="item"><a href="login.php"><i class="fa-regular fa-arrow-right-from-bracket"></i>Logout</a></div>

      </div>
    </div>

    <div class="usericon"><?php echo displayUser(); ?><i class="fa-regular fa-user"></i></div>  

    <div class="titlebar">
      <div class="dropdown">
        <h2 style="font-weight: 700; font-size: 65px; transform: translateY(25px);">ANALYTICS</h2>
        
    </div>
    <hr>
    </div>
   </div>


<!--Analytics Design-->
  
    <div class="container-xl">
      <div>
          <ul class="tabs">
            <li data-tab-target="#sales" class="active tab">SALES</li>
            <li data-tab-target="#products" class="tab">PRODUCTS</li>
            <li data-tab-target="#category" class="tab">CATEGORY</li>
          </ul>
      </div> 

      <div class="tab-content">
        <div id="sales" data-tab-content class="active">
          <h1 style="font-weight: 700; font-size: 35px;">TOTAL SALES</h1>

            <div class="radiocontainer">
                <input type="radio" id="month" name="option" value="month">
                <label for="custombtn1">Month</label>
                <input type="radio" id="week" name="option" value="week">
                <label for="custombtn1">Week</label>
            </div>       
               
          <div class="box">
            <p>Sample</p>
          </div>
          <br>
          <h1 style="font-weight: 700; font-size: 35px;">SALES PER BRANCH</h1>
            <div class="radiocontainer">
                <input type="radio" id="month" name="option" value="month">
                <label for="custombtn1">Month</label>
                <input type="radio" id="week" name="option" value="week">
                <label for="custombtn1">Week</label>
            </div>   
          <div class="box">
            <p>Sample</p>
          </div>
        </div>
                                                                  
        <div class="products" id="products" data-tab-content> 

          <div>

          </div>

          <h1 style="font-weight: 700; font-size: 35px;">TOP PERFORMING PRODUCTS</h1>
            <div class="radiocontainer">
                <input type="radio" id="month" name="option" value="month">
                <label for="custombtn1">Month</label>
                <input type="radio" id="week" name="option" value="week">
                <label for="custombtn1">Week</label>
            </div> 
          <div class="box2">
            <p>Sample</p>
          </div>       
        </div>

        <div class="category" id="category" data-tab-content>
          <h1 style="font-weight: 700; font-size: 35px;">TOP PERFORMING CATEGORY</h1>
            <div class="radiocontainer">
                <input type="radio" id="month" name="option" value="month">
                <label for="custombtn1">Month</label>
                <input type="radio" id="week" name="option" value="week">
                <label for="custombtn1">Week</label>
            </div>          <div class="box2">
            <p>Sample</p>
          </div>         
        </div>

      </div>

    </div>

  </body>
</html>