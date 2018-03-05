<?php

    if(isset($_GET['p_id'])){
        $edit_post_id = $_GET['p_id'];

        echo $edit_post_id;  
    }

    $query_post_id = "SELECT * FROM posts WHERE post_id = {$edit_post_id}";

    $select_post_id = mysqli_query($connection, $query_post_id);

    if(!$select_post_id){
        die("QUERY FAILED" . mysqli_error($connection));
    }

    while($row = mysqli_fetch_assoc($select_post_id)){
        $post_image = $row['post_image'];
        $post_image_src = "../images/{$post_image}";

        $post_id = $row['post_id'];
        $post_cat_id = $row['post_cat_id'];
        $post_author = $row['post_author'];
        $post_status = $row['post_status'];
        $post_tags = $row['post_tags'];
        $post_content = $row['post_content'];
        $post_title = $row['post_title'];
    }

// Edit Part

    if(isset($_POST['edit'])){
        
        $edit_title = $_POST['title'];
        $edit_author = $_POST['author'];
        $edit_status = $_POST['post_status'];
        $edit_tags = $_POST['post_tags'];
        $edit_content = $_POST['post_content'];
        
        
        $edit_category_id = $_POST['post_category_id'];
        if($edit_category_id == 0){
            $query_cat_id = "SELECT * FROM posts WHERE post_id = {$edit_post_id}";
            
            $select_cat_id = mysqli_query($connection, $query_cat_id);
            
            confirm($select_cat_id);
            
            while($row = mysqli_fetch_assoc($select_cat_id)){
                $edit_category_id = $row['post_cat_id'];
            }
        } 


        $edit_image_name = $_FILES['image']['name'];
        $edit_image_tmp_name = $_FILES['image']['tmp_name'];

        move_uploaded_file($edit_image_tmp_name, "../images/{$edit_image_name}");
        
        if(empty($edit_image_name)){
            
            $query_img = "SELECT * FROM posts WHERE post_id = {$edit_post_id}";
            
            $select_img_id = mysqli_query($connection, $query_img);
            
            confirm($select_img_id);
            
            while($row = mysqli_fetch_assoc($select_img_id)){
                $edit_image_name = $row['post_image'];
            }
            
        }
        
        $query_up = "UPDATE posts SET ";
        $query_up .= "post_cat_id = {$edit_category_id}, ";
        $query_up .= "post_title = '{$edit_title}', ";
        $query_up .= "post_date = now(), ";
        $query_up .= "post_author = '{$edit_author}', ";
        $query_up .= "post_status = '{$edit_status}', ";
        $query_up .= "post_tags = '{$edit_tags}', ";
        $query_up .= "post_content = '{$edit_content}', ";
        $query_up .= "post_image = '{$edit_image_name}' ";
        $query_up .= "WHERE post_id = {$edit_post_id}";
        
        $update_post = mysqli_query($connection, $query_up);
        
        confirm($update_post);
    }

?>
   
   
<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="post_title">Post Title</label>
        <input type="text" class="form-control" name="title" value="<?php echo $post_title ?>">
    </div>
    
    <div class="form-group">
        <label for="">Post Category Id</label>
        <select name="post_category_id" id="" class="form-control">
          <option value='0'>Edit</option>
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
    
<!--
        <label for="">Post Category Id</label>
        <input value="<?php echo $post_cat_id ?>" type="text" class="form-control" name="post_category_id">
-->
    </div>
    
    <div class="form-group">
        <label for="">Post Author</label>
        <input value="<?php echo $post_author ?>" type="text" class="form-control" name="author">
    </div>
    <div class="form-group">
        <label for="">Post Status</label>
        <input value="<?php echo $post_status ?>" type="text" class="form-control" name="post_status">
    </div>
    
    <div class="form-group">
        <div><img width="180px" src="../images/<?php echo $post_image; ?>" alt=""></div>
        
        <label for="">Post Image</label>
        <input type="file"  name="image">
    </div>
    
    <div class="form-group">
        <label for="">Post Tags</label>
        <input value="<?php echo $post_tags ?>" type="text" class="form-control" name="post_tags">
    </div>
     <div class="form-group">
        <label for="">Post Content</label>
        <textarea name="post_content" id="" cols="30" rows="5" class="form-control"><?php echo $post_content; ?></textarea>
    </div>
    <div class="form-group">
        <input type="submit" name="edit" class="btn btn-primary" value="Edit Post">
    </div>
    
</form>


<div style="margin-top:600px"></div>