<?php 

   include "../actions/DbConnect.php";
   $db = new DbConnect;
   $conn = $db->connect();

   if(isset($_POST['graphs_name_r'])){

      if($_POST['graphs_name_r'] == 'sales'){

         if($_POST['display_graph_r'] == 2){

            $graphs_data = $conn->prepare("select sum(total) totalsale,date_add(salesdate, interval  -WEEKDAY(salesdate)-1 day) FirstDayOfWeek,date_add(date_add(salesdate, interval  -WEEKDAY(salesdate)-1 day), interval 6 day) LastDayOfWeek, week(DATE_SUB(salesdate, INTERVAL 1 DAY)) my_week from tblsales group by week(DATE_SUB(salesdate, INTERVAL 1 DAY)),YEAR(salesdate) order by my_week ASC");
            $graphs_data->execute();
            $graphs_data = $graphs_data->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode($graphs_data);

         }else{
           
            $graphs_data = $conn->prepare("SELECT sum(total) as totalsale,MONTHNAME(salesdate) as month,year(salesdate) as year  FROM tblsales GROUP by YEAR(salesdate),Month(salesdate)");
            $graphs_data->execute();
            $graphs_data = $graphs_data->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode($graphs_data);

         }

      }
      else if($_POST['graphs_name_r'] == 'sales_branch'){

         if($_POST['display_graph_r'] == 2){

            $graphs_data = $conn->prepare("select sum(total) totalsale,name,date_add(salesdate, interval  -WEEKDAY(salesdate)-1 day) FirstDayOfWeek,date_add(date_add(salesdate, interval  -WEEKDAY(salesdate)-1 day), interval 6 day) LastDayOfWeek, week(DATE_SUB(salesdate, INTERVAL 1 DAY)) my_week,branchid from tblsales INNER JOIN tblbranch on tblbranch.id = tblsales.branchid group by week(DATE_SUB(salesdate, INTERVAL 1 DAY)),YEAR(salesdate),branchid order by my_week ASC");
            $graphs_data->execute();
            $graphs_data = $graphs_data->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode($graphs_data);

         }else{
           
            $graphs_data = $conn->prepare("SELECT sum(total) as totalsale,name,MONTHNAME(salesdate) as month,year(salesdate) as year,branchid  FROM tblsales INNER JOIN tblbranch on tblbranch.id = tblsales.branchid GROUP by YEAR(salesdate),Month(salesdate),branchid");
            $graphs_data->execute();
            $graphs_data = $graphs_data->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode($graphs_data);

         }

      }
      else if($_POST['graphs_name_r'] == 'top_product_graphs'){

         if($_POST['display_graph_r'] == 2){

            $graphs_data = $conn->prepare("select COUNT(*) total,tblproducts.name as product_name,date_add(salesdate, interval  -WEEKDAY(salesdate)-1 day) FirstDayOfWeek,date_add(date_add(salesdate, interval  -WEEKDAY(salesdate)-1 day), interval 6 day) LastDayOfWeek, week(DATE_SUB(salesdate, INTERVAL 1 DAY)) my_week,productid from  tblsalesitem 
               INNER JOIN tblsales on tblsales.id = tblsalesitem.salesid 
               INNER JOIN tblproducts on tblproducts.id = tblsalesitem.productid 
               group by week(DATE_SUB(salesdate, INTERVAL 1 DAY)),YEAR(salesdate),productid order by COUNT(*) DESC");
            $graphs_data->execute();
            $graphs_data = $graphs_data->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode($graphs_data);

         }else{
           
            $graphs_data = $conn->prepare("SELECT productid,tblproducts.name as product_name,MONTHNAME(salesdate) as month,COUNT(*) total,MONTH(salesdate) as month_num,year(salesdate) as year FROM `tblsalesitem` 
               INNER JOIN tblsales on tblsales.id = tblsalesitem.salesid 
               INNER JOIN tblproducts on tblproducts.id = tblsalesitem.productid 
               GROUP by YEAR(salesdate),Month(salesdate),productid ORDER by COUNT(*) DESC;");
            $graphs_data->execute();
            $graphs_data = $graphs_data->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode($graphs_data);

         }

      }
      else if($_POST['graphs_name_r'] == 'supplier_graphs'){

         if($_POST['display_graph_r'] == 2){

            $graphs_data = $conn->prepare("select sum(total) totalsupply,date_add(salesdate, interval  -WEEKDAY(salesdate)-1 day) FirstDayOfWeek,date_add(date_add(salesdate, interval  -WEEKDAY(salesdate)-1 day), interval 6 day) LastDayOfWeek, week(DATE_SUB(salesdate, INTERVAL 1 DAY)) my_week,userid,CONCAT(firstname,' ', lastname) AS username FROM tblpayables INNER JOIN tblusers on tblusers.id = tblpayables.userid group by week(DATE_SUB(salesdate, INTERVAL 1 DAY)),YEAR(salesdate),userid order by my_week,userid ASC");
            $graphs_data->execute();
            $graphs_data = $graphs_data->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode($graphs_data);

         }else{
           
            $graphs_data = $conn->prepare("SELECT sum(total) as totalsupply,MONTHNAME(salesdate) as month,year(salesdate) as year,userid,CONCAT(firstname,' ', lastname) AS username FROM tblpayables INNER JOIN tblusers on tblusers.id = tblpayables.userid GROUP by YEAR(salesdate),Month(salesdate),userid");
            $graphs_data->execute();
            $graphs_data = $graphs_data->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode($graphs_data);

         }

      }
      else if($_POST['graphs_name_r'] == 'category_graphs'){

         if($_POST['display_graph_r'] == 2){

            $graphs_data = $conn->prepare("select count(*) total,tblcategory.id as category_id,tblcategory.name as category_name,date_add(salesdate, interval  -WEEKDAY(salesdate)-1 day) FirstDayOfWeek,date_add(date_add(salesdate, interval  -WEEKDAY(salesdate)-1 day), interval 6 day) LastDayOfWeek,week(DATE_SUB(salesdate, INTERVAL 1 DAY)) my_week FROM tblsalesitem INNER join tblproducts on tblproducts.id = tblsalesitem.productid INNER join tblsales on tblsales.id = tblsalesitem.salesid INNER join tblcategory on tblcategory.id = tblproducts.category group by week(DATE_SUB(salesdate, INTERVAL 1 DAY)),YEAR(salesdate),tblcategory.id order by my_week ASC");
            $graphs_data->execute();
            $graphs_data = $graphs_data->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode($graphs_data);

         }else{
           
            $graphs_data = $conn->prepare("SELECT count(*) total,tblcategory.id as category_id,tblcategory.name as category_name,MONTHNAME(salesdate) as month,year(salesdate) as year FROM tblsalesitem INNER join tblproducts on tblproducts.id = tblsalesitem.productid INNER join tblsales on tblsales.id = tblsalesitem.salesid INNER join tblcategory on tblcategory.id = tblproducts.category GROUP by  YEAR(salesdate),Month(salesdate),tblcategory.id");
            $graphs_data->execute();
            $graphs_data = $graphs_data->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode($graphs_data);

         }

      }



      

   }

?>