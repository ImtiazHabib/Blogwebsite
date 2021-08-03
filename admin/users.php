<?php   
      include "inc/header.php";
      include "inc/topmenubar.php";
      include "inc/leftmenubar.php";
?>


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
              <li class="breadcrumb-item active">Dashboard </li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- php code start here  -->

    <?php 

         if($_SESSION['user_role'] == 1)
         {
            $do = isset($_GET['do'])? $_GET['do'] : 'Manage';

            if($do == "Manage")
            {
              ?>
              <!-- All user information table start here  -->
                <section class="content">
                  <div class="container-fluid">
                    <!-- Info boxes -->
                    <div class="row">
                      <div class="col-12">
                        <div class="card card-success">
                          <div class="card-header">
                            <h3 class="card-title">Users Information</h3>
                          </div>
                          <div class="card-body">
                              <table class="table .table-striped .table-bordered">
                                <thead>
                                  <tr>
                                    <th scope="col">#SL</th>
                                    <th scope="col">Avater</th>
                                    <th scope="col">Fullname</th>
                                    <th scope="col">Username</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Phone</th>
                                    <th scope="col">Address</th>
                                    <th scope="col">Role</th>
                                    <th scope="col">Action</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <!-- reading data from db for all user information php start here   -->
                                   <?php 
                                        
                                        $all_user_data_query = "SELECT * FROM user";

                                        $all_user_data = mysqli_query($connect,$all_user_data_query);
                                        
                                        $i=0;
                                        while($row = mysqli_fetch_assoc($all_user_data))
                                        {
                                          $user_id        = $row['user_id'];
                                          $user_fullname  = $row['user_fullname'];
                                          $user_name      = $row['user_name'];
                                          $user_password  = $row['user_password'];
                                          $user_email     = $row['user_email'];
                                          $user_phone     = $row['user_phone'];
                                          $user_address   = $row['user_address'];
                                          $user_role      = $row['user_role'];
                                          $user_image     = $row['user_image'];
                                          $i++;
                                          ?>

                                          <tr>
                                            <th scope="row"><?php  echo $i; ?></th>
                                            <td>
                                              <?php 

                                                   if(empty($user_image))
                                                   {
                                                    ?>

                                                     <img src="dist/img/users/default.png" width="30" >

                                                    <?php
                                                   }
                                                   else
                                                   {
                                                    ?>
                                                     <img src="dist/img/users/<?php echo $user_image; ?>" width="30" >
                                                    <?php
                                                   }
                                              ?>

                                            </td>
                                            <td><?php  echo $user_fullname; ?></td>
                                            <td><?php  echo $user_name; ?></td>
                                            <td><?php  echo $user_email; ?></td>
                                            <td>

                                                    <?php

                                                         if(empty($user_phone))
                                                         {
                                                         ?>

                                                            <span>Empty</span>

                                                          <?php
                                                         }
                                                         else
                                                         {
                                                          ?>
                                                              
                                                              <span><?php  echo $user_phone; ?></span> 

                                                        <?php
                                                         } 
                                                    ?>



                                              </td>

                                            <td>

                                                    <?php

                                                         if(empty($user_address))
                                                         {
                                                         ?>

                                                            <span>Empty</span>

                                                          <?php
                                                         }
                                                         else
                                                         {
                                                          ?>
                                                              
                                                              <span><?php  echo $user_address; ?></span> 

                                                        <?php
                                                         } 
                                                    ?>
                                                


                                              </td>
                                            <td>
                                               <?php

                                               if($user_role ==1)
                                               {
                                                ?>

                                                <span class="badge badge-success">Supper Admin</span>

                                                <?php
                                               }
                                               else if($user_role == 2)
                                               {
                                                ?>
                                                
                                                <span class="badge badge-danger"> Editors</span>

                                                <?php
                                               }
                                               ?>
                                            </td>

                                            <td> 
                                              <div class="btn-group">
                                                <a href="users.php?do=Edit&edit_id=<?php echo $user_id; ?>">
                                                  <i class="fas fa-edit"></i>
                                                </a>
                                                <a href="users.php" data-toggle="modal" data-target="#delete_user_modal<?php echo $user_id;  ?>" >
                                                  <i class="fas fa-trash"></i>
                                                </a>

                                                <!-- delete user modal start -->
                            <div class="modal fade" id="delete_user_modal<?php echo $user_id;  ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                              <div class="modal-dialog">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Are you sure to delete this User? </h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                  <div class="modal-body">
                                    <a type="button" class="btn btn-danger" data-dismiss="modal">Cancel</a>
                                    <a  href="users.php?do=Delete&delete_id=<?php echo $user_id;  ?>" class="btn btn-primary" >Confirm</a>
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
                                  <!-- reading data from db for all user information php end here  -->                         
                                </tbody>
                              </table>                      
                          </div>
                        </div>
                      </div>
                      <div class="col-md-12">
                        <a href="users.php?do=Add" class="btn btn-primary btn-block">Add New User</a>
                      </div>
                    </div>
                  </div>
                </section>
              <!-- All user information table end  here  -->
              <?php
            }
            else if($do == "Add")
            {
              ?>

              <!--  // add user form start -->
               <section class="content">
                  <div class="container-fluid">
                    <!-- Info boxes -->
                    <div class="row">
                      <div class="col-12">
                        <div class="card card-success">
                          <div class="card-header">
                            <h3 class="card-title">Register New User</h3>
                          </div>
                          <div class="card-body">
                            <form action="users.php?do=Insert" method="POST" enctype="multipart/form-data">

                              <div class="row">
                               <div class="col-sm-6">

                                  <div class="form-group">
                                    <label for="Fullname">Fullname</label>
                                    <input type="text" name="Fullname" class="form-control" id="Fullname" >
                                  </div>

                                  <div class="form-group">
                                    <label for="Username">Username</label>
                                    <input type="text" name="Username" class="form-control" id="Username"  required="required">
                                  </div>

                                  <div class="form-group">
                                    <label for="Email">Email</label>
                                    <input type="email" name="Email" class="form-control" id="Email" >
                                  </div>

                                  <div class="form-group">
                                    <label for="Phone">Phone</label>
                                    <input type="text" name="Phone" class="form-control" id="Phone" >
                                  </div>
                              </div> 

                              <div class="col-sm-6">

                                    <div class="form-group">
                                        <label for="Password">Password</label>
                                        <input type="password" name="Password" class="form-control" id="Password" required="required" >
                                    </div>

                                    <div class="form-group">
                                        <label for="Re-Password">Retype Password</label>
                                        <input type="password" name="Re-Password" class="form-control" id="Re-Password"  required="required" >
                                    </div>

                                    <div class="form-group">
                                      <label for="Address">Address</label>
                                      <input type="text" name="Address" class="form-control" id="Address" >
                                    </div>

                                  <div class="form-group">
                                     <label for="Role">Role</label>
                                        <select  name="Role" class="form-control" id="Role">
                                          <option value="0" selected="selected" >Please select User Role</option>
                                          <option value="1">Super Admin</option>
                                          <option value="2">Editor</option>
                                           
                                        </select>
                                  </div>

                                  <div class="form-group">
                                    <label for="">Profile Picture</label>
                                    <input type="file" name="image" class="form-control-file">
                                  </div>

                                  <div class="form-group">
                                    <input type="submit" name="register" class="btn btn-primary" value="Submit">
                                  </div>

                                
                              </div>

                              </div>                      
                            </form>
                          </div> 
                        </div>
                      </div>
                    </div>
                  </div>
                </section>
              <!-- // add user form end  -->

              <?php
            }
            else if($do == "Insert")
            {

              if(isset($_POST['register']))
              {
                $user_fullname  = $_POST['Fullname'];
                $user_name      = $_POST['Username'];
                $user_email     = $_POST['Email'];
                $user_phone     = $_POST['Phone'];
                $user_address   = $_POST['Address'];
                $user_role      = $_POST['Role'];


                $user_password  = $_POST['Password'];
                $user_re_password  = $_POST['Re-Password'];

                //store image with image name
                $image       = $_FILES['image']['name'];

                //name of temp file where image is temporary stored
                  $image_tmp = $_FILES['image']['tmp_name'];

               

                if($user_password == $user_re_password)
                {
                  $hasspassword = sha1($user_password);

                  $imageRandom = rand(0, 9999999);

                   $image_name = $imageRandom.$image;

                   //move image to destination file
                   move_uploaded_file($image_tmp,"dist/img/users/" . $image_name);

                  $insert_user_query = "INSERT INTO user (user_fullname,user_name,user_password,user_email,user_phone,user_address,user_role,user_image) VALUES ('$user_fullname','$user_name','$hasspassword','$user_email','$user_phone','$user_address','$user_role','$image_name')";

                  $insert_user_data = mysqli_query($connect,$insert_user_query);

                  if($insert_user_data)
                  {
                    header("Location: users.php?do=Manage");
                  }
                  else{
                    
                    die("Insertion falied " . mysqli_error($connect));
                  }
                }

              }

            }
            else if($do == "Edit")
            {

              $edit_user_id = $_GET['edit_id'];

              $edit_user_id_query = "SELECT * FROM user WHERE user_id='$edit_user_id'";

              $edit_user_id_data = mysqli_query($connect,$edit_user_id_query);


              while($row = mysqli_fetch_array($edit_user_id_data))
              {          
                  $user_fullname  = $row['user_fullname'];
                 $user_name      = $row['user_name'];
                 $user_password  = $row['user_password'];
                  $user_email     = $row['user_email'];
                 $user_phone     = $row['user_phone'];
                   $user_address   = $row['user_address'];
                   $user_role      = $row['user_role'];
                   $user_image     = $row['user_image'];

                   ?>

                   <!-- edit user form  start here  -->
                   <section class="content">
                  <div class="container-fluid">
                    <!-- Info boxes -->
                    <div class="row">
                      <div class="col-12">
                        <div class="card card-success">
                          <div class="card-header">
                            <h3 class="card-title">Edit User Information</h3>
                          </div>
                          <div class="card-body">
                            <form action="users.php?do=Update" method="POST" enctype="multipart/form-data">

                              <div class="row">
                               <div class="col-sm-6">

                                  <div class="form-group">
                                    <label for="Fullname">Fullname</label>
                                    <input type="text" name="Fullname" class="form-control" id="Fullname" value="<?php echo $user_fullname ?>" >
                                  </div>

                                  <div class="form-group">
                                    <label for="Username">Username</label>
                                    <input type="text" name="Username" class="form-control" id="Username" value="<?php echo $user_name ?>"  >
                                  </div>

                                  <div class="form-group">
                                    <label for="Email">Email</label>
                                    <input type="email" name="Email" class="form-control" id="Email" value="<?php echo $user_email ?>" >
                                  </div>

                                  <div class="form-group">
                                    <label for="Phone">Phone</label>
                                    <input type="text" name="Phone" class="form-control" id="Phone" value="<?php echo $user_phone ?>" >
                                  </div>
                              </div> 

                              <div class="col-sm-6">

                                    <div class="form-group">
                                        <label for="Password">Password</label>
                                        <input type="password" name="Password" class="form-control" id="Password"   placeholder="*********">
                                    </div>

                                    <div class="form-group">
                                        <label for="Re-Password">Retype Password</label>
                                        <input type="password" name="Re-Password" class="form-control" id="Re-Password"     placeholder="********" >
                                    </div>

                                    <div class="form-group">
                                      <label for="Address">Address</label>
                                      <input type="text" name="Address" class="form-control" id="Address" value="<?php echo $user_address ?>" >
                                    </div>

                                  <div class="form-group">
                                     <label for="Role">Role</label>
                                        <select  name="Role" class="form-control" id="Role">
                                          <option value="1" <?php if($user_role == 1){ echo "selected"; } ?> >Super Admin</option>
                                          <option value="2"  <?php if($user_role == 2){ echo "selected"; } ?> >Editor</option>
                                           
                                        </select>
                                  </div>

                                  <div class="form-group">

                                    <!-- check user has image or not  -->
                                    <?php 

                                    if(!empty($user_image))
                                    {
                                      ?>

                                      <img src="dist/img/users/<?php echo $user_image ?>" width="80" alt="">

                                      <?php
                                    }
                                    else{
                                      ?>

                                      <img src="dist/img/users/default.png"  width="80" alt="">
                                       
                                      <?php
                                    }

                                    ?>
                                    </br>
                                    <label for="">Profile Picture</label>
                                    <input type="file" name="image" class="form-control-file">
                                  </div>

                                  <div class="form-group">
                                    <!-- hidden input for update id  -->
                                    <input type="hidden" name="update" value="<?php echo $edit_user_id ?>" >
                                    <input type="submit" name="save" class="btn btn-primary" value="Update">
                                  </div>

                                
                              </div>

                              </div>                      
                            </form>
                          </div> 
                        </div>
                      </div>
                    </div>
                  </div>
                </section>
                   <!-- edit user form end here  -->

                   <?php
              }




            }
            else if($do == "Update")
            {
               if($_POST['update'])
               {
                  $update_user_id = $_POST['update'];

                $user_fullname  = $_POST['Fullname'];
                $user_name      = $_POST['Username'];
                $user_email     = $_POST['Email'];
                $user_phone     = $_POST['Phone'];
                $user_address   = $_POST['Address'];
                $user_role      = $_POST['Role'];


                $user_password  = $_POST['Password'];
                $user_re_password  = $_POST['Re-Password'];

                //store image with image name
                $image       = $_FILES['image']['name'];

                //name of temp file where image is temporary stored
                  $image_tmp = $_FILES['image']['tmp_name'];

                  // if password change
                  if(!empty($user_password))
                  {
                    if($user_password == $user_re_password)
                    {
                      // encryption
                      $hasspassword = sha1($user_password);

                      // update password sql
                      $update_user_password_query = "UPDATE user SET user_password = '$hasspassword' WHERE user_id='$update_user_id'";

                      $update_user_password = mysqli_query($connect,$update_user_password_query);

                      if($update_user_password)
                      {
                        header("Location: users.php?do=Manage");
                      }
                      else{

                        die("update User Paaword failed " . mysqli_error($connect));
                      }

                    }
                  }

                  // if image changes 

                  if(!empty($image))
                  {
                    // remove old image start
                    $remove_image_query ="SELECT * FROM user WHERE user_id='$update_user_id'";
                      $remove_image_data = mysqli_query($connect,$remove_image_query);
                       while($row = mysqli_fetch_assoc($remove_image_data))
                              {
                                   $remove_image = $row['user_image'];
                                    unlink("dist/img/users/" .$remove_image);
                             }
                     // remove old image end 
                    
                    $image_random_number = rand(0,9999999);

                    $image_file = $image_random_number.$image;

                    move_uploaded_file($image_tmp,"dist/img/users/".$image_file);

                    $update_image_query = "UPDATE user SET  user_fullname='$user_fullname', user_name='$user_name', user_password='$user_password',  user_email='$user_email', user_phone='$user_phone', user_address='$user_address', user_role='$user_role', user_image='$image_file' WHERE user_id='$update_user_id'";

                    $update_image = mysqli_query($connect,$update_image_query);
                    
                     if($update_image)
                      {
                        header("Location: users.php?do=Manage");
                      }
                      else{

                        die("update User Paaword failed " . mysqli_error($connect));
                      }

                  }
                  else{
                       
                       $update_user_query = "UPDATE user SET  user_fullname='$user_fullname', user_name='$user_name',  user_email='$user_email', user_phone='$user_phone', user_address='$user_address', user_role='$user_role'  WHERE user_id='$update_user_id'";

                    $update_user = mysqli_query($connect,$update_user_query);
                    
                     if($update_user)
                      {
                        header("Location: users.php?do=Manage");
                      }
                      else{

                        die("update User Paaword failed " . mysqli_error($connect));
                      }

                  }


               }
            }
            else if($do == "Delete")
            {
                if (isset($_GET['delete_id'])) {
                          
                          $delete_user_id =$_GET['delete_id'];

                          // remove old image start
                           $remove_image_query ="SELECT * FROM user WHERE user_id='$delete_user_id'";
                           $remove_image_data = mysqli_query($connect,$remove_image_query);
                            while($row = mysqli_fetch_assoc($remove_image_data))
                                  {
                                    $remove_image = $row['user_image'];
                                    unlink("dist/img/users/" .$remove_image);
                                  }
                            // remove old image end 

                             $delete_query ="DELETE FROM user WHERE user_id='$delete_user_id'";
                             
                             $delete_user = mysqli_query($connect,$delete_query);

                             if($delete_user)
                                  {
                                     
                                    header("Location: users.php?do=Manage");
                                  }
                                  else{
                                    die("deletion failed". mysqli_error($connect));
                                  }     


                        }
            }

         }
         else 
         {
          
            echo '<div class="alert alret-info"> You can not access this page </div>';
         }
      
      
 
    ?>

    <!-- php code end here  -->



   </div>
  <!-- Content Wrapper. Contains page content end  -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->

<!-- footer path included -->
<?php 
         
      include "inc/footer.php";

?>