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
                          <th scope="col" class="text-center">#Sl</th>
                          <th scope="col" class="text-center">Image</th>
                          <th scope="col" class="text-center">Post Title</th>
                          <th scope="col" class="text-center">Posts Category</th>
                          <th scope="col" class="text-center">Author Name</th>
                          <th scope="col" class="text-center">meta Tags</th>
                          <th scope="col" class="text-center">Status</th>
                          <th scope="col" class="text-center">Date</th>
                          <th scope="col" class="text-center">Option</th>       
                        </tr>
                      </thead>
                      <tbody>

                       <?php 
                       
                         $getData = "SELECT * FROM posts WHERE status = 1 ORDER BY title DESC";
                         $postsData = mysqli_query($db, $getData);
                         $totalNumberData = mysqli_num_rows($postsData);

                           if( $totalNumberData == 0 ){
                            ?>
                           <div class="bg-danger" style="width: 100%; margin-bottom: 20px">
                              <h3 style="text-align: center; font-size: 20px; padding: 10px 0;">There is no data into this field</h3>
                            </div>
                       <?php
                           }
                           else{
                              $sl = 0;
                              while( $row = mysqli_fetch_assoc($postsData) ){
                                  $id                     = $row['id'];
                                  $title                  = $row['title'];
                                  $image                  = $row['image'];
                                  $cat_id                 = $row['cat_id'];
                                  $auth_id                = $row['auth_id'];
                                  $status                 = $row['status'];
                                  $meta_tags              = $row['meta_tags'];
                                  $post_date              = $row['post_date'];
                                  $sl++;
                              ?>

                                   <tr>
                                      <th scope="row" class="text-center"><?php echo $sl ?></th>
                                      <td class="text-center">
                                        <?php 
                                           if( !empty( $image ) ){
                                            ?>
                                             <img src="dist/img/posts/<?php echo $image; ?>" alt="" width="50">
                                            <?php
                                           }
                                           else{
                                            ?>
                                             <img src="dist/img/posts/avatar.png" alt="" width="50">
                                            <?php
                                           }
                                        ?>
                                      </td>
                                      <td class="text-center"><?php echo $title; ?></td>
                                      <td class="text-center">
                                        <?php 
                                            $sqli = "SELECT * FROM category WHERE id = '$cat_id'";
                                            $categoryData =  mysqli_query($db, $sqli);
                                            
                                            while( $row = mysqli_fetch_array($categoryData) ){
                                                $catName    = $row['cat_name'];
                                                echo $catName;
                                            }
                                        
                                        ?>
                                    </td>
                                      <td class="text-center"><?php echo $auth_id ?></td>
                                      <td class="text-center"><?php echo $meta_tags; ?></td>
                                      <td class="text-center">
                                        <?php 
                                          if( $status == 1 ){
                                            echo '<span class="float-right badge bg-success">Active</span>';
                                          }
                                          else if( $status == 0 ){
                                            echo  '<span class="float-right badge bg-danger">Inactive</span>';
                                          }
                                        ?>
                                      </td>
                                      <td class="text-center"><?php echo $post_date; ?></td>
                                      <td class="text-center">
                                        <ul class="options">
                                          <li>
                                              <a href="posts.php?do=edit&id=<?php echo $id ?>"><i class="fa-solid fa-pen-to-square"></i></a>
                                          </li>
                                          <li>
                                              <a href="posts.php?do=delete&id=<?php echo $id ?>"    data-toggle="modal" data-target="#exampleModal<?php echo $id ?>"><i class="fa-solid fa-trash"></i></a>
                                          </li>
                                        </ul>
                                      </td>
                                    </tr>

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
                           }
                       ?>
                      </tbody>
                    </table>
                  </div>
                 </div>

                <?php
              }

              else if($do == "add"){
                  ?>

                    <?php 
                          if( !empty($_SESSION['img_error']) ){
                          ?>
                            <div class="alert alert-danger">
                                <?php echo $_SESSION['img_error']; ?>
                            </div>
                          <?php

                             unset($_SESSION['img_error']);
                          
                          }
                      ?>
           
                  <div class="container">
                    <form action="posts.php?do=store" method="POST" enctype="multipart/form-data">
                        <div class="row">
                          <div class="col-lg-4">
                             <div class="form-group">
                                  <label for="posts Title">posts Title</label>
                                  <input type="text" name="name" class="form-control" id="exampleInputEmail1" placeholder="Enter Full Name">
                              </div>

                              <div class="form-group">
                                    <label>posts Category</label>
                                    <select class="form-control" name="cat_id">
                                        <option>Please select the posts category</option>
                                        <?php
                                          $categorySql = "SELECT * FROM category WHERE status = 1 ORDER BY cat_name ASC";
                                          $categoryQuery = mysqli_query($db, $categorySql);

                                          while( $row = mysqli_fetch_assoc($categoryQuery) ){
                                               $cat_id      = $row['id'];
                                               $cat_name    = $row['cat_name'];

                                            ?>
                                               <option value="<?php echo $cat_id; ?>"><?php echo $cat_name; ?></option>
                                            <?php
                                          }
                                        ?>
                                    </select>
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
                                   <label for="">Post Image</label>
                                   <input type="file" name="images" class="form-control">
                                </div>
                            </div>

                            <div class="col-lg-8">
                                <div class="form-group">
                                   <label for="posts Name">Meta Tags</label>
                                   <input type="text" name="metaTag" class="form-control" id="exampleInputEmail1" placeholder="Enter Full Name">
                                </div>

                                <div class="form-group">
                                    <label>Post Description</label>
                                    <textarea name="description" id="descriptionContent" class="form-control"></textarea>
                                </div>
                            </div>

                            <div class="col-lg-4">
                                 <button type="submit" name="addPosts" class="btn btn-block btn-primary">Add New Posts</button>
                            </div>
                        </div>
                    </form>
                  </div>

                  <?php
              }

              else if( $do == "store" ){
                    if( isset ( $_POST['addPosts'] ) ){
                        $title               = mysqli_real_escape_string($db, $_POST['name']);
                        $cat_id              = mysqli_real_escape_string($db, $_POST['cat_id']);
                        $status              = mysqli_real_escape_string($db, $_POST['status']);
                        $description         = mysqli_real_escape_string($db, $_POST['description']);
                        $metaData            = mysqli_real_escape_string($db, $_POST['metaTag']);
                        $auth_id             = $_SESSION['name'];
                        $image_name          = $_FILES['images']['name'];
                        $image_tmp           = $_FILES['images']['tmp_name'];
                        $image_size          = $_FILES['images']['size'];
                        $image_type          = $_FILES['images']['type'];

                        /// file type are problem here
                        //  in_array($image_type,  $extensions, TRUE);
                        //  $extensions= array("jpeg","jpg","png");

                        if( !empty($image_name) ){

                            if ( $image_size < 2091040 ){
                              $image = rand(1, 999999) . "-image-" . $image_name;
                              move_uploaded_file($image_tmp, "dist/img/posts/" . $image );

                              $sql = "INSERT INTO posts (title, description, image, cat_id, auth_id, status, meta_tags, post_date) VALUES ('$title', '$description', '$image', $cat_id, '$auth_id', '$status', '$metaData', now() )";

                              $addPosts = mysqli_query($db, $sql);

                                if($addPosts){
                                    header("Location: posts.php?do=manage");
                                }
                                else{
                                    die("data not store into database");
                                }

                            }

                            else{
                              $_SESSION["img_error"] = "extension not allowed, please choose a JPEG or PNG or JPG file.";
                              header("Location: posts.php?do=add");                              
                            }
                             
                        }
                        else{
                           $image = "";

                           $sql = "INSERT INTO posts (title, description, cat_id, auth_id, status, meta_tags, post_date) VALUES ('$title', '$description', '$image', $cat_id, '$auth_id', '$status', '$metaData', now() )";

                           $addPosts = mysqli_query($db, $sql);

                             if($addPosts){
                                 header("Location: posts.php?do=manage");
                             }
                             else{
                                 die("data not store into database");
                             }
                        }
                  }
              }


              else if($do == "edit"){
                if( isset ( $_GET['id'] ) ){
                  $updateId = $_GET['id'];

                  $sql = "SELECT * FROM posts WHERE id = '$updateId'";
                  $singleId = mysqli_query($db, $sql);

                  while( $row = mysqli_fetch_array($singleId) ){
                         $id                      = $row['id'];
                         $title                   = $row['title'];
                         $description             = $row['description'];
                         $image                   = $row['image'];
                         $cat_id                  = $row['cat_id'];
                         $status                  = $row['status'];
                         $meta_tags               = $row['meta_tags'];
                  ?> 

                   <div class="container">
                      <form action="posts.php?do=update" method="POST" enctype="multipart/form-data">
                          <div class="row">
                            <div class="col-lg-4">

                               <input type="hidden" name="id" value="<?php echo $id ?>">
                               <input type="hidden" name="oldImage" value="<?php echo $image ?>">

                              <div class="form-group">
                                    <label for="Category Name">Posts Title</label>
                                    <input type="text" name="title" value="<?php echo $title; ?>" class="form-control" id="exampleInputEmail1" placeholder="Enter Full Name">
                                </div>

                                <div class="form-group">
                                    <label>posts Category</label>
                                    <select class="form-control" name="cat_id">
                                        <option>Please select the posts category</option>
                                        <?php
                                          $categorySql = "SELECT * FROM category WHERE status = 1 ORDER BY cat_name ASC";
                                          $categoryQuery = mysqli_query($db, $categorySql);

                                          while( $row = mysqli_fetch_assoc($categoryQuery) ){
                                               $catId      = $row['id'];
                                               $cat_name    = $row['cat_name'];

                                            ?>
                                               <option value="<?php echo $catId; ?>"  
                                               <?php if( $catId == $cat_id){
                                                   echo 'selected';
                                                } 
                                               ?>>
                                               <?php echo $cat_name; ?>
                                            </option>

                                            <?php
                                          }
                                        ?>
                                    </select>
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
                                    <label for="">Post Image</label>
                                    <br />
                                     <?php 
                                       if( !empty($image) ){
                                        ?>
                                           <img src="dist/img/posts/<?php echo $image ?>" alt="" width="50">
                                        <?php
                                       }
                                     ?>
                                    <input type="file" name="image" class="form-control">
                                  </div>
                              </div>

                              <div class="col-lg-8">
                                <div class="form-group">
                                   <label for="posts Name">Meta Tags</label>
                                   <input type="text" name="metaTag" value="<?php echo $meta_tags; ?>" class="form-control" id="exampleInputEmail1" placeholder="Enter Full Name">
                                </div>

                                  <div class="form-group">
                                      <label>Post Description</label>
                                      <textarea name="description" id="descriptionContent" class="form-control"><?php echo $description; ?></textarea>
                                  </div>
                              </div>

                              <div class="col-lg-4">
                                  <button type="submit" name="updatePosts" class="btn btn-block btn-primary">Update Posts</button>
                              </div>
                          </div>
                      </form>
                    </div>

                <?php
                  }
                  
                }
              }

              else if($do == "update"){
                if( isset( $_POST['updatePosts'] ) ){
                      $id                   = $_POST["id"];
                      $cat_id               = $_POST["cat_id"];
                      $title                = mysqli_real_escape_string($db, $_POST['title']);
                      $description          = mysqli_real_escape_string($db, $_POST['description']);
                      $status               = mysqli_real_escape_string($db, $_POST['status']);
                      $metaTag                = mysqli_real_escape_string($db, $_POST['metaTag']);
                      $oldImage             = $_POST['oldImage'];
                      $image                = $_FILES['image']['name'];
                      $image_tmp            = $_FILES['image']['tmp_name'];

                     if( !empty( $image ) ){
                        // remove the existing image
                        unlink("dist/img/posts/" .  $oldImage);

                        $img = rand(1, 999999999) . "-image-" . $image;
                        move_uploaded_file($image_tmp, "dist/img/posts/" . $img);  

                        $updateSql = "UPDATE posts SET title='$title', description='$description',  image='$img', cat_id='$cat_id', status='$status', meta_tags='$metaTag'  WHERE id ='$id '";
                        $updateQuery = mysqli_query($db, $updateSql);
   
                        if($updateQuery){
                          header("Location: posts.php?do=manage");
                        }
                        else{
                           die("data has not been set into database");
                        }

                     } 
                     else{
                        //  $img = "";

                         $updateSql = "UPDATE posts SET title='$title', description='$description', cat_id='$cat_id', status='$status', meta_tags='$metaTag' WHERE id ='$id '";
                        $updateQuery = mysqli_query($db, $updateSql);
   
                        if($updateQuery){
                          header("Location: posts.php?do=manage");
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
                    
                    $delSql = "UPDATE posts SET status='0' WHERE id = '$delId'";
                    $softDel = mysqli_query($db, $delSql);

                    if($softDel){
                       header("Location: posts.php?do=manage");
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