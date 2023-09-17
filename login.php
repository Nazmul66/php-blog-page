<?php 
   session_start();
   include "inc/db.php";
   ob_start();
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Log in</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href=""><b>Admin</b>LTE</a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Sign in to start your session</p>

      <?php 
        if( !empty($_SESSION['err_msg']) ){
        ?>
           <div class="alert alert-danger">
              <?php echo $_SESSION['err_msg']; ?>
           </div>
        <?php

         session_unset();
         session_destroy();
         
         }
        ?>

      <form action="" method="post">
        <div class="input-group mb-3">
          <input type="Email" name="email" class="form-control" placeholder="Email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" name="password" class="form-control" placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="remember">
              <label for="remember">
                Remember Me
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" name="loginBtn" class="btn btn-primary btn-block">Sign In</button>
          </div>
          <!-- /.col -->
        </div>
      </form>


      <?php 
        
        if( isset( $_POST['loginBtn'] ) ){
             $email     = mysqli_real_escape_string($db,  $_POST['email']);
             $password  = mysqli_real_escape_string($db,  $_POST['password']);

             $hashPassword = sha1($password);

             $sql = "SELECT * FROM userinfo WHERE email = '$email' AND role = 1";
             $userAuth = mysqli_query($db, $sql);
             $userCount = mysqli_num_rows($userAuth);

             if( $userCount == 1 ){
                  while( $row = mysqli_fetch_array($userAuth) ){
                    $_SESSION['id']              = $row['id'];
                    $_SESSION['name']            = $row['name'];
                    $_SESSION['email']           = $row['email'];
                    $password                    = $row['password'];
                    $_SESSION['Image']           = $row['Image'];
                    $role                        = $row['role'];
                    $status                      = $row['status'];

                    if( $_SESSION['email'] == $email && $password == $hashPassword && $status == 1 ){
                        header("Location: Dashboard.php");
                    }
                    else if( $_SESSION['email'] != $email || $password != $hashPassword && $status != 1 ){
                      $_SESSION['err_msg'] = "Invalid Email and Password";
                      header("Location: login.php");
                    }
                    else{
                      $_SESSION['err_msg'] = "Please fillUp the form then login";
                      header("Location: login.php");
                    }

                }
             }

             else{
                $_SESSION['err_msg'] = "User not found in our system";
                header("Location: login.php");
             }
        }

      ?>


      <div class="social-auth-links text-center mb-3">
        <p>- OR -</p>
        <a href="#" class="btn btn-block btn-primary">
          <i class="fab fa-facebook mr-2"></i> Sign in using Facebook
        </a>
        <a href="#" class="btn btn-block btn-danger">
          <i class="fab fa-google-plus mr-2"></i> Sign in using Google+
        </a>
        <?php 
        // echo $_SESSION['id'];
        // echo $_SESSION['name'];
        // echo $_SESSION['email'];
        ?>
      </div>
      <!-- /.social-auth-links -->

      <p class="mb-1">
        <a href="forgot-password.html">I forgot my password</a>
      </p>
      <p class="mb-0">
        <a href="register.html" class="text-center">Register a new membership</a>
      </p>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
</body>
</html>


<?php 
    ob_end_flush();
?>
