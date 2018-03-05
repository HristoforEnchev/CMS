<form action="" method="post">
                                <div class="form-group">
                                    <label for="">Edit Category</label>
                                    
<?php

if( isset($_GET['edit_id'])){
    $edit_id = $_GET['edit_id'];

    $query = "SELECT * FROM categories WHERE cat_id = {$edit_id}";

    $select_cat_id = mysqli_query($connection, $query);

    if(!$select_cat_id){
        die("QUERY FAILED" . mysqli_error($connection));
    }

    while($row = mysqli_fetch_assoc($select_cat_id)){
        $cat_title = $row['cat_title'];
        $cat_id = $row['cat_id'];
 ?>
                                            
                                           <input type="text" name="cat_edit_title" class="form-control" value="<?php if(isset($cat_title)) echo $cat_title  ?>"> 
                                           </div>
                                           <div class="form-group">
                                               <input name="cat_upd_id" type="hidden" value="<?php if(isset($cat_title)) echo $cat_id  ?>">
                                           </div>
                                            
     <?php   
    }


    } 

    ?>
                                    
                                    <?php
                                    
                                    if(isset($_POST['update_cat'])){
                                        
                                        $upd_title = $_POST['cat_edit_title'];
                                        
                                        $upd_id = $_POST['cat_upd_id'];
                                        
                                        $query_upd = "UPDATE categories SET cat_title = '{$upd_title}' ";
                                        $query_upd .= "WHERE cat_id = $upd_id";
                                            
                                        $update_res = mysqli_query($connection, $query_upd);
                                        
                                        if(!$update_res){
                                            die("QUERY FAILED" . mysqli_error($connection));
                                        }
                                        
                                    }
                                    
                                    
                                    
                                    ?>
                                    
                                    
                                
                                <div class="form-group">
                                    <input type="submit" name="update_cat" class="btn btn-default" value="Update Category">
                                </div>
                            </form>