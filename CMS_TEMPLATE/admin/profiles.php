<?php include "includes_admin/admin_header.php" ?>


<?php 
    if(isset($_SESSION['user_id'])){
        $user_id= $_SESSION['user_id'];
        $query = "SELECT * FROM users WHERE user_id = '{$user_id}'";

        $select_users = mysqli_query($connection, $query);
        if(!$select_users){
            echo 'QUERY FAILED!';
        }
        while($row = mysqli_fetch_array($select_users)){

            $user_id = $row['user_id'];
            $user_name = $row['user_name'];
            $user_password = $row['user_password'];
            $user_firstname = $row['user_firstname'];
            $user_lastname = $row['user_lastname'];
            $user_email = $row['user_email'];
            $user_role = $row['user_role'];
            $user_image = $row['user_image'];
        }
    }
?>
    
    <?php
    if(isset($_POST['update_profile'])){
        $user_id= $_SESSION['user_id'];
        $user_name = $_POST['user_name'];
        $user_password = $_POST['user_password'];
        $user_firstname = $_POST['user_firstname'];
        $user_lastname = $_POST['user_lastname'];
        $user_email = $_POST['user_email'];
        $user_role = $_POST['user_role'];       


        
        $user_image = $_FILES['user_image']['name'];
        $user_image_temp = $_FILES['user_image']['tmp_name'];
       
       
        move_uploaded_file($user_image_temp, "../images/{$user_image}");    
        
        $query ="UPDATE users SET ";
        $query .= "user_name = '$user_name', ";
        $query .= "user_password = '$user_password', ";
        $query .= "user_firstname = '$user_firstname', ";
        $query .= "user_lastname = '$user_lastname', ";
        $query .= "user_email = '$user_email', ";
        $query .= "user_image = '$user_image', ";
        $query .= "user_role = '$user_role' ";
        $query .= "WHERE user_id = $user_id";
        
        $update_user_query = mysqli_query($connection, $query);
        if($update_user_query){
            header('location: profiles.php');
        }

        
    }
    ?>  

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
                <form action="" method="post" enctype="multipart/form-data">

                    <div class="form-group">
                        <label for="user_name" class="text-uppercase">Username</label>
                        <input type="text" name="user_name" class="form-control" value="<?php echo $user_name; ?>">
                    </div>
                    <div class="form-group">
                        <label for="user_password" class="text-uppercase">Password </label>
                        <input type="password" name="user_password" class="form-control"
                            value="<?php echo $user_password; ?>">
                    </div>
                    <div class="form-group">
                        <label for="user_firstname" class="text-uppercase">First Name</label>
                        <input type="text" name="user_firstname" class="form-control"
                            value="<?php echo $user_firstname; ?>">
                    </div>
                    <div class="form-group">
                        <label for="user_lastname" class="text-uppercase">Last Name</label>
                        <input type="text" name="user_lastname" class="form-control"
                            value="<?php echo $user_lastname; ?>">
                    </div>
                    <div class="form-group">
                        <label for="user_email" class="text-uppercase">Email</label>
                        <input type="mail" name="user_email" class="form-control" value="<?php echo $user_email; ?>">
                    </div>
                    <div class="form-group">
                        <label for="user_image" class="text-uppercase">Image</label>
                        <input type="file" name="user_image" class="form-control">
                        <?php checkImg($user_image)?>
                    </div>
                    <div class="form-group">
                        <label for="user_role" class="text-uppercase">Role</label>
                        <select name="user_role" id="" class="form-control">
                            <option value='Admin'><?php echo $user_role; ?></option>
                            <?php
                if($user_role == 'Admin'){
                    echo  "<option value='Subcriber'>Subcriber</option>";
                }
                else
                {
                    echo "<option value='Admin'>Admin</option>";
                }
            ?>

                        </select>
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-primary" name="update_profile" value="UPDATE PROFILE">
                    </div>
                </form>
            </div>
            <!-- /.row -->

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->


    <?php include "includes_admin/admin_footer.php" ?>