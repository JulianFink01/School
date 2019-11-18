<!DOCTYPE html>
<?php
  session_start();
?>
  <html>
    <head>
      <link rel="stylesheet" href="style/style.css">
      <script src="js/JavaScripts.js"></script>
    </head>
    <body>
        <?php
        if(isset($_SESSION["loggedIn"])){
          ?><a id="Username"><?php echo "Hallo ".$_SESSION["username"];?></a><?php
          include("logout.php");
        }else{

            ?>
              <a id="title">Schularbeit Julian Fink in Programmieren | 11.11.2019</a>
            <?php
            include("functions.php");
            include("templates/login_tmp.php");
            include("templates/register_tmp.php");
            }
        ?>
    <body>
  </html>
