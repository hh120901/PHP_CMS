<div class="col-md-4">
    <!-- Blog Search Well -->
    <div class="well">
        <h4>Blog Search</h4>
        <form action="search.php" method="post">
            <!-- search form -->
            <div class="input-group">
                <input type="text" name="search" class="form-control">
                <span class="input-group-btn">
                    <button class="btn btn-default" type="submit" name="submit">
                        <span class="glyphicon glyphicon-search"></span>
                    </button>
                </span>
            </div>
        </form>
        <!-- /.input-group -->
    </div>

        <!-- LOGIN -->
    <div class="well">
        <h4>LOGIN to ADMIN</h4>
        <form action="includes/login.php" method="post">
            <!-- search form -->
            <div class="form-group">
                <input type="text" name="username" class="form-control" placeholder="Enter Username">
            </div>
            <div class="input-group">
                <input type="password" name="password" class="form-control" placeholder="Enter Password">
                <span class="input-group-btn">
                    <button class="btn btn-primary" name="login" type="submit">Submit</button>
                </span>
            </div>
        </form>
        <!-- /.input-group -->
    </div>




    <!-- Blog Categories Well -->
    <div class="well">
        <h4>Blog Categories</h4>
        <div class="row">
            <div class="col-lg-12">
                <ul class="list-unstyled">
                    <?php 
                         $query = "SELECT * FROM categories ";
                         $select_categories_sighbar = mysqli_query($connection, $query);
                         while($row = mysqli_fetch_assoc($select_categories_sighbar)){
                             $cat_title = $row['cat_title'];
                             $cat_id = $row['cat_id'];
                             echo "<li><a href='category.php?category={$cat_id}'>{$cat_title}</a></li>";
                         }
                    ?>
                </ul>
            </div>
            <!-- /.col-lg-6 -->
        </div>
        <!-- /.row -->
    </div>
    <!-- Side Widget Well -->
    <?php include "widget.php" ?>     
</div>