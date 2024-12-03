<!doctype html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <meta name="description" content="">
      <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
      <meta name="generator" content="Jekyll v3.8.6">
      <title>Gramedia Inventory App</title>
      <!-- Bootstrap core CSS -->
      <link href="assets/vendors/bootstrap/css/bootstrap.min.css" rel="stylesheet">
      <link href="assets/vendors/fontawesome/css/all.min.css" rel="stylesheet">
      <link href="assets/css/style.css" rel="stylesheet">
      <!-- Custom styles for this template -->
      <link href="assets/css/dashboard.css" rel="stylesheet">
  </head>
  <body>

      <?php include_once('init.php') ?>

      <?php include('templates/navbar.php') ?>

      <div class="container-fluid">
         <div class="row">
            
            <?php include('templates/sidebar.php') ?>

            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">

               <?php
                  if(isset($_GET['page'])) {
                     $page = $_GET['page'];
                     include($page . '.php');
                  }else {
                     include('home.php');
                  }
               ?>

            </main>
         </div>
      </div>

      <script src="assets/vendors/jquery/jquery-3.4.1.min.js"></script>
      <script src="assets/vendors/bootstrap/js/bootstrap.min.js"></script>
      <script src="assets/vendors/bootstrap/js/bootstrap.bundle.min.js"></script>
   </body>
</html>
