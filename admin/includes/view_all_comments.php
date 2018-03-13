<div class="table-responsive">
    <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th>Id</th>
                <th>Author</th>
                <th>Content</th>
                <th>Email</th>
                <th>Status</th>
                <th>In response to</th>
                <th>Date</th>
                <th>Approve</th>
                <th>Unapprove</th>
                <th>Delete</th>
            </tr>
        </thead>

        <tbody>
        <?php
            $query_comments_all = "SELECT * FROM comments";
            $select_comments_all = mysqli_query($connection, $query_comments_all);
            
            confirm($select_comments_all);
            
            while($row = mysqli_fetch_assoc($select_comments_all)){
                
                $comment_id = $row['comment_id'];
                $comment_post_id = $row['comment_post_id'];
                $comment_author = $row['comment_author'];
                $comment_content = $row['comment_content'];
                $comment_email = $row['comment_email'];
                $comment_status = $row['comment_status'];
                $comment_status = $row['comment_status'];
                $comment_date = $row['comment_date'];
                
                echo "<tr><td>{$comment_id}</td>";
                echo "<td>{$comment_author}</td>";
                echo "<td>{$comment_content}</td>";
                echo "<td>{$comment_email}</td>";
                echo "<td>{$comment_status}</td>";
                
                
                
                $query_post_id = "SELECT * FROM posts WHERE post_id = {$comment_post_id}";
                
                $select_post_id = mysqli_query($connection, $query_post_id);
                
                confirm($select_post_id);
                
                while($row = mysqli_fetch_assoc($select_post_id)){
                    $post_title = $row['post_title'];
                    $post_id = $row['post_id'];
                    
                    echo "<td><a href='../post.php?id={$post_id}'>{$post_title}</a></td>";
                    
                }
                
                
                
                
                echo "<td>{$comment_date}</td>";
                
                echo "<td><a href='comments.php?approve={$comment_id}'>Approve</a></td>";
                echo "<td><a href='comments.php?unapprove={$comment_id}'>Unapprove</a></td>";
               
                echo "<td><a href='comments.php?del={$comment_id}'>Delete</a></td></tr>";
            }


        ?>

        </tbody>
    </table>
    
    <?php
    
//Unapprove button 
    
        if(isset($_GET['unapprove'])){
            
            $unapprove_id = $_GET['unapprove'];
            
            $unapprove_query = "UPDATE comments SET comment_status = 'unapproved' ";
            $unapprove_query .= "WHERE comment_id = {$unapprove_id}";
            
            $res_unapprove_query = mysqli_query($connection, $unapprove_query);
            
            confirm($res_unapprove_query);
            
            header("Location: comments.php");
            
        }
    
    
//Approve button 
    
         if(isset($_GET['approve'])){
            
            $approve_id = $_GET['approve'];
            
            $approve_query = "UPDATE comments SET comment_status = 'approved' ";
            $approve_query .= "WHERE comment_id = {$approve_id}";
            
            $res_approve_query = mysqli_query($connection, $approve_query);
            
            confirm($res_approve_query);
            
            header("Location: comments.php");
            
        }
    
    
    
//Delete button 
    
        if(isset($_GET['del'])){
            
            $delete_id = $_GET['del'];
            
            $delete_query = "DELETE FROM comments WHERE comment_id = {$delete_id}";
            
            $delete_result = mysqli_query($connection, $delete_query);
            
            header("Location: comments.php");  //reload   refresh
            
        }
    
    ?>
    
</div>