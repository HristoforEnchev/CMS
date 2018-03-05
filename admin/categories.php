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
                            Welcome to Admin area
                            <small>Author Forko</small>
                        </h1>
                    </div>
                </div>
                
                
                
                <div class="row">

                <!-- Add Cattegory Form -->
                <div class="col-md-6">
                           
                <?php insert_categories(); ?>

                    <!-- Add Cattegory Form -->
                    <form action="" method="post">
                        <div class="form-group">
                            <label for="">Add Category</label>
                            <input type="text" name="cat_title" class="form-control">
                        </div>
                        <div class="form-group">
                            <input type="submit" name="submit" class="btn btn-default" value="Add Category">
                        </div>
                    </form>

                    <!-- Update Cattegory Form -->
                    <?php 

                    if(isset($_GET['edit_id'])){
                        include "includes/edit_cat.php";
                    }

                    ?>      
                            
                </div>
                        
                        
                <!-- Categories table -->
                <div class="col-md-6">
                
                <!-- Handle categories table -->
                
                          
                   <label for="">Categories</label>
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Category Title</th>
                                <th>Delete Cat</th>
                                <th>Edit Cat</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php delete_category(); ?>
                           
                            <?php find_all_ategories(); ?>
                        </tbody>
                    </table>
                </div><!-- Categories table -->
                        
             </div><!-- div row -->
               

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

<?php include "includes/admin_footer.php"; ?>