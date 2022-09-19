                        <form action="" method="post">
                            <div class="form-group">
                                <lable for="cat-title" class="text-uppercase"> Edit Category</lable>
                                <?php
                                    if(isset($_GET['edit'])){
                                        $edit_cat_id = $_GET['edit'];
                                        $query = "SELECT * FROM categories WHERE cat_id = {$edit_cat_id}";
                                        $select_categories_id = mysqli_query($connection, $query);
                                        while($row = mysqli_fetch_assoc($select_categories_id)){
                                            $cat_id = $row['cat_id'];
                                            $cat_title =$row['cat_title'];
                                ?>

                                <input type="text" value="<?php if(isset($cat_title)) {echo $cat_title;} ?>" name="cat_title" class="form-control">

                                <?php }  
                                    }
                                ?>


                                <?php //-- Update when click update category
                                    if(isset($_POST['update_category'])){
                                        $update_cat = $_POST['cat_title'];
                                        $query = "UPDATE categories SET cat_title = '{$update_cat}' WHERE cat_id = {$edit_cat_id} ";
                                        $update_cat_title = mysqli_query($connection, $query);
                                        if($update_cat_title){
                                            header('location: categories.php');
                                        }
                                    }
                                ?>
                            </div>
                            <div class="form-group">
                                <input type="submit" class="btn btn-primary" name="update_category" value="Update Category">
                            </div>
                        </form>