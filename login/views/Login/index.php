<body>
    <h2>Login</h2>
    <form action="./index.php?controller=UsuarioController&action=login" method="post">
        Username: <input type="text" name="username"><br>
        Password: <input type="password" name="password"><br>
        <input type="submit" value="Login">
    </form>
    <a href="./index.php?controller=UsuarioController&action=registrar">Register</a>
</body>