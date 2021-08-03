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
  <title>AdminLTE 3 | Registration Page (v2)</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>
<body class="hold-transition register-page">
<div class="register-box">
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="index.php" class="h1"><b>Admin</b>LTE</a>
    </div>
    <div class="card-body">
      <p class="login-box-msg">Register a new membership</p>

      <form action="" method="POST">

        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Full name" name="fullname">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>

        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Username" name="username">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>

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
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Retype password" name="retype_password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="agreeTerms" name="terms" value="agree">
              <label for="agreeTerms">
               I agree to the <a href="#">terms</a>
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <input type="submit" class="btn btn-primary btn-block" value="Register" name="register">
          </div>
          <!-- /.col -->
        </div>

        <!-- php start for inserting register form information into database  -->


        <?php

             if(isset($_POST['register']))
             {
                $user_fullname   = mysqli_real_escape_string($connect, $_POST['fullname']);
                $user_name       = mysqli_real_escape_string($connect,$_POST['username'];
                $user_email      = mysqli_real_escape_string($connect, $_POST['email']);
                $user_password   = mysqli_real_escape_string($connect, $_POST['password']);
                $retype_password = mysqli_real_escape_string($connect, $_POST['retype_password']);



                if(empty($user_fullname) || empty($user_name) || empty($user_email) || empty($user_password)){

                      echo '<div class="alert alert-danger">Please Enter all Information </div>';

                    }
                else if($user_password == $retype_password)
                {

                  $hass_password = sha1($user_password);

                  $query = "INSERT INTO user (user_fullname,user_name,user_password,user_email,user_role) VALUES ('$user_fullname','$user_name','$hass_password','$user_email',2)";

                  $data = mysqli_query($connect,$query);

                  if($data)
                  {
                    header("Location: index.php");

                  }
                  else
                  {
                    die("registration failed " . mysqli_error($connect));
                  }

                }
                else 
                {
                  echo '<div class="alert alert-info">Password is not matched</div>';
                }

                
                 

                

             }



         ?>




        <!-- php end  for inserting register form information into database  -->



      </form>

      <div class="social-auth-links text-center">
        <a href="#" class="btn btn-block btn-primary">
          <i class="fab fa-facebook mr-2"></i>
          Sign up using Facebook
        </a>
        <a href="#" class="btn btn-block btn-danger">
          <i class="fab fa-google-plus mr-2"></i>
          Sign up using Google+
        </a>
      </div>

      <a href="index.php" class="text-center">I already have a membership</a>
    </div>
    <!-- /.form-box -->
  </div><!-- /.card -->
</div>
<!-- /.register-box -->

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
