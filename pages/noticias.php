<!DOCTYPE html>
<?php
    $crumb="noticias";
    chdir(__DIR__);
    include("../components/head.php");
?>
</head>
<body>
<div class="body-wrapper">
    <?php
    $crumb = $crumb;
    include_once("../components/navbar.php");
    ?>
    <section id="middle-section">
        <h2 style="margin-top: -3rem;">
            Todas las noticias de Magic: the Gathering
        </h2>
        <div id="noticias-container" class="gap-5">
            <?php
                include("../db/DB.php");

                $noticias = DB::getNoticias();

                $sliced_noticias = $noticias;/*array_slice($noticias, 0, 3);*/

                include("../components/card.php");
            ?>
        </div>
    </section>
    <?php
    include("../components/footer.php");
    ?>