<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" href="assets/vendors/bootstrap/css/bootstrap.min.css">
   <link rel="stylesheet" href="assets/css/login.css">
   <title>Login Page</title>
</head>
<body>

   <?php 
      include_once('init.php'); 
      $auth = new Auth();

      if(isset($_POST['submit'])){
         $auth->login();
      }
   ?>

   <div class="container">
      <div class="row my-5">
      <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
         <div class="card card-signin my-5">
            <div class="card-body">
               <h5 class="card-title text-center">Sign In</h5>
               <?php Flasher::flash(); ?> 
               <form class="form-signin" action="" method="post">
                  <div class="form-label-group">
                     <input type="text" id="inputUsername" class="form-control" placeholder="   " name="username" required autofocus>
                     <label for="inputUsername">Username</label>
                  </div>

                  <div class="form-label-group">
                     <input type="password" id="inputPassword" class="form-control" placeholder="Password" name="password" required>
                     <label for="inputPassword">Password</label>
                  </div>

                  <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit" name="submit">Sign in</button>

                  <hr>
                  <small class="text-muted">Username : tegar</small>
                  <small class="text-muted float-right">Password : admin</small>
               </form>
            </div>
         </div>
      </div>
      </div>
   </div>

   <script src="assets/vendors/jquery/jquery-3.4.1.min.js"></script>
   <script src="assets/vendors/bootstrap/js/bootstrap.min.js"></script>
   <script src="assets/vendors/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>