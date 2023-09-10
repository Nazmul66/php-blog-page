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
                          <th scope="col">Full Name</th>
                          <th scope="col">Email</th>
                          <th scope="col">Address</th>
                          <th scope="col">Phone No.</th>
                          <th scope="col">User Roll</th>
                          <th scope="col">Status</th>
                          <th scope="col">Option</th>
                        </tr>
                      </thead>
                      <tbody>

                       <?php 
                       
                         $getData = "SELECT * FROM userinfo ORDER BY name DESC";
                         $userData = mysqli_query($db, $getData);
                         $totalNumberData = mysqli_num_rows($userData);

                           if( $totalNumberData == 0 ){
                            ?>
                           <div class="bg-danger" style="width: 100%; margin-bottom: 20px">
                              <h3 style="text-align: center; font-size: 20px; padding: 10px 0;">There is no data into Database</h3>
                            </div>
                       <?php
                           }
                           else{
                              $sl = 0;
                              while( $row = mysqli_fetch_assoc($userData) ){
                                  $id              = $row['id'];
                                  $name            = $row['name'];
                                  $email           = $row['email'];
                                  $phone           = $row['phone'];
                                  $address         = $row['address'];
                                  $role            = $row['role'];
                                  $status          = $row['status'];
                                  $image           = $row['Image'];
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
                                        ?>
                                      </td>
                                      <td><?php echo $name ?></td>
                                      <td><?php echo $email ?></td>
                                      <td><?php echo $address ?></td>
                                      <td><?php echo $phone ?></td>
                                      <td>
                                        <?php 
                                          if( $role == 1 ){
                                            echo '<span class="float-right badge bg-primary">Admin</span>';
                                          }
                                          else if ( $role == 2 ){
                                            echo '<span class="float-right badge bg-info">User</span>';
                                          }
                                        ?>
                                      </td>
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
                                              <a href="user.php?do=edit&id=<?php echo $id ?>"><i class="fa-solid fa-pen-to-square"></i></a>
                                          </li>
                                          <li>
                                              <a href="user.php?do=delete&id=<?php echo $id ?>"  data-toggle="modal" data-target="#Modal<?php echo $id ?>"><i class="fa-solid fa-trash"></i></a>
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
                  <div class="modal fade" id="Modal<?php echo $id ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel">Delete Option</h5>
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
                                    <a href="user.php?do=delete&id=<?php echo $id ?>">
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
                    <form action="user.php?do=store" method="POST" enctype="multipart/form-data">
                        <div class="row">
                          <div class="col-lg-4">
                             <div class="form-group">
                                  <label for="Full Name">Full Name</label>
                                  <input type="text" name="name" class="form-control" id="exampleInputEmail1" placeholder="Enter Full Name">
                              </div>
                              <div class="form-group">
                                  <label for="Email address">Email address</label>
                                  <input type="Email" name="email" class="form-control" placeholder="Enter Email Address">
                              </div>
                              <div class="form-group">
                                  <label for="Password">Password</label>
                                  <input type="Password" name="Password" class="form-control" placeholder="Enter Password">
                              </div>
                              <div class="form-group">
                                  <label for="Confirm Password">Confirm Password</label>
                                  <input type="Password" name="rePassword" class="form-control" placeholder="Enter Confirm Password">
                              </div>
                            </div>

                            <div class="col-lg-4">
                               <div class="form-group">
                                  <label for="Phone Number">Phone Number</label>
                                  <input type="text" name="phone" class="form-control" id="exampleInputEmail1" placeholder="Write Your Phone Number">
                               </div>

                               <div class="form-group">
                                  <label for="Address">Address</label>
                                  <input type="text" name="address" class="form-control" id="exampleInputEmail1" placeholder="Write Your Address">
                               </div>

                               <div class="form-group">
                                    <label>User role</label>
                                    <select class="form-control" name="role">
                                        <option>Select the user roll</option>
                                        <option value="1">Admin</option>
                                        <option value="2">User</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>User status</label>
                                    <select class="form-control" name="status">
                                        <option>Select the user status</option>
                                        <option value="1">Active</option>
                                        <option value="0">Inactive</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-4">
                              <div class="form-group">
                                 <label for="">Image</label>
                                 <input type="file" name="image" class="form-control">
                              </div>

                              <button type="submit" name="addUser" class="btn btn-block btn-primary">Register New User</button>
                            </div>
                        </div>
                    </form>
                  </div>

                  <?php
              }

              else if( $do == "store" ){
                 if( isset ( $_POST['addUser'] ) ){
                        $name            = mysqli_real_escape_string($db, $_POST['name']);
                        $email           = mysqli_real_escape_string($db, $_POST['email']);
                        $Password        = mysqli_real_escape_string($db, $_POST['Password']);
                        $rePassword      = mysqli_real_escape_string($db, $_POST['rePassword']);
                        $phone           = mysqli_real_escape_string($db, $_POST['phone']);
                        $address         = mysqli_real_escape_string($db, $_POST['address']);
                        $role            = mysqli_real_escape_string($db, $_POST['role']);
                        $status          = mysqli_real_escape_string($db, $_POST['status']);
                        $image_name      = $_FILES['image']['name'];
                        $image_tmp       = $_FILES['image']['tmp_name'];
                 }

                 if( $Password == $rePassword ){
                    $hashPassword = sha1($Password);

                      if( !empty($image_name) ){
                        $image = rand(1, 999999) . "-image-" . $image_name;
                        move_uploaded_file($image_tmp, "dist/img/users/" . $image );
                      }
                      else{
                        $image = "";
                      }

                      $sqli = "INSERT INTO userinfo (name, email, password, phone, address, role, status, Image) VALUES ('$name', '$email', '$hashPassword', '$phone', '$address', '$role', '$status', '$image')";

                       $queries = mysqli_query($db, $sqli);

                        if($queries){
                            header("Location: user.php?do=manage");
                        }
                        else{
                            die("data not store into database");
                        }

                 }
                 else{
                    header("Location: user.php?do=add");
                    echo "show that error password does not match";
                 }

              }

              else if($do == "edit"){
                if( isset ( $_GET['id'] ) ){
                   $id = $_GET['id'];

                   $sql = "SELECT * FROM userinfo WHERE id = '$id'";
                   $singleId = mysqli_query($db, $sql);

                   while( $row = mysqli_fetch_array($singleId) ){
                          $id              = $row['id'];
                          $name            = $row['name'];
                          $Email           = $row['email'];
                          $phone           = $row['phone'];
                          $address         = $row['address'];
                          $role            = $row['role'];
                          $status          = $row['status'];
                          $email           = $row['name'];
                          $image           = $row['Image'];
                   ?>

                     <div class="container">
                        <form action="user.php?do=update" method="POST" enctype="multipart/form-data">
                            <div class="row">
                              <div class="col-lg-4">

                               <input type="hidden" name="id" value="<?php echo $id ?>">
                               <input type="hidden" name="oldImage" value="<?php echo $image ?>">

                                <div class="form-group">
                                      <label for="Full Name">Full Name</label>
                                      <input type="text" name="name" value="<?php echo $name ?>" class="form-control" id="exampleInputEmail1" placeholder="Enter Full Name">
                                  </div>
                                  <div class="form-group">
                                      <label for="Email address">Email address</label>
                                      <input type="Email" name="email" value="<?php echo $Email ?>" class="form-control" placeholder="Enter Email Address">
                                  </div>
                                  <div class="form-group">
                                      <label for="Password">Password</label>
                                      <input type="Password" name="Password" value="***********"  class="form-control" placeholder="Enter Password">
                                  </div>
                                  <div class="form-group">
                                      <label for="Confirm Password">Confirm Password</label>
                                      <input type="Password" name="rePassword" value="***********" class="form-control" placeholder="Enter Confirm Password">
                                  </div>
                                </div>

                                <div class="col-lg-4">
                                  <div class="form-group">
                                      <label for="Phone Number">Phone Number</label>
                                      <input type="text" name="phone" value="<?php echo $phone ?>" class="form-control" id="exampleInputEmail1" placeholder="Write Your Phone Number">
                                  </div>

                                  <div class="form-group">
                                      <label for="Address">Address</label>
                                      <input type="text" name="address" value="<?php echo $address ?>"class="form-control" id="exampleInputEmail1" placeholder="Write Your Address">
                                  </div>

                                  <div class="form-group">
                                        <label>User Role</label>
                                        <select class="form-control" name="role">
                                            <option>Select the user roll</option>
                                            <option value="1" <?php if( $role == 1 ){ echo 'selected'; } ?>>Admin</option>
                                            <option value="2" <?php if( $role == 2 ){ echo 'selected'; } ?>>User</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label>User status</label>
                                        <select class="form-control" name="status">
                                            <option>Select the user status</option>
                                            <option value="1" <?php if( $status == 1 ){ echo 'selected'; } ?>>Active</option>
                                            <option value="0" <?php if( $status == 0 ){ echo 'selected'; } ?>>Inactive</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-4">
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

                                  <button type="submit" name="updateUser" class="btn btn-block btn-primary">Update User Data</button>
                                </div>
                            </div>
                        </form>
                      </div>

                   <?php

                  }
                }
              }

              else if($do == "update"){
                if( isset( $_POST['updateUser'] ) ){
                      $id              = $_POST["id"];
                      $name            = mysqli_real_escape_string($db, $_POST['name']);
                      $email           = mysqli_real_escape_string($db, $_POST['email']);
                      $Password        = mysqli_real_escape_string($db, $_POST['Password']);
                      $rePassword      = mysqli_real_escape_string($db, $_POST['rePassword']);
                      $phone           = mysqli_real_escape_string($db, $_POST['phone']);
                      $address         = mysqli_real_escape_string($db, $_POST['address']);
                      $role            = mysqli_real_escape_string($db, $_POST['role']);
                      $status          = mysqli_real_escape_string($db, $_POST['status']);
                      $oldImage        = $_POST['oldImage'];
                      $image           = $_FILES['image']['name'];
                      $image_tmp       = $_FILES['image']['tmp_name'];


                    if( !empty( $Password ) && !empty( $image ) ){
                        if( $Password == $rePassword ){
                          $hashPassword = sha1($Password);
                        }

                        if( !empty( $oldImage ) ){
                          unlink( "dist/img/users/" . $oldImage );
                        }

                        if( !empty( $image ) ){
                            $img = rand(1, 999999) . "-image-" . $image;
                            move_uploaded_file($image_tmp, "dist/img/users/" . $img);
                        }

                        $sql = "UPDATE userinfo SET name='$name', email='$email', password='$hashPassword', phone=' $phone', address='$address', role='$role', status='$status', Image='$img'";

                        $updateData = mysqli_query($db, $sql);

                          if($updateData){
                            header("Location: user.php?do=manage");
                          }
                          else{
                            die("something has wrong about update files");
                          }

                    }

                    else if( empty( $Password ) && !empty( $image ) ){
                        if( !empty ( $oldImage ) ){
                           unlink("dist/img/users/" . $oldImage );
                        }
                        if( !empty ( $image ) ){
                           $img = rand(1, 99999) . "-img-" . $image;
                           move_uploaded_file($image_tmp, "dist/img/users/" . $img );
                        }

                        $sql = "UPDATE userinfo SET name='$name', email='$email', phone=' $phone', address='$address', role='$role', status='$status', Image='$img'";

                        $updateData = mysqli_query($db, $sql);

                        if($updateData){
                          header("Location: user.php?do=manage");
                        }
                        else{
                          die("something has wrong about update files");
                        }
                    }

                    else if( !empty( $Password ) && empty( $image ) ){
                      if( $Password == $rePassword ){
                        $hashPassword = sha1($Password);
                      }

                      $sql = "UPDATE userinfo SET name='$name', email='$email', password='$hashPassword', phone=' $phone', address='$address', role='$role', status='$status'";

                      $updateData = mysqli_query($db, $sql);

                          if($updateData){
                            header("Location: user.php?do=manage");
                          }
                          else{
                            die("something has wrong about update files");
                          }

                    }

                    else{

                       $sql = "UPDATE userinfo SET name='$name', email='$email', phone=' $phone', address='$address', role='$role', status='$status'";

                       $updateData = mysqli_query($db, $sql);

                          if($updateData){
                            header("Location: user.php?do=manage");
                          }
                          else{
                            die("something has wrong about update files");
                          }
                    }

                }
              }


              else if($do == "delete"){
                if( isset ( $_GET['id'] ) ){
                   $id = $_GET['id'];

                  $sql = "DELETE FROM userinfo WHERE id = '$id' ";
                  $delete = mysqli_query($db, $sql);

                  if( $delete ){
                     header("Location: user.php?do=manage");
                  }
                  else{
                    die("Data has not delete yet,there is a problem");
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