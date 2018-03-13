<?php include "db.php"; ?>
<?php session_start(); ?>


<?php

if(isset($_POST['submit'])){
    $username = $_POST['username'];    
    $password = $_POST['password'];      // prevent sql injection
    
    $username = mysqli_real_escape_string($connection, $username);
    $password = mysqli_real_escape_string($connection, $password);
    
    $query = "SELECT * FROM users WHERE username = '$username' ";
    
    $select_query = mysqli_query($connection, $query);
    
    if(!$select_query){
        die("QUERY FAILED" . mysqli_error($connection));
    }
    
    while($row = mysqli_fetch_array($select_query)){
        
        $user_id = $row['user_id'];
        $user_username = $row['username'];
        $user_password = $row['password'];
        $user_firstname = $row['firstname'];
        $user_lastname = $row['lastname'];
        $user_role = $row['user_role'];
    }
    
    
    
    if ($username === $user_username && $user_password === $password){
        
        $_SESSION['username'] = $user_username;
        $_SESSION['firstname'] = $user_firstname;
        $_SESSION['lastname'] = $user_lastname;
        $_SESSION['user_role'] = $user_role;
        
        
        
        header("Location: ../admin");
    } else {
        header("Location: ../index.php");
    }
    
    
    
//    if($username !== $user_username || $user_password !== $password){
//        header("Location: ../index.php");
//    } else if ($username == $user_username && $user_password == $password){
//        
//        $_SESSION['username'] = $user_username;
//        $_SESSION['firstname'] = $user_firstname;
//        $_SESSION['lastname'] = $user_lastname;
//        $_SESSION['user_role'] = $user_role;
//        
//        
//        
//        header("Location: ../admin");
//    }
    
    
    
}



?>