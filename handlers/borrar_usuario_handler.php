<?php
include(__DIR__ . "/../db/DB.php");

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idUser = $_POST['idUser'];

    if (!empty($idUser)) {
        DB::borrarUsuario($idUser);
        setcookie('eliminado', 1, time() + 5, '/');
        exit();
    } else {
        echo "ID de la noticia es requerido.";
    }
}
?>