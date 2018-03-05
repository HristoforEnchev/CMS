<?php

if(isset($_POST['submit'])){
    
    $post_title = $_POST['title'];
    $post_category_id = $_POST['post_category_id'];
    $post_author = $_POST['author'];
    $post_status = $_POST['post_status'];
    
    
    $image_name = $_FILES['image']['name'];
    $image_tmp_name = $_FILES['image']['tmp_name'];
    
    move_uploaded_file($image_tmp_name, "../images/{$image_name}");
    
    
    $post_tags = $_POST['post_tags'];
    $post_content = $_POST['post_content'];
    
    $post_date = date("Y-m-d");               // sql    now()      '2000-12-28'
    $post_comment_count = 4;
    
    $query_insert = "INSERT INTO posts (post_cat_id, post_title, post_author, post_date, post_image, post_content, post_tags, post_comment_count, post_status) ";
    
    $query_insert .= "VALUES ({$post_category_id}, '{$post_title}', '{$post_author}', '{$post_date}', '{$image_name}', '{$post_content}', '{$post_tags}', {$post_comment_count}, '{$post_status}')";
    
    $insert_post = mysqli_query($connection, $query_insert);
    
    confirm($insert_post);
    
    header("Location: posts.php");
}

?>
   

   
   
<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="post_title">Post Title</label>
        <input type="text" class="form-control" name="title">
    </div>
    <div class="form-group">
        <label for="">Post Category Id</label>
        
        <select name="post_category_id" id="" class="form-control">
           <?php
            
                $query_cat_all = "SELECT * FROM categories";

                $select_cat_all = mysqli_query($connection, $query_cat_all);

                confirm($select_cat_all);

                while($row = mysqli_fetch_assoc($select_cat_all)){
                    $cat_title = $row['cat_title'];
                    $cat_id = $row['cat_id'];

                    echo "<option value='{$cat_id}'>{$cat_title}</option>";

                }

            
            ?>
           
            
        </select>
        
        
<!--        <input type="text" class="form-control" name="post_category_id">-->
    </div>
    <div class="form-group">
        <label for="">Post Author</label>
        <input type="text" class="form-control" name="author">
    </div>
    <div class="form-group">
        <label for="">Post Status</label>
        <input type="text" class="form-control" name="post_status">
    </div>
    <div class="form-group">
        <label for="">Post Image</label>
        <input type="file"  name="image">
    </div>
    <div class="form-group">
        <label for="">Post Tags</label>
        <input type="text" class="form-control" name="post_tags">
    </div>
     <div class="form-group">
        <label for="">Post Content</label>
        <textarea name="post_content" id="" cols="30" rows="5" class="form-control"></textarea>
    </div>
    <div class="form-group">
        <input type="submit" name="submit" class="btn btn-primary" value="Add Post">
    </div>
    
</form>


<div style="margin-top:600px"></div>