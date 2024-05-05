<?php

error_reporting(0);
require_once __DIR__ . '/../models/Universidad.php';

// Controlador de Universidad
class UniversidadController {
    private $model;

    // Constructor
    public function __construct() {
        $this->model = new Universidad();
    }

    // Método para mostrar el listado de Universidades
    public function index() {
        $universidades = $this->model->obtenerUniversidad();
        include './views/header.php';
        include './views/Universidad/index.php';
        include './views/footer.php';
    }

    // Método para agregar una Universidad
    public function agregar() {
        
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $nombre = $_POST['nombre'];
            $fundacion = $_POST['fundacion'];
            $direccion = $_POST['direccion'];
    
            if ($this->model->agregarUniversidad($nombre, $fundacion, $direccion)) {
                echo "Universidad agregada correctamente";
                header('Location: ./index.php?controller=UniversidadController&action=index');
            } else {
                echo "Error al agregar la universidad";
            }
        } else {
            include  './views/header.php';
            include  './views/Universidad/agregar.php';
            include  './views/footer.php';
        }
    }

    // Método para editar una Universidad
    public function editar() {
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $id = $_POST['id_universidad'];
            $nombre = $_POST['nombre'];
            $fundacion = $_POST['fundacion'];
            $direccion = $_POST['direccion'];
    
            if ($this->model->actualizarUniversidad($id, $nombre, $fundacion, $direccion)) {
                echo "Universidad actualizada correctamente";
                header('Location: ./index.php?controller=UniversidadController&action=index');
            } else {
                echo "Error al actualizar la universidad";
            }
        } else {
            $id = $_GET['id'];
            $universidad = $this->model->obtenerUniversidadPorId($id);
            include './views/header.php';
            include './views/Universidad/editar.php';
            include './views/footer.php';
        }
    }

    // Método para eliminar una Universidad 
    public function eliminar() {
        $id = $_GET['id'];
        
        try {
            $this->model->eliminarUniversidad($id);
            echo "Universidad eliminada correctamente";
            header('Location: ./index.php?controller=UniversidadController&action=index');
        } catch (Exception $e) {
            // En caso de que la condición sea falsa, se mostrará un mensaje de error
            echo "<script>alert('No se pudo eliminar la universidad debido a que cuenta con carreras');</script>";
            echo "<script>window.location.href = './index.php?controller=UniversidadController&action=index';</script>";
            exit(); 
        }
    }
        
    

}

?>