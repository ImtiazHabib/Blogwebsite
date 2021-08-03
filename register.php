<!-- header php -->
<?php
     
     include "inc/header.php";

?>

		<section class="login">
			<div class="container">
				<div class="row">
					<div class="col-md-3 offset-md-5" style="margin-left: 300px;
    width: 35%;">

						<div class="card">

							   <h2>Registration Form</h2>
    
	                        <form action="" method="POST" enctype="multipart/form-data">

	                            <input type="text" name="fullname"  class="form-control" placeholder="Full Name" required autofocus style="margin-bottom: 15px;">
	                            <input type="text" name="username"  class="form-control" placeholder="Username" required style="margin-bottom: 15px;">
	                            
	                            <input type="email" name="email"  class="form-control" placeholder="Email address" required autofocus style="margin-bottom: 15px;">
	                            <input type="password" name="password"  class="form-control" placeholder="Password" required style="margin-bottom: 15px;">
	                            <input type="password" name="retype_password"  class="form-control" placeholder="Retype Password" required style="margin-bottom: 15px;">

	                            <input type="text" name="phone"  class="form-control" placeholder="Phone Number" required autofocus style="margin-bottom: 15px;">
	                            <input type="text" name="address"  class="form-control" placeholder="Address" required style="margin-bottom: 15px;">

	                            <!-- Image -->
                                <div class="from-group">
                                  <label for="image">Profile Picture</label>
                                  <input type="file" name="image" class="from-control-file">
                                </div>


	                            
	                            <input class="btn btn-lg btn-primary btn-block btn-signin" type="submit" name="register" value="Register" style="margin-top: 15px;">

	                            <!-- php start-- for sending and adding data into database   --> 
                <?php
                     
                     if(isset($_POST['register']))
                     {
                        $full_name         = mysqli_real_escape_string($connect,$_POST['fullname']);
                        $username         = mysqli_real_escape_string($connect,$_POST['username']);

                        $email             = mysqli_real_escape_string($connect,$_POST['email']);
                        $password          = mysqli_real_escape_string($connect,$_POST['password']);
                        $retype_password   = mysqli_real_escape_string($connect,$_POST['retype_password']);
                        $phone         = mysqli_real_escape_string($connect,$_POST['phone']);
                        $address         = mysqli_real_escape_string($connect,$_POST['address']);


                         //store image with image name
                      $image       = $_FILES['image']['name'];

                      //name of temp file where image is temporary stored
                      $image_tmp = $_FILES['image']['tmp_name'];





                        if($password == $retype_password)
                        {
                          $hass_password = sha1($password);

                          $imageRandom = rand(0, 9999999);

                          $image_name = $imageRandom.$image;

                          //move image to destination file
                          move_uploaded_file($image_tmp,"admin/dist/img/users/" . $image_name);
                          
                           $query = "INSERT INTO user (user_fullname,user_name,user_email,user_password,user_phone,user_address,user_image) VALUES ('$full_name','$username','$email','$hass_password','$phone','$address','$image_name')";

                           $register_user_data = mysqli_query($connect,$query);

                           if($register_user_data)
                           {
                            header("Location: login.php");
                           }
                           else
                           {
                            die("REGISTRATION FAILED" . mysqli_error($connect));
                           }
                           
                        }
                        else
                        {
                          echo '<div class="alert alert-danger"> Password did not match </div>';

                        }
                     }    


                ?>
               <!-- php end -- for sending and adding data into database   -->


                            </form><!-- /form -->
    
                      </div><!-- /card-container -->
						
					</div>
				</div>
			</div>

			
		</section>

						</div>
					</div>

				<!-- Sidebar php  -->
				<?php

				     include "inc/leftsidebar.php";

				?>
					

			</div>

<!-- footer php  -->
<?php

 include "inc/footer.php";

?>

		