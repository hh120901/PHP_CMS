<table class="table table-hover text-center">
    <thead>
        <tr class="text-center">
            <td> <strong> Id </strong></td>
            <td> <strong> Username </strong></td>
            <td> <strong> First Name </strong></td>
            <td> <strong> Last Name </strong></td>
            <td> <strong> Email </strong></td>
            <td> <strong> Image </strong></td>
            <td> <strong> Role </strong></td>
            <td> <strong> C.T Admin </strong></td>
            <td> <strong> C.T Subcriber </strong></td>
            <td> <strong> Delete User </strong></td>
            <td> <strong> Update User </strong></td>
        </tr>
    </thead>
    <tbody>
        <?php
             $query = "SELECT * FROM users ";
             $select_posts = mysqli_query($connection, $query);       
                 while($row = mysqli_fetch_assoc($select_posts)){
                     $user_id = $row['user_id'];
                     $user_name = $row['user_name'];
                     $user_password = $row['user_password'];
                     $user_firstname = $row['user_firstname'];
                     $user_lastname = $row['user_lastname'];
                     $user_email = $row['user_email'];
                     $user_role = $row['user_role'];
                     $user_image = $row['user_image'];
         
                     echo "<tr>";
                        echo " <td>{$user_id}</td> ";
                        echo " <td>{$user_name}</td> ";
                        echo " <td>{$user_firstname}</td> ";
                        echo " <td>{$user_lastname}</td> ";
                        echo " <td>{$user_email}</td> ";
                        echo " <td> <img src='../images/{$user_image}' width='100' height='100' alt='image'></td> ";
                        echo " <td>{$user_role}</td> ";

                         echo " <td><a href='users.php?change_admin={$user_id}'>Admin</a></td> ";
                         if(isset($_GET['change_admin'])){
                            $admin_id= $_GET['change_admin'];
                            $change_query = "UPDATE users SET user_role = 'Admin' WHERE user_id = $admin_id";
                
                            $change = mysqli_query($connection,$change_query);
                            if($change) {
                                header('location: users.php');
                            }
                         }  

                         echo " <td><a href='users.php?chang_sub={$user_id}'>subcriber</a></td> ";
                         if(isset($_GET['chang_sub'])){
                            $sub_id= $_GET['chang_sub'];
                            $change_query = "UPDATE users SET user_role = 'Subcriber' WHERE user_id = $sub_id";
                
                            $change_to_sub = mysqli_query($connection,$change_query);
                            if($change_to_sub) {
                                header('location: users.php');
                            }
                         }  
                         

                         echo " <td><a href='users.php?delete={$user_id}'>Delete</a></td> ";
                 // DELETE

                         if(isset($_GET['delete'])){
                            $del_user_id= $_GET['delete'];
                            $del_query = "DELETE FROM users WHERE user_id = {$del_user_id}";
                
                            $del_user_query = mysqli_query($connection,$del_query);
                            if($del_user_query) {
                                header('location: users.php');
                            }
                        }

                // EDIT
                         echo " <td><a href='users.php?source=edit_user&user_id={$user_id}'>Edit</a></td> ";
                     echo "</tr>";
                 }
                 
        
        ?>
    </tbody>
</table>