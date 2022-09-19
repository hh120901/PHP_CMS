<?php include "includes/header.php" ?>
<?php include "includes/db.php" ?>
    <!-- Navigation -->
    <?php include "includes/navigation.php" ?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">
                <?php 
                //function search: 
                if(isset($_POST['submit'])){
                    $search = $_POST['search'];
                    $query = "SELECT * FROM posts WHERE post_tags LIKE '%$search%' ";
                    $search_query = mysqli_query($connection, $query);
                    
                    if(!$search_query){
                        die("QUERY FAILED!" .mysqli_error($connection));
                    }
                    $count = mysqli_num_rows($search_query);
            
                    if($count == 0){
                        echo " <h1>NO RESULT!</h1> ";
                    }
                    else{

                        while($row = mysqli_fetch_assoc($search_query)){
                        $post_title = $row['post_title'];
                        $post_author = $row['post_author'];
                        $post_dates = $row['post_date'];
                        $post_content = $row['post_content'];
                        $post_image = $row['post_image'];
                ?>
                <h1 class="page-header">
                    Page Heading
                    <small>Secondary Text</small>
                </h1>

                <!-- First Blog Post -->
                <h2>
                    <a href="#"><?php echo $post_title; ?></a>
                </h2>
                <p class="lead">
                    by <a href="index.php"><?php echo $post_author; ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"> <?php echo $post_dates ; ?></span></p>
                <hr>
                <img class="img-responsive" src="images/<?php echo $post_image;?> " alt="">
                <hr>
                <p><?php echo $post_content; ?></p>
                <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                <hr>


                <?php } 
                    }
            
                }
                ?>
                    



                

                

                <!-- Pager -->
                <ul class="pager">
                    <li class="previous">
                        <a href="#">&larr; Older</a>
                    </li>
                    <li class="next">
                        <a href="#">Newer &rarr;</a>
                    </li>
                </ul>

            </div>

            <!-- Blog Sidebar Widgets Column -->
            <?php include "includes/sidebar.php" ?>

        </div>
        <!-- /.row -->

        <hr>

        <!-- Footer -->
        <footer>
            <div class="row">
                <div class="col-lg-12">
                    <p>Copyright &copy; Your Website 2014</p>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
        </footer>

    </div>
    <!-- /.container -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
<?php include "includes/footer.php"?>