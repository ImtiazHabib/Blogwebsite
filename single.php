<!-- header php -->
<?php
     
     include "inc/header.php";

?>
    

                  <section>
                  	<div class="container">
                  		<div class="row">
                  			<div class="col-md-8 offset-md-2">
                  				<!-- reading the artical from the database acrroding to artical id-- php start -->
				                    <?php

				                        if(isset($_GET['article']))
				                        {
				                            $article_title = $_GET['article'];
				                            // reading that article from post database 
				                            $find_article_query = "SELECT * FROM post WHERE post_title='$article_title'";

				                            $find_article_data = mysqli_query($connect,$find_article_query);

				                            
				                            while( $row = mysqli_fetch_assoc($find_article_data))
				                             {
				                                   $post_id            = $row['post_id'];
				                                   $post_title         = $row['post_title'];
				                                   $post_description   = $row['post_description'];
				                                   $catagory_id        = $row['post_catagory_id'];
				                                   $post_user_id       = $row['post_user_id'];
				                                   $post_image         = $row['post_image'];
				                                   $post_date          = $row['post_date'];

				                                   ?>
				                                   <span class="image fit">

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


					                  				</span>
					                  				<div class="inner-body">
					                  					<h1> <?php echo $post_title; ?>
					                  						
					                  					</h1>
					                  					<p>
					                  						<?php echo $post_description; ?>
					                  					</p>

					                  					 <div class="blog-info">
					                                        <ul class="alt">
					                                            <li><i class="fa fa-calendar"></i><?php $old_date_timestamp = strtotime($post_date);
					                                                   $new_date = date('F j, Y, g:i a', $old_date_timestamp); 
					                                                   echo " " . $new_date;
					                                              ?></li>
					                                            <li><i class="fa fa-user"></i>
					                                          <!-- search post author name from the user database  -->

					                                            <?php
                                                                      $query = "SELECT * FROM user WHERE user_id='$post_user_id'";

                                                                      $data = mysqli_query($connect,$query);
                                                                      while($row = mysqli_fetch_assoc($data))
                                                                      {
                                                                      	$user_fullname = $row['user_fullname'];

                                                                      }
					                                                

					                                                  echo "BY-". $user_fullname;

					                                               


					                                            ?>

					                                            </li>
					                                            <!-- <li><i class="fa fa-heart"></i>(50)</li> -->
					                                        </ul>
					                                    </div>
					          					
					                  				</div>
				                                   


				                           <?php
				                             }    
				                        }
				                    ?>
				                    <!-- reading the artical from the database acrroding to artical id-- php end  -->
                  				
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

		