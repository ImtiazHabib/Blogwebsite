<!-- Sidebar -->
		<div id="sidebar">
			<div class="inner">

				<!-- Search -->
					<section  id="search" class="alt">
						<!-- Search Form Start -->
                        <form action="search.php" method="POST">
                            <div class="form-group">
                                <input type="text" name="search"  autocomplete="off" class="form-input">
                                <i class="fa fa-paper-plane-o"></i>
                            </div>
                            <div class="form-group">
                                <input type="submit" name="search_content" value="Search" class="btn btn-primary btn-block">
                            </div>
                        </form>
                        <!-- Search Form End -->
					</section>


				<!-- Menu -->
					<nav id="menu">
						<header class="major">
							
							<h2>Menu</h2>
						</header>
						<ul>
							<li><a href="index.php">Homepage</a></li>

							<!-- catagory reading from database ... php code start -->
                           <?php

                                $all_parent_catagory_query = "SELECT cat_id AS 'p_cat_id', cat_name AS 'p_cat_name' FROM catagories WHERE cat_status=1 ORDER BY cat_name ASC";

                                $all_parent_catagory_data = mysqli_query($connect,$all_parent_catagory_query);

                                while($row = mysqli_fetch_assoc($all_parent_catagory_data))
                                {
                                      extract($row);

                                        ?>
                                         <li class="nav-item">
                                            <a class="nav-link" href="catagory.php?catagory=<?php echo $p_cat_name; ?>"><?php echo $p_cat_name; ?></a>
                                          </li>


                                        
                                        <?php
                                      }
                               
                           ?>
                          <!-- catagory reading from database ... php code end  -->

                           <li>
								<span class="opener">Account</span>
								<ul>
									<li><a href="login.php">Login</a></li>
									<li><a href="register.php">Register</a></li>


                              <?php
                                             
                                             if( !empty($_SESSION['email']) && !empty($_SESSION['user_id']))
                                                 {
                                                  ?>



                                                  
                                                   <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                                                   




                                               <?php

                                                 }

                                ?> 
									
								</ul>
							</li>
						</ul>
					</nav>

				<!-- Section -->
					<section>
						<header class="major">
							<h2>Latest Blogs</h2>
						</header>
						<div class="mini-posts">
							<!-- Latest blog readiing from php start here  -->

								<?php 
                                 
	                                 $three_latest_post_query ="SELECT * FROM post ORDER BY post_id DESC LIMIT 3";
	                                 $three_latest_post_data = mysqli_query($connect,$three_latest_post_query);
	                                 while( $row = mysqli_fetch_assoc($three_latest_post_data))
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
											<p><?php echo $post_title; ?></p>

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
                                 ?>



								<!-- Latest blog readiing from php end  here  -->
							
						</div>
						<ul class="actions">
							<li><a href="#" class="button">More</a></li>
						</ul>
					</section>

				<!-- Section -->
					<section>
						<header class="major">
							<h2>About us</h2>
						</header>
						<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Necessitatibus nisi deleniti reprehenderit doloribus aspernatur eaque impedit, officiis unde libero voluptatibus, tenetur sint magni dolorem error similique ea qui, vel suscipit.</p>
						<ul class="contact">
							<li class="icon solid fa-envelope"><a href="#">imtiazhabib7@gmail.com</a></li>
							<li class="icon solid fa-phone">(+880) 168-1651501</li>
							<li class="icon solid fa-home">24/1 no monir hossaine lane<br />
							Narinda,DHAKA-1100</li>
						</ul>
					</section>

				<!-- Footer -->
					<footer id="footer">
						<p class="copyright">&copy; Imtiaz Habib. All rights reserved</p>
					</footer>

			</div>
		</div>