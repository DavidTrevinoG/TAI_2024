<?php

error_reporting(0);

        // Si se envía el controlador y la acción por la URL
        if (isset($_GET['controller']) && isset($_GET['action'])) {
                // Se obtienen los valores de controller y action
                $controller = $_GET['controller'];
                $action = $_GET['action'];
                require_once "controllers/$controller.php";
                $controller = new $controller();
                $controller->$action();
            
        } else {
            // Si no se envía un controlador y una acción por la URL, se muestra la página de inicio se sesión
            require_once "controllers/UsuarioController.php";
            $UsuarioController = new UsuarioController();
            $UsuarioController->index();
        }

?>
