<li>
    <article id="info-torneo">
        <div class="tournament-header">
            <h3><?php echo htmlspecialchars($torneo['titulo']) . ': ' . $torneo['fecha'] . ' a las ' . $torneo['hora']; ?></h3>
            <?php if($_COOKIE['rol'] == 'admin'): ?>
                <button <?php echo 'id="tournament-edition-btn-' . $torneo['idTorneo'] .'"' ?>
                        style="display:block;" onclick="toggleTournamentEdition(<?php echo $idTorneo; ?>)">
                    Editar
                </button>
            <?php endif; ?>
        </div>
        <div class="tournament-edition-div" <?php echo 'id="tournament-edition-div-' . $torneo['idTorneo'] .'"' ?> style="display:none;">
            <form action="../handlers/editar_torneo_handler.php" id="editarTorneoForm" method="POST" onsubmit="return editarTorneo()">
                <input type="hidden" name="idTorneo" value="<?php echo $torneo['idTorneo'] ?>" />
                <label for="titulo">Título</label>
                <input type="text" name="titulo" id="titulo" value="<?php echo $torneo['titulo'] ?>" required/> <br/>
                <label for="fecha">Fecha del torneo</label>
                <input type="date" name="fecha" id="fecha" value="<?php echo $torneo['fecha'] ?>"required/><br/>
                <label for="hora">Hora del torneo</label>
                <input type="time" name="hora" id="hora" value="<?php echo $torneo['hora'] ?>" step="300" required/><br/>
                <button type="submit">
                    Guardar
                </button>
                <button type="button" onclick="toggleTournamentEdition(<?php echo $idTorneo; ?>)">
                    Cancelar
                </button>
            </form>
        </div>
        <div id="inscripciones-actions">
            <div id="numero-inscritos">
                Inscripciones: <?php echo count($inscripciones); ?>
            </div>
            <div id="inscribirse" onclick="inscribirUsuario(<?php echo $_COOKIE['idUser'] . ',' . $idTorneo . ',' . $torneo['fecha']; ?>)">
                Inscribirse
            </div>
        </div>
    </article>
    <?php foreach ($inscripciones as $inscripcion): ?>
        <div class="inscripcion">
            <h4><?php echo htmlspecialchars($inscripcion['nombre']) . ' ' . htmlspecialchars($inscripcion['apellidos']); ?></h4>
            <?php if(($_COOKIE['rol'] == 'admin') || ($_COOKIE['idUser'] == $inscripcion['idUser'])): ?>
            <button onclick="borrarInscripcion(<?php echo $inscripcion['idUser'] . ', ' . $idTorneo . ',' . $torneo['fecha']; ?>)">Borrar</button>
            <?php endif; ?> 
        </div>
    <?php endforeach; ?>
    <?php if($_COOKIE['rol'] == 'admin'): ?>
        <div id="separator"></div>
        <div id="buscador-container">
            <h3>Añadir jugador</h3>
            <div id="buscador">
                <input type="text" placeholder="Buscar..." onkeyup="buscarUsuarios(this.value, <?php echo $idTorneo; ?>, <?php echo $torneo['fecha']?>)" id="buscador-usuarios" />
                <div id="searchResults-<?php echo $idTorneo; ?>">
            </div>
            </div>
        </div>
    <?php endif; ?> 
    
</li>
