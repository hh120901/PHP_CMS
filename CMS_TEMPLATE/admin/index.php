<?php include "includes_admin/admin_header.php" ?>
<div id="wrapper">

    <!-- Navigation -->
    <?php include "includes_admin/admin_navigation.php" ?>

    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        WELCOME TO ADMIN
                        <small><?php echo $_SESSION['firstname']." ".$_SESSION['lastname']; ?></small>
                    </h1>
                </div>
            </div>
            <!-- /.row -->

            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-file-text fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <?php
                                        $query = "SELECT * FROM posts";
                                        $select_all_posts = mysqli_query($connection, $query);
                                        $post_count= mysqli_num_rows($select_all_posts);
                                        echo "<div class='huge'>{$post_count}</div>";
                                    ?>
                                    <div>Posts</div>
                                </div>
                            </div>
                        </div>
                        <a href="posts.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-green">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-comments fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <?php
                                        $query = "SELECT * FROM comments";
                                        $select_all_comments = mysqli_query($connection, $query);
                                        $comment_count= mysqli_num_rows($select_all_comments);
                                        echo "<div class='huge'>{$comment_count}</div>";
                                    ?>
                                    <div>Comments</div>
                                </div>
                            </div>
                        </div>
                        <a href="comments.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-yellow">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-user fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <?php
                                        $query = "SELECT * FROM users";
                                        $select_all_users = mysqli_query($connection, $query);
                                        $user_count= mysqli_num_rows($select_all_users);
                                        echo "<div class='huge'>{$user_count}</div>";
                                    ?>
                                    <div> Users</div>
                                </div>
                            </div>
                        </div>
                        <a href="users.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-red">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-list fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <?php
                                        $query = "SELECT * FROM categories";
                                        $select_all_categories = mysqli_query($connection, $query);
                                        $cat_count= mysqli_num_rows($select_all_categories);
                                        echo "<div class='huge'>{$cat_count}</div>";
                                    ?>
                                    <div>Categories</div>
                                </div>
                            </div>
                        </div>
                        <a href="categories.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <!-- /.row -->
            <?php
            //count draft post
                $query = "SELECT * FROM posts WHERE post_status = 'draft'";
                $select_all_draft = mysqli_query($connection, $query);
                $draft_count= mysqli_num_rows($select_all_draft);
            //count published post
                $query = "SELECT * FROM posts WHERE post_status = 'published'";
                $select_all_published = mysqli_query($connection, $query);
                $pub_count= mysqli_num_rows($select_all_published);
                
             //count unapprove comments
                $query = "SELECT * FROM comments WHERE comment_status = 'Unapproved'";
                $select_all_unap = mysqli_query($connection, $query);
                $unapprove_count= mysqli_num_rows($select_all_unap);      
             //count subcriber
                $query = "SELECT * FROM users WHERE user_role = 'Subcriber'";
                $select_all_subu = mysqli_query($connection, $query);
                $subu_count= mysqli_num_rows($select_all_subu);  

            ?>

            <div class="row">
                <script type="text/javascript">
                google.charts.load('current', {
                    'packages': ['bar']
                });
                google.charts.setOnLoadCallback(drawChart);

                function drawChart() {
                    var data = google.visualization.arrayToDataTable([
                        ['Data', 'Count'],
                        <?php   
                            $eletment_text = ['Posts','Published Posts','Draft Posts', 'Categories', 'Users','Subcriber Users', 'Comments','Pending Comments'];
                            $element_count = [$post_count,$pub_count,$draft_count,$cat_count,$user_count,$subu_count,$comment_count,$unapprove_count];
                            for($i= 0; $i< 8;$i++ ){
                                echo "['{$eletment_text[$i]}'".",". "{$element_count[$i]}],";
                            }

                        
                        ?>
          
                    ]);

                    var options = {
                        chart: {
                            title: 'CMS',
                            subtitle: 'Blog',
                        }
                    };

                    var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

                    chart.draw(data, google.charts.Bar.convertOptions(options));
                }
                </script>
                <div id="columnchart_material" style="width: auto; height: 500px;"></div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /#page-wrapper -->


    <?php include "includes_admin/admin_footer.php" ?>