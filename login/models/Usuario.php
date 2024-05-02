<?php 

require_once 'Conexion.php';

class Usuario {
    private $conexion;

    public function __construct() {
        $this->conexion = new Conexion();
    }

    public function registrar($usuario, $password) {
        $conexion = $this->conexion->conectar();
        $sql = "INSERT INTO users (username, password) VALUES ('$usuario','$password')";

        if ($conexion->query($sql) === TRUE) {
            return true;
        } else {
            return false;
        }
    }

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