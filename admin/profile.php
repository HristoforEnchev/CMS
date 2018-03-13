<?php include "includes/admin_header.php"; ?>
<?php session_start(); ?>

    <div id="wrapper">

    <!-- Navigation -->
        
    <?php include "includes/admin_navigation.php" ?>  
        
        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Welcome to Admin area
                            <small>Profile <?php echo $_SESSION['username']; ?></small>
                        </h1>
                           <?php
                                
                                $username = $_SESSION['username'];
                        
                                $query = "SELECT * FROM users WHERE username = '{$username}'";
                        
                                $res = mysqli_query($connection, $query);
                        
                                confirm($res);
                        
                                while($row = mysqli_fetch_assoc($res)){
                                    $users_id = $row['user_id'];
                                    $username = $row['username'];
                                    $firstname = $row['firstname'];
                                    $lastname = $row['lastname'];
                                    $email = $row['user_email'];
                                    $user_role = $row['user_role'];
                                    $password = $row['password'];
                                }
                        
                        
                            ?>
                            
                            <?php
                        
                            if(isset($_POST['update'])){
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
                                $query_edit .= "WHERE user_id = {$users_id}";

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
                                    <input type="submit" name="update" class="btn btn-primary" value="Update Profile">
                                </div>

                            </form>

                    </div>
                </div>

            </div>
        <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

<?php include "includes/admin_footer.php"; ?>