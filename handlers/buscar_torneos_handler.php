<?php
    include(__DIR__ . "/../db/DB.php");

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $query = trim($_POST['query']);

        if ($query === '') {
            echo '<div />';
            exit;
        }

        $torneos = DB::buscarTorneos($query);
        
        foreach ($torneos as $torneo) {
            $idTorneo = $torneo['idTorneo'];
            $inscripciones = DB::getInscripciones($idTorneo);
            include("../components/torneo.php");    
        }
    }

?>