<?php
// Código para verificar si existe una sesión iniciada, de lo contrario redirigir al usuario a la página de inicio de sesión
session_start();
if(!isset($_SESSION['usuario'])){
    header('Location: ./index.php?controller=UsuarioController&action=index');
    exit();
}
?>

<!-- Menú de navegación -->
<ul class="nav nav-tabs">
    <li class="nav-item">
        <a class="nav-link <?php echo((isset($_GET['controller']) && $_GET['controller'] == 'UniversidadController' || !isset($_GET['controller']))? 'active' : '') ?>" href="./index.php?controller=UniversidadController&action=index">Universidad</a>
    </li>
    <li class="nav-item">
        <a class="nav-link <?php echo(isset($_GET['controller']) && $_GET['controller'] == 'CarreraController' ? 'active' : '') ?>" href="./index.php?controller=CarreraController&action=index">Carrera</a>
    </li>
    <li class="nav-item">
        <a class="nav-link <?php echo(isset($_GET['controller']) && $_GET['controller'] == 'UsuarioController' ? 'active' : '') ?>" href="./index.php?controller=UsuarioController&action=cerrarSesion">Cerrar Sesión</a>
    </li>
</ul>

<!-- Contenido -->
<div class="container mt-4" id="secon">
    <h2>Listado de Universidades</h2>

    <a href="./index.php?controller=UniversidadController&action=agregar" class="btn btn-primary mb-3">Agregar Universidad</a>

    <table class="table">
        <thead>
        <tr>
            <th>ID_UNIVERSIDAD</th>
            <th>NOMBRE</th>
            <th>FUNDACIÓN</th>
            <th>DIRECCIÓN</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($universidades as $uni): ?>
            <tr>
                <td><?php echo $uni['id_universidad']; ?></td>
                <td><?php echo $uni['nombre']; ?></td>
                <td><?php echo $uni['fundacion']; ?></td>
                <td><?php echo $uni['direccion']; ?></td>
                <td>
                    <a href="./index.php?controller=UniversidadController&action=editar&id=<?php echo $uni['id_universidad']; ?>" class="btn btn-warning">Editar</a>
                    <a href="./index.php?controller=UniversidadController&action=eliminar&id=<?php echo $uni['id_universidad']; ?>" class="btn btn-danger">Eliminar</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>