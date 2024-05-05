<?php 

error_reporting(0);

require_once 'Conexion.php';

class Usuario {
    private $conexion;

    // Constructor
    public function __construct() {
        $this->conexion = new Conexion();
    }

    // Método para registrar un usuario
    public function registrar($usuario, $password) {
        $conexion = $this->conexion->conectar();
        $sql = "INSERT INTO users (username, password) VALUES ('$usuario','$password')";

        if ($conexion->query($sql) === TRUE) {
            return true;
        } else {
            return false;
        }
    }

    // Método para iniciar sesión
    public function login($usuario, $password) {
        $conexion = $this->conexion->conectar();
        $sql = "SELECT * FROM users WHERE username = '$usuario' AND password = '$password'";
        $resultado = $conexion->query($sql);

        if ($resultado->num_rows > 0) {
            return true;
        } else {
            return false;
        }
    }



}

?>