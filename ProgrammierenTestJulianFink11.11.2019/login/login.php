<?php
    session_start();
    include("functions.php");


    $uname = $_POST["uname"];
    $pass = $_POST["pass"];
    $hashedPass = md5($pass);
    $sql = "select * from users where username = '$uname' and password = '$hashedPass'";
    $conn = connect();
    $result = mysqli_query($conn,$sql);
    if(mysqli_num_rows($result) > 0)
       {
        while($row = $result->fetch_assoc()) {
          $_SESSION["userid"] = $row["id"];
          $_SESSION["username"] = $row["username"];
          $_SESSION["loggedIn"] = true;
          unset($_SESSION["error"]);
          unset($_SESSION["info"]);
          header("Location: index.php");
        }

       }
     else
        {
      $_SESSION["Error"] = "Überprüfe deine Daten nochmal!";
        header("Location: index.php");

        }
?>
