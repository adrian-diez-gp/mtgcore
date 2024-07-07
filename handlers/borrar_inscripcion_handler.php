<?php
    include(__DIR__ . "/../db/DB.php");

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $idUser = trim($_POST['idUser']);
        $idTorneo = trim($_POST['idTorneo']);

        if (!empty($idUser) && !empty($idTorneo)) {
            DB::borrarInscripcion($idUser, $idTorneo);
            setcookie('eliminado', 1, time() + 5, '/');
        } else {
            echo "Los campos no pueden quedar vacíos.";
        }
    }

?>

