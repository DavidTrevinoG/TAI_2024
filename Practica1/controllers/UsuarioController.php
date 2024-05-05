<?php

error_reporting(0);
require_once __DIR__ . '/../models/Usuario.php';

// Controlador de Usuario
class UsuarioController {
    private $model;

    // Constructor
    public function __construct() {
        $this->model = new Usuario();
    }

    // Método para mostrar el formulario de inicio de sesión
    public function index() {
        include_once './views/header.php';
        require_once __DIR__ . '/../views/Login/index.php';
        include_once './views/footer.php';
    }

    // Método para registrar un usuario
    public function registrar() {
        
        if(!isset($_POST['username']) || !isset($_POST['password'])){
            include_once './views/header.php';
            require_once __DIR__ . '/../views/Registro/index.php';
            include_once './views/footer.php';
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

    // Método para iniciar sesión
    public function login() {

        if(!isset($_POST['username']) || !isset($_POST['password'])){
            include_once './views/header.php';
            require_once __DIR__ . '/../views/Login/index.php';
            include_once './views/footer.php';
        } else {
            $usuario = $_POST['username'];
            $password = $_POST['password'];
    
            if ($this->model->login($usuario, $password)) {
                session_start();
                $_SESSION['usuario'] = $usuario;
                header('Location: ./index.php?controller=UniversidadController&action=index');
                exit();
            } else {
                echo "Usuario o contraseña incorrectos";
            }
        }
       
    }

    // Método para cerrar sesión
    public function cerrarSesion() {
        // Inicia la sesión si no se ha iniciado aún
        if (!isset($_SESSION)) {
            session_start();
        }
        
        // Destruye la sesión
        session_destroy();
        
        // Elimina la cookie de sesión del navegador
        if (isset($_COOKIE[session_name()])) {
            setcookie(session_name(), '', time() - 3600, '/');
        }
        
        // Redirige a la página de inicio de sesión u otra página adecuada
        header('Location: ./index.php?controller=UsuarioController&action=index');
        exit(); 
    }
}

?>

