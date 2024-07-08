<!DOCTYPE html>
<?php
    $crumb="torneos";
    chdir(__DIR__);
    include("../components/head.php");
?>

<body>
<div class="body-wrapper">
    <?php
    $crumb = $crumb;
    include_once("../components/navbar.php");

    include_once("../components/inscripciones_desc.php");
    ?>
 <?php if(isset($_COOKIE['creado']) && $_COOKIE['creado'] == 1): 
        setcookie('creado', 0, time() - 3600);
    ?>
        <div id="banner-creado">
            TE HAS INSCRITO CORRECTAMENTE!
        </div>
    <?php endif; ?>
    <?php if(isset($_COOKIE['eliminado']) && $_COOKIE['eliminado'] == 1): 
        setcookie('eliminado', 0, time() - 3600);
    ?>
        <div id="banner-eliminado">
            TE HAS BORRADO DEL TORNEO.
        </div>
    <?php endif; ?>
    <?php if(isset($_COOKIE['error']) && $_COOKIE['error'] == 1): 
        setcookie('error', 0, time() - 3600);
    ?>
        <div id="banner-eliminado">
            ESTE TORNEO YA SE HA JUGADO.
        </div>
    <?php endif; ?>
    <section id="middle-section">
        <div id="perfil-wrapper">
            <div id="datos-personales-article-wrapper">
                <article id="datos-personales">
                    <h2 id="datos-personales-title">
                        Próximos torneos
                    </h2>
                    <div id="buscador-torneos">
                        <label for="buscar-torneos">Buscar</label>
                        <input type="text"
                               name="buscar-torneos"
                               id="buscar-torneos"
                               placeholder="¡Busca tu primer torneo!"
                               onkeyup="buscarTorneos(this.value)">
                    </div>
                    <div id="proximos-torneos">
                        <ul id="lista-torneos-general">
                            <?php
                            include("../db/DB.php");
                            $torneos = DB::getTorneos();

                            $torneos = array_chunk($torneos, 5, true);

                            foreach($torneos[0] as $torneo) {
                                $idTorneo = $torneo['idTorneo'];
                                $inscripciones = DB::getInscripciones($idTorneo);

                                include("../components/torneo.php");
                            }
                            ?>
                        </ul>
                        <ul id="lista-torneos-buscados" style="display:none;">
                        </ul>
                    </div>
                </article>
            </div>
            <div id="torneos-wrapper">
                <article id="torneos">
                    
                    <h2>
                        TUS TORNEOS
                    </h2>
                    <ul id="lista-torneos">
                    <?php
                        $torneos = DB::getTorneosById($_COOKIE['idUser']);

                        if (count($torneos) > 0) {
                            foreach($torneos as $torneo) {
                                $idTorneo = $torneo['idTorneo'];
                                $inscripciones = DB::getInscripciones($idTorneo);
    
                                include("../components/torneo.php");
                            }
                        } else {
                            echo 'No tienes torneos proximamente. ¡Inscríbete a la izquierda!';
                        }
                    ?>
            </ul>
                </article>
            </div>
        </div>
    </section>
    <?php
    include("../components/footer.php");
    ?>