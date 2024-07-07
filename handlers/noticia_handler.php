<?php
    include(__DIR__ . "/../db/DB.php");

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    if ($_POST) {
        $titulo = $_POST['titulo'];
        $texto = $_POST['texto'];
        $imagen = $_POST['imagen'] . '.jpg';
        $idUser = $_COOKIE['idUser'];
        $fecha_creacion = date("Y-m-d");

        $titulo = htmlspecialchars(trim($titulo));
        $texto = htmlspecialchars(trim($texto));

        if(!empty($titulo) && !empty($texto) && !empty($imagen) && !empty($idUser)) {
            DB::crearNoticia($idUser, $titulo, $texto, $imagen, $fecha_creacion);
            setcookie('creado', 1, time() + 5, '/');
            echo "<div>NOTICIA CREADA!!!</div>"; 
            echo "<script>window.location.href='../pages/noticias_admin.php';</script>";
        } else {
            echo "Username and password cannot be empty.";
        }
    }
?>
