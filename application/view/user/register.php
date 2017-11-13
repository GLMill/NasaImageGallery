<div class="container-fluid">
    <div class='row'>
        <div class="col-md-4 offset-md-4 col-sm-12" id='border'> 
        <h3>Sign Up </h3>

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
                        echo "</div>";
                    }
                    ?> 


        <!-- form action is to a controller and register function, app adds controller to user-->

            <form action="<?php echo URL?>user/register" method="POST">
                <label for='userName'> User Name: </label>
                <input type="text" name="userName" id='userName' placeholder="Enter user Name" value="<?php if(isset($errors)){echo $_POST['userName'];}?>" />
                <label for='email'> Email: </label>
                <input type="text" name="email" id='email' placeholder="Enter E-Mail" value="<?php if(isset($errors)){echo $_POST['email'];}?>" />
                <label for='password'> Password: </label>
                <input type="password" name="password" id='password' placeholder="Enter Password"/>
                <label for='retypePassword'> Retype Password: </label>
                <input type="password" name="retypePassword" id='retypePassword' placeholder="retype password"/>
                </br>
                <div class="g-recaptcha" data-sitekey="6LdCPjgUAAAAAAdMf4v3qpv0VLGjcS59AcZMIrDi"></div>
                </br>
                <input type="submit" name="register" value="Sign Up">
                </br>
                <p>Already a user ! <a href="<?php echo URL?>user">Sign in</a></p>

        </div> <!-- end of border -->
    </div><!-- end of row-->
</div> <!--End of container -->
