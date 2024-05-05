<?php

error_reporting(0);
require_once __DIR__ . '/../models/Carrera.php';

// Controlador de Carrera
class CarreraController {
    private $model;

    // Constructor
    public function __construct() {
        $this->model = new Carrera();
    }

    // Método para mostrar el listado de Carreras
    public function index() {
        $carreras = $this->model->obtenerCarrera();
        include_once './views/header.php';
        include_once './views/Carrera/index.php';
        include_once './views/footer.php';
    }

    // Método para agregar una Carrera
    public function agregar() {
        
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $nombre = $_POST['nombre'];
            $director = $_POST['director'];
            $id_universidad = $_POST['id_universidad'];
    
            if ($this->model->agregarCarrera($nombre, $director, $id_universidad)) {
                echo "Carrera agregada correctamente";
                header('Location: ./index.php?controller=CarreraController&action=index');
            } else {
                echo "Error al agregar la carrera";
            }
        } else {
            include './views/header.php';
            include  './views/Carrera/agregar.php';
            include  './views/footer.php';
        }
    }

    // Método para editar una Carrera
    public function editar() {
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $id = $_POST['id_carrera'];
            $nombre = $_POST['nombre'];
            $director = $_POST['director'];
            $id_universidad = $_POST['id_universidad'];
    
            if ($this->model->actualizarCarrera($id, $nombre, $director, $id_universidad)) {
                echo "Carrera actualizada correctamente";
                header('Location: ./index.php?controller=CarreraController&action=index');
            } else {
                echo "Error al actualizar la Carrera";
            }
        } else {
            $id = $_GET['id'];
            $carrera = $this->model->obtenerCarreraPorId($id);
            include './views/header.php';
            include './views/Carrera/editar.php';
            include './views/footer.php';
        }
    }


    // Método para eliminar una Carrera
    public function eliminar() {
        $id = $_GET['id'];
        if ($this->model->eliminarCarrera($id)) {
            echo "Carrera eliminada correctamente";
            header('Location: ./index.php?controller=CarreraController&action=index');
        } 
    }

}

?>