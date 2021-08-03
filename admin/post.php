<?php
    
    include "inc/header.php";
    include "inc/topmenubar.php";
    include "inc/leftmenubar.php";

?>

  <!-- Body start here  -->
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Manage All Post</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
              <li class="breadcrumb-item active">Manage Post </li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main  body content  start-->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">

          <div class="col-lg-12">

            

          <!-- post php start here  -->
            <?php 
               
               $do = isset($_GET['do'])? $_GET['do']:'Manage';

                // read user information from database 

               if($do == "Manage")
               {
                 ?>
                <div class="catagories-table">
                  <table class="table">
                     <thead>
                        <tr>
                           <th scope="col">#Sl</th>
                           <th scope="col">Thumbnail</th>
                           <th scope="col">Title</th>                          
                           <th scope="col">Catagory</th>
                           <th scope="col">Author</th>
                           <th scope="col">Publish Date</th>
                           <th scope="col">Action</th>
                        </tr>
                     </thead>
                     <tbody>

                      <!-- php for reading all post from database  -->
                      <?php 
                             //this is query 
                             $query ="SELECT * FROM post ORDER BY post_id DESC ";
                             //here query run into $connect database and store data into $all_user_information.
                             $all_posts_infromation = mysqli_query($connect,$query);


                             // if post number is zero then print this start

                                 $count =mysqli_num_rows($all_posts_infromation);

                                 if($count<=0)
                                 {
                                    echo '<div class="alert alert-info ">No Post has been found . Please add new post...... </div>';
                                 }

                             // if post number is zero then print this send 


                             $i=0;

                             while( $row = mysqli_fetch_assoc($all_posts_infromation))
                             {
                               $post_id            = $row['post_id'];
                               $post_title         = $row['post_title'];
                               $post_description   = $row['post_description'];
                               $post_catagory_id        = $row['post_catagory_id'];
                               $post_user_id       = $row['post_user_id'];
                               $post_image         = $row['post_image'];
                               $post_date          = $row['post_date'];                               
                               $i++;
                               ?>

                                 <tr>
                           <th scope="row"><?php echo $i; ?></th>
                           <th scope="row">

                            <?php 

                                 if(!empty($post_image))
                                 {
                                  ?>
                                      <img src="dist/img/posts/<?php echo $post_image; ?>" width="30" alt="">
                                  <?php
                                 }
                                 else
                                 {?>
                                  <img src="dist/img/posts/default.png" width="30" alt="">

                                <?php
                                 }

                              ?>
                           </th>
                           <th scope="row"><?php echo $post_title; ?></th>
                           <th scope="row">

                             <!-- search post catagory name from the catagory database  -->

                            <?php

                                $query = "SELECT * FROM catagories WHERE cat_id='$post_catagory_id'";

                                $post_cat_name = mysqli_query($connect,$query);

                                while($row = mysqli_fetch_array($post_cat_name))
                                {
                                  $p_cat_name = $row['cat_name'];

                                  echo $p_cat_name;

                                }


                            ?>
 
                            </th>

                           <th scope="row">


                            <!-- search post author name from the user database  -->

                            <?php

                                $query = "SELECT * FROM user WHERE user_id='$post_user_id'";

                                $post_author_name = mysqli_query($connect,$query);

                                while($row = mysqli_fetch_array($post_author_name))
                                {
                                  $p_author_name = $row['user_name'];

                                  echo $p_author_name;

                                }


                            ?>
                            </th>

                            <!-- Publish date  -->
                           <th scope="row"><?php echo $post_date; ?></th>
                             <td>
                               <div class="btn-group">
                                <a href="post.php?do=Edit&edit_id=<?php echo $post_id; ?>">
                                  <i class="fas fa-edit"></i>
                                </a>
                                <a href="" data-toggle="modal" data-target="#delete_post_modal<?php echo $post_id;  ?>" >
                                  <i class="fas fa-trash"></i>
                                </a>

                                <!-- delete user modal start -->
                                <div class="modal fade" id="delete_post_modal<?php echo $post_id;  ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                  <div class="modal-dialog">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Are you sure to delete this Post? </h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                          <span aria-hidden="true">&times;</span>
                                        </button>
                                      </div>
                                      <div class="modal-body">
                                        <a type="button" class="btn btn-danger" data-dismiss="modal">Cancel</a>
                                        <a  href="post.php?do=Delete&delete_id=<?php echo $post_id;  ?>" class="btn btn-primary" >Confirm</a>
                                      </div>                           
                                    </div>
                                  </div>
                                </div>
                                <!-- delete user  modal end  -->
                              </div>
                           </td>

                            

                        </tr>

                             <?php
                             }
                              
                      ?>

                     </tbody>
                  </table>
               </div>                
               
               <?php
               }


               else if ($do == "Add") {
                ?>

                   <div class="card">
                     <div class="card-header">
                       <h3 class="card-title"> Add New Post</h3>
                     </div>
                     <div class="card-body">
                      <form action="post.php?do=Insert" method="POST" enctype="multipart/form-data">
                           <div class="row">

                             <div class="col-lg-6">

                                  <!-- Post Title  -->
                                    <div class="form-group">
                                      <label for="">Post Title</label>
                                      <input type="text" name="post_title" class="form-control" required="required" autocomplete="off">
                                    </div>

                                    

                                    <!-- Post Catagory  -->
                                    <div class="form-group">
                                      <label for="">Post Catagory</label>
                                       <select name="catagory_id" id="">
                                         <option value="0">Please Select the Catagory</option>
                                         
                                         <!-- All Catagory reading from database php start here  -->
                                          <?php 

                                                $query = "SELECT * FROM catagories  ORDER BY cat_name ASC";

                                                $read_catagory = mysqli_query($connect,$query);

                                                while($row = mysqli_fetch_assoc($read_catagory))
                                                {
                                                   $cat_id = $row['cat_id'];
                                                   $cat_name = $row['cat_name'];

                                                   // print catagories names 
                                                   ?>

                                                    <option value="<?php echo $cat_id; ?>"><?php echo $cat_name; ?></option>

                                                    

                                                  <?php
                                                }  
                                                
                                            ?>

                                         <!-- All Catagory reading from database php end here  -->
                                         
                                       </select>
                                    </div> 

                                   

                                    <!-- Post  Image -->
                                    <div class="from-group">
                                      <label for="image">Post Image</label>
                                      
                                      <input type="file" name="post_image" class="from-control-file">
                                    </div>
                               
                            
                                                                                                  
                             </div>

                             <!-- right side colume -->
                             <div class="col-lg-6">

                                  <!-- Post Date  -->
                                    <div class="form-group">
                                      <label for="">Post Date</label>
                                      <input type="date" name="post_date" class="form-control" required="required" autocomplete="off">
                                    </div>

                                  
                                   <!-- catagories description -->
                                    <div class="form-group">
                                       <label for="inputDescription">Posts Description</label>
                                       <textarea id="inputDescription" class="form-control" rows="4" name="description"></textarea>
                                    </div>

                                    

                                    <!-- button -->
                                    <div class="from-group">
                                      <input type="submit" name="publish_post" class="btn btn-primary" value="Publish Post">
                                    </div>

                             </div>
                           </div>
                      </form>
                     </div>
                   </div>
              <?php
               }
                else if ($do == "Insert") {

                  //take information from add and update it into db
                  if(isset($_POST['publish_post']))
                  {

                        $post_title      = mysqli_real_escape_string($connect,$_POST['post_title']);

                        $post_description = mysqli_real_escape_string($connect,$_POST['description']);

                        $post_catagory_id   = $_POST['catagory_id'];

                        $post_date   = $_POST['post_date'];


                        $post_user_id  = $_SESSION['user_id'];

                        
                       

                        //store image with image name
                        $image       = $_FILES['post_image']['name'];

                        //name of temp file where image is temporary stored
                        $image_tmp = $_FILES['post_image']['tmp_name'];

                      
                        

                        $imageRandom = rand(0, 9999999);

                        $image_name = $imageRandom.$image;

                        //move image to destination file
                        move_uploaded_file($image_tmp,"dist/img/posts/" . $image_name);

                        //insert query
                        $query = "INSERT INTO post (post_title,post_description,post_catagory_id,post_user_id,post_date,post_image) VALUES ('$post_title','$post_description','$post_catagory_id','$post_user_id','$post_date','$image_name')";
                       
                        $publish_post = mysqli_query($connect,$query);

                        if($publish_post)
                        {
                           
                          header("Location: post.php");
                        }
                        else{
                          die("inserting failed". mysqli_error($connect));
                        }

                                            
                  }
                   // php end --insert to db
               }
               // insert if end 


               else if ($do == "Edit") {

                // takeing data from db after user  edit button pressed

                if(isset($_GET['edit_id']))
                {
                  $edit_post_id = $_GET['edit_id'];

                  $edit_post_id_data_query = "SELECT * FROM post WHERE post_id='$edit_post_id'";
                  $edit_post_id_data = mysqli_query($connect,$edit_post_id_data_query);

                  while($row = mysqli_fetch_assoc($edit_post_id_data))
                  {
                       $post_id            = $row['post_id'];
                       $post_title         = $row['post_title'];
                       $post_description   = $row['post_description'];
                       $post_catagory_id        = $row['post_catagory_id'];
                       $post_user_id       = $row['post_user_id'];
                       $post_image         = $row['post_image'];
                       $post_date          = $row['post_date']; 
                        
                        ?>
                        <!-- Edit user table start here  -->
                        <div class="card">
                     <div class="card-header">
                       <h3 class="card-title"> Edit Post</h3>
                     </div>
                     <div class="card-body">
                      <form action="post.php?do=Update" method="POST" enctype="multipart/form-data">
                           <div class="row">

                             <div class="col-lg-6">

                                  <!-- Post Title  -->
                                    <div class="form-group">
                                      <label for="">Post Title</label>
                                      <input type="text" name="post_title" class="form-control"  autocomplete="off" value="<?php echo $post_title; ?>">
                                    </div>

                                   

                                    <!-- Post Catagory  -->
                                    <div class="form-group">
                                      <label for="">Post Catagory</label>
                                       <select name="post_catagory_id" id="">
                                         <option value="0">Please Select the Catagory</option>
                                         
                                         <!-- All Catagory reading from database php start here  -->
                                          <?php 

                                                $query = "SELECT * FROM catagories  ORDER BY cat_name ASC";

                                                $read_catagory = mysqli_query($connect,$query);

                                                while($row = mysqli_fetch_assoc($read_catagory))
                                                {
                                                   $cat_id = $row['cat_id'];
                                                   $cat_name = $row['cat_name'];

                                                   // print catagories names 
                                                   ?>

                                                    <option value="<?php echo $cat_id; ?>" <?php if($post_catagory_id == $cat_id) { echo 'selected'; } ?> ><?php echo $cat_name; ?></option>

                                                    

                                                    <?php
                                                  }  
                                                
                                            ?>

                                         <!-- All Catagory reading from database php end here  -->
                                         
                                       </select>
                                    </div> 

                                  

                                    <!-- Post  Image -->
                                    <div class="from-group">
                                      <label for="image">Post Image</label>
                                      <!-- post image  -->
                                      <?php 

                                           if(!empty($post_image))
                                           {
                                            ?>
                                                <img src="dist/img/posts/<?php echo $post_image; ?>" width="80" alt="" style="display:block;margin-bottom: 25px; width: 283px;">
                                            <?php
                                           }
                                           else
                                           {?>
                                            <img src="dist/img/posts/default.png" width="30" alt="">

                                          <?php
                                           }

                                        ?>
                                      <input type="file" name="post_image" class="from-control-file">
                                    </div>
                               
                            
                                                                                                  
                             </div>

                             <!-- right side colume -->
                             <div class="col-lg-6">

                                  
                                   <!-- catagories description -->
                                    <div class="form-group">
                                       <label for="inputDescription">Posts Description</label>
                                       <textarea id="inputDescription" class="form-control" rows="4" name="description" ><?php echo $post_description; ?></textarea>
                                    </div>

                                    

                                    <!-- button -->
                                    <div class="from-group">
                                      <input type="hidden" name="update_post_id" value="<?php echo $edit_post_id; ?>">
                                      <input type="submit" name="update_post" class="btn btn-primary" value="Update Post">
                                    </div>

                             </div>
                           </div>
                      </form>
                     </div>
                   </div>
                  <!-- Edit user table end here  -->

                 <?php }
                }
                  
               }

               // update if start
               else if ($do == "Update") {

               // update user php start
               if(isset($_POST['update_post']))
                {

                      $update_post_id = $_POST['update_post_id'];

                      $post_title      = mysqli_real_escape_string($connect,$_POST['post_title']);

                      $post_description = mysqli_real_escape_string($connect,$_POST['description']);

                      $post_catagory_id   = $_POST['post_catagory_id'];

                      $post_user_id  = $_SESSION['user_id'];

                      
                     

                      //store image with image name
                      $image       = $_FILES['post_image']['name'];

                      //name of temp file where image is temporary stored
                      $image_tmp = $_FILES['post_image']['tmp_name'];

                    
                      

                      

                      // now there is 2 conditions
                      // 1. post image is not empty 2. post image is empty

                      if(!empty($image))
                      {
                           // remove old image start
                            $remove_image_query ="SELECT * FROM post WHERE post_id='$update_post_id'";
                            $remove_image_data = mysqli_query($connect,$remove_image_query);
                            while($row = mysqli_fetch_assoc($remove_image_data))
                            {
                              $remove_image = $row['post_image'];
                              unlink("dist/img/posts/" .$remove_image);
                            }
                            // remove old image end 

                            $imageRandom = rand(0, 9999999);

                            $image_name = $imageRandom.$image;

                            //move image to destination file
                            move_uploaded_file($image_tmp,"dist/img/posts/" . $image_name);

                            $update_post_query = "UPDATE post SET post_title='$post_title', post_description='$post_description', post_catagory_id='$post_catagory_id', post_user_id='$post_user_id',  post_image='$image_name' WHERE post_id='$update_post_id'";

                            $update_post_data = mysqli_query($connect,$update_post_query);

                            if($update_post_data)
                            {
                               
                              header("Location: post.php?do=Manage");
                            }
                            else{
                              die("updating  failed". mysqli_error($connect));
                            }
                      }
                      else 
                      {
                            $update_post_query = "UPDATE post SET post_title='$post_title', post_description='$post_description', post_catagory_id='$post_catagory_id', post_user_id='$post_user_id' WHERE post_id='$update_post_id'";

                            $update_post_data = mysqli_query($connect,$update_post_query);

                            if($update_post_data)
                            {
                               
                              header("Location: post.php?do=Manage");
                            }
                            else{
                              die("updating  failed". mysqli_error($connect));
                            }
                      }

                      



               }
               // update user php end    

               }
               // update if end 

               else if ($do == "Delete"){

                  if (isset($_GET['delete_id'])) {
                    
                    $delete_post_id = $_GET['delete_id'];

                    // remove old image start
                     $remove_image_query ="SELECT * FROM post WHERE post_id='$delete_post_id'";
                     $remove_image_data = mysqli_query($connect,$remove_image_query);
                      while($row = mysqli_fetch_assoc($remove_image_data))
                            {
                              $remove_image = $row['post_image'];
                              unlink("dist/img/posts/" .$remove_image);
                            }
                      // remove old image end 

                       $delete_query ="DELETE FROM post WHERE post_id='$delete_post_id'";
                       
                       $delete_post = mysqli_query($connect,$delete_query);

                       if($delete_post)
                            {
                               
                              header("Location: post.php?do=Manage");
                            }
                            else{
                              die("Deletion failed ". mysqli_error($connect));
                            }     


                  }
                 
               }                                            

          ?>


          <!-- post php end  here  -->
 

        </div>
       
      </div>
    </section>
    <!-- body end here  -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Body end here  -->
 
<?php
     
     include "inc/footer.php";
?>