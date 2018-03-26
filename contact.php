<?php  include "includes/db.php"; ?>
<?php  include "includes/header.php"; ?>
 
    <?php    
        
        if(isset($_POST['submit'])){
            
            $to = "e55amg@abv.bg";
            $from_email = mysqli_real_escape_string($connection, $_POST['email']);
            $subject = mysqli_real_escape_string($connection, $_POST['subject']);
            $body = mysqli_real_escape_string($connection, $_POST['body']);    
                    
            if(!empty($subject) && !empty($from_email) && !empty($body)){
                
                // the message
        //$msg = "Wow you are amazing developer, and you are testing wordwrap command which takes two parameters!";
    
            // use wordwrap() if lines are longer than 70 characters
            //$msg = wordwrap($msg,10);
    
        // send email       
        //$head = $from_email;
        
        $header = "From: {$from_email}";
        
        mail($to, $subject, $body, $header);
    
                
                
                               
                $message = "Your message has been sent!";
                
            } else {
                $val_mess = "Fields can not be empty!";
            }
            
            
                
            
        }







    ?>
 


    <!-- Navigation -->
    
    <?php  include "includes/navigation.php"; ?>
    
 
    <!-- Page Content -->
    <div class="container">
    
<section id="login">
    <div class="container">
        <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
                <div class="form-wrap">
                <h1>Contact</h1>
                   <?php
                    
                    if(isset($val_mess)){
                        echo $val_mess;
                    }
                    if(isset($message)){
                        echo "<div class='alert alert-success'>{$message}</div>";
                    }
                        
                    ?>
                    
                    <form role="form" action="contact.php" method="post" id="login-form" autocomplete="off">
                        
                         <div class="form-group">
                            <label for="email" class="sr-only">Email</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="somebody@example.com">
                        </div>

                        <div class="form-group">
                            <label for="subject" class="sr-only">subject</label>
                            <input type="text" name="subject" id="subject" class="form-control" placeholder="Enter Subject">
                        </div>

                         <div class="form-group">
                            <label for="password" class="sr-only">Password</label>
                            <textarea name="body" class="form-control" rows="8" placeholder="Enter Message"></textarea>
                        </div>
                
                        <input type="submit" name="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Submit">
                    </form>
                 
                </div>
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>


        <hr>



<?php include "includes/footer.php";?>
