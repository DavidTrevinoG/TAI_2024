<?php

//Jesús David Treviño Gandarilla

include 'conexion.php';

if(isset($_POST['nombre'])){
    $nombre = $_POST['nombre'];
    $tipo = $_POST['tipo'];
    $ingredientes = $_POST['ingredientes'];
    $precio = $_POST['precio'];

    if($tipo == 'básico'){
        $ingredientes = 1;
    }

    $sql = "INSERT INTO platillos (nombre, tipo_alimento, ingredientes, precio) VALUES ('$nombre', '$tipo', '$ingredientes', '$precio')";

    if($conexion->query($sql) === true){
        echo "Registro guardado";
        header('Location: index.php');
    }else{
        die("Error al guardar: " . $conexion->error);
    }
    $conexion->close();
}

?>