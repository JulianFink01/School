<?php
session_start();
if(!$_SESSION["login"]){
  header("Location: index.php");
}
  echo "Hello ".$_SESSION["user"];

?>
