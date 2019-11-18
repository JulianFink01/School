<?php

function insert($conn, $sql){
    if ($conn->query($sql) === TRUE) {
    return true;
    } else {
    return false;
    }
}

function connect(){
  $servername = "localhost";
  $username = "root";
  $password = "";
  $db = "login";
  // Create connection
  $conn = new mysqli($servername, $username, $password, $db);

  // Check connection
  if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
  }else{
    return $conn;
  }
}
function checkIfUserExists($conn, $username){
  $sql = "select * from users where username = '$username'";
  $result = mysqli_query($conn,$sql);
  if(mysqli_num_rows($result) > 0)
     {


      return true;
     }
}
function closeConnection($conn){
  $conn->close();
}
?>
