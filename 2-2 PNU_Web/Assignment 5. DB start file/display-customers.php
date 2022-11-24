<?php

require_once('includes/book-config.inc.php');
require_once('includes/database.inc.php');


// if we have search string search for customer matches
if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['search']) ) {
   $customers = readSelectCustomers($_GET['search']);  

}
else {
   // otherwise get all customers
   $customers = readAllCustomers();    
}   

$categories = readCategories();
$imprints = readImprints();

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta http-equiv="Content-Type" content="text/html; 
   charset=UTF-8" />
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta name="description" content="">
   <meta name="author" content="">
   <title>Book Template</title>

   <link rel="shortcut icon" href="../../assets/ico/favicon.png">   

   <!-- Bootstrap core CSS -->
   <link href="bootstrap3_bookTheme/dist/css/bootstrap.min.css" rel="stylesheet">
   <!-- Bootstrap theme CSS -->
   <link href="bootstrap3_bookTheme/theme.css" rel="stylesheet">


   <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
   <!--[if lt IE 9]>
   <script src="bootstrap3_bookTheme/assets/js/html5shiv.js"></script>
   <script src="bootstrap3_bookTheme/assets/js/respond.min.js"></script>
   <![endif]-->
</head>

<body>

<?php include 'includes/book-header.inc.php'; ?>
   
<div class="container">
   <div class="row">  <!-- start main content row -->

      <div class="col-md-2">  <!-- start left navigation rail column -->
         <?php include 'includes/book-left-nav.inc.php'; ?>
      </div>  <!-- end left navigation rail --> 

      <div class="col-md-8">  <!-- start main content column -->
        
         <!-- book panel  -->
         <div class="panel panel-danger spaceabove">           
           <div class="panel-heading"><h4>My Customers</h4></div>
           <table class="table">
             <tr>
               <th>Name</th>
               <th>Email</th>
               <th>University</th>
               <th>City</th>
             </tr>
             <?php  
           
             foreach ($customers as $cust) {
               echo '<tr>';
               echo '<td><a href="display-customers.php?customer=' . $cust[0] . '">' . utf8_encode($cust[1]) . ' ' . utf8_encode($cust[2]) . '</a></td>';
               echo '<td>' . utf8_encode($cust[3]) . '</td>';
               echo '<td>' . $cust["University"] . '</td>';
               echo '<td>' . utf8_encode($cust["City"]) . '</td>';   
               echo '</tr>    ';    
            } 
            ?>
           </table>
         </div>           
      </div>
      
      <div class="col-md-2">  <!-- start left navigation rail column -->
         <div class="panel panel-info spaceabove">
            <div class="panel-heading"><h4>Categories</h4></div>
               <ul class="nav nav-pills nav-stacked">
       
             <?php  
           
             foreach ($categories as $cat) { 
               echo '<li><a href="#">' . $cat[1] . '</a></li>';
             }
             ?>
             </ul> 
         </div>
         
         <div class="panel panel-info">
            <div class="panel-heading"><h4>Imprints</h4></div>
            <ul class="nav nav-pills nav-stacked">
             <?php  
           
             foreach ($imprints as $imp) { 
               echo '<li><a href="#">' . $imp[1] . '</a></li>';
             }
             ?>
             </ul>
         </div>         
      </div>  <!-- end left navigation rail --> 


      </div>  <!-- end main content column -->
   </div>  <!-- end main content row -->
</div>   <!-- end container -->
   


   
   
 <!-- Bootstrap core JavaScript
 ================================================== -->
 <!-- Placed at the end of the document so the pages load faster -->
 <script src="bootstrap3_bookTheme/assets/js/jquery.js"></script>
 <script src="bootstrap3_bookTheme/dist/js/bootstrap.min.js"></script>
 <script src="bootstrap3_bookTheme/assets/js/holder.js"></script>
</body>
</html>