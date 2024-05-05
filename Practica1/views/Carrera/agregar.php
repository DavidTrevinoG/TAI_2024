<?php

// Código para verificar si existe una sesión iniciada, de lo contrario redirigir al usuario a la página de inicio de sesión
session_start();
if(!isset($_SESSION['usuario'])){
    header('Location: ./index.php?controller=UsuarioController&action=index');
    exit();
}
?>
<div class="container mt-4" id="secon">
    <h2>Agregar Carrera</h2>

    <form method="post" action="./index.php?controller=CarreraController&action=agregar">
        <div class="form-group">
            <label for="nombre">Nombre:</label>
            <input type="text" name="nombre" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="director">Director:</label>
            <input type="text" name="director" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="Universidad">Universidad:</label>
            <select name="id_universidad" class="form-control" required>
                <option value="">Seleccione una universidad</option>
                <?php 

                // Select para mostrar las universidades

                include './models/Universidad.php';
                $uni = new Universidad();
                $universidades = $uni->obtenerUniversidad();  
                foreach ($universidades as $universidad): ?>
                    <option value="<?php echo $universidad['id_universidad']; ?>"><?php echo $universidad['nombre']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <button type="submit" class="btn btn-success">Guardar</button>
    </form>
</div>