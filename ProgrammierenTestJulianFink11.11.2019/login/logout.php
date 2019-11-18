
<form id="logout" action="index.php" method="POST">
  <input type="submit" name="logout" value="logout">
</form>


<?php
  if($_POST){
    if(isset($_POST["logout"])){
      session_destroy();
      header("Location: index.php");
    }
  }
?>
