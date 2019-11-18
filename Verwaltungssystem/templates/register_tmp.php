<div id="register" >
    <form id="login-form" action="register.php" method="POST">
        <a  onclick="openRegister()" id="login-close">&times;</a>
        <img src="Images/login_icon.png" alt="Login-Icon">
        <input class="login-input login-register" type="text" name="name" required placeholder="Name">
        <input class="login-input login-register" type="text" name="lastname" required placeholder="Name">
        <input class="login-input login-register" type="password" name="password" required placeholder="Password">
        <input class="login-input login-register" type="password"name="password2"  required placeholder="Confirm Password">
        <input class="login-input login-register" type="submit" value="Send verification Email">
        <a href="#" class="login-text" onclick="openRegister()">Need some help?</a>
    </form>
</div>
