<?php  include "includes/db.php"; ?>
 <?php  include "includes/header.php"; ?>
 
    <?php
        
        if(isset($_POST['submit'])){
            
            $username = mysqli_real_escape_string($connection, $_POST['username']);
            $email = mysqli_real_escape_string($connection, $_POST['email']);
            $password = mysqli_real_escape_string($connection, $_POST['password']);
            //$password = $_POST['password'];
            
            if(!empty($username) && !empty($email) && !empty($password)){
                
                // $query = "SELECT rand_salt FROM users LIMIT 1";
                // $select_rand_salt_query = mysqli_query($connection, $query);

                // if(!$select_rand_salt_query){
                //     die("QUERY FAILED" . mysqli_error($connection));
                // }

                // $row = mysqli_fetch_assoc($select_rand_salt_query);
                // $salt = $row['rand_salt'];
                
                // $password = crypt($password, $salt);
                
                $password = password_hash($password, PASSWORD_DEFAULT, array('cost' => 12));

                $query = "INSERT INTO users (username, user_email, password, user_role) ";
                $query .= "VALUES ('{$username}', '{$email}', '{$password}', 'subscriber')";
                
                $result_insert = mysqli_query($connection, $query);
                
                if(!$result_insert){
                    die("QUERY FAILED" . mysqli_error($connection) . ' ' . mysqli_errno($connection));
                }
                
                $message = "Your registration has been submitted!";
                
            } else {
                $val_mess = "Fields can not be empty!";
            }
            
            
                
            
        }







    ?>
 


    <!-- Navigation -->
    
    <?php  include "includes/navigation.php"; ?>
    
 
    <!-- Page Content -->
    <div class="container">
    
<section id="login">
    <div class="container">
        <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
                <div class="form-wrap">
                <h1>Register</h1>
                   <?php
                    
                    if(isset($val_mess)){
                        echo $val_mess;
                    }
                    if(isset($message)){
                        echo "<div class='alert alert-success'>{$message}</div>";
                    }
                        
                    ?>
                    
                    <form role="form" action="registration.php" method="post" id="login-form" autocomplete="off">
                        <div class="form-group">
                            <label for="username" class="sr-only">username</label>
                            <input type="text" name="username" id="username" class="form-control" placeholder="Enter Desired Username">
                        </div>
                         <div class="form-group">
                            <label for="email" class="sr-only">Email</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="somebody@example.com">
                        </div>
                         <div class="form-group">
                            <label for="password" class="sr-only">Password</label>
                            <input type="password" name="password" id="key" class="form-control" placeholder="Password">
                        </div>
                
                        <input type="submit" name="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Register">
                    </form>
                 
                </div>
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>


        <hr>



<?php include "includes/footer.php";?>
