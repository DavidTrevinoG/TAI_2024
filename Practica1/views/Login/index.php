<!-- Login form -->
<br><br><br>
<div class="login-container">
<h2 class="login-title">Login</h2>
<form action="./index.php?controller=UsuarioController&action=login" method="post" class="login-form">
    <label for="username" class="login-label">Username:</label>
    <input type="text" name="username" id="username" class="login-input"><br>
    <label for="password" class="login-label">Password:</label>
    <input type="password" name="password" id="password" class="login-input"><br>
    <input type="submit" value="Login" class="login-button">
</form>
<a href="./index.php?controller=UsuarioController&action=registrar" class="register-link">Register</a>
</div>
   
