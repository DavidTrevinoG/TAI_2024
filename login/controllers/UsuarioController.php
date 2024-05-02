<?php

require_once __DIR__ . '/../models/Usuario.php';

class UsuarioController {
    private $model;

    public function __construct() {
        $this->model = new Usuario();
    }

    public function index() {
        require_once __DIR__ . '/../views/Login/index.php';
    }

    public function registrar() {
        
        if(!isset($_POST['username']) || !isset($_POST['password'])){
            require_once __DIR__ . '/../views/Registro/index.php';
        } else {
            $usuario = $_POST['username'];
            $password = $_POST['password'];
    
            if ($this->model->registrar($usuario, $password)) {
                echo "Regisrtado correctamente";
                header('Location: ./index.php?controller=UsuarioController&action=login');
            } else {
                echo "Error al registrar el usuario";
            }
        }
       
    }

    public function login() {

        if(!isset($_POST['username']) || !isset($_POST['password'])){
            require_once __DIR__ . '/../views/Login/index.php';
        } else {
            $usuario = $_POST['username'];
            $password = $_POST['password'];
    
            if ($this->model->login($usuario, $password)) {
                session_start();
                $_SESSION['usuario'] = $usuario;
                require_once __DIR__ . '/../views/MainPage/index.php';
            } else {
                echo "Usuario o contraseña incorrectos";
            }
        }
       
    }

    public function cerrarSesion() {
        session_destroy();
        require_once __DIR__ . '/../views/Login/index.php';
    }
}

?>

