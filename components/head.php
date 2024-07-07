<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>
        <?php

        echo(
           ucfirst($crumb).' - MTG Core'
        );

        $conexion = new mysqli('localhost', 'root', '', 'mtg_core');
        if ($conexion->connect_errno) {
            echo "connect errno = $conexion->connect_errno <br>";
         }

        ?>
        
        </title>
        <link rel="stylesheet" href="../styles/index.css">
        <link rel="stylesheet" href="../styles/card.css">
        <link rel="stylesheet" href="../styles/navbar.css">
        <link rel="stylesheet" href="../styles/perfil.css">
        <link rel="stylesheet" href="../styles/admin.css">
        <link rel="stylesheet" href="../styles/banner.css">

        <script src="../scripts/navbar-logic.js" defer> </script>
        <script src="../scripts/users-logic.js" defer> </script>
        <script src="../scripts/inscripciones-logic.js" defer> </script>
        <script src="../scripts/banner-logic.js" defer> </script>
        <script src="../scripts/perfil-logic.js" defer> </script>

        
    