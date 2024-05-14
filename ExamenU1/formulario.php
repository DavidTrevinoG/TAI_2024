<!-- Jesús David Treviño Gandarilla -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EXAMEN U1</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<script>
    function change(){
        var tipo = document.getElementById('tipo').value;
        if(tipo == 'avanzado'){
            document.getElementById('ingredientes').disabled = false;
        }else{
            document.getElementById('ingredientes').disabled = true;
        }
    };
</script>
<body>
    
    <div class="container">
        <h1 class="text-center">Registro de platillos</h1>
        <form action="guardar.php" method="POST">
            <div class="form-group">
                <label for="nombre">Nombre del platillo</label>
                <input type="text" name="nombre" id="nombre" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="tipo">Tipo de alimento</label>
                <select name="tipo" id="tipo" class="form-control" onchange="change()">
                    <option value="básico">Básico</option>
                    <option value="avanzado">Avanzado</option>
                </select>
            </div>
            <div class="form-group">
                <label for="ingredientes">Cantidad de ingredientes</label>
                <input type="number" name="ingredientes" id="ingredientes" class="form-control" disabled>
            </div>
            <div class="form-group">
                <label for="precio">Precio</label>
                <input type="number" step="0.01" name="precio" id="precio" class="form-control" required>
            </div>
            <input type="submit" value="Guardar" class="btn btn-primary">
        </form>
    </div>

</body>
<script src="https://code.jquery.com/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"></script>

</html>
