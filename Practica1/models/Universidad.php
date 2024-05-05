<?php

require_once 'Conexion.php';

class Universidad {

   
    private $conexion;

    // Constructor
    public function __construct() {
        $this->conexion = new Conexion();
    }

    // Método para obtener el listado de Universidades
    public function obtenerUniversidad(){
        $query = "SELECT * FROM universidad";
        $resultado = $this->conexion->conectar()->query($query);
        return $resultado->fetch_all(MYSQLI_ASSOC);
    }

    // Método para agregar una Universidad
    public function agregarUniversidad($nombre, $fundacion, $direccion){
        $query = "INSERT INTO universidad (nombre, fundacion, direccion) VALUES ('$nombre', '$fundacion', '$direccion')";
        $resultado = $this->conexion->conectar()->query($query);

        return $resultado;
    }

    // Método para obtener una Universidad por ID
    public function obtenerUniversidadPorId($id){
        $query = "SELECT * FROM universidad WHERE id_universidad = '$id'";
        $resultado = $this->conexion->conectar()->query($query);

        return $resultado->fetch_assoc();
    }

    // Método para actualizar una Universidad
    public function actualizarUniversidad($id, $nombre, $fundacion, $direccion){
        $query = "UPDATE universidad SET nombre = '$nombre', fundacion = '$fundacion', direccion = '$direccion' WHERE id_universidad = '$id'";
        return $this->conexion->conectar()->query($query);
    }

    // Método para eliminar una Universidad
    public function eliminarUniversidad($id){
        $query = "DELETE FROM universidad WHERE id_universidad = '$id'";
        $resultado = $this->conexion->conectar()->query($query);

        return $resultado;
    }




}

?>