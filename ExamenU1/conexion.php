<?php

//Jesús David Treviño Gandarilla

$host = "localhost";
$user = "admin";
$password = "0ff42d8a24af5b106c0b0d5bfbda40dfb6d57e4f11434fa8"; 
$database = "ExamenU1";

$conexion = new mysqli($host, $user, $password, $database);

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

?>