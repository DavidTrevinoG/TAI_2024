<body>
    <h2>Register</h2>
    <form action="./index.php?controller=UsuarioController&action=registrar" method="post">
        Username: <input type="text" name="username"><br>
        Password: <input type="password" name="password"><br>
        <input type="submit" value="Register">
    </form>
    <a href="./index.php?controller=UsuarioController&action=login">Login</a>
</body>