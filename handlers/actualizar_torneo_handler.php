<?php
    include(__DIR__ . "/../db/DB.php");

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $query = trim($_POST['query']);
        $idTorneo = trim($_POST['idTorneo']);
        if ($query === '') {
            echo '<div />';
            exit;
        }
        $results = DB::buscarUsuarios($query);
        foreach ($results as $result) {
            echo '<div>'
            . htmlspecialchars($result['usuario']) . ' - ' .
            htmlspecialchars($result['nombre']) . ' ' .
            htmlspecialchars($result['apellidos']) .
            '<span onclick="inscribirUsuario('. $result['idUser'] . ', ' . $idTorneo .')">
                Añadir
            </span>
            </div>';
        }
    }

?>