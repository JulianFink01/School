<?php
session_start();
  $uname = $_GET["uname"];
  $pass = $_GET["pass"];


  $host = "localhost";
  $db = "login";
  $dbuser = "root";
  $dbpass = "";

  $conn = mysqli_connect($host, $dbuser, $dbpass, $db);

  $sql ="select * from users";

  $result = mysqli_query($conn,$sql);

  if(mysqli_num_rows($result) > 0)
     {
      while($row = $result->fetch_assoc()) {
        $_SESSION["user"] = $row["username"];
        $_SESSION["login"] = true;
        header("Location: welcome.php");
      }

     }
   else
      {

      header("Location: index.php");

      }

?>
