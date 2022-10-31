<?php 
session_start();
include '../x-function/redirect_if_notLogin.php';
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Purchase Order</title>
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
        <h3>PURCHASE ORDER</h3>
          <div style="display: inline;">
            <a href="addpurchaseorder.php"><button type="button" class="btn btn-primary" style="font-size: 16px; font-weight: 700;"><i class="fa-solid fa-circle-plus"></i> Add</button></a>
          <a href="purchaseorderreport.php"><button type="button" class="btn btn-dark" style="font-size: 16px; font-weight: 700;"><i class="fa-solid fa-print"></i> Print</button></a>
            <button type="button" class="btn btn-success" style="font-size: 16px; font-weight: 700;"><i class="fa-regular fa-circle-check"></i> Save</button>            
          </div>
          <div style="float: right;">
            <label><span>Search: </span><input type="text" class="input-field" name="field3" value=""/></label>
          </div>
        </div>
        <table class="table-fill">
        <thead>
        <tr>
        <th class="text-center">Date</th>
        <th class="text-center">Purchase Order I.D.</th>
        <th class="text-center">Supplier Name</th>
        <th class="text-center">Total</th>
        <th class="text-left">Action</th>
        </tr>
        </thead>
        <tbody class="table-hover">

        <tr>
        <td class="text-center">10/28/2021</td>
        <td class="text-center">PO001</td>
        <td class="text-left">John Geoffrey</td>
        <td class="text-center">0</td>
        <td class="text-center"> <i class="fa fa-bell" aria-hidden="true">&nbsp;</i><i class="fa-solid fa-circle-minus"></i> <i class="fa-solid fa-pen-to-square"></i></td> 
        </tr>

        <tr>
        <td class="text-center">10/21/2021</td>
        <td class="text-center">PO002</td>
        <td class="text-left">Lesley Katelyn</td>
        <td class="text-center">22</td>
        <td class="text-center"> <i class="fa fa-bell" aria-hidden="true">&nbsp;</i><i class="fa-solid fa-circle-minus"></i> <i class="fa-solid fa-pen-to-square"></i></td> 
        </tr>

        <tr>
        <td class="text-center">10/18/2021</td>
        <td class="text-center">PO003</td>
        <td class="text-left">Sofia Tranquilla</td>
        <td class="text-center">19</td>
        <td class="text-center"> <i class="fa fa-bell" aria-hidden="true">&nbsp;</i><i class="fa-solid fa-circle-minus"></i> <i class="fa-solid fa-pen-to-square"></i></td> 
        </tr>

        <tr>
        <td class="text-center">10/12/2021</td>
        <td class="text-center">PO004</td>
        <td class="text-left">Shop Thrifty</td>
        <td class="text-center">13</td>
        <td class="text-center"> <i class="fa fa-bell" aria-hidden="true">&nbsp;</i><i class="fa-solid fa-circle-minus"></i> <i class="fa-solid fa-pen-to-square"></i></td> 
        </tr>

        <tr>
        <td class="text-center">10/09/2021</td>
        <td class="text-center">PO005</td>
        <td class="text-left">Kirsten Clothing</td>
        <td class="text-center">31</td>
        <td class="text-center"> <i class="fa fa-bell" aria-hidden="true">&nbsp;</i><i class="fa-solid fa-circle-minus"></i> <i class="fa-solid fa-pen-to-square"></i></td> 
        </tr>

        <tr>
        <td class="text-center">10/05/2021</td>
        <td class="text-center">PO006</td>
        <td class="text-left">AMARAH</td>
        <td class="text-center">27</td>
        <td class="text-center"> <i class="fa fa-bell" aria-hidden="true">&nbsp;</i><i class="fa-solid fa-circle-minus"></i> <i class="fa-solid fa-pen-to-square"></i></td> 
        </tr>

        <tr>
        <td class="text-center">10/04/2021</td>
        <td class="text-center">PO007</td>
        <td class="text-left">Kira Monica</td>
        <td class="text-center">0</td>
        <td class="text-center"> <i class="fa fa-bell" aria-hidden="true">&nbsp;</i><i class="fa-solid fa-circle-minus"></i> <i class="fa-solid fa-pen-to-square"></i></td> 
        </tr>

        </tbody>
        </table>
     </div>
  </div>
</div>


  </body>
</html>
