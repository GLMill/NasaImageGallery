<div class="container-fluid">
    <div class="row">
        <div class="col-md-4 offset-md-4 col-sm-12" id='border'>
            
<?PHP echo URL ?>
            <?php
                if(isset($errors)){
                        echo "<div class='form_error'>";
                        foreach($errors as $error){
                            ?>
                            <div>
                                <?php echo $error; ?>
                            </div>
                            <?php
                        }
                        echo "</div>";} 
                        else if(isset($status)){

                            if($status == "confirm_registration" ){
                                echo "<div class='alert info'>You have successfully registered! You can now login! </div>";
                            } else if($status == "confirm_inactive"){
                                echo "<div class='alert error'>Your account seems inactive! Please contact admin! </div>";
                            } else  if($status == "confirm_activation" ){
                                echo "<div class='alert info'>You have successfully activated your account! </div>";
                            }
                    }
            ?>


                <form action="<?php echo URL?>user" method="POST">
                <h3>Sign In </h3>
                    <label for='email'> Email: </label>
                    <input type="text" name="email" id='email' placeholder="Email" value="<?php if(isset($errors)){echo $_POST['email'];}?>" />
                    <label for='password'> Password: </label>
                    <input type="password" name="password" id='password' placeholder="Password" value="<?php if(isset($errors)){echo $_POST['password'];}?>" />
                    </br>
                    <input type="submit" name="login" value="Sign In" id='loginButton'></br>
                    <p>Don't have account yet ! <a href="<?php echo URL?>user/register/">Sign Up</a></p>
                </form>
            </div> <!-- closing login-->
    </div> <!-- closing row div-->
</div><!-- closing container-->
