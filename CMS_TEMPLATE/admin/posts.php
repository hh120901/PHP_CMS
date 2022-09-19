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
                    <?php 
                    if(isset($_GET['source'])){
                        $source = $_GET['source'];
                    }
                    else
                    {
                        $source = '';
                    }
                    switch ($source) {
                        case 'add_post':
                            include "includes_admin/admin_addPost.php";
                            break;
                        
                        case 'edit_post':
                            include "includes_admin/admin_edit_post.php";
                            break;

                        default:
                            include "includes_admin/admin_view_all_post.php";
                            break;
                    }
                    
                     ?>
                </div>
            </div>
            <!-- /.row -->

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->


    <?php include "includes_admin/admin_footer.php" ?>