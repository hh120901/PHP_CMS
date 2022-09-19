<?php

    if(isset($_GET['user_id'])){
        $the_user_id = $_GET['user_id'];
    
     $query = "SELECT * FROM users WHERE user_id = $the_user_id";
     $select_users = mysqli_query($connection, $query);       
         while($row = mysqli_fetch_assoc($select_users)){
            $user_name = $row['user_name'];
            $user_password = $row['user_password'];
            $user_firstname = $row['user_firstname'];
            $user_lastname = $row['user_lastname'];
            $user_email = $row['user_email'];
            $user_image = $row['user_image'];
            $user_role = $row['user_role'];
         }
        }

    if(isset($_POST['edit_user'])){
        $the_user_id = $_GET['user_id'];
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
        $query .= "WHERE user_id = $the_user_id";
        
        $update_user_query = mysqli_query($connection, $query);
        if($update_user_query){
            header('location: users.php');
        }

        
    }

?>

<form action="" method="post" enctype="multipart/form-data">
    
    <div class="form-group">
        <label for="user_name" class="text-uppercase">Username</label>
        <input type="text" name="user_name" class="form-control" value="<?php echo $user_name; ?>">
    </div>
    <div class="form-group">
        <label for="user_password" class="text-uppercase">Password </label>
        <input type="password" name="user_password" class="form-control" value="<?php echo $user_password; ?>">
    </div>
    <div class="form-group">
        <label for="user_firstname" class="text-uppercase">First Name</label>
        <input type="text" name="user_firstname" class="form-control" value="<?php echo $user_firstname; ?>">
    </div>
    <div class="form-group">
        <label for="user_lastname" class="text-uppercase">Last Name</label>
        <input type="text" name="user_lastname" class="form-control" value="<?php echo $user_lastname; ?>">
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
            <option value='Subcriber'><?php echo $user_role; ?></option>
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
        <input type="submit" class="btn btn-primary" name="edit_user" value="Edit User">
    </div>
</form>