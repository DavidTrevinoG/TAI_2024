<?php
// Código para verificar si existe una sesión iniciada, de lo contrario redirigir al usuario a la página de inicio de sesión
session_start();
if(!isset($_SESSION['usuario'])){
    header('Location: ./index.php?controller=UsuarioController&action=index');
    exit();
}
?>

<!-- Menú -->
<ul class="nav nav-tabs">
    <li class="nav-item">
        <a class="nav-link <?php echo(isset($_GET['controller']) && $_GET['controller'] == 'UniversidadController' ? 'active' : '') ?>" href="./index.php?controller=UniversidadController&action=index">Universidad</a>
    </li>
    <li class="nav-item">
         <a class="nav-link <?php echo((isset($_GET['controller']) && $_GET['controller'] == 'CarreraController' || !isset($_GET['controller']))? 'active' : '') ?>" href="./index.php?controller=CarreraController&action=index">Carrera</a>
    </li>
    <li class="nav-item">
        <a class="nav-link <?php echo(isset($_GET['controller']) && $_GET['controller'] == 'UsuarioController' ? 'active' : '') ?>" href="./index.php?controller=UsuarioController&action=cerrarSesion">Cerrar Sesión</a>
    </li>
</ul>

<!-- Contenido -->
<div class="container mt-4" id="secon">
    <h2>Listado de Carreras</h2>

    <a href="./index.php?controller=CarreraController&action=agregar" class="btn btn-primary mb-3">Agregar Carrera</a>

    <table class="table">
        <thead>
        <tr>
            <th>ID_CARRERA</th>
            <th>NOMBRE</th>
            <th>DIRECTOR</th>
            <th>UNIVERSIDAD</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($carreras as $carrera): ?>
            <tr>
                <td><?php echo $carrera['id_carrera']; ?></td>
                <td><?php echo $carrera['nombre']; ?></td>
                <td><?php echo $carrera['director']; ?></td>
                <td><?php echo $carrera['universidad']; ?></td>
                <td>
                    <a href="./index.php?controller=CarreraController&action=editar&id=<?php echo $carrera['id_carrera']; ?>" class="btn btn-warning">Editar</a>
                    <a href="./index.php?controller=CarreraController&action=eliminar&id=<?php echo $carrera['id_carrera']; ?>" class="btn btn-danger">Eliminar</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>