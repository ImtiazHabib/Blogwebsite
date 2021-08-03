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
            <h1 class="m-0">Catagories</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Info boxes -->
        <div class="row">
          <!-- main body start here  -->
          <!-- adding from of new catagory -->
          <div class="col-12 col-sm-6 col-md-6">
      
               <!-- edit catagory start -->
            <div class="card card-primary">
                    <div class="card-header">
                         <h3 class="card-title">Add Catagories</h3>
                         <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                            <i class="fas fa-minus"></i>
                            </button>
                         </div>
                      </div>
              <div class="card-body" style="display: block;">
              <!-- form start -->
                  <form action="" method="POST" >
                    <div class="form-group">
                      <label for="exampleInputEmail1">Name</label>
                      <input type="text" name="name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                    </div>
                    <div class="form-group">
                      <label for="description">Description</label>
                      <textarea   name="description"  class="form-control" id="description" rows="3">   </textarea>
                    </div>
                    <div class="form-group">
                      <label for="exampleFormControlSelect1">Status</label>
                      <select  name="status" class="form-control" id="exampleFormControlSelect1">
                        <option value="2" selected>Please select the status</option>
                        <option value="1">Active</option>
                        <option value="2">In-Active</option>
                      </select>
                    </div>

                    <input type="submit" name="add_catagory_form" class="btn btn-primary" value="Add New Catagory"/>
                  </form>
              <!-- form end  --> 
            </div>
         </div>        
              <!-- php for getting data from the add fill up form and insert them in db -->
              <?php

              if(isset($_POST['add_catagory_form']))
              {
                $cat_name = $_POST['name'];
                $cat_desc = $_POST['description'];
                $cat_status = $_POST['status'];
                
                $insert_data_query = "INSERT INTO catagories (cat_name,cat_desc,cat_status) VALUES ('$cat_name','$cat_desc','$cat_status')";

                

                $insert_data = mysqli_query($connect,$insert_data_query);

                if($insert_data)
                {
                  header("Location: catagory.php");
                }
                else{
                  die("insert data to db failed " . mysqli_error($connect));
                }

              } 

              ?>
            

             
            <!-- edit catagory php start here  -->
            <?php 
                 
                 if(isset($_GET['edit']))
                 {
                  $edit_cat_id = $_GET['edit'];

                  $get_edit_cat_data_query = "SELECT * FROM catagories WHERE cat_id='$edit_cat_id'";
                  $get_edit_cat_data = mysqli_query($connect,$get_edit_cat_data_query);

                  while($row = mysqli_fetch_assoc($get_edit_cat_data))
                  {
                    $cat_name = $row['cat_name'];
                    $cat_desc = $row['cat_desc'];
                    $cat_status = $row['cat_status'];
                    
                    ?>
             

              <!-- edit catagory start -->
                 <div class="card card-primary">
                      <div class="card-header">
                         <h3 class="card-title">Edit Catagories</h3>
                         <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                            <i class="fas fa-minus"></i>
                            </button>
                         </div>
                      </div>
                      <div class="card-body" style="display: block;">
                         <!-- card body should be in a from to use in backend -->
                         <form action="" method="POST" class="cat_from">
                            <!-- catagories name -->
                            <div class="form-group">
                               <label for="inputName">Name</label>
                               <input type="text" id="inputName" class="form-control" name="cat_name" value="<?php echo $cat_name; ?>">
                            </div>
                            <!-- catagories description -->
                            <div class="form-group">
                               <label for="inputDescription"> Description</label>
                               <textarea id="inputDescription" class="form-control" rows="4" name="cat_desc"> <?php echo $cat_desc; ?></textarea>
                            </div>
                            <!-- catagories status -->
                            <div class="form-group">
                               <label for="inputParent">status</label>
                               <select id="inputParent" class="form-control custom-select" name="cat_status">
                                  <option value="1" <?php if($cat_status == 1 ) { echo 'selected'; } ?>>Active</option>
                                  <option value="2" <?php if($cat_status== 2 ) { echo 'selected'; } ?> >Inactive</option>
                               </select>
                            </div>
                            <!-- add catagories button -->
                            <div class="from-group">
                               <input type="submit" name="edit_catagory_form" class="btn btn-primary" value="Save Changes"/>
                            </div>
                         </form>
                      </div>
               </div>
               <!-- edit catagory section end  -->                

                  <?php }
                 }

            ?>
            <!-- edit catagory php end  here  -->
          </div>
          <!-- php start for sending edit cat form information to db -->
          <?php 
                 
                 if(isset($_POST['edit_catagory_form']))
                 {
                   $cat_name = $_POST['cat_name'];
                   $cat_desc = $_POST['cat_desc'];
                   $cat_status = $_POST['cat_status'];

                   $update_cat_query ="UPDATE catagories SET cat_name='$cat_name', cat_desc='$cat_desc', cat_status='$cat_status' WHERE cat_id='$edit_cat_id'";
                   $update_cat_data = mysqli_query($connect,$update_cat_query);
                   
                   if($update_cat_data)
                   {
                     header("Location: catagory.php");
                   }
                    else{
                     die("insert data to db failed " . mysqli_error($connect));
                    }

                 } 
          ?>

          <!-- php end for sending edit cat form information to db -->


          <!-- right side colume showing all catagories -->
          <div class="col-12 col-sm-6 col-md-6">
            <h1 class="all_catagories_title">All Catagories</h1>
                <table class="table .table-dark">
                <thead>
                  <tr>
                    <th scope="col">SL.</th>
                    <th scope="col">Catagory Name</th>
                    <th scope="col">Status</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <!-- php code for reading data from db -->
                  <?php

                  $read_data_query = "SELECT * FROM catagories";

                  $all_data = mysqli_query($connect,$read_data_query);

                  $i=0;

                  while($row = mysqli_fetch_assoc($all_data))
                  {
                    $cat_id = $row['cat_id'];
                    $cat_name = $row['cat_name'];
                    $cat_desc = $row['cat_desc'];
                    $cat_status = $row['cat_status'];
                    $i++;

                    ?>

                    <tr>

                    <th scope="row"><?php echo $i; ?></th>
                    <td><?php echo $cat_name; ?></td>

                    <td>
                      <?php
                      if($cat_status ==1)
                      {
                        ?>
                        <span class="badge badge-primary">Active</span>

                        <?php
                      }
                      else if ($cat_status==2)
                      {
                        ?>
                        <span class="badge badge-danger"> In-Activew</span>

                        <?php
                      }
                      ?>
                    </td>

                    <td>
                      <div class="btn-group">
                        <a href="catagory.php?edit=<?php echo $cat_id;  ?>">
                          <i class="fas fa-edit"></i>
                        </a>
                        <a href="catagory.php" data-toggle="modal" data-target="#delete_cat_modal<?php echo $cat_id;  ?>">
                          <i class="fa fa-trash"></i>
                        </a>
                      </div>
                      <!-- delete catagory modal start -->
                      <div class="modal fade" id="delete_cat_modal<?php echo $cat_id;  ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel">Are you sure to delete this catagory? </h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                              <a type="button" class="btn btn-danger" data-dismiss="modal">Cancel</a>
                              <a  href="catagory.php?delete=<?php echo $cat_id;  ?>" class="btn btn-primary" >Confirm</a>
                            </div>                           
                          </div>
                        </div>
                      </div>
                      <!-- delete catagory modal end  -->
                    </td>
                  </tr>
                  <?php } 
                  ?>
                  
                </tbody>
                <!-- delete catagory php start here  -->
                <?php 
                  
                  if(isset($_GET['delete']))
                   { 
                    // get the delete id
                    $delete_cat_id = $_GET['delete'];

                    $delete_cat_query = "DELETE  FROM catagories where cat_id='$delete_cat_id'";
                    $delete_cat_data = mysqli_query($connect,$delete_cat_query);

                    if($delete_cat_data)
                    {
                      header("Location: catagory.php");
                    }
                    else
                    {
                      die("Delete Failed" . mysqli_error($connect));
                    }


                  }

                ?>

                <!-- delete catagory php end  here  -->

              </table>
          </div>
          <!-- main body end here  -->
        </div>
      </div>
    </section>
    <!-- Main content  end -->


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