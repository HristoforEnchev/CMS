<?php include "includes/db.php" ?>
<?php include "includes/header.php"; ?>


    <!-- Navigation -->
<?php include "includes/navigation.php"; ?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">

                <h1 class="page-header">
                    Page Heading
                    <small>Secondary Text</small>
                </h1>
                
                <?php
                
                if(isset($_GET['id'])){
                
                $post_id = escape($_GET['id']);
                    
                $query_update_post_count = "UPDATE posts SET post_views_count = post_views_count + 1 WHERE post_id = {$post_id}";
                    
                $res_update_count = mysqli_query($connection, $query_update_post_count);
                    
                    
                    
                $query = "SELECT * FROM posts WHERE post_id = {$post_id}";
                
                $result = mysqli_query($connection, $query);
                
                while($row = mysqli_fetch_assoc($result)){
                    
                    $post_title = $row['post_title'];
                    $post_author = $row['post_author'];
                    $post_date = $row['post_date'];
                    $post_image = $row['post_image'];
                    $post_content = $row['post_content'];

                    
                ?>
                
                <!-- First Blog Post -->
                <h2>
                    <a href="#"><?php echo $post_title; ?></a>
                </h2>
                <p class="lead">
                    by <a href="author_posts.php?author=<?php echo $post_author; ?>"><?php echo $post_author; ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> <?php echo $post_date; ?> Posted on August 28, 2013 at 10:00 PM</p>
                <hr>
                <img class="img-responsive" src="images/<?php echo $post_image; ?>" alt="">
                <hr>
                <p><?php echo $post_content; ?></p>
               
                <hr>
                
                <?php
                
                }
                } else {
                    header("Location: index.php");
                }
                ?>
                
                
                
                
                
                
                
                
                

                
                <!-- Blog Comments -->
                
                <?php

                if(isset($_POST['add_comment'])){
                    
                $post_id = escape($_GET['id']);

                $comment_author = escape($_POST['comment_author']);
                $comment_email = escape($_POST['comment_email']);
                $comment_content = escape($_POST['comment_content']);
                    
                if(!empty($comment_author) && !empty($comment_email) && !empty($comment_content)){

                    $query_add_comment = "INSERT INTO comments VALUES ";
                    $query_add_comment .= "( NULL, {$post_id}, '{$comment_author}', '{$comment_email}', ";
                    $query_add_comment .= "'{$comment_content}', 'unapproved', now())";  
                        
                    $insert_post = mysqli_query($connection, $query_add_comment);
                        
                    if(!$query_add_comment){
                        die("Query Failed " . mysqli_error($connection));
                    }
                    
                        
                    // $query_add_com_count = "UPDATE posts SET post_comment_count = post_comment_count + 1 ";
                    // $query_add_com_count .= "WHERE post_id = {$post_id}";
                        
                    // $upd_add_com_count = mysqli_query($connection, $query_add_com_count);
                    
                    
                   
                } else {
                    echo "<script>alert('Fields can not be empty!');</script>";
                }
                    
                }
                
                ?>




                <!-- Comments Form -->
                <div class="well">
                    <h4>Leave a Comment:</h4>
                    <form action="" method="post">
                        <div class="form-group">
                            <label for="">Email</label>
                            <input name="comment_email" type="email" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="">Author</label>
                            <input name="comment_author" type="text" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="">Comment</label>
                            <textarea name="comment_content" class="form-control" rows="3"></textarea>
                        </div>

                        <button type="submit" name="add_comment" class="btn btn-primary">Submit</button>
                    </form>
                </div>

                <hr>

                <!-- Posted Comments -->
                
                
<?php

$post_id = escape($_GET['id']);

$query_com_by_postId_app = "SELECT * FROM comments WHERE comment_post_id = {$post_id} AND ";
$query_com_by_postId_app .= "comment_status = 'approved' ";
$query_com_by_postId_app .= "ORDER BY comment_id DESC";      
                
$res_query_com_by_postId_app = mysqli_query($connection, $query_com_by_postId_app);
                
if(!$res_query_com_by_postId_app){
    die("QUERY FAILED " . mysqli_error($connection));
}

while($row_com = mysqli_fetch_assoc($res_query_com_by_postId_app)){
    
    $comment_date = $row_com['comment_date'];
    $comment_content = $row_com['comment_content'];
    $comment_author = $row_com['comment_author'];
?>
   
   <!-- Comment -->
        <div class="media">
            <a class="pull-left" href="#">
                <img class="media-object" src="http://placehold.it/64x64" alt="">
            </a>
            <div class="media-body">
                <h4 class="media-heading"><?php echo $comment_author ?>
                    <small><?php echo $comment_date ?></small>
                </h4>
                <?php echo $comment_content ?>
            </div>
        </div>
  
    
    
<?php   
}               
?>
                
                

                
                
                

            </div>

            <!-- Blog Sidebar Widgets Column -->

<?php include "includes/sidebar.php"; ?>
       
        </div>
        <!-- /.row -->

        <hr>
        
<?php include "includes/footer.php"; ?>
       
       <div style="margin-top:700px;"></div>

       