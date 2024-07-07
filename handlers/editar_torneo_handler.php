<?php
    include(__DIR__ . "/../db/DB.php");

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    if ($_POST) {
        $idTorneo = $_POST['idTorneo'];
        $titulo = $_POST['titulo'];
        $fecha = $_POST['fecha'];
        $hora = $_POST['hora'];


        if(!empty($idTorneo) && !empty($titulo) && !empty($fecha) && !empty($hora)) {
            DB::editarTorneo($idTorneo, $titulo, $fecha, $hora);
            header("Location:../pages/inscripciones_admin.php");
        } else {
            echo "Fields cannot be empty.";
        }
    }
?>