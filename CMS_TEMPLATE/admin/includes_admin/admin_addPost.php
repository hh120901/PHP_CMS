<?php
    global $connection;
    if(isset($_POST['create_post'])){
        $post_category_id = $_POST['post_category_id'];
        $post_author = $_POST['post_author'];
        $post_title = $_POST['post_title'];

        $post_image = $_FILES['post_image']['name'];
        $post_image_temp = $_FILES['post_image']['tmp_name'];

        $post_content = $_POST['post_content'];
        $post_status = $_POST['post_status'];
        $post_tags = $_POST['post_tags'];
        $post_date = date('d-m-y');
        // $post_comment_count = 4;

        move_uploaded_file($post_image_temp, "../images/{$post_image}");

        $query = "INSERT INTO posts (post_category_id, post_title, post_author, 
        post_date, post_image, post_content, post_tags, post_comment_count, post_status) ";
        $query .= "VALUES ('{$post_category_id}','{$post_title}', '{$post_author}', now(), '{$post_image}', 
        '{$post_content}', '{$post_tags}','{$post_comment_count}', '{$post_status}')";
        $create_post_query = mysqli_query($connection, $query);
        confirmQuery($create_post_query);
    }

?>

<form action="" method="post" enctype="multipart/form-data">
    
    <div class="form-group">
        <label for="post_title" class="text-uppercase">Post Title</label>
        <input type="text" name="post_title" class="form-control">
    </div>
    <div class="form-group">
    <label for="post_category" class="text-uppercase">Post Category</label>
        <select name="post_category_id" id="" class="form-control">
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
        <input type="text" name="post_author" class="form-control">
    </div>
    <div class="form-group">
        <label for="post_status" class="text-uppercase">Post Status</label>
        <select name="post_status" id="" class="form-control">
             <option value="published">published</option>
             <option value="draft">draft</option>

        </select>
    </div>
    <div class="form-group">
        <label for="post_image" class="text-uppercase">Post Image</label>
        <input type="file" name="post_image" class="form-control">
    </div>
    <div class="form-group">
        <label for="post_tags" class="text-uppercase">Post Tags</label>
        <input type="text" name="post_tags" class="form-control">
    </div>
    <div class="form-group">
        <label for="post_content" class="text-uppercase">Post Content</label>
        <textarea name="post_content" id="post_content" cols="30" rows="7" class="form-control" id="summernote">
        </textarea>
    </div>
    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="create_post" value="Add post">
    </div>
</form>