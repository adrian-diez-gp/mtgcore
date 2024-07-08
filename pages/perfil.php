<!DOCTYPE html>
<?php
    $crumb="perfil";
    chdir(__DIR__);
    include("../components/head.php");
?>
</head>
<body>
    <?php if(isset($_COOKIE['creado']) && $_COOKIE['creado'] == 1): 
        setcookie('creado', 0, time() - 3600);
    ?>
        <div id="banner-creado">
            TE HAS INSCRITO CORRECTAMENTE!
        </div>
    <?php endif; ?>
    <?php if(isset($_COOKIE['actualizado']) && $_COOKIE['actualizado'] == 1): 
        setcookie('actualizado', 0, time() - 3600);
    ?>
        <div id="banner-actualizado">
            TU PERFIL HA SIDO ACTUALIZADO.
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
        ESTE TORNEO YA SE HA JUGADO. POR FAVOR, ESCOGE OTRO.
        </div>
    <?php endif; ?>
    <div class="body-wrapper">
    <?php
        $crumb = $crumb;
        include_once("../components/navbar.php");
    ?>

    <section id="middle-section">
        <div id="perfil-wrapper">
            <div id="datos-personales-article-wrapper">
                <article id="datos-personales">
                    <h2 id="perfil-title">
                        TUS DATOS
                    </h2>
                    <ul id="perfil-lista-datos">
                        <?php
                            include("../db/DB.php");
                            if(isset($_COOKIE['idUser'])) {
                                $user = DB::getUsuarioById($_COOKIE['idUser']);
                            } else {
                                echo '<div> USUARIO NO ENCONTRADO. POR FAVOR. LOGUÉATE DE NUEVO.';
                            }

                            if ($user) {
                                echo '<form id="perfilForm" method="POST">';
                                echo '<input type="hidden" name="_method" value="PUT" />';
                                echo '<input type="hidden" name="perfil-idUser" id="perfil-idUser" value="' . $user['idUser'] . '" />';
                                echo '<li>';
                                echo '<label for="perfil-username">Nombre de usuario</label>';
                                echo '<div class="input-container">';
                                echo '<input type="text" name="perfil-username" id="perfil-username" value="' . $user['usuario'] . '" disabled/>';
                                echo '</div>';
                                echo '</li>';

                                echo '<li>';
                                echo '<label for="cambiar-password">Cambiar contraseña</label>';
                                echo '<div class="input-container">';
                                echo '<input type="password" name="cambiar-password" id="cambiar-password"/>';
                                echo '<div class="see-pwd-icon" onmousedown="seePassword()" onmouseup="hidePassword()"><img src="../assets/see-password.png"/></div>';
                                echo '</div>';
                                echo '</li>';

                                echo '<li>';
                                echo '<label for="confirmar-password">Confirmar contraseña</label>';
                                echo '<div class="input-container">';
                                echo '<input type="password" name="confirmar-password" id="confirmar-password" />';
                                echo '<div class="see-pwd-icon" onmousedown="seePassword()" onmouseup="hidePassword()"><img src="../assets/see-password.png"/></div>';
                                echo '</div>';
                                echo '<div class="actualizar-pwd-btn">';
                                echo '<button type="button" onclick="confirmPassword(' . $user['idUser'] . ')">Actualizar contraseña</button>';
                                echo '</div>';
                                echo '</li>';  

                                echo '<li>';
                                echo '<label for="perfil-nombre">Nombre</label>';
                                echo '<div class="input-container">';
                                echo '<input type="text" name="perfil-nombre" id="perfil-nombre" value="' . $user['nombre'] . '" disabled/>';
                                echo '<button type="button" id="editar-perfil-nombre">Editar</button>';
                                echo '<button type="button" id="guardar-perfil-nombre" style="display:none;">Guardar</button>';
                                echo '</div>';
                                echo '</li>';

                                echo '<li>';
                                echo '<label for="perfil-apellidos">Apellidos</label>';
                                echo '<div class="input-container">';
                                echo '<input type="text" name="perfil-apellidos" id="perfil-apellidos" value="' . $user['apellidos'] . '" disabled/>';
                                echo '<button type="button" id="editar-perfil-apellidos">Editar</button>';
                                echo '<button type="button" id="guardar-perfil-apellidos" style="display:none;">Guardar</button>';
                                echo '</div>';
                                echo '</li>';

                                echo '<li>';
                                echo '<label for="perfil-telefono">Teléfono</label>';
                                echo '<div class="input-container">';
                                echo '<input type="tel" name="perfil-telefono" id="perfil-telefono" value="' . $user['telefono'] . '"/>';
                                echo '<button type="button" id="editar-perfil-telefono">Editar</button>';
                                echo '<button type="button" id="guardar-perfil-telefono" style="display:none;">Guardar</button>';
                                echo '</div>';
                                echo '</li>';

                                echo '<li>';
                                echo '<label for="perfil-fechanacimiento">Fecha de nacimiento</label>';
                                echo '<div class="input-container">';
                                echo '<input type="date" name="perfil-fechanacimiento" id="perfil-fechanacimiento" value="' . $user['fecha_nacimiento'] . '" disabled/>';
                                echo '<button type="button" id="editar-perfil-fechanacimiento">Editar</button>';
                                echo '<button type="button" id="guardar-perfil-fechanacimiento" style="display:none;">Guardar</button>';
                                echo '</div>';
                                echo '</li>';

                                echo '<li>';
                                echo '<label for="perfil-sexo">Sexo</label>';
                                echo '<div class="input-container">';
                                echo '<select name="perfil-sexo" id="perfil-sexo" required>';
                                $s = $user['sexo'];
                                if ($s) {
                                    echo '<option value="' . $s . '" disabled selected>' . $s . '</option>';
                                } else {
                                    echo '<option value="" disabled selected>Sexo: </option>';
                                }
                                echo '<option value="Hombre" onclick="actualizarUsuarioPerfil(' . $user['idUser'] . ')" >Hombre</option>';
                                echo '<option value="Mujer" onclick="actualizarUsuarioPerfil(' . $user['idUser'] . ')">Mujer</option>';
                                echo '<option value="nsnc" onclick="actualizarUsuarioPerfil(' . $user['idUser'] . ')">Prefiero no decir</option>';
                                echo '</select>';
                                echo '<button type="button" id="guardar-perfil-sexo">Guardar</button>';
                                echo '</div>';
                                echo '</li>';

                                echo '<li>';
                                echo '<label for="perfil-direccion">Dirección</label>';
                                echo '<div class="input-container">';
                                echo '<textarea rows="4" name="perfil-direccion" id="perfil-direccion" disabled>';
                                echo $user['direccion'];
                                echo '</textarea>';
                                echo '<button type="button" id="editar-perfil-direccion">Editar</button>';
                                echo '<button type="button" id="guardar-perfil-direccion" style="display:none;">Guardar</button>';
                                echo '</div>';
                                echo '</li>';
                                echo '</form>';

                            }
                        ?>
                    </ul>
                </article>
            </div>
            <div id="perfil-torneos-article-wrapper">
                <article id="perfil-torneos">
                    <h2 id="perfil-title">
                        TUS TORNEOS
                    </h2>
                    <ul id="perfil-lista-torneos">
                    <?php
                        $torneos = DB::getTorneosById($_COOKIE['idUser']);

                        foreach($torneos as $torneo) {
                            $idTorneo = $torneo['idTorneo'];
                            $inscripciones = DB::getInscripciones($idTorneo);

                            include("../components/torneo.php");
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