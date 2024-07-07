<?php
include(__DIR__ . "/../db/DB.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idUser = $_POST['idUser'];
    $idTorneo = $_POST['idTorneo'];

    DB::inscribirUsuario($idUser, $idTorneo);
    setcookie('actualizado', 1, time() + 5, '/');
}
?>