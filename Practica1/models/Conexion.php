<?php
class Conexion {

    // Atributos de la clase
    private $host = "localhost";
    private $user = "admin";
    private $password = "0ff42d8a24af5b106c0b0d5bfbda40dfb6d57e4f11434fa8"; 
    private $database = "logMVC";

    // Método para conectar a la base de datos
    public function conectar() {
        $conexion = new mysqli($this->host, $this->user, $this->password, $this->database);

        if ($conexion->connect_error) {
            die("Error de conexión: " . $conexion->connect_error);
        }

        return $conexion;
    }
}
?>