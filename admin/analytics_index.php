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
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
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

    <div class="usericon"><?php echo displayUser(); ?><i class="fa-regular fa-user"></i></div>  

    <div class="titlebar">
      <div class="dropdown">
        <h2 style="font-weight: 700; font-size: 65px; transform: translateY(25px);">ANALYTICS</h2>
        
    </div>
    <hr>
    </div>
   </div>


<!--Analytics Design-->
  
    <div class="container-xl" style="height: auto;">
      <div>
          <ul class="tabs">
            <li data-tab-target="#sales" class="active tab">SALES</li>
            <li data-tab-target="#products" class="tab">PRODUCTS</li>
            <li data-tab-target="#category" class="tab">Category</li>
          </ul>
      </div> 

      <div class="tab-content">
        <div id="sales" data-tab-content class="active">
          <h1 style="font-weight: 700; font-size: 35px;">TOTAL SALES</h1>

            <div class="radiocontainer">
                <input type="radio" checked class="btn_radio" id="month" name="sales" value="1">
                <label for="month">Month</label>
                <input type="radio" class="btn_radio" id="week" name="sales" value="2">
                <label for="week">Week</label>
            </div>       
               
          <div class="boxs">
            <canvas id="sales_chart"></canvas>
          </div>
          <br>
          <h1 style="font-weight: 700; font-size: 35px;">SALES PER BRANCH</h1>
            <div class="radiocontainer">
               <input type="radio" checked class="btn_radio" id="month_b" name="sales_branch" value="1">
                <label for="month_b">Month</label>
                <input type="radio" class="btn_radio" id="week_b" name="sales_branch" value="2">
                <label for="week_b">Week</label>
            </div>   
          <div class="boxs">
            <canvas id="branch_chart"></canvas>
          </div>
        </div>
                                                                  
        <div class="products" id="products" data-tab-content> 

          <div>

          </div>

          <h1 style="font-weight: 700; font-size: 35px;">TOP PERFORMING PRODUCTS</h1>
            <div class="radiocontainer">
                <input type="radio" checked class="btn_radio" id="month_p" name="top_product_graphs" value="1">
                <label for="month_p">Month</label>
                <input type="radio" class="btn_radio" id="week_p" name="top_product_graphs" value="2">
                <label for="week_p">Week</label>
            </div> 
           <div class="boxs">
               <canvas id="top_performing_chart"></canvas>
            </div>     
        </div>

        <div class="category" id="category" data-tab-content>
            
            <h1 style="font-weight: 700; font-size: 35px;">TOP PERFORMING Category</h1>
            <div class="radiocontainer">
                <input type="radio" checked class="btn_radio" id="month_c" name="category_graphs" value="1">
                <label for="month_c">Month</label>
                <input type="radio" class="btn_radio" id="week_c" name="category_graphs" value="2">
                <label for="week_c">Week</label>
            </div>          
            <div class="boxs" style="height: 600px; width: 600px;">
               <canvas id="category_chart" ></canvas>
            </div>     
        </div>

      </div>

    </div>

  </body>
</html>

