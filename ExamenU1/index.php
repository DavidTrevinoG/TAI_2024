<!-- Jesús David Treviño Gandarilla -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EXAMEN U1</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    
    <div class="container">
        <h1 class="text-center">Platillos</h1>

        <a href="formulario.php" class="btn btn-primary">Agregar platillo</a>
        <hr><br>
        <table class="table">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Tipo</th>
                    <th>Ingredientes</th>
                    <th>Precio</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include 'conexion.php';
                $sql = "SELECT * FROM platillos";
                $resultado = $conexion->query($sql);
                while($fila = $resultado->fetch_assoc()){
                    echo "<tr>";
                    echo "<td>".$fila['nombre']."</td>";
                    echo "<td>".$fila['tipo_alimento']."</td>";
                    echo "<td>".$fila['ingredientes']."</td>";
                    echo "<td>".$fila['precio']."</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
    </div>
</body>
<script src="https://code.jquery.com/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"></script>

</html>
