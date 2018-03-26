<?php

if(isset($_POST['submit'])){
    
    $firstname = escape($_POST['firstname']);
    $lastname = escape($_POST['lastname']);
    $username = escape($_POST['username']);
    $user_email = escape($_POST['user_email']);
    $user_role = escape($_POST['user_role']);
    $password = escape($_POST['password']);
    
    
    
    
//    $image_name = $_FILES['image']['name'];
//    $image_tmp_name = $_FILES['image']['tmp_name'];
//    
//    move_uploaded_file($image_tmp_name, "../images/{$image_name}");
    
    
    $password = password_hash($password, PASSWORD_DEFAULT, array('cost' => 12));
    
    $query_insert = "INSERT INTO users (username, password, firstname, lastname, user_email, user_image, user_role)";
    
    $query_insert .= "VALUES ('{$username}', '{$password}', '{$firstname}', '{$lastname}', '{$user_email}', '', '{$user_role}')";
    
    $insert_user = mysqli_query($connection, $query_insert);
    
    confirm($insert_user);
    
    header("Location: users.php");
}

?>
   

   
   
<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="post_title">First Name</label>
        <input type="text" class="form-control" name="firstname">
    </div>
    <div class="form-group">
        <label for="post_title">Last Name</label>
        <input type="text" class="form-control" name="lastname">
    </div>
    <div class="form-group">
        <label for="">Role</label>
        <select name="user_role" id="" class="form-control">
            <option value="subscriber">subscriber</option>
            <option value="admin">admin</option>
        </select>
    </div>
    
    
    
    
    
<!--
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

    </div>
-->
    
    <div class="form-group">
        <label for="">Username</label>
        <input type="text" class="form-control" name="username">
    </div>
    <div class="form-group">
        <label for="">Email</label>
        <input type="email" class="form-control" name="user_email">
    </div>
    <div class="form-group">
        <label for="">Password</label>
        <input type="password" class="form-control" name="password">
    </div>
<!--
    <div class="form-group">
        <label for="">Post Image</label>
        <input type="file"  name="image">
    </div>
-->
    
     
    <div class="form-group">
        <input type="submit" name="submit" class="btn btn-primary" value="Add User">
    </div>
    
</form>


<div style="margin-top:600px"></div>