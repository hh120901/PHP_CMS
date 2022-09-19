<?php
    global $connection;
    if(isset($_POST['creat_user'])){
        $user_name = $_POST['user_name'];
        $user_password = $_POST['user_password'];
        $user_firstname = $_POST['user_firstname'];
        $user_lastname = $_POST['user_lastname']; 
        $user_image = $_FILES['user_image']['name'];
        $user_image_temp = $_FILES['user_image']['tmp_name'];
        $user_email = $_POST['user_email'];
        $user_role = $_POST['user_role'];
        move_uploaded_file($user_image_temp, "../images/{$user_image}");
        $query = "INSERT INTO users (user_name, user_password, user_firstname, 
        user_lastname, user_email, user_image, user_role) ";
        $query .= "VALUES ('{$user_name}','{$user_password}', '{$user_firstname}', '{$user_lastname}', '{$user_email}', 
        '{$user_image}', '{$user_role}')";
        $create_user_query = mysqli_query($connection, $query);
        if($create_user_query){
            echo 'Created!!!'. " ". " <a href='users.php'>View Users</a> ";
        }
    }
?>

<form action="" method="post" enctype="multipart/form-data">
    
    <div class="form-group">
        <label for="user_name" class="text-uppercase">Username</label>
        <input type="text" name="user_name" class="form-control">
    </div>
    <div class="form-group">
        <label for="user_password" class="text-uppercase">Password </label>
        <input type="password" name="user_password" class="form-control">
    </div>
    <div class="form-group">
        <label for="user_firstname" class="text-uppercase">First Name</label>
        <input type="text" name="user_firstname" class="form-control">
    </div>
    <div class="form-group">
        <label for="user_lastname" class="text-uppercase">Last Name</label>
        <input type="text" name="user_lastname" class="form-control">
    </div>
    <div class="form-group">
        <label for="user_email" class="text-uppercase">Email</label>
        <input type="mail" name="user_email" class="form-control">
    </div> 
    <div class="form-group">
        <label for="user_image" class="text-uppercase">Image</label>
        <input type="file" name="user_image" class="form-control">
    </div>
    <div class="form-group">
        <label for="user_role" class="text-uppercase">Role</label>
        <select name="user_role" id="" class="form-control">
            <option value=''>Select</option>
            <option value='Subcriber'>Subcriber</option>
            <option value='Admin'>Admin</option>

         </select>
    </div>
    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="creat_user" value="Add User">
    </div>
</form>