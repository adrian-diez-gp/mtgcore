<!DOCTYPE html>
<?php
    $crumb="home";
    chdir(__DIR__);
    include("../components/head.php");
?>
</head>
<body>
    <?php if(isset($_COOKIE['creado']) && $_COOKIE['creado'] == 1): 
        setcookie('creado', 0, time() - 3600);
    ?>
        <div id="banner-creado">
            LOGIN CORRECTO! BIENVENIDO!
        </div>
    <?php endif; ?>
    <div class="body-wrapper">
    <header>
    <?php

    $crumb = $crumb;

    include("../components/navbar.php");
    include("../components/cta.php");
    ?>
    </header>
    <section id="middle-section">
    <h2>Las últimas noticias de Magic: the Gathering</h2>
    <?php
    include("../components/news.php");
    ?>
    <span><a href="noticias.php">Ver más</a></span>
    </section>
    <?php
    include("../components/footer.php")
    ?>

