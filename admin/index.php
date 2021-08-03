<?php 
    ob_start();
    session_start();
    include "inc/db.php";

?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Log in (v2)</title>

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
  <!-- /.login-logo -->
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="index.php" class="h1"><b>Admin</b>LTE</a>
    </div>
    <div class="card-body">
      <p class="login-box-msg">Sign in to start your session</p>

      <form action="" method="POST">
        <div class="input-group mb-3">
          <input type="email" class="form-control" placeholder="Email" name="email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Password" name="password">
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
            <input type="submit" name="login" class="btn btn-primary btn-block" value="Sign In">
          </div>
          <!-- /.col -->
        </div>

        <!-- php for login validation of user start -->
         <?php 
              
              if(isset($_POST['login']))
              {
                $email = mysqli_real_escape_string($connect,$_POST['email']);
                $password = mysqli_real_escape_string($connect,$_POST['password']);

                // encryption the password 

                $hass_password = sha1($password);

                // check user existence in db 

                $query = "SELECT * FROM user WHERE user_email = '$email'";

                $data = mysqli_query($connect,$query);

                while($row = mysqli_fetch_assoc($data))
                {
                  $_SESSION['user_id']       = $row['user_id'];
                  $_SESSION['user_fullname'] = $row['user_fullname'];
                  $_SESSION['user_name']     = $row['user_name'];
                  $user_password             = $row['user_password'];
                  $_SESSION['user_email']    = $row['user_email'];
                  $_SESSION['user_phone']    = $row['user_phone'];
                  $_SESSION['user_address']  = $row['user_address'];
                  $_SESSION['user_role']     = $row['user_role'];
                  $_SESSION['user_image']    = $row['user_image'];
                }

                if($email == $_SESSION['user_email'] && $hass_password == $user_password)
                {
                  header("Location: dashboard.php");
                }
                else if($email != $_SESSION['user_email'] || $hass_password != $user_password)
                {
                  header("Location: index.php");

                }
                else {

                  header("Location: index.php");


                }
                

              }


         ?>


        <!-- php for login validation of user end  -->

      </form>

      <div class="social-auth-links text-center mt-2 mb-3">
        <a href="#" class="btn btn-block btn-primary">
          <i class="fab fa-facebook mr-2"></i> Sign in using Facebook
        </a>
        <a href="#" class="btn btn-block btn-danger">
          <i class="fab fa-google-plus mr-2"></i> Sign in using Google+
        </a>
      </div>
      <!-- /.social-auth-links -->

      <p class="mb-1">
        <a href="forgot-password.html">I forgot my password</a>
      </p>
      <p class="mb-0">
        <a href="register.php" class="text-center">Register a new membership</a>
      </p>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>

<?php 

 ob_end_flush();


?>
</body>
</html>
