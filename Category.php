<?php
  include "inc/header.php";
?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard </li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
         <div class="row">
            
          <?php 

              $do = isset($_GET['do']) ? $_GET['do'] : "manage";

              if($do == "manage"){
                ?>
                    
                 <div class="container">
                  <div class="row">
                  <table class="table table-striped table-bordered">
                      <thead class="thead-dark">
                        <tr>
                          <th scope="col">#Sl</th>
                          <th scope="col">Image</th>
                          <th scope="col">Category Name</th>
                          <th scope="col">Category Description</th>
                          <th scope="col">Status</th>
                          <th scope="col">Option</th>
                        </tr>
                      </thead>
                      <tbody>

                       <?php 
                       
                         $getData = "SELECT * FROM category WHERE status='1' ORDER BY cat_name DESC";
                         $categoryData = mysqli_query($db, $getData);
                         $totalNumberData = mysqli_num_rows($categoryData);

                           if( $totalNumberData == 0 ){
                            ?>
                           <div class="bg-danger" style="width: 100%; margin-bottom: 20px">
                              <h3 style="text-align: center; font-size: 20px; padding: 10px 0;">There is no data into Database</h3>
                            </div>
                       <?php
                           }
                           else{
                              $sl = 0;
                              while( $row = mysqli_fetch_assoc($categoryData) ){
                                  $id                  = $row['id'];
                                  $cat_name            = $row['cat_name'];
                                  $cat_desc            = $row['cat_desc'];
                                  $status              = $row['status'];
                                  $image               = $row['Image'];
                                  $sl++;
                              ?>

                                   <tr>
                                      <th scope="row"><?php echo $sl ?></th>
                                      <td>
                                        <?php 
                                           if( !empty($image) ){
                                            ?>
                                             <img src="dist/img/users/<?php echo $image ?>" alt="" width="50">
                                            <?php
                                           }
                                           else{
                                            ?>
                                             <img src="dist/img/avatar5.png" alt="" width="50">
                                            <?php
                                           }
                                        ?>
                                      </td>
                                      <td><?php echo $cat_name ?></td>
                                      <td><?php echo $cat_desc ?></td>
                                      <td>
                                        <?php 
                                          if( $status == 1 ){
                                            echo '<span class="float-right badge bg-success">Active</span>';
                                          }
                                          else if( $status == 0 ){
                                            echo  '<span class="float-right badge bg-danger">Inactive</span>';
                                          }
                                        ?>
                                      </td>
                                      <td>
                                        <ul class="options">
                                          <li>
                                              <a href="category.php?do=edit&id=<?php echo $id ?>"><i class="fa-solid fa-pen-to-square"></i></a>
                                          </li>
                                          <li>
                                              <a href="category.php?do=delete&id=<?php echo $id ?>"    data-toggle="modal" data-target="#exampleModal<?php echo $id ?>"><i class="fa-solid fa-trash"></i></a>
                                          </li>
                                        </ul>
                                      </td>
                                    </tr>
                              <?php
                              }
                           }
                       ?>
                      </tbody>
                    </table>
                  </div>
                 </div>

                 <!-- Modal -->
                    <div class="modal fade" id="exampleModal<?php echo $id ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                              <ul class="options">
                                <li>
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                </li>
                                <li>
                                    <a href="category.php?do=delete&id=<?php echo $id ?>">
                                      <button class="btn btn-danger">Delete</button>
                                    </a>
                                </li>
                              </ul>
                          </div>
                        </div>
                      </div>
                    </div>
                <?php
              }

              else if($do == "add"){
                  ?>
           
                  <div class="container">
                    <form action="category.php?do=store" method="POST" enctype="multipart/form-data">
                        <div class="row">
                          <div class="col-lg-4">
                             <div class="form-group">
                                  <label for="Category Name">Category Name</label>
                                  <input type="text" name="name" class="form-control" id="exampleInputEmail1" placeholder="Enter Full Name">
                              </div>
  
                              <div class="form-group">
                                    <label>Active status</label>
                                    <select class="form-control" name="status">
                                        <option>Please select the status</option>
                                        <option value="1">Active</option>
                                        <option value="0">Inactive</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                   <label for="">Image</label>
                                   <input type="file" name="image" class="form-control">
                                </div>
                            </div>

                            <div class="col-lg-8">
                                <div class="form-group">
                                    <label>Description</label>
                                    <textarea name="description" id="descriptionContent" class="form-control"></textarea>
                                </div>
                            </div>

                            <div class="col-lg-4">
                                 <button type="submit" name="addCategory" class="btn btn-block btn-primary">Add New Category</button>
                            </div>
                        </div>
                    </form>
                  </div>

                  <?php
              }

              else if( $do == "store" ){
                    if( isset ( $_POST['addCategory'] ) ){
                        $name               = mysqli_real_escape_string($db, $_POST['name']);
                        $status             = mysqli_real_escape_string($db, $_POST['status']);
                        $description        = mysqli_real_escape_string($db, $_POST['description']);
                        $image_name         = $_FILES['image']['name'];
                        $image_tmp          = $_FILES['image']['tmp_name'];

                        if( !empty($image_name) ){
                            $image = rand(1, 999999) . "-image-" . $image_name;
                            move_uploaded_file($image_tmp, "dist/img/users/" . $image );
                        }
                        else{
                           $image = "";
                        }


                      $sqli = "INSERT INTO category (cat_name, cat_desc, status, Image) VALUES ('$name', '$description', '$status', '$image')";

                      $queries = mysqli_query($db, $sqli);

                        if($queries){
                            header("Location: category.php?do=manage");
                        }
                        else{
                            die("data not store into database");
                        }

                  }
              }

              else if($do == "edit"){
                if( isset ( $_GET['id'] ) ){
                  $updateId = $_GET['id'];

                  $sql = "SELECT * FROM category WHERE id = '$updateId'";
                  $singleId = mysqli_query($db, $sql);

                  while( $row = mysqli_fetch_array($singleId) ){
                         $id                   = $row['id'];
                         $cat_name             = $row['cat_name'];
                         $cat_desc             = $row['cat_desc'];
                         $status               = $row['status'];
                         $image                = $row['Image'];
                  ?> 

                   <div class="container">
                      <form action="category.php?do=update" method="POST" enctype="multipart/form-data">
                          <div class="row">
                            <div class="col-lg-4">

                               <input type="hidden" name="id" value="<?php echo $id ?>">
                               <input type="hidden" name="oldImage" value="<?php echo $image ?>">

                              <div class="form-group">
                                    <label for="Category Name">Category Name</label>
                                    <input type="text" name="name" value="<?php echo $cat_name; ?>" class="form-control" id="exampleInputEmail1" placeholder="Enter Full Name">
                                </div>
    
                                <div class="form-group">
                                      <label>Active status</label>
                                      <select class="form-control" name="status">
                                          <option>Please select the status</option>
                                          <option value="1" <?php if( $status == 1 ){ echo 'selected'; } ?> >Active</option>
                                          <option value="0" <?php if( $status == 0 ){ echo 'selected'; } ?> >Inactive</option>
                                      </select>
                                  </div>

                                  <div class="form-group">
                                    <label for="">Image</label>
                                    <br />
                                     <?php 
                                       if( !empty($image) ){
                                        ?>
                                           <img src="dist/img/users/<?php echo $image ?>" alt="" width="50">
                                        <?php
                                       }
                                     ?>
                                    <input type="file" name="image" class="form-control">
                                  </div>
                              </div>

                              <div class="col-lg-8">
                                  <div class="form-group">
                                      <label>Description</label>
                                      <textarea name="description" id="descriptionContent" class="form-control"><?php echo $cat_desc; ?></textarea>
                                  </div>
                              </div>

                              <div class="col-lg-4">
                                  <button type="submit" name="updateCategory" class="btn btn-block btn-primary">Update Category</button>
                              </div>
                          </div>
                      </form>
                    </div>

                <?php
                  }
                  
                }
              }

              else if($do == "update"){
                if( isset( $_POST['updateCategory'] ) ){
                      $id               = $_POST["id"];
                      $name             = mysqli_real_escape_string($db, $_POST['name']);
                      $description      = mysqli_real_escape_string($db, $_POST['description']);
                      $status           = mysqli_real_escape_string($db, $_POST['status']);
                      $oldImage         = $_POST['oldImage'];
                      $image            = $_FILES['image']['name'];
                      $image_tmp        = $_FILES['image']['tmp_name'];

                     if( !empty( $image ) ){
                        // remove the existing image
                        unlink("dist/img/users/" .  $oldImage);

                        $img = rand(1, 999999999) . "-image-" . $image;
                        move_uploaded_file($image_tmp, "dist/img/users/" . $img);  

                        $updateSql = "UPDATE category SET cat_name='$name', cat_desc='$description', status='$status', Image='$img' WHERE id ='$id '";
                        $updateQuery = mysqli_query($db, $updateSql);
   
                        if($updateQuery){
                          header("Location: category.php?do=manage");
                        }
                        else{
                           die("data has not been set into database");
                        }

                     } 
                     else{
                        //  $img = "";

                         $updateSql = "UPDATE category SET cat_name='$name', cat_desc='$description', status='$status' WHERE id ='$id '";
                        $updateQuery = mysqli_query($db, $updateSql);
   
                        if($updateQuery){
                          header("Location: category.php?do=manage");
                        }
                        else{
                           die("data has not been set into database");
                        }
                     }
                }
              }


              else if($do == "delete"){
                 if( isset( $_GET['id'] ) ){
                    $delId = $_GET['id'];
                    
                    $delSql = "UPDATE category SET status='0' WHERE id = '$delId'";
                    $softDel = mysqli_query($db, $delSql);

                    if($softDel){
                       header("Location: category.php?do=manage");
                    }
                    else{
                      die("delete has not done successfully");
                    }
                 }
              }
              
              else{
                 echo "There is no page found";
              }

          ?>

         </div>
      </div>
    </section>

  </div>
  <!-- /.content-wrapper -->



 <?php include "inc/footer.php" ?>