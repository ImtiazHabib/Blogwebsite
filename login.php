<!-- header php -->
<?php
     
     include "inc/header.php";

?>

							<section class="login">
								<div class="container">
									<div class="row">
										<div class="col-md-6 offset-md-3">

											<div class="card">
												<div class="card-header">
													<div class="card-title">
														<h3>Login</h3>	
													</div>
												</div>
												<div class="card-body">
													<form method="POST" action="">
														<div class="row gtr-uniform">
															<div class="col-6 col-12-xsmall">
																<input type="email" name="email" id="demo-email" value="" placeholder="Email" class="form-control">
															</div>
															<div class="col-6 col-12-xsmall">
																<input type="password" name="password" id="demo-name" placeholder="Password" class="form-control">
															</div>

															<div class="form-group">
																<ul class="actions">
																	<li><input type="submit" name="login" value="Login" class="primary"></li>
																	
																</ul>
															</div>	
														</div>
													</form>

							<?php 
      
                              if(isset($_POST['login']))
                              {

                                $email        = mysqli_real_escape_string($connect, $_POST['email']);
                                $password     = mysqli_real_escape_string($connect, $_POST['password']);
                                

                                // change password to sha1 because the database apply sha1 algorithms

                                $hasspassword = sha1($password);

                                 // get information of this user from database start
                                 
                                 $login_user_data_query = "SELECT * FROM user WHERE user_email='$email' ";

                                 $login_user_data = mysqli_query($connect,$login_user_data_query);

                                 // count how many user has this email and password 

                                 $count = mysqli_num_rows($login_user_data);


                                 if( $count > 0){
             
                                         while($row = mysqli_fetch_array($login_user_data))
                                         {

                                            $_SESSION['user_id']  = $row['user_id'];
                                             
                                            $_SESSION['full_name']   = $row['user_fullname'];
                                            $_SESSION['user_name']   = $row['user_name'];
                                            $_SESSION['email']      = $row['user_email'];
                                            
                                            $_SESSION['user_role']   = $row['user_role'];

                                            $password    = $row['user_password'];
                                            $phone       = $row['user_phone'];
                                            $address     = $row['user_address'];
                                            
                                            $image       = $row['user_image'];

                                             
                                             if($_SESSION['email'] == $email && $password == $hasspassword   )
                                             {
                                               header("Location: index.php");
                                             }
                                             else if($_SESSION['email'] != $email || $password != $hasspassword)
                                             {
                                                echo '<div class="alert alert-danger login"> Sorry, User is invalid </div>'; 

                                             }
                                             else {

                                              echo '<div class="alert alert-danger login"> Wait for admin approval </div>'; 

                                             }

                                         }

                                     }
                                     else if( $count <= 0 )
                                     {
                                       
                                       echo '<div class="alert alert-danger login"> Sorry, User is invalid </div>'; 

                                     }
                              }

                         ?>
												</div>
											</div>
											
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

		