<?php
include(__DIR__ . "/../db/DB.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    print_r($_POST);
    $idUser = $_POST['idUser'];
    $username = $_POST['username'];
    $nombre = $_POST['nombre'];
    $apellidos = $_POST['apellidos'];
    if ($_POST['telefono']){
        $telefono = $_POST['telefono'];
    } else {
        $telefono = '';
    }
    if ($_POST['fecha_nacimiento']){
        $fecha_nacimiento = $_POST['fecha_nacimiento'];
    } else {
        $fecha_nacimiento = '';
    }
    if ($_POST['sexo']){
        $sexo = $_POST['sexo'];
    } else {
        $sexo = 'nsnc';
    }
    if ($_POST['direccion']){
        $direccion = $_POST['direccion'];
    } else {
        $direccion = '';
    }


    $username = htmlspecialchars(trim($username));
    $nombre = htmlspecialchars(trim($nombre));
    $apellidos = htmlspecialchars(trim($apellidos));
    $telefono = htmlspecialchars(trim($telefono));
    $direccion = htmlspecialchars(trim($direccion));

    if (!empty($idUser) && !empty($username) && !empty($nombre) && !empty($apellidos)) {
        DB::actualizarUsuario($username, $nombre, $apellidos, $telefono, $fecha_nacimiento, $sexo, $direccion, $idUser);
        setcookie('actualizado', 1, time() + 5, '/');
    } else {
        echo "Todos los campos son obligatorios.";
    }
}
?>