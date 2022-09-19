<table class="table table-hover">
    <thead>
        <tr>
            <th>Id</th>
            <th>Author</th>
            <th>Comment</th>
            <th>Email</th>
            <th>Status</th>
            <th>In Response to</th>
            <th>Date</th>
            <th>Approve</th>
            <th>Unapprove</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody>
        <?php
             $query = "SELECT * FROM comments ";
             $select_posts = mysqli_query($connection, $query);       
                 while($row = mysqli_fetch_assoc($select_posts)){
                     $comment_id = $row['comment_id'];
                     $comment_post_id = $row['comment_post_id'];
                     $comment_author = $row['comment_author'];
                     $comment_email = $row['comment_email'];
                     $comment_content = $row['comment_content'];
                     $comment_status = $row['comment_status'];
                     $comment_date = $row['comment_date'];
                     
         
                     echo "<tr>";
                        echo " <td>{$comment_id}</td> ";
                        echo " <td>{$comment_author}</td> ";
                        echo " <td>{$comment_content}</td> ";
                        echo " <td>{$comment_email}</td> ";
                        echo " <td>{$comment_status}</td> ";

                        $query_select = "SELECT * FROM posts WHERE post_id = $comment_post_id";
                        $select_post = mysqli_query($connection, $query_select);
                        while($row = mysqli_fetch_assoc($select_post)){
                            $post_id = $row['post_id'];
                            $post_title = $row['post_title'];
                            echo "<td> <a href='../posts.php?p_id=$post_id'>{$post_title}</a></td>";
                        }

                         echo " <td>{$comment_date}</td> ";

                         echo " <td><a href='comments.php?approve=${comment_id}'>Approve</a></td> ";
                         if(isset($_GET['approve'])){
                            $approve_comment_id= $_GET['approve'];
                            $approve_query = "UPDATE comments SET comment_status = 'Approved' WHERE comment_id = $approve_comment_id";
                
                            $approve_comment = mysqli_query($connection,$approve_query);
                            if($approve_comment) {
                                header('location: comments.php');
                            }
                         }  

                         echo " <td><a href='comments.php?unapprove=${comment_id}'>Unapprove</a></td> ";
                         if(isset($_GET['unapprove'])){
                            $unapprove_comment_id= $_GET['unapprove'];
                            $unapprove_query = "UPDATE comments SET comment_status = 'Unapproved' WHERE comment_id = $unapprove_comment_id";
                
                            $unapprove_comment = mysqli_query($connection,$unapprove_query);
                            if($unapprove_comment) {
                                header('location: comments.php');
                            }
                         }  
                         

                         echo " <td><a href='comments.php?delete=${comment_id}'>Delete</a></td> ";
                 // DELETE

                         if(isset($_GET['delete'])){
                            $del_comment_id= $_GET['delete'];
                            $del_query = "DELETE FROM comments WHERE comment_id = {$del_comment_id}";
                
                            $delete_comment = mysqli_query($connection,$del_query);
                            if($delete_comment) {
                                header('location: comments.php');
                            }
                        }
                        //  echo " <td><a href='#'>Edit</a></td> ";
                     echo "</tr>";
                 }
                 
        
        ?>
    </tbody>
</table>