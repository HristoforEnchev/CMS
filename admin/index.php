<?php include "includes/admin_header.php"; ?>

    <div id="wrapper">



        <!-- Navigation -->
        
        <?php include "includes/admin_navigation.php" ?>    
        
        

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        
                           
                        <h1 class="page-header">
                            Welcomeeeeee to Admin area
                            <small><?php echo $_SESSION['username'] . " " . session_id(); ?></small>
                        </h1>


                        
                        
                        
                    </div>
                </div>
                <!-- /.row -->
                
                
                
                
       
                <!-- /.row -->
                
<div class="row">
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-file-text fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                    
                    <?php
                        
                       $query = "SELECT * FROM posts";
                       $res = mysqli_query($connection, $query);
                        
                       $num_posts = mysqli_num_rows($res);
                        
                        
                        
                    ?>
                    
                    
                  <div class='huge'><?php echo $num_posts; ?></div>
                        <div>Posts</div>
                    </div>
                </div>
            </div>
            <a href="posts.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-green">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-comments fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                    
                    <?php
                        
                       $query = "SELECT * FROM comments";
                       $res = mysqli_query($connection, $query);
                        
                       $num_comments = mysqli_num_rows($res);
                        
                        
                        
                    ?>
                    
                     <div class='huge'><?php echo $num_comments; ?></div>
                      <div>Comments</div>
                    </div>
                </div>
            </div>
            <a href="comments.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-yellow">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-user fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                    
                    <?php
                        
                       $query = "SELECT * FROM users";
                       $res = mysqli_query($connection, $query);
                        
                       $num_users = mysqli_num_rows($res);
                        
                        
                        
                    ?>
                    
                    <div class='huge'><?php echo $num_users; ?></div>
                        <div> Users</div>
                    </div>
                </div>
            </div>
            <a href="users.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-red">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-list fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                       
                       <?php
                        
                       $query = "SELECT * FROM categories";
                       $res = mysqli_query($connection, $query);
                        
                       $num_categories = mysqli_num_rows($res);
                        
                        
                        
                       ?>
                       
                        <div class='huge'><?php echo $num_categories; ?></div>
                         <div>Categories</div>
                    </div>
                </div>
            </div>
            <a href="categories.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
</div>
                <!-- /.row -->
                
                
                <?php
                
                $query = "SELECT * FROM posts WHERE post_status = 'published'";
                $res_published = mysqli_query($connection, $query);
                $num_published_posts = mysqli_num_rows($res_published);
                
                $query = "SELECT * FROM posts WHERE post_status = 'draft'";
                $res_draft = mysqli_query($connection, $query);
                $num_draft_posts = mysqli_num_rows($res_draft);
                        
                $query = "SELECT * FROM comments WHERE comment_status = 'unapproved'";
                $res_unapproved = mysqli_query($connection, $query);
                $num_unapproved_comments = mysqli_num_rows($res_unapproved);
                
                $query = "SELECT * FROM users WHERE user_role = 'subscriber'";
                $res_subscriber = mysqli_query($connection, $query);
                $num_subscribers = mysqli_num_rows($res_subscriber);
                
                
                
                ?>
                
                
                
                <!-- blue chart -->
      
                <div class="row">
                    <script type="text/javascript">
                      google.charts.load('current', {'packages':['bar']});
                      google.charts.setOnLoadCallback(drawChart);

                      function drawChart() {
                        var data = google.visualization.arrayToDataTable([
                          ['Data', 'Count'],
                            
                            <?php
                            
                            
                            echo "['All Posts', {$num_posts}],";
                            echo "['Active Posts', {$num_published_posts}],";
                            echo "['Draft Posts', {$num_draft_posts}],";
                            echo "['Comments', {$num_comments}],";
                            echo "['Unapproved Comments', {$num_unapproved_comments}],";
                            echo "['Users', {$num_users}],";
                            echo "['Subscribers', {$num_subscribers}],";
                            echo "['Categories', {$num_categories}]";
                            
                            
                            ?>
                            
                            
                            
                            
                          
                        ]);

                        var options = {
                          chart: {
                            title: '',
                            subtitle: '',
                          }
                        };

                        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

                        chart.draw(data, google.charts.Bar.convertOptions(options));
                      }
                    </script>
                    <div id="columnchart_material" style="width: 'auto'; height: 500px;"></div>
                    
                </div>          
                
                
                

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->
        

    </div>
    <!-- /#wrapper -->

<?php include "includes/admin_footer.php"; ?>