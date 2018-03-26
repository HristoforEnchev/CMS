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

                $query_count_rows = "SELECT * FROM posts WHERE post_status = 'published'";

                $res_count_rows = mysqli_query($connection, $query_count_rows);

                $rows_count = mysqli_num_rows($res_count_rows);

                                                                //echo $rows_count . "<br>";

                $total_pages = ceil($rows_count / 5);

                                                                //echo $total_pages . "<br>";




                if (isset($_GET['page'])) {
                   
                    $page = escape($_GET['page']);
                    

                } else {
                    $page = 1;
                }

                //echo($page);

                $pages_to_skip = ($page - 1) * 5;



                
                $query = "SELECT * FROM posts WHERE post_status = 'published' LIMIT $pages_to_skip, 5";
                
                $result = mysqli_query($connection, $query);
                
                $rows = mysqli_num_rows($result);      //!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
                
                
                
                if($rows < 1){
                    echo "<h1 class='text-center' >There is no published Posts!</h1>";
                } else {

                ?>
                <h1 class="page-header">
                    Page Heading
                    <small>Secondary Text <?php echo phpversion(); ?></small>
                </h1>  
                
                <?php

                while($row = mysqli_fetch_assoc($result)){
                    
                    
                    $post_id = $row['post_id'];
                    $post_cat_id = $row['post_cat_id'];
                    $post_title = $row['post_title'];
                    $post_author = $row['post_author'];
                    $post_date = $row['post_date'];
                    $post_image = $row['post_image'];
                    $post_content = substr($row['post_content'], 0, 50);


                    $query_category = "SELECT * FROM categories WHERE cat_id = {$post_cat_id}";

                    $res_cat = mysqli_query($connection, $query_category);

                    $row_cat = mysqli_fetch_assoc($res_cat);

                    $cat_title = $row_cat['cat_title'];
                    
                    
                ?>
                
                <!-- First Blog Post -->
                <h2>
                    <a href="post.php?id=<?php echo $post_id ?>"><?php echo $post_title; ?></a>
                </h2>
                <p class="lead">Category <?php echo $cat_title ; ?></p>
            
                <p class="lead">
                    by <a href="author_posts.php?author=<?php echo $post_author; ?>"><?php echo $post_author; ?></a> 
                </p>
                <p><span class="glyphicon glyphicon-time"></span> <?php echo $post_date; ?> Id is <?php echo $post_id ?></p>
                <br>
                <a href="post.php?id=<?php echo $post_id ?>">
                    <img class="img-responsive" src="images/<?php echo $post_image; ?>" alt="">
                </a>
                <br>
                <p><?php echo $post_content; ?></p>
                <a class="btn btn-primary" href="post.php?id=<?php echo $post_id ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>
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



        <!-- pagination -->
        <ul class="pager">

            <?php 

            for ($i=1; $i <= $total_pages; $i++) { 

                if ($i == $page) {
                   $current_page = "active-page";
                } else {
                    $current_page = "";
                }

                echo "<li><a id='{$current_page}' href='index.php?page={$i}'>{$i}</a></li>";
            }

            ?>
        </ul>


        <hr>
        
<?php include "includes/footer.php"; ?>
       
       <div style="margin-top:700px;"></div>



       