
    

<!--
    echo mysqli_num_rows($result);
    
    mysqli_num_rows()    
-->
   





<div class="col-md-4">




    <!-- Blog Search Well -->
    <div class="well">
        <h4>Blog Search</h4>
        <form action="search.php" method="post">
            <div class="input-group">
                <input name="search" type="text" class="form-control">
                <span class="input-group-btn">
                    <button name="submit" class="btn btn-default" type="submit">
                    <span class="glyphicon glyphicon-search"></span>
                </button>
                </span>
            </div>
        </form><!--seaech form-->
        <!-- /.input-group -->
    </div>






    <!-- Blog Categories Well -->
    <div class="well">
       
       <?php
        
        $query = "SELECT * FROM categories LIMIT 6";
        
        $res = mysqli_query($connection, $query);

        if(!$res){
            die("Query Failed" . mysqli_error($connection));
        }

        
        
        ?>
       
        <h4>Blog Categories</h4>
        <div class="row">
            <div class="col-lg-12">
                <ul class="list-unstyled">
                    <?php
                    
                        while($row = mysqli_fetch_assoc($res)){
            
                        $title = $row['cat_title'];
            
                        echo "<li><a href='#'>$title</a></li>";
                        }
                    
                    ?>
                </ul>
            </div>
            
        </div>
        <!-- /.row -->
    </div>
    
    
    
    

    <!-- Side Widget Well -->
    
    <?php include "widget.php"?>
    
</div>