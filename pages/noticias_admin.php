<!DOCTYPE html>
<?php
    $crumb="admin";
    chdir(__DIR__);
    include("../components/head.php");
?>
    <script src="../scripts/news-logic.js" defer> </script>
</head>

<body>
<div class="body-wrapper">
    <?php
    $crumb = $crumb;
    include_once("../components/navbar.php");
    ?>
    <?php if(isset($_COOKIE['creado']) && $_COOKIE['creado'] == 1):     
           setcookie('creado', 0, time() - 10, '/');
            ?>
        <div id="banner-creado" style="display:block;">
            NOTICIA CREADA.
        </div>
    <?php endif ?>
    
    <?php if(isset($_COOKIE['eliminado']) && $_COOKIE['eliminado'] == 1): 
        setcookie('eliminado', 0, time() - 10, '/');
        ?>
        <div id="banner-eliminado" style="display:block;">
            NOTICIA BORRADA.
        </div>
    <?php endif ?>
    <section id="middle-section" class="width-100 centered">
        <h1 style="margin: -50px auto;">
            Noticias
        </h1>
        <article class="width-100" style="padding-bottom: 2rem;">
            <h2>Añadir noticia</h2>
            <div id="noticia-form-container">
                <form id="noticiaForm" action="../handlers/noticia_handler.php" method="POST">
                    <label for="titulo">Título de la noticia</label>
                    <input type="text" name="titulo" id="titulo" required/>
                    <label for="texto">Texto de la noticia</label>
                    <textarea  name="texto" id="texto" rows="4" required> </textarea>
                    <label for="imagen">Imagen</label>
                    <select name="imagen" id="imagen" required>
                        <option value="" disabled selected>Elige uno:</option>
                        <option value="Eldrazi">Eldrazi</option>
                        <option value="Wizard">Wizard</option>
                        <option value="Merfolk">Merfolk</option>
                        <option value="Logo">Logo</option>
                    </select>
                    <button type="submit" value="publicar">
                    Publicar
                    </button>
                </form>
            </div>
        </article>
        <article  style="margin: -50px auto;">
            <h2>
                Todas las noticias
            </h2>
            <div id="noticias-container" class="gap-5">
            <?php
                include("../db/DB.php");

                $noticias = DB::getNoticias();

                $sliced_noticias = $noticias;/*array_slice($noticias, 0, 3);*/

                include("../components/card.php");

            ?>
            </div>
            <div id="news-paginator">
                <?php /*include_once("../components/noticias_paginator.php"); */?>
            </div>
        </article>
    </section>
    <?php
    include("../components/footer.php");
    ?>