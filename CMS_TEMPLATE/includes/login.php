<?php include "db.php" ?>
<?php session_start(); ?>

<?php
    if(isset($_POST['login'])){
        $username = $_POST['username'];
        $password = $_POST['password'];

        $user_name= mysqli_real_escape_string($connection,$username);
        $user_password= mysqli_real_escape_string($connection,$password);

        $query = "SELECT * FROM users WHERE user_name = '{$user_name}'";
        $select_user = mysqli_query($connection, $query);
        if(!$select_user){
            die ("QUERY FAILED! ".mysqli_error($connection));
        }
        while($row = mysqli_fetch_array($select_user)){
            $db_user_id = $row['user_id'];
            $db_user_name = $row['user_name'];
            $db_user_password = $row['user_password'];
            $db_user_firstname = $row['user_firstname'];
            $db_user_lastname = $row['user_lastname'];
            $db_user_role = $row['user_role'];
        }
        if ($user_name === $db_user_name && $user_password === $db_user_password){
            $_SESSION['user_id']= $db_user_id;
            $_SESSION['username']= $db_user_name;
            $_SESSION['firstname']= $db_user_firstname;
            $_SESSION['lastname']= $db_user_lastname;
            $_SESSION['user_role']= $db_user_role;
            header("location: ../admin");
        }
        else{
            header("location: ../index.php");
        }



    }




?>