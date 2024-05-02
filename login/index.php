<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOGIN</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="index.css">
</head>
<body>

    <?php


        if (isset($_GET['controller']) && isset($_GET['action'])) {
            $controller = $_GET['controller'];
            $action = $_GET['action'];
            require_once "controllers/$controller.php";
            
            $controller = new $controller();
            $controller->$action();
            
        } else {
            require_once "controllers/UsuarioController.php";
            $UsuarioController = new UsuarioController();
            $UsuarioController->index();
        }


    ?>

    <script src="https://code.jquery.com/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"></script>
</body>
</html>