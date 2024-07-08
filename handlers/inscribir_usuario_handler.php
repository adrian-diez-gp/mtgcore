<?php
include(__DIR__ . "/../db/DB.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idUser = $_POST['idUser'];
    $idTorneo = $_POST['idTorneo'];
    $fecha = $_POST['fecha'];

    $fecha_hoy = new DateTime();
    $fecha_torneo    = new DateTime($fecha);

    print_r($fecha_hoy);
    print_r($fecha_torneo);
    if (!empty($idUser) && !empty($idTorneo) && !empty($fecha)) {

         if ($fecha_torneo > $fecha_hoy) {
         DB::inscribirUsuario($idUser, $idTorneo);
               setcookie('actualizado', 1, time() + 5, '/');
          }else{
               setcookie('error', 1, time() + 5, '/');
          }
     }
   
}
?>