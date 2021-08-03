<!-- header php -->
<?php
     
     include "inc/header.php";

?>

	<!-- Banner -->
		<section id="banner">

			<div class="content">
			   <!-- post reading from database start here -->
                <?php
                     
                     //this is query 
                 $query ="SELECT * FROM post ORDER BY post_id DESC LIMIT 1";
                 //here query run into $connect database and store data into $all_user_information.
                 $all_posts_infromation = mysqli_query($connect,$query);


                 // if post number is zero then print this start

                     $count =mysqli_num_rows($all_posts_infromation);

                     if($count<=0)
                     {
                        echo '<div class="alert alert-info ">Ohh!!! No Post has been published yet...</div>';
                     }
                     else {
                            while( $row = mysqli_fetch_assoc($all_posts_infromation))
                             {
                               $post_id            = $row['post_id'];
                               $post_title         = $row['post_title'];
                               $post_description   = $row['post_description'];
                               $catagory_id        = $row['post_catagory_id'];
                               $post_user_id       = $row['post_user_id'];
                               
                               $post_image         = $row['post_image'];
                               $post_date          = $row['post_date'];

                               ?>
                                <header>
									<h2>Hi,Welcome to BlogPage<br />
									by Imtiaz Habib</h2>
									<p>Place to write your imagination</p>
								</header>
								<p><?php echo substr($post_description, 0, 300) ?></p>


                               <!-- php code for checking login or not start -->
                                <?php
                                     
                                     if( empty($_SESSION['email']) && empty($_SESSION['user_id']))
                                         {
                                            ?>
                                             <div class="alert alert-primary" role="alert" style="background: black; color: white; padding: 10px 0px; text-align: center; font-weight: 700;">
                                              Please Login for Reading
                                            </div>
                                            
                                   <?php
                                         }
                                         else
                                         {
                                            ?>
                                            <ul class="actions">
												<li><a href="single.php?article=<?php echo $post_title; ?>" class="button big">Read More</a></li>
											</ul>

                                           
                                     <?php
                                         }

                                ?>
                                <!-- php code for checking login or not end  -->

								




							</div>
							<span class="image object">
								<a href="single.php?article=<?php echo $post_title; ?>">
                                    <?php 

                                         if(!empty($post_image))
                                         {
                                          ?>
                                              <img src="admin/dist/img/posts/<?php echo $post_image; ?>" >
                                          <?php
                                         }
                                         else
                                         {?>
                                          <img src="admin/dist/img/posts/default.png" >

                                        <?php
                                         }

                                      ?>
                                </a>
							</span>

                               <?php
                              }
                          }

                     ?> 
				
		</section>

	<!-- Section -->
		<section>
			<header class="major">
				<h2>All Blogs</h2>
			</header>
			<div class="posts">
				<!-- post reading from database start here -->
                <?php
                     
                     //this is query 
                 $query ="SELECT * FROM post ORDER BY post_id DESC ";
                 //here query run into $connect database and store data into $all_user_information.
                 $all_posts_infromation = mysqli_query($connect,$query);


                 // if post number is zero then print this start

                     $count =mysqli_num_rows($all_posts_infromation);

                     if($count<=0)
                     {
                        echo '<div class="alert alert-info ">Ohh!!! No Post has been published yet...</div>';
                     }
                     else {
                                while( $row = mysqli_fetch_assoc($all_posts_infromation))
                                 {
                                   $post_id            = $row['post_id'];
                                   $post_title         = $row['post_title'];
                                   $post_description   = $row['post_description'];
                                   $catagory_id        = $row['post_catagory_id'];
                                   $post_user_id       = $row['post_user_id'];
                                   
                                   $post_image         = $row['post_image'];
                                   $post_date          = $row['post_date'];

                                   ?>
                                    <article>
										<a href="" class="image">
	                                        <?php 

	                                             if(!empty($post_image))
	                                             {
	                                              ?>
	                                                  <img src="admin/dist/img/posts/<?php echo $post_image; ?>" >
	                                              <?php
	                                             }
	                                             else
	                                             {?>
	                                              <img src="admin/dist/img/posts/default.png" >

	                                            <?php
	                                             }

	                                          ?>
	                                    </a>
	                                    <a href="">
	                                        <h3 class="post-title"><?php echo $post_title; ?></h3>
	                                    </a>
										
										<p><?php echo substr($post_description, 0, 150) ?>... ...</p>


										<!-- php code for checking login or not start -->
		                                <?php
		                                     
		                                     if( empty($_SESSION['email']) && empty($_SESSION['user_id']))
		                                         {
		                                            ?>
		                                             <div class="alert alert-primary" role="alert" style="background: black; color: white; padding: 10px 0px; text-align: center; font-weight: 700;">
		                                              Please Login for Reading
		                                            </div>
		                                            
		                                   <?php
		                                         }
		                                         else
		                                         {
		                                            ?>
		                                            <ul class="actions">
														<li><a href="single.php?article=<?php echo $post_title; ?>" class="button big">Read More</a></li>
													</ul>

		                                           
		                                     <?php
		                                         }

		                                ?>
                                        <!-- php code for checking login or not end  -->

									</article>

									<?php
									}
							}
				?>				

				
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

		