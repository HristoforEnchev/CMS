<?php

if(isset($_SESSION['confirm'])){
    echo "<div class='alert alert-danger'>{$_SESSION['confirm']}</div>";
}

$_SESSION['confirm'] = null;

?>
  
<?php

include "delete_modal.php";


    
if(isset($_POST['checkBoxArray'])){
    
    $arrCheckBox = $_POST['checkBoxArray'];
    
    foreach($arrCheckBox as $checkId){
        
        
        $bulk_options = $_POST['bulk_options'];
        
        switch($bulk_options){
            case 'published':
            $query_publish = "UPDATE posts SET post_status = 'published' WHERE post_id = {$checkId}";
            $res_publish = mysqli_query($connection, $query_publish);
            break;
                
            case 'draft':
            $query_draft = "UPDATE posts SET post_status = 'draft' WHERE post_id = {$checkId}";
            $res_draft = mysqli_query($connection, $query_draft);
            break;
                
            case 'delete':
            $query_delete = "DELETE FROM posts WHERE post_id = {$checkId}";
            $res_delete = mysqli_query($connection, $query_delete);
            break;
                
            case 'clone':
            $query_clone = "INSERT INTO posts (post_cat_id, post_title, post_author, post_date, post_image, post_content, post_tags, post_comment_count, post_status) ";
             
            $query_clone .= "SELECT post_cat_id, post_title, post_author, post_date, post_image, post_content, post_tags, post_comment_count, post_status FROM posts ";
                
            $query_clone .= "WHERE post_id = {$checkId}";
                
            $res_clone = mysqli_query($connection, $query_clone);
            
                
            break;
        }
        
    }
}
?>
  
  
  
  
  
   
<form action="" method="post">
   <div class="row">
       <div class="col-xs-4">
            <select name="bulk_options" id="" class="form-control">
                <option value="">Select Options</option>
                <option value="published">Publish</option>
                <option value="draft">Draft</option>
                <option value="delete">Delete</option>
                <option value="clone">Clone</option>
            </select>
       </div>
       <div class="col-xs-4">
           <input type="submit" name="submit" class="btn btn-success" value="Apply" >
           <a href="posts.php?source=add_post" class="btn btn-primary" >Add New</a>
       </div>
    </div>
    

   
   <hr>
   
<div class="table-responsive">
    <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th><input id="selectAllBoxes" type="checkbox"></th>
                <th>Id</th>
                <th>Author</th>
                <th>Title</th>
                <th>Category</th>
                <th>Status</th>
                <th>Image</th>
                <th>Tags</th>
                <th>Comments</th>
                <th>Date</th>
                <th>View</th>
                <th>Edit</th>
                <th>Delete</th>
                <th>Views</th>
            </tr>
        </thead>

        <tbody>
        <?php
            $query_posts_all = "SELECT * FROM posts ORDER BY post_id DESC";
            $select_posts_all = mysqli_query($connection, $query_posts_all);
            if(!$select_posts_all){
                die("QUERY FAILED" . mysqli_error($connection));
            }
            while($row = mysqli_fetch_assoc($select_posts_all)){
                $post_image = $row['post_image'];
                $post_image_src = "../images/{$post_image}";
                
                $post_id = $row['post_id'];

                echo "<tr>";
                
                ?>
                
                <td><input class='checkBoxes' type='checkbox' name='checkBoxArray[]' value='<?php echo $post_id; ?>' ></td>
                
                <?php
                
                echo "<td>{$row['post_id']}</td>";
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

                $query_com_count = "SELECT * FROM comments WHERE comment_post_id = $post_id";
                $res_com_count = mysqli_query($connection, $query_com_count);
                $comments_count = mysqli_num_rows($res_com_count);


                echo "<td><a href='comments.php?source=comments&post_id={$post_id}'>{$comments_count}</a></td>";
                echo "<td>{$row['post_date']}</td>";
                
                echo "<td><a href='../post.php?id={$post_id}'>View</a></td>";
                echo "<td><a href='posts.php?source=edit_post&p_id={$post_id}'>Edit</a></td>";
                
                // JavaScript Confirm on Delete 
                 // echo "<td><a onclick=\" return confirm('Are you sure you want to delete the post?'); \" href='posts.php?del={$post_id}'>Delete</a></td>";

                
                echo "<td><a rel='$post_id' href='javascript:void(0)' class='delete_link' >Delete</a></td>";

                
                echo "<td><a onclick=\" return confirm('Are you sure you want to reset the count?'); \" href='posts.php?reset={$post_id}'>{$row['post_views_count']}</a></td></tr>";
                
            }


        ?>

        </tbody>
    </table>
    
  </div>
</form>
   
    
    <?php
    
        if(isset($_GET['del'])){
            
            $delete_id = escape($_GET['del']);
            
            $delete_query = "DELETE FROM posts WHERE post_id = {$delete_id}";
            
            $delete_result = mysqli_query($connection, $delete_query);
            
            header("Location: posts.php");     // reload  refresh
            
            
            
            
        }

        if(isset($_GET['reset'])){
            
            $reset_id = escape($_GET['reset']);
            
            $reset_query = "UPDATE posts SET post_views_count = 0 WHERE post_id = {$reset_id}";
            
            $reset_result = mysqli_query($connection, $reset_query);
            
            header("Location: posts.php");     // reload  refresh
            
            
            
            
        }
    
    ?>


<script>
    
    $(document).ready(function(){

        $(".delete_link").on('click', function(){

            var id = $(this).attr('rel');

            var delete_url = `posts.php?del=${id}`;

            $(".modal_delete_link").attr('href', delete_url);


            $("#exampleModal").modal("show");
        });




    });

</script>
    
