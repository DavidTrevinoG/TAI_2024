<?php
// Código para verificar si existe una sesión iniciada, de lo contrario redirigir al usuario a la página de inicio de sesión
session_start();
if(!isset($_SESSION['usuario'])){
    header('Location: ./index.php?controller=UsuarioController&action=index');
    exit();
}
?>


<div class="container mt-4" id="secon">
    <h2>Editar Universidad</h2>

    <form method="post" action="./index.php?controller=UniversidadController&action=editar">
        <input type="hidden" name="id_universidad" value="<?php echo $universidad["id_universidad"]; ?>">
        <div class="form-group">
            <label for="nombre">Nombre:</label>
            <input type="text" name="nombre" class="form-control" value="<?php echo $universidad["nombre"]; ?>" required>
        </div>
        <div class="form-group">
            <label for="fundacion">Fundación:</label>
            <input type="date" name="fundacion" class="form-control" value="<?php echo $universidad["fundacion"]; ?>" required>
        </div>
        <div class="form-group">
            <label for="direccion">Dirección:</label>
            <input type="text" name="direccion" class="form-control" value="<?php echo $universidad["direccion"]; ?>" required>
        </div>
        <button type="submit" class="btn btn-success">Guardar</button>
    </form>
</div>