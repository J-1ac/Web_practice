<?php

require_once('includes/book-setup.inc.php');

// if we have search string search for customer matches (검색을 위한 string을 입력 받은 경우)
if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['search'])) {
   $search = $_GET['search'];
   $customers = CustomerCollection::findBy('LastName Like ?', array($search . '%'));
} else {
   // otherwise get all customers(string 입력이 없으면 모든 customer를 get)
   // Active Record pattern을 사용하여 DB와 interface.
   // Goal 1.1 - CustomerCollection 클래스의 findALL(); 함수를 통해 $customers 생성
   $customers = CustomerCollection::findALL();
   

}

// 우측 네비게이션에 categories와 imprints를 위한 인터페이스
// Goal 1.2 - categoriesCollection과 imprintsCollection 클래스의 findALL(); 함수를 통해 $categories와 $imprints 생성
$categories = CategoryCollection:: findALL();
$imprints = ImprintCollection:: findALL();



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
      <div class="row">
         <!-- start main content row -->

         <div class="col-md-2">
            <!-- start left navigation rail column -->
            <?php include 'includes/book-left-nav.inc.php'; ?>
         </div> <!-- end left navigation rail -->

         <div class="col-md-8">
            <!-- start main content column -->

            <!-- book panel  -->
            <div class="panel panel-danger spaceabove">
               <div class="panel-heading">
                  <h4>My Customers</h4>
               </div>
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
                     echo '<td><a href="edit-customer.php?id=' . $cust->ID . '">' . utf8_encode($cust->getFullName(false)) . '</a></td>';
                     echo '<td>' . utf8_encode($cust->Email) . '</td>';
                     echo '<td>' . $cust->University . '</td>';
                     echo '<td>' . utf8_encode($cust->City) . '</td>';
                     echo '</tr>    ';
                  }
                  ?>
               </table>
            </div>
         </div>

         <div class="col-md-2">
            <!-- start left navigation rail column -->
            <div class="panel panel-info spaceabove">
               <div class="panel-heading">
                  <h4>Categories</h4>
               </div>
               <ul class="nav nav-pills nav-stacked">

                  <?php

                  foreach ($categories as $cat) {
                     echo '<li><a href="#">' . $cat->CategoryName . '</a></li>';
                  }
                  ?>
               </ul>
            </div>

            <div class="panel panel-info">
               <div class="panel-heading">
                  <h4>Imprints</h4>
               </div>
               <ul class="nav nav-pills nav-stacked">
                  <?php

                  foreach ($imprints as $imp) {
                     echo '<li><a href="#">' . $imp->Imprint . '</a></li>';
                  }
                  ?>
               </ul>
            </div>
         </div> <!-- end left navigation rail -->


      </div> <!-- end main content column -->
   </div> <!-- end main content row -->
   </div> <!-- end container -->





   <!-- Bootstrap core JavaScript
 ================================================== -->
   <!-- Placed at the end of the document so the pages load faster -->
   <script src="bootstrap3_bookTheme/assets/js/jquery.js"></script>
   <script src="bootstrap3_bookTheme/dist/js/bootstrap.min.js"></script>
   <script src="bootstrap3_bookTheme/assets/js/holder.js"></script>
</body>

</html>