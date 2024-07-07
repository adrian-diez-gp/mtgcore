<!DOCTYPE html>
<?php
    $crumb="noticias";
    chdir(__DIR__);
    include("../components/head.php");

    $id = isset($_GET['id']) ? $_GET['id'] : null;

    include("../db/DB.php");

    $noticia = $id ? DB::getNoticiaById($id) : null;
?>
</head>

<body>
<div class="body-wrapper">
    <?php
    include_once("../components/navbar.php");
    ?>
    <section id="middle-section">
    <?php if(isset($_COOKIE['actualizado']) && $_COOKIE['actualizado'] == 1):     
           setcookie('actualizado', 0, time() - 100, '/');
            ?>
        <div id="banner-actualizado" style="display:block;">
            NOTICIA ACTUALIZADA.
        </div>
    <?php endif ?>
    <div id="view-mode">
        <?php if ($noticia): ?>
            <?php if (isset($_COOKIE) && $_COOKIE['rol'] == 'admin'): ?>
                <div style="float: right;
                            position: absolute;
                            right: 10vw;
                            top: 15vh;"
                    id="btn-editar-noticia"
                            >Editar</div>
                            <form id="borrarNoticiaForm" action="../handlers/borrar_noticia_handler.php" method="POST" style="display: inline;">
                    <input type="hidden" name="idNoticia" value="<?php echo $noticia['idNoticia']; ?>">
                    <div style="float: right; position: absolute; right: 10vw; top: 20vh;" id="btn-borrar-noticia">
                    <button type="button" onclick="confirmDelete()" style="background: none; border: none; cursor: pointer; color: red;">Borrar</button>
                    </div>
                </form>
            <?php endif; ?>
        <h1><?php echo $noticia['titulo']; ?></h1>
        <div class="noticia-img-container">
            <img src="<?php echo "../assets/" . $noticia['imagen']; ?>" alt="Imagen de la noticia">
        </div>
        <div class="card-autor">
            <?php echo "Escrito por: ". $noticia['nombre']. " ". $noticia['apellidos']. ", publicada el ". $noticia['fecha_creacion']; ?>
        </div>
        <div class="card-content">
            <?php echo $noticia['texto']; ?>
        </div>
        <?php else: ?>
            <h1>Noticia no encontrada</h1>
        <?php endif; ?>
        </div>

        <div id="edit-mode" style="display:none;">
        <?php if ($noticia): ?>

            <form id="noticiaForm" action="../handlers/actualizar_noticia_handler.php" method="POST">
            <input type="hidden" name="_method" value="PUT">
            <input type="hidden" name="idNoticia" value="<?php echo $noticia['idNoticia']; ?>">
            <label for="titulo">Editar título: </label>
            <input name="titulo" id="titulo" type="text" value="<?php echo $noticia['titulo']; ?>"></input>

            <div id="seleccionar-imagen">
                <h4>Imagen seleccionada:</h4>
                <div class="noticia-img-container">
                <img src="<?php echo "../assets/" . $noticia['imagen']; ?>" alt="Imagen de la noticia">
            </div>
                <select name="imagen" id="imagen" required>
                    <option value="" disabled selected>Selecciona una nueva imagen:</option>
                    <option value="Eldrazi">Eldrazi</option>
                    <option value="Wizard">Wizard</option>
                    <option value="Merfolk">Merfolk</option>
                    <option value="Logo">Logo</option>
                </select>
            </div>
            <div class="card-autor">
                <?php echo "Escrito por: ". $noticia['nombre']. " ". $noticia['apellidos']. ", publicada el ". $noticia['fecha_creacion']; ?>
            </div>
            <label for="texto">Texto de la noticia: </label> <br/> 
            <textarea name="texto" id="texto" cols="30"><?php echo $noticia['texto']; ?></textarea>

        <div id="guardar-noticia">
            <button type="submit">Guardar</button>
        </div>
        <div id="cancelar-noticia">
            <button type="button" onclick="toggleEditMode()">Cancelar</button>
        </div>
        </form>
        <?php else: ?>
            <h1>Noticia no encontrada</h1>
        <?php endif; ?>
        </div>
        <a href="noticias.php">Volver atrás</a>
    </section>
    <?php
    include("../components/footer.php");
    ?>
</div>
</body>
</html>