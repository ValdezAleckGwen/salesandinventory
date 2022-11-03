<?php 
session_start();
include '../x-function/redirect_if_notLogin.php';
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stock Manager - Settings</title>
    <link rel="stylesheet" href="../admin/assets/styleaddedit.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v6.0.0-beta3/css/all.css" type="text/css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" charset="utf-8"></script>
    
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
            <a href="stocktransfer.php" class="sub-item"><i class="fa-regular fa-box-circle-check"></i>Stock Transfer</a>
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
        <div class="form-style-2">
        <div class="form-style-2-heading">SETTINGS</div>

        <form action="" method="post">
        <label for="field1"><span>Name:<span class="required">*</span></span><input type="text" class="input-field" name="field1" value="Jeremy Langcay" /></label>
        <label for="field1"><span>Email:<span class="required">*</span></span><input type="text" class="input-field" name="field1" value="jeremylangcay@gmail.com" /></label>
        <label for="field1"><span>Password<span class="required">*</span></span><input type="password" class="input-field" name="field1" value="123123213123123" /></label>

        <div align="center">
          <button type="button" class="btn btn-primary" style="font-size: 16px; font-weight: 700;"><i class="fa fa-pencil" aria-hidden="true"></i> Update</button>
          <button type="button" class="btn btn-danger" style="font-size: 16px; font-weight: 700;"><i class="fa fa-ban" aria-hidden="true"></i> Cancel</button>
        </div>
        </form>
        </div>
     </div>
  </div>
</div>   


  </body>
</html>