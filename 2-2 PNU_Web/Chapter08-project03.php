<?php



function outputPostRow($number)
{
   
   include("travel-data.php");
   
   $postLink = 'post.php?id=' . ${"postId" . $number};
   $image = '<img src="images/travel/' . ${"thumb" . $number} . '" alt="' . ${"title" . $number} . '" class="img-thumbnail"/>';
   
   $user =  utf8_encode(${"userName" . $number});
   $userLink = generateLink("user.php?id=" . ${"userId" . $number}, $user, null);
   
   echo '<div class="row">';
   echo '<div class="col-md-2">';
   echo generateLink($postLink, $image, null);
   echo '</div>';
   echo '<div class="col-md-10">';
   echo '<h2>' . ${"title" . $number} . '</h2>';
   echo '<div class="details">';
   
   echo 'Posted by ' . $userLink;
   echo '<span class="pull-right">' . ${"date" . $number} . '</span>';
   echo '</div>';
   echo '<p class="excerpt">';
   echo ${"excerpt" . $number};
   echo '</p>';
   echo '<p>' . generateLink($postLink, 'Read more', 'btn btn-primary btn-sm') . '</p>';
   echo '</div>';
   echo '</div>';
}

// ----------------------------------------
// Goal 2. Make 'generateLink' function with three arguments: $url, $label and $class
// ----------------------------------------


function generateLink($url, $label, $class)
   {
      $link = '<a href="'.$url.'" class="'.$class.'">';
      $link .= $label;
      $link .= '</a>';
      return $link;
   }
   
   
   function ouputPagination($startNum, $currentNum)
   {
      echo '<ul class="pagination">';
      $disabled = '';
      if ($startNum <= 10) $disabled = ' class="disabled"';
      echo '<li' . $disabled . '>' . generateLink("#", "&laquo;", null) . '</li>';
      
      $number = $startNum;
      for ($i = 0; $i < 10; $i++) {
         $active = '';
         if ($number == $currentNum) $active = ' class="active"';
         echo '<li' . $active . '>';
         echo generateLink('#', $number, null);
         $number++;
   }
   
   
   echo '<li><a href="#">&raquo;</a></li>';
   echo '</ul>';
}

?>

<!DOCTYPE html>
<html lang="en">
   
   <head>
      <meta http-equiv="Content-Type" content="text/html; 
      charset=UTF-8" />
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta name="description" content="">
      <meta name="author" content="">
      <title>Travel Template</title>
      
      <link rel="shortcut icon" href="../../assets/ico/favicon.png">
      
      <!-- Google fonts used in this theme  -->
      <link href='http://fonts.googleapis.com/css?family=Open+Sans+Condensed:700' rel='stylesheet' type='text/css'>
      <link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,400,800,600,700,300' rel='stylesheet' type='text/css'>
      
      <!-- Bootstrap core CSS -->
      <link href="bootstrap3_travelTheme/dist/css/bootstrap.min.css" rel="stylesheet">
      <!-- Custom styles for this template -->
      <link href="bootstrap3_travelTheme/theme.css" rel="stylesheet">
      
      <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
      <!--[if lt IE 9]>
   <script src="bootstrap3_travelTheme/assets/js/html5shiv.js"></script>
   <script src="bootstrap3_travelTheme/assets/js/respond.min.js"></script>
   <![endif]-->
</head>


<body>

<?php include "travel-header.php"; ?>

   <!------------------------------------------------>
   <!---- Goal 1: include file in adequate area ----->
   <!------------------------------------------------>
   <!-- Goal 1.1 includes files (header) ------------>
   <!-- Goal 1.2 includes files (navigation boxes) -->
   <!-- Goal 1.3 includes files (footer) ------------>
   <!------------------------------------------------>
   

   <div class="container">
      <!-- start main content container -->
      <div class="row">
         <!-- start main content row -->
         <div class="col-md-3">
            <!-- start left navigation rail column -->
            <?php include "travel-left-rail.php"; ?>

            


         </div> <!-- end left navigation rail -->


         <div class="col-md-9">
            <!-- start main content column -->
            <ol class="breadcrumb">
               <li><a href="#">Home</a></li>
               <li><a href="#">Browse</a></li>
               <li class="active">Posts</li>
            </ol>

            <div class="jumbotron" id="postJumbo">
               <h1>Posts</h1>
               <p>Read other travellers' posts ... or create your own.</p>
               <p><a class="btn btn-warning btn-lg">Learn more &raquo;</a></p>
            </div>

            <!-- start post summaries -->

   <!------------------------------------------------------------->
   <!-- Goal 3: use outputPostRow function witn single argument -->
   <!-- *make three row ------------------------------------------>
   
            <div class="postlist">
               
               <hr />
               <?php outputPostRow(1); ?>
               <hr />
               <?php outputPostRow(2); ?>
               <hr />
               <?php outputPostRow(3); ?>
               <hr />
               
            </div>

            <!-- replace pagination with function call -->
            <?php ouputPagination(1, 4); ?>

         </div> <!-- end main content column -->
      </div> <!-- end main content row -->
   </div> <!-- end main content container -->
<?php include 'travel-footer.php'; ?>

  



   <!-- Bootstrap core JavaScript
 ================================================== -->
   <!-- Placed at the end of the document so the pages load faster -->
   <script src="bootstrap3_travelTheme/assets/js/jquery.js"></script>
   <script src="bootstrap3_travelTheme/dist/js/bootstrap.min.js"></script>
   <script src="bootstrap3_travelTheme/assets/js/holder.js"></script>
</body>

</html>