<?php include "includes/db.php" ?>
<?php include "includes/header.php"; ?>


    <!-- Navigation -->
<?php include "includes/navigation.php"; ?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">

                
                
                <?php
                
                if(isset($_GET['cat_id'])){
                    $post_cat_id = escape($_GET['cat_id']);
                }
                
                $query = "SELECT * FROM posts WHERE post_cat_id = {$post_cat_id} AND post_status = 'published'";
                
                $result = mysqli_query($connection, $query);

                if (mysqli_num_rows($result) < 1) {
                    echo "<h1 class='text-center' >There is no published Posts!</h1>";
                } else {

                ?>

                <h1 class="page-header">
                    Page Heading
                    <small>Secondary Text</small>
                </h1>
                
                <?php

                while($row = mysqli_fetch_assoc($result)){
                    
                    $post_id = $row['post_id'];
                    $post_title = $row['post_title'];
                    $post_author = $row['post_author'];
                    $post_date = $row['post_date'];
                    $post_image = $row['post_image'];
                    $post_content = $row['post_content'];
                    
                ?>
                
                <!-- First Blog Post -->
                <h2>
                    <a href="post.php?id=<?php echo $post_id ?>"><?php echo $post_title; ?></a>
                    <h2>Id is <?php echo $post_id ?></h2>
                </h2>
                <p class="lead">
                    by <a href="index.php"><?php echo $post_author; ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> <?php echo $post_date; ?> Posted on August 28, 2013 at 10:00 PM</p>
                <hr>
                <a href="post.php?id=<?php echo $post_id ?>">
                    <img class="img-responsive" src="images/<?php echo $post_image; ?>" alt="">
                </a>
                <hr>
                <p><?php echo $post_content; ?></p>
                <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>
                <hr>
                
                <?php
                
                }

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

       