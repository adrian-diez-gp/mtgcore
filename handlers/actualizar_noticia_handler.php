<?php
    include(__DIR__ . "/../db/DB.php");

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idNoticia = $_POST['idNoticia'];
    $titulo = $_POST['titulo'];
    $texto = $_POST['texto'];
    $imagen = $_POST['imagen'] . '.jpg';
    $fecha_creacion = date("Y-m-d");

    $titulo = htmlspecialchars(trim($titulo));
    $texto = htmlspecialchars(trim($texto));

    if (!empty($idNoticia) && !empty($titulo) && !empty($texto) && !empty($imagen)) {
        DB::actualizarNoticia($idNoticia, $titulo, $texto, $imagen, $fecha_creacion);
        setcookie('actualizado', 1, time() + 5, '/');
        header("Location: ../pages/noticia.php?id=$idNoticia");
    } else {
        echo "Todos los campos son obligatorios.";
    }
}
?>