<?php

    if(isset($_GET['u_id'])){
        $edit_user_id = $_GET['u_id'];

        echo $edit_user_id; 
        
        $query_display_user = "SELECT * FROM users WHERE user_id = {$edit_user_id}";
        
        $res_display_user = mysqli_query($connection, $query_display_user);
        
        confirm($res_display_user);
        
        while($row = mysqli_fetch_assoc($res_display_user)){
            $firstname = $row['firstname'];
            $lastname = $row['lastname'];
            $username = $row['username'];
            $email = $row['user_email'];
            $password = $row['password'];
            $user_role = $row['user_role'];
        }
        
        
    }

    if(isset($_POST['submit'])){
    
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $username = $_POST['username'];
    $user_email = $_POST['user_email'];
    $user_role = $_POST['user_role'];
    $password = $_POST['password'];
        
    $query_edit = "UPDATE users SET ";
    $query_edit .= "username = '{$username}', "; 
    $query_edit .= "password = '{$password}', ";
    $query_edit .= "firstname = '{$firstname}', ";
    $query_edit .= "lastname = '{$lastname}', ";
    $query_edit .= "user_email = '{$user_email}', ";
    $query_edit .= "user_role = '{$user_role}' ";
    $query_edit .= "WHERE user_id = {$edit_user_id}";
        
    $res_edit = mysqli_query($connection, $query_edit);
        
    confirm($res_edit);
        
    header("Location: users.php");
    }

?>
   

   
   
<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="post_title">First Name</label>
        <input type="text" class="form-control" name="firstname" value="<?php echo $firstname ?>">
    </div>
    <div class="form-group">
        <label for="post_title">Last Name</label>
        <input type="text" class="form-control" name="lastname" value="<?php echo $lastname ?>">
    </div>
    <div class="form-group">
        <label for="">Role</label>
        <select name="user_role" id="" class="form-control">
            <option value="<?php echo $user_role ?>"><?php echo $user_role ?></option>

            <?php
            
            if($user_role == 'admin'){
                echo "<option value='subscriber'>subscriber</option>";
            } else {
                echo "<option value='admin'>admin</option>";
            }
            
            ?>
            
        </select>
    </div>
    
    
    
    <div class="form-group">
        <label for="">Username</label>
        <input type="text" class="form-control" name="username" value="<?php echo $username ?>">
    </div>
    <div class="form-group">
        <label for="">Email</label>
        <input type="email" class="form-control" name="user_email" value="<?php echo $email ?>">
    </div>
    <div class="form-group">
        <label for="">Password</label>
        <input type="password" class="form-control" name="password" value="<?php echo $password ?>">
    </div>
     
    <div class="form-group">
        <input type="submit" name="submit" class="btn btn-primary" value="Edit User">
    </div>
    
</form>


<div style="margin-top:600px"></div>