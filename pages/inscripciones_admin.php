<!DOCTYPE html>
<?php
    $crumb="admin";
    chdir(__DIR__);
    include("../components/head.php");
?>

<body>
<div class="body-wrapper">
    <?php
    $crumb = $crumb;
    include_once("../components/navbar.php");
    ?>
 <?php if(isset($_COOKIE['creado']) && $_COOKIE['creado'] == 1): 
        setcookie('creado', 0, time() - 3600);
    ?>
        <div id="banner-creado">
            EL TORNEO SE HA CREADO CORRECTAMENTE.
        </div>
    <?php endif; ?>
    <?php if(isset($_COOKIE['actualizado']) && $_COOKIE['actualizado'] == 1): 
        setcookie('actualizado', 0, time() - 3600);
    ?>
        <div id="banner-actualizado">
            EL JUGADOR SE HA INSCRITO CORRECTAMENTE.
        </div>
    <?php endif; ?>
    <?php if(isset($_COOKIE['eliminado']) && $_COOKIE['eliminado'] == 1): 
        setcookie('eliminado', 0, time() - 3600);
    ?>
        <div id="banner-eliminado">
        EL JUGADOR SE HA BORRADO DEL TORNEO.
        </div>
    <?php endif; ?>
    <?php if(isset($_COOKIE['error']) && $_COOKIE['error'] == 1): 
        setcookie('error', 0, time() - 3600);
    ?>
        <div id="banner-eliminado">
        ESTE TORNEO YA SE HA JUGADO. POR FAVOR, ESCOGE OTRO.
        </div>
    <?php endif; ?>
    <section id="middle-section">
        <div id="admin-wrapper">
            <div id="admin-inscripciones-header">
                <h1 id="admin-title">ADMINISTRAR TORNEOS</h1>
                <button class="crear-torneo" onclick="toggleTournamentCreation()">Crear torneo</button>
            </div>
            <div id="tournament-creation-div" style="display:none;">
                <form id="inscripcionForm" action="../handlers/inscripcion_handler.php" method="POST">
                    <input type="hidden" name="idUser" value=1>
                    <label for="titulo">Título del torneo</label>
                    <input type="text" name="titulo" id="titulo" required/>
                    <label for="fecha">Fecha del torneo</label>
                    <input type="date" name="fecha" id="fecha" required/>
                    <label for="hora">Hora del torneo</label>
                    <input type="time" name="hora" id="hora" value="00:00" step="300" required/>
                    <button type="submit">
                    Publicar
                    </button>
                </form>
            </div>
            <ul id="lista-torneos">
                <?php
                include("../db/DB.php");
                $torneos = DB::getTorneos();

                foreach($torneos as $torneo) {
                    $idTorneo = $torneo['idTorneo'];
                    $inscripciones = DB::getInscripciones($idTorneo);

                    include("../components/torneo.php");
                }
                ?>
            </ul>
        </div>
    </section>
    <?php
    include("../components/footer.php");
    ?>