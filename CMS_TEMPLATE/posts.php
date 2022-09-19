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
                if(isset($_GET['p_id'])){
                    $post_id = $_GET['p_id'];
                }
                    $query = "SELECT * From posts WHERE post_id = $post_id;";
                    $select_all_post_query = mysqli_query($connection, $query);
                    while($row = mysqli_fetch_assoc($select_all_post_query)){
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
            <!-- <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a> -->
            <hr>
            <?php } ?>

            <!-- comment -->
            <!-- Blog Comments -->

            <?php
                if(isset($_POST['create_comment'])){
                
                    $the_post_id = $_GET['p_id'];
                    $comment_author = $_POST['comment_author'];
                    $comment_email = $_POST['comment_email'];
                    $comment_content = $_POST['comment_content'];
                    
                    $query = "INSERT INTO comments (comment_post_id, comment_author, comment_email, 
                    comment_content, comment_status,comment_date)";
                    $query .= "VALUES ($the_post_id, '$comment_author', '$comment_email','$comment_content','Approved',now())";
                    
                    $creat_comment_query = mysqli_query($connection,$query);
                    if(!$creat_comment_query){
                        die ("QUERY FAIlED" .mysqli_error($connection) );
                       
                    }
                    $query2= "UPDATE posts SET post_comment_count = post_comment_count + 1 ";
                    $query2 .= "WHERE post_id = $the_post_id;";
                    $update_comment = mysqli_query($connection, $query2);

                }
                        
            

            ?>
            <!-- Comments Form -->
            <div class="well">
                <h4>Leave a Comment:</h4>
                <form role="form" method="post">
                <div class="form-group">
                    <label for="comment_author">Author</label>
                    <input type="text" name="comment_author" class="form-control">
                    </div>
                    <div class="form-group">
                    <label for="comment_email">Email</label>
                       <input type="email" name="comment_email" class="form-control">
                    </div>                  
                    <div class="form-group">
                    <label for="comment">Your Comment</label>
                        <textarea class="form-control" rows="3" name="comment_content"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary" name="create_comment">Submit</button>
                </form>
            </div>

            <hr>

            <!-- Posted Comments -->
            <?php
                $the_post_id = $_GET['p_id'];
                $query = "SELECT * FROM comments WHERE comment_post_id = {$the_post_id} ";
                $query .="AND comment_status = 'Approved' ";
                $query .="ORDER BY comment_id DESC;"; 
                
                $select_comment_query = mysqli_query($connection, $query);
                if(!$select_comment_query){
                    die("QUERY FAILED!!! ".mysqli_error($connection));
                }
                while($row = mysqli_fetch_assoc($select_comment_query)){
                    $comment_date = $row['comment_date'];
                    $comment_author = $row['comment_author'];
                    $comment_content = $row['comment_content'];
                    
            ?>
            <div class="media">
                <a class="pull-left" href="#">
                    <img class="media-object" src="images/CMS.jpg" width="64" height="64" alt="image">
                </a>
                <div class="media-body">
                    <h4 class="media-heading"><?php echo $comment_author; ?>
                        <small><?php echo $comment_date; ?></small>
                    </h4>
                    <?php echo $comment_content; ?>
                </div>
            </div>


            <?php } ?>

            <!-- Comment -->

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