<?php ob_start();
session_start();
?>
<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Ajax practice</title>

        <!-- Bootstrap style sheet -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">

        <!-- my styling -->
        <link rel='stylesheet' href="<?php echo URL; ?>css/main.css">
        <link href="https://fonts.googleapis.com/css?family=Rubik" rel="stylesheet">

        <!-- date picker -->
        <link rel="stylesheet" href="<?php echo URL; ?>js/jquery/jquery-ui.css">

        <!-- Google recaptcha -->
        <script src='https://www.google.com/recaptcha/api.js'></script>
      
    </head>

    <body>
        <nav>
            <a href='<?php echo URL?>data/index'><img src='https://upload.wikimedia.org/wikipedia/commons/thumb/e/e5/NASA_logo.svg/200px-NASA_logo.svg.png' width='75px' height='50px' id='logo'/></a>
            <?php if($_SESSION){
                echo "<a href=".URL."user/logout/true".">Sign Out</a>";
            }
            else{ echo "<a href=".URL."user/index/'>Signin</a>
                        <a href=".URL."user/register/'>Register</a>";
            };
            ?>
        </nav>
		






