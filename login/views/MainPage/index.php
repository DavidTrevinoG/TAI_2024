
<?php 
    if (isset($_SESSION['usuario'])) {
        echo "<h1>Bienvenido ".$_SESSION['usuario']."</h1>";
    } else {
        header('Location: ../../index.php?controller=UsuarioController&action=login');
    }
?>


Felicidades!, has iniciado sesión correctamente.

<a href="?controller=UsuarioController&action=cerrarSesion">Cerrar Sesión</a>
