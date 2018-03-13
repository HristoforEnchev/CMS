<div class="table-responsive">
    <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th>Id</th>
                <th>Username</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Admin</th>
                <th>Subscriber</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </thead>

        <tbody>
        <?php
            $query_users_all = "SELECT * FROM users";
            $select_users_all = mysqli_query($connection, $query_users_all);
            
            confirm($select_users_all);
            
            while($row = mysqli_fetch_assoc($select_users_all)){
                
                $users_id = $row['user_id'];
                $username = $row['username'];
                $firstname = $row['firstname'];
                $lastname = $row['lastname'];
                $user_email = $row['user_email'];
                $user_role = $row['user_role'];
                
                echo "<tr><td>{$users_id}</td>";
                echo "<td>{$username}</td>";
                echo "<td>{$firstname}</td>";
                echo "<td>{$lastname}</td>";
                echo "<td>{$user_email}</td>";
                echo "<td>{$user_role}</td>";
                
                echo "<td><a href='users.php?to_admin={$users_id}'>To Admin</a></td>";
                echo "<td><a href='users.php?to_subscriber={$users_id}'>To Subscriber</a></td>";
                
                echo "<td><a href='users.php?source=edit_user&u_id={$users_id}'>Edit</a></td>";
                echo "<td><a href='users.php?del={$users_id}'>Delete</a></td></tr>";
            }


        ?>

        </tbody>
    </table>
    
    <?php
    
//change to admin 
    
        if(isset($_GET['to_admin'])){
            
            $to_admin_id = $_GET['to_admin'];
            
            $to_admin_query = "UPDATE users SET user_role = 'admin' ";
            $to_admin_query .= "WHERE user_id = {$to_admin_id}";
            
            $res_to_admin_query = mysqli_query($connection, $to_admin_query);
            
            confirm($res_to_admin_query);
            
            header("Location: users.php");
            
        }
    
    
//change to subscriber 
    
        if(isset($_GET['to_subscriber'])){
            
            $to_subscriber_id = $_GET['to_subscriber'];
            
            $to_subscriber_query = "UPDATE users SET user_role = 'subscriber' ";
            $to_subscriber_query .= "WHERE user_id = {$to_subscriber_id}";
            
            $res_to_subscriber_query = mysqli_query($connection, $to_subscriber_query);
            
            confirm($res_to_subscriber_query);
            
            header("Location: users.php");
            
        }
    

    
//Delete button 
    
        if(isset($_GET['del'])){
            
            $delete_id = $_GET['del'];
            
            $delete_query = "DELETE FROM users WHERE user_id = {$delete_id}";
            
            $delete_result = mysqli_query($connection, $delete_query);
            
            header("Location: users.php");  //reload   refresh
            
        }
    
    ?>
    
</div>