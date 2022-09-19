<?php
// Add category
function insert_categories(){
    global $connection;
    if(isset($_POST['submit'])){
        $cat_title = $_POST['cat_title'];
        if($cat_title == "" || empty($cat_title)){
            echo "<h3 class='text-danger'>This field should not empty!!!</h3>";
        }
        else
        {
            $query = "INSERT INTO categories(cat_title) ";
            $query .= "VALUE('{$cat_title}')";
            $create_cat_title = mysqli_query($connection, $query);
            if(!$create_cat_title){
                die ('Query Failed' .mysqli_error($connection));
            }
        }
    }
}
// function getall
function findAllCategories(){
    global $connection;
    $query = "SELECT * FROM categories ";
    $select_categories = mysqli_query($connection, $query);       
        while($row = mysqli_fetch_assoc($select_categories)){
            $cat_id = $row['cat_id'];
            $cat_title = $row['cat_title'];
            echo "<tr>";
            echo "<td>{$cat_id}</td>";
            echo "<td>{$cat_title}</td>";
            echo "<td> <a href='categories.php?delete={$cat_id}'>DELETE</a></td>";
            echo "<td> <a href='categories.php?edit={$cat_id}'>Edit</a></td>";
            echo "</tr>";
    }   

}

function delete_categories(){
    global $connection;
    if(isset($_GET['delete'])){
        $del_cat_id = $_GET['delete'];

        $query = "DELETE FROM categories WHERE cat_id = {$del_cat_id}";
        $delete_cat = mysqli_query($connection, $query);
        if($delete_cat){
            header('location: categories.php');
        }
    }


}
function getAllPosts(){
    global $connection;
    $query = "SELECT * FROM posts ";
    $select_posts = mysqli_query($connection, $query);       
        while($row = mysqli_fetch_assoc($select_posts)){
            $post_id = $row['post_id'];
            $post_category_id = $row['post_category_id'];
            $post_author = $row['post_author'];
            $post_title = $row['post_title'];
            $post_image = $row['post_image'];
            $post_tags = $row['post_tags'];
            $post_date = $row['post_date'];
            $post_comment_count = $row['post_comment_count'];
            $post_status = $row['post_status'];

            echo "<tr>";
                echo " <td>{$post_id}</td> ";
                echo " <td>{$post_author}</td> ";
                echo " <td>{$post_title}</td> ";
                //display category title
                $query = "SELECT * FROM categories WHERE cat_id = {$post_category_id}";
                $select_categories_id = mysqli_query($connection, $query);
                while($row = mysqli_fetch_assoc($select_categories_id)){
                    $cat_id = $row['cat_id'];
                    $cat_title =$row['cat_title'];                
                echo " <td>{$cat_title}</td> ";
                }


                echo " <td>{$post_status}</td> ";
                echo " <td> <img src='../images/{$post_image}' width='100' height='100' alt='image'></td> ";
                echo " <td>{$post_tags}</td> ";
                echo " <td>{$post_comment_count}</td> ";
                echo " <td>{$post_date}</td> ";
                echo " <td><a href='posts.php?delete={$post_id}'>Delete</a></td> ";
                echo " <td><a href='posts.php?source=edit_post&post_id={$post_id}'>Edit</a></td> ";
            echo "</tr>";
        }
        if(isset($_GET['delete'])){
            $del_post_id= $_GET['delete'];
            $del_query = "DELETE FROM posts WHERE post_id = {$del_post_id}";

            $delete_post = mysqli_query($connection,$del_query);
            if($delete_post) {
                header('location: posts.php');
            }
        }

}

function confirmQuery($result){
    global $connection;
    if(!$result){
        die ("Query Failed! " .mysqli_error($connection));
    }

}

function checkImg($image_check){
    if($image_check){
        echo "<img src='../images/{$image_check}' alt='' width='100' height='100'>";
    }
}


?>