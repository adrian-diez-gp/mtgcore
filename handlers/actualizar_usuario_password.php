<?php
include(__DIR__ . "/../db/DB.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idUser = $_POST['idUser'];
    $password = $_POST['password'];

    if (!empty($idUser) && !empty($password))    {
        DB::actualizarUsuarioPassword($idUser, $password);
        setcookie('actualizado', 1, time() + 5, '/');
    } else {
        echo "¡Vaya! Algo salió mal.";
    }
}
?>