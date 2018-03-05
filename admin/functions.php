<?php

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