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

                if(isset($_GET['category']))
                {
                    $the_cat_id = $_GET['category'];
                }
                    $query = "SELECT * From posts WHERE post_category_id = $the_cat_id";
                    $select_all_post_query = mysqli_query($connection, $query);
                    while($row = mysqli_fetch_assoc($select_all_post_query)){
                        $post_id = $row['post_id'];
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
                    <a href="posts.php?p_id=<?php echo $post_id; ?>"><?php echo $post_title; ?></a>
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
                <?php } ?>
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
       
<?php include "includes/footer.php"?>