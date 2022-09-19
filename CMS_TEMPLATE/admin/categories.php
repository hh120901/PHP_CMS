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
                    <div class="col-xs-6">
                        <?php insert_categories(); ?>
                        <form action="" method="post">
                            <div class="form-group">
                                <lable for="cat-title" class="text-uppercase"> Add Category</lable>
                                <input type="text" name="cat_title" class="form-control">
                            </div>
                            <div class="form-group">
                                <input type="submit" class="btn btn-primary" name="submit" value="Add Category">
                            </div>
                        </form>


                        <!-- Update -->
                        <?php
                            if(isset($_GET['edit'])){
                                $cat_id = $_GET['edit'];
                                include "includes_admin/admin_update_cat.php";
                            }
                        ?>
                        

                    </div> <!-- add categories form -->
                    <div class="col-xs-6">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Category Title</th>
                                </tr>
                            </thead>
                            <tbody>
                            <!-- Get All Categories-->
                            <?php findAllCategories(); ?>
                            <!-- Delete Categoriy -->
                            <?php delete_categories(); ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- /.row -->

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->


    <?php include "includes_admin/admin_footer.php" ?>