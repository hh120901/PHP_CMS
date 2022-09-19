<?php

    if(isset($_GET['post_id'])){
        $the_post_id = $_GET['post_id'];
    
     $query = "SELECT * FROM posts WHERE post_id = $the_post_id";
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
             $post_content = $row['post_content'];
         }
        }

    if(isset($_POST['update_post'])){
        $the_post_id = $_GET['post_id'];
        $post_category_id = $_POST['post_category'];
        $post_author = $_POST['post_author'];
        $post_title = $_POST['post_title'];
        $post_image = $_FILES['post_image']['name'];
        $post_image_temp = $_FILES['post_image']['tmp_name'];
        $post_content = $_POST['post_content'];
        $post_status = $_POST['post_status'];
        $post_tags = $_POST['post_tags'];
       
        move_uploaded_file($post_image_temp, "../images/{$post_image}");    
        
        $query ="UPDATE posts SET ";
        $query .= "post_title = '$post_title', ";
        $query .= "post_category_id = '$post_category_id', ";
        $query .= "post_author = '$post_author', ";
        $query .= "post_status = '$post_status', ";
        $query .= "post_tags = '$post_tags', ";
        $query .= "post_content = '$post_content', ";
        $query .= "post_image = '$post_image' ";
        $query .= "WHERE post_id = $the_post_id";
        
        $update_post_query = mysqli_query($connection, $query);
        if($update_post_query){
            header('location: posts.php');
        }

        
    }

?>

<form action="" method="post" enctype="multipart/form-data">
    
    <div class="form-group">
    <label for="post_title" class="text-uppercase">Post Title </label>
        <input type="text" name="post_title" class="form-control" value="<?php echo $post_title; ?>">
    </div>
    <div class="form-group">
        <label for="post_category" class="text-uppercase">Post Category</label>
        <select name="post_category" id="" class="form-control">
        <?php
             $query = "SELECT * FROM categories";

             $select_categories = mysqli_query($connection, $query);

             confirmQuery($select_categories);
             
             while($row = mysqli_fetch_assoc($select_categories)){
                 $cat_id = $row['cat_id'];
                 $cat_title =$row['cat_title'];
                echo "<option value='{$cat_id}'>{$cat_title}</option>";
             }
        ?>
        

         </select>
    </div>
    <div class="form-group">
        <label for="post_author" class="text-uppercase">Post Author </label>
        <input type="text" name="post_author" class="form-control" value="<?php echo $post_author; ?>">
    </div>
    <div class="form-group">
        <label for="post_status" class="text-uppercase">Post Status</label>
        <select name="post_status" id="" class="form-control">
             <option value='<?php echo $post_status; ?>'><?php echo $post_status?></option>
            <?php
            if($post_status == 'published')
                echo "<option value='draft'>draft</option>";
            
            else
            {
                echo "<option value='published'>published</option>";
            }
            ?>
        </select>

    </div>
    <div class="form-group">
        <label for="post_image" class="text-uppercase">Post Image</label>
        <input type="file" name="post_image">
        <?php checkImg($post_image)?>
        
    </div>
    <div class="form-group">
        <label for="post_tags" class="text-uppercase">Post Tags</label>
        <input type="text" name="post_tags" class="form-control" value="<?php echo $post_tags; ?>">
    </div>
    <div class="form-group">
        <label for="post_content" class="text-uppercase">Post Content</label>
        <textarea name="post_content" id="post_content" cols="20" rows="7" class="form-control">
        <?php echo $post_content; ?>
        </textarea>
    </div>
    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="update_post" value="Update Post">
    </div>
</form>