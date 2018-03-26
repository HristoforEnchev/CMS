<?php


function escape($string){

    global $connection;

    return mysqli_real_escape_string($connection, trim($string));

}


function users_online(){

    if (isset($_GET['onlineusers'])) {
       
    

    global $connection;

    session_start();

    include("../includes/db.php");

    $session = session_id();
                                                        
    $time = time();

    $time_out = $time - 60;

                                                    

    $query = "SELECT * FROM users_online WHERE session = '$session' ";  
    $send_query = mysqli_query($connection, $query);
   
    $count = mysqli_num_rows($send_query);


    if ($count == null) {
        mysqli_query($connection, "INSERT INTO users_online VALUES (NULL, '$session', $time)");
    } else {
        mysqli_query($connection, "UPDATE users_online SET time = {$time} WHERE session = '$session'");
    } 
    

    $query_online_users = "SELECT * FROM users_online WHERE time > $time_out";
    $res_online_users = mysqli_query($connection, $query_online_users);
    echo $count_users_online = mysqli_num_rows($res_online_users);

    }

    
}

users_online();


function confirm($result){
    global $connection;
    
    if(!$result){
        die("Query Failed " . mysqli_error($connection));
    }
}

function insert_categories(){
    
    global $connection;
    
    if(isset($_POST['submit'])){

    $category = $_POST['cat_title'];

    if($category == "" || empty($category)){
        echo "This field should not be empty";
    } else {
        $query = "INSERT INTO categories ( cat_title ) VALUES ('$category')";

        $res = mysqli_query($connection, $query);

        if(!$res){
            die("QUERY FAILED" . mysqli_error($connection));
        }

        echo "<div class='alert alert-success'>Category Added</div>";

    }
    }   
    
}


function find_all_ategories(){
    
    global $connection;
    
    $query = "SELECT * FROM categories";

    $res = mysqli_query($connection, $query);

    if(!$res){
        die("Query Failed" . mysqli_error($connection));
    }

    while($row = mysqli_fetch_assoc($res)){
        $category = $row['cat_title'];
        $id = $row['cat_id'];

        echo "<tr>";
        echo "<td>{$id}</td>";
        echo "<td>{$category}</td>";
        echo "<td><a href='categories.php?del_id={$id}'>DELETE</a></td>";
        echo "<td><a href='categories.php?edit_id={$id}'>EDIT</a></td>";
        echo "</tr>";
    }
}


function delete_category(){
    
    global $connection;
    
    if(isset($_GET['del_id'])){

      $cat_id = $_GET['del_id'];

      $query = "DELETE FROM categories WHERE cat_id = $cat_id";

      $res = mysqli_query($connection, $query);

      if(!$res){
          die("QUERY FAILED" . mysqli_error($connection));
      } 

      header("location: categories.php");
    }
    
}











?>