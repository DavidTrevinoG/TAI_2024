<?php

require_once 'Conexion.php';

// Modelo de Carrera
class Carrera {


   
    private $conexion;

    // Constructor
    public function __construct() {
        $this->conexion = new Conexion();
    }

    // Método para obtener el listado de Carreras
    public function obtenerCarrera(){
        // Uso de sentencia SQL con INNER JOIN para obtener el nombre de la carrera en lugar de su ID
        $query = "SELECT c.id_carrera as id_carrera, c.nombre as nombre, c.director as director, u.nombre as universidad  FROM carrera as c INNER JOIN universidad as u ON c.id_universidad = u.id_universidad";
        $resultado = $this->conexion->conectar()->query($query);
        return $resultado->fetch_all(MYSQLI_ASSOC);
    }

    // Método para agregar una Carrera
    public function agregarCarrera($nombre, $director, $id_universidad){
        $query = "INSERT INTO carrera (nombre, director, id_universidad) VALUES ('$nombre', '$director', '$id_universidad')";
        $resultado = $this->conexion->conectar()->query($query);

        return $resultado;
    }

    // Método para obtener una Carrera por ID
    public function obtenerCarreraPorId($id){
        // Uso de sentencia SQL con INNER JOIN para obtener el nombre de la carrera en lugar de su ID
        $query = "SELECT c.id_carrera as id_carrera, c.nombre as nombre, c.director as director, u.nombre as universidad  FROM carrera as c INNER JOIN universidad as u ON c.id_universidad = u.id_universidad WHERE id_carrera = '$id'";
        $resultado = $this->conexion->conectar()->query($query);

        return $resultado->fetch_assoc();
    }

    // Método para actualizar una Carrera
    public function actualizarCarrera($id, $nombre, $director, $id_universidad){
        $query = "UPDATE carrera SET nombre = '$nombre', director = '$director', id_universidad = '$id_universidad' WHERE id_carrera = '$id'";
        return $this->conexion->conectar()->query($query);
    }

    // Método para eliminar una Carrera
    public function eliminarCarrera($id){
        $query = "DELETE FROM carrera WHERE id_carrera = '$id'";
        $resultado = $this->conexion->conectar()->query($query);

        return $resultado;
    }




}

?>