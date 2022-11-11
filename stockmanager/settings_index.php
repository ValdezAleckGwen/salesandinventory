<?php 
session_start();
include '../x-function/redirect_if_notLogin.php';
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Settings</title>
    <link rel="stylesheet" href="../admin/assets/styleaddedit.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v6.0.0-beta3/css/all.css" type="text/css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" charset="utf-8"></script>
    
  </head>
<body style="overflow-y: hidden">

<!-- Start of sidebar -->
    <div class="side-bar">

<!-- Start of Menu Proper -->
      <div class="menu">

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

        <form action="" method="post" id="insert_form">
        <div>
            <label for="oldpassword"><span>Input Old Password:<span class="required">*</span></span><input type="password" class="oldpassword" name="oldpassword" id="oldpassword" value="" /></label>
            <label for="newpassword" class="d-none newpw"><span>New Password:<span class="required">*</span></span><input type="password" class="newpassword" name="newpassword" id="newpassword" value="" required /></label>


            
            

        </div>
        <p style="font-size: 15px" id="info"></p>
        <div align="right">
          <button type="submit" class="btn btn-primary update" style="font-size: 16px; font-weight: 700;"><i class="fa fa-pencil" aria-hidden="true"></i> Update</button>
          <button type="button" class="btn btn-primary showold" style="font-size: 16px; font-weight: 700;"><i class="fa-solid fa-eye"></i></i> Show Old Password</button>
          <button type="button" class="btn btn-primary shownew d-none" style="font-size: 16px; font-weight: 700;"><i class="fa-solid fa-eye"></i></i> Show New Password</button>
          
        </div>
        </form>
        </div>
     </div>
  </div>
</div>   


  </body>
</html>
<script>
   $(document).ready(function(){

    $('.update').prop('disabled', true);

    $(document).on('keyup', '#oldpassword', function () {
        var oldpassword = $(this).val();
        var datatype = 1;
        $.ajax({
            url: "../actions/checkpassword.php",
            method: "POST",
            data: {oldpassword : oldpassword, datatype: datatype},
            
            success: function (data) {
                    
                
                if (data == 1) {
                    $('.newpw').removeClass('d-none');
                    $('.shownew').removeClass('d-none');
                    $('.update').prop('disabled', false);
                } else {
                    $('.newpw').addClass('d-none');
                    
                }

            }
        });


    });


        $(document).on('mousedown', '.shownew', function () {
            
            $('.newpassword').prop('type', 'text');
        }).on('mouseup mouseleave', function() {
            $('.newpassword').prop('type', 'password');
        });

        $(document).on('mousedown', '.showold', function () {
            
            $('.oldpassword').prop('type', 'text');
        }).on('mouseup mouseleave', function() {
            $('.oldpassword').prop('type', 'password');
        });


    $('#insert_form').on('submit', function(event){

        var form_data = $(this).serialize();
        event.preventDefault();

        var error = '';

        count = 1;

        

        $.ajax({
            url: "../actions/updatepassword.php",
            method: "POST",
            data: form_data,
            
            success: function (data) {
                alert(data);

            }
        });

        
    });

       







    
}); 


</script>