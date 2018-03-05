<div class="table-responsive">
    <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th>Id</th>
                <th>Author</th>
                <th>Title</th>
                <th>Category</th>
                <th>Status</th>
                <th>Image</th>
                <th>Tags</th>
                <th>Comments</th>
                <th>Date</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </thead>

        <tbody>
        <?php
            $query_posts_all = "SELECT * FROM posts";
            $select_posts_all = mysqli_query($connection, $query_posts_all);
            if(!$select_posts_all){
                die("QUERY FAILED" . mysqli_error($connection));
            }
            while($row = mysqli_fetch_assoc($select_posts_all)){
                $post_image = $row['post_image'];
                $post_image_src = "../images/{$post_image}";
                
                $post_id = $row['post_id'];

                echo "<tr><td>{$row['post_id']}</td>";
                echo "<td>{$row['post_author']}</td>";
                echo "<td>{$row['post_title']}</td>";
                
                $post_cat_id = $row['post_cat_id'];
                
                $query_cat_title = "SELECT * FROM categories WHERE cat_id = {$post_cat_id}";
                $select_cat_title = mysqli_query($connection, $query_cat_title);
                
                confirm($select_cat_title);
                
                while($row_cat = mysqli_fetch_assoc($select_cat_title)){
                    $cat_title = $row_cat['cat_title'];
                }
                
                
                
                
                echo "<td>{$cat_title}</td>";
                echo "<td>{$row['post_status']}</td>";
                echo "<td><img width='70px' src='{$post_image_src}' alt=''></td>";  //style='width:70px;'  class='img-responsive'
                echo "<td>{$row['post_tags']}</td>";
                echo "<td>{$row['post_comment_count']}</td>";
                echo "<td>{$row['post_date']}</td>";
                echo "<td><a href='posts.php?source=edit_post&p_id={$post_id}'>Edit</a></td>";
                echo "<td><a href='posts.php?del={$post_id}'>Delete</a></td></tr>";
            }


        ?>

        </tbody>
    </table>
    
    <?php
    
        if(isset($_GET['del'])){
            
            $delete_id = $_GET['del'];
            
            $delete_query = "DELETE FROM posts WHERE post_id = {$delete_id}";
            
            $delete_result = mysqli_query($connection, $delete_query);
            
            header("Location: posts.php");     // reload  refresh
            
            
            
            
        }
    
    
    
    
    
    
    ?>
    
</div>