<script>

    $(document).ready(function() {

      let sale_graph    = ''; 
      let branch_graph  = ''; 
      let top_product   = ''; 
      let category_g    = ''; 
      $('.btn_radio').click(function (e) {
        var graphs_mode  = $(this).val();
        var graphs_names = $(this).attr('name');

        if(graphs_names == 'sales'){
          sale_graph.destroy();
        }
        else if(graphs_names == 'sales_branch'){
          branch_graph.destroy();
        }
        else if(graphs_names == 'top_product_graphs'){
          top_product.destroy();
        }
        else if(graphs_names == 'category_graphs'){
          category_g.destroy();
        }
        graphs_display(graphs_names,graphs_mode);

      });

      graphs_display('sales',1);
      graphs_display('sales_branch',1);
      graphs_display('top_product_graphs',1);
      graphs_display('category_graphs',1);

      function graphs_display(graphs_name,display_graph){
        $.ajax({
          url: '../x-function/analytics_graphs.php',
          type: 'POST',
          dataType: 'JSON',
          data: {graphs_name_r: graphs_name,display_graph_r:display_graph}
        })
        .done(function(data_result) {
            if(graphs_name == 'sales'){
              sale_graphs(data_result,display_graph);
            }else if(graphs_name == 'sales_branch'){
              sale_branch_graphs(data_result,display_graph);
            }
            else if(graphs_name == 'top_product_graphs'){
              top_product_graphs(data_result,display_graph);
            }
            else if(graphs_name == 'category_graphs'){
               category_graphs(data_result,display_graph);
            }
        })
        .fail(function() {
          console.log('error');
        });
      }

      function sale_graphs(data_result,display_graphs){

        var labels      = [];
        var data_values = [];
        var label_text  = '';

        if(display_graphs == 2){
          $.each(data_result, function(index, result_get) {
            labels.push(result_get['FirstDayOfWeek']+' - '+ result_get['LastDayOfWeek']);
            data_values.push(result_get['totalsale']);
            label_text  = 'Weekly Sales';
          });

        }else{
          $.each(data_result, function(index, result_get) {
            labels.push(result_get['month']+' - '+ result_get['year']);
            data_values.push(result_get['totalsale']);
            label_text  = 'Monthly Sales';
          });
        }

        var data = {
          labels: labels,
          datasets: [{
            label: label_text,
            backgroundColor: 'rgb(255, 99, 132)',
            borderColor: 'rgb(255, 99, 132)',
            data: data_values,
          }]
        };
        var config = {
          type: 'bar',
          data: data,
          options: {}
        };

        sale_graph = new Chart(
          document.getElementById('sales_chart'),
          config
        );
       

      }
      function sale_branch_graphs(data_result,display_graphs){

        var labels      = [];
        var data_values = [];
        var label_text  = '';

        if(display_graphs == 2){
          $.each(data_result, function(index, result_get) {
            labels.push(result_get['FirstDayOfWeek']+' - '+ result_get['LastDayOfWeek'] +' ('+ result_get['name'] +')');
            data_values.push(result_get['totalsale']);
            label_text  = 'Weekly Sales';
          });

        }else{
          $.each(data_result, function(index, result_get) {
            labels.push(result_get['month']+' - '+ result_get['year']+' ('+ result_get['name'] +')');
            data_values.push(result_get['totalsale']);
            label_text  = 'Monthly Sales';
          });
        }

        var data = {
          labels: labels,
          datasets: [{
            label: label_text,
            backgroundColor: 'rgb(255, 99, 132)',
            borderColor: 'rgb(255, 99, 132)',
            data: data_values,
          }]
        };
        var config = {
          type: 'bar',
          data: data,
          options: {}
        };

        branch_graph = new Chart(
          document.getElementById('branch_chart'),
          config
        );
       

      }
      function top_product_graphs(data_result,display_graphs){

        var labels      = [];
        var data_values = [];
        var product_id  = [];
        var label_text  = '';

        if(display_graphs == 2){
          $.each(data_result, function(index, result_get) {
          var product_name= result_get['product_name'].substring(0,10);
            labels.push(result_get['FirstDayOfWeek']+' - '+ result_get['LastDayOfWeek'] +' ('+ product_name +')');
            data_values.push(result_get['total']);
            product_id.push(product_name);
            label_text  = 'Weekly Sales';
          });

        }else{
          $.each(data_result, function(index, result_get) {
            var product_name= result_get['product_name'].substring(0,10);
            labels.push(result_get['month']+' - '+ result_get['year'] +' ('+ product_name +')');
            data_values.push(result_get['total']);
            product_id.push(product_name);
            label_text  = 'Monthly Sales';
          });
        }
        const data = {
             labels: labels,
             datasets: [{
               axis: 'y',
               label: label_text,
               data: data_values,
               fill: false,
               backgroundColor: [
                 'rgba(255, 99, 132, 0.5)',
               ],
               borderWidth: 1
             }]
           };
           const config = {
             type: 'bar',
             data,
             options: {
               indexAxis: 'y',
             }
           };
        top_product = new Chart(
          document.getElementById('top_performing_chart'),
          config
        );

      }
      function category_graphs(data_result,display_graphs){

        var labels      = [];
        var data_values = [];
        var product_id  = [];
        var label_text  = '';

          if(display_graphs == 2){
            $.each(data_result, function(index, result_get) {
              labels.push(result_get['FirstDayOfWeek']+' - '+ result_get['LastDayOfWeek'] +' ('+ result_get['category_name'] +')');
              data_values.push(result_get['total']);
              label_text  = 'Weekly Sales';
            });

          }else{
            $.each(data_result, function(index, result_get) {
              labels.push(result_get['month']+' - '+ result_get['year'] +' ('+ result_get['category_name'] +')');
              data_values.push(result_get['total']);
              label_text  = 'Monthly Sales';
            });
          }
          console.log(data_values)
          const data = {
            labels: labels,
            datasets: [{
              label: label_text,
              data: data_values,
              backgroundColor: [
                'rgb(255, 99, 132)',
                'rgb(54, 162, 235)',
                'rgb(255, 205, 86)',
                'rgb(255, 99, 132)',
                'rgb(255, 159, 64)',
                'rgb(255, 205, 86)',
                'rgb(75, 192, 192)',
                'rgb(54, 162, 235)',
                'rgb(153, 102, 255)',
                'rgb(201, 203, 207)'
              ],
              hoverOffset: 4
            }]
          };
          const config = {
            type: 'pie',
            data
          };
        category_g = new Chart(
          document.getElementById('category_chart'),
          config
        );

      }
      
    });

</script>
<script>
  
</script>