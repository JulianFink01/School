<div id="login" class="toggle-show-login">
    <form id="login-form" method="post" action="login.php">
        <legend class="<?php   if(isset($_SESSION["Error"])){echo "redtext";} else if(isset($_SESSION["info"])){echo "greentext";}?>">
            <?php
                if(isset($_SESSION["Error"])){
                  echo $_SESSION["Error"];
                }else if(isset($_SESSION["info"])){
                  echo $_SESSION["info"];
                }
             ?>
        </legend>
        <img src="Images/login_icon.png" alt="Login-Icon">
        <input class="login-input" type="text" name="uname" required placeholder="Token">
        <input class="login-input" type="password" name="pass" required placeholder="Password">
        <input class="login-input" type="submit" value="Login">
        <br>
        <a href="#" class="login-text" onclick="openRegister()">Not yet registered?</a>
    </form>
</div>
