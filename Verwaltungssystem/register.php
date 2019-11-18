<?php
    session_start();
    include("functions.php");

    $name = $_POST["name"];
    $lastname = $_POST["lastname"];
    $pass = $_POST["password"];
    $pass2 = $_POST["password2"];
    $hashedPass = md5($pass);

    if(checkIfUserExists(connect(), $uname))
       {

          $_SESSION["Error"] = "Dein Username ist leider schon vergeben";
          header("Location: index.php");


       }
     else if($pass != $pass2)
      {
          $_SESSION["Error"] = "Deine Passwörter stimmen nicht überein";
            header("Location: index.php");
      }else{
          $sql = "insert into users (username, password) values('$uname', '$hashedPass')";
          if(insert(connect(), $sql)){
                $_SESSION["info"] = "Du wurderst erfolgreich reigistriert!";
                unset($_SESSION["Error"]);
                header("Location: index.php");
          };

      }
?>
