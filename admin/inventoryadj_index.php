<?php 
session_start();
include '../x-function/redirect_if_notLogin.php';
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NARCI - Inventory Adjustment</title>
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
            <a href="inventoryadj_index.php" class="sub-item"><i class="fa-regular fa-house-blank"></i>Dashboard</a>
            <a href="inventoryadjustment_index.php" class="sub-item"><i class="fa-regular fa-box-circle-check"></i>Adjustment</a>
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

    <div class="usericon">Admin <i class="fa-regular fa-user"></i></div>       

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
        <h3>INVENTORY ADJUSTMENT</h3>
          <div style="display: inline;">
            <button type="button" class="btn btn-primary" style="font-size: 16px; font-weight: 700;"><i class="fa-solid fa-circle-plus"></i> Add</button>
            <a href = "inventoryadjustment.php"><button type="button" class="btn btn-dark" style="font-size: 16px; font-weight: 700;"><i class="fa-solid fa-print"></i> Print</button></a>
            <button type="button" class="btn btn-success" style="font-size: 16px; font-weight: 700;"><i class="fa-regular fa-circle-check"></i> Save</button>            
          </div>
          <div style="float: right;">
            <label><span>Search: </span><input type="text" class="input-field" name="field3" value=""/></label>
          </div>
        </div>
        <table class="table-fill">
        <thead>
        <tr>
        <th class="text-center">Product ID</th>
        <th class="text-center">Product Name</th>
        <th class="text-center">Increase Inventory</th>
        <th class="text-center">Decrease Inventory</th>
        <th class="text-center">Branch</th>
        <th class="text-center">Action</th>
        </tr>
        </thead>
        <tbody class="table-hover">

        <tr>
        <td class="text-center">SW01</td>
        <td class="text-left">Basic Sweatpants</td>
        <td class="text-center"> </td>
        <td class="text-center">2</td>
        <td class="text-center">Branch 1</td>
        <td class="text-center"> <i class="fa-solid fa-circle-minus"></i> </td> 
        </tr>

        <tr>
        <td class="text-center">SW02</td>
        <td class="text-left">Fluzzy Flare Sweatpants</td>
        <td class="text-center"> </td>
        <td class="text-center">1</td>
        <td class="text-center">Branch 2</td>
        <td class="text-center"> <i class="fa-solid fa-circle-minus"></i> </td> 
        </tr>

        <tr>
        <td class="text-center">SW03</td>
        <td class="text-left">Tie Dye Sweatpants</td>
        <td class="text-center"> </td>
        <td class="text-center">1</td>
        <td class="text-center">Branch 1</td>
        <td class="text-center"> <i class="fa-solid fa-circle-minus"></i> </td> 
        </tr> 

        <tr>
        <td class="text-center">SS01</td>
        <td class="text-left">Basic Sweatpants</td>
        <td class="text-center"> </td>
        <td class="text-center">3</td>
        <td class="text-center">Branch 1</td>
        <td class="text-center"> <i class="fa-solid fa-circle-minus"></i> </td> 
        </tr>

        <tr>
        <td class="text-center">C01</td>
        <td class="text-left">Dianne Coordinates</td>
        <td class="text-center"> </td>
        <td class="text-center">2</td>
        <td class="text-center">Branch 1</td>
        <td class="text-center"> <i class="fa-solid fa-circle-minus"></i> </td> 
        </tr>

        <tr>
        <td class="text-center">T01</td>
        <td class="text-left">Reese Crop Polo</td>
        <td class="text-center">1</td>
        <td class="text-center"> </td>
        <td class="text-center">Branch 2</td>
        <td class="text-center"> <i class="fa-solid fa-circle-minus"></i> </td> 
        </tr>

        <tr>
        <td class="text-center">B01</td>
        <td class="text-left">Chunky Chain Medium</td>
        <td class="text-center"> </td>
        <td class="text-center">11</td>
        <td class="text-center">Branch 1</td>
        <td class="text-center"> <i class="fa-solid fa-circle-minus"></i> </td> 
        </tr>            

        </tbody>
        </table><br>
     </div>
  </div>
</div>   


  </body>
</html>
