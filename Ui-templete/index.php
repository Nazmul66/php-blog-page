<?php 
   include "../inc2/header.php";
?>
    
    <!-- :::::::::: Page Banner Section Start :::::::: -->
    <section class="blog-bg background-img">
        <div class="container">
            <!-- Row Start -->
            <div class="row">
                <div class="col-md-12">
                    <h2 class="page-title">Blog Page</h2>
                    <!-- Page Heading Breadcrumb Start -->
                    <nav class="page-breadcrumb-item">
                        <ol>
                            <li><a href="javascript:;">Home <i class="fa fa-angle-double-right"></i></a></li>
                            <!-- Active Breadcrumb -->
                            <li class="active">Blog</li>
                        </ol>
                    </nav>
                    <!-- Page Heading Breadcrumb End -->
                </div>
                  
            </div>
            <!-- Row End -->
        </div>
    </section>
    <!-- ::::::::::: Page Banner Section End ::::::::: -->


   
    <!-- :::::::::: Blog With Right Sidebar Start :::::::: -->
    <section>
        <div class="container">
            <div class="row">
                <!-- Blog Posts Start -->
                <div class="col-md-8">
                            
                               <!-- Single Item Blog Post Start -->
                                <div class="blog-post">
                                    <!-- Blog Banner Image -->
                                    <div class="blog-banner">
                                        <a href="">
                                            <img src="admin/dist/post-image/avatar.png" class="thumbnail">
                                            <!-- Post Category Names -->
                                            <div class="blog-category-name">
                                                <h6>Technical</h6>
                                            </div>
                                        </a>
                                    </div>
                                    <!-- Blog Title and Description -->
                                    <div class="blog-description">
                                        <a href="">
                                            <h3 class="post-title">Web Application</h3>
                                        </a>
                                        <p>Hello! Looking for web designer to help me update photos, colors and text to a simple landing page design made in WordPress (Using Elementor) Scope: - Check attachment called "New design", this should replace current elements on site </p>
                                        <!-- Blog Info, Date and Author -->
                                        <div class="row">
                                            <div class="col-md-8">
                                                <div class="blog-info">
                                                    <ul>
                                                        <li><i class="fa fa-calendar"></i> 2023-02-09</li>
                                                        <li><i class="fa fa-user"></i> Nazmul Hassan</li>
                                                    </ul>
                                                </div>
                                            </div>

                                            <div class="col-md-4 read-more-btn">
                                                <button type="button" class="btn-main">
                                                    <a href="">
                                                    Read More <i class="fa fa-angle-double-right"></i>
                                                    </a>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                             <!-- Single Item Blog Post End -->


                    <!-- Blog Paginetion Design Start -->
                    <div class="paginetion">
                        <ul>
                            <!-- Next Button -->
                            <li class="blog-prev">
                                <a href=""><i class="fa fa-long-arrow-left"></i>  Previous</a>
                            </li>
                            <li><a href="">1</a></li>
                            <li><a href="">2</a></li>
                            <li class="active"><a href="">3</a></li>
                            <li><a href="">4</a></li>
                            <li><a href="">5</a></li>
                            <!-- Previous Button -->
                            <li class="blog-next">
                                <a href=""> Next <i class="fa fa-long-arrow-right"></i></a>
                            </li>
                        </ul>
                    </div>
                    <!-- Blog Paginetion Design End -->               
                </div>



                <!-- Blog Right Sidebar -->
                <div class="col-md-4">

                   <?php include "../inc2/sidebar.php";?>

                </div>
                <!-- Right Sidebar End -->
            </div>
        </div>
    </section>
    <!-- ::::::::::: Blog With Right Sidebar End ::::::::: -->
    


<?php 
  include "../inc2/footer.php";
?>