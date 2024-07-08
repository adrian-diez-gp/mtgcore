<!DOCTYPE html>
<?php
    $crumb="login";
    chdir(__DIR__);
    include("../components/head.php");
    include(__DIR__ . "/../db/DB.php");
?>
<script src="../scripts/login-logic.js" defer></script>
<link rel="stylesheet" href="../styles/login.css">
</head>
<body>
<div class="body-wrapper">
    <?php
    $crumb = $crumb;
    $navbarItems = array('home','noticias','registro','login');
    include_once("../components/navbar.php");
    ?>
        <?php if(isset($_COOKIE['error']) && $_COOKIE['error'] == 1): 
        setcookie('error', 0, time() - 3600);
    ?>
        <div id="banner-eliminado">
        USERNAME O CONTRASEÑA INCORRECTOS. POR FAVOR, INTÉNTALO DE NUEVO.
        </div>
    <?php endif; ?>
        <section id="middle-section">
           <div class="form-wrapper">
                <form id="loginForm" action="../handlers/login_handler.php" method="POST">
                    <label for="username">Nombre de usuario</label>
                    <input type="text" name="username" id="username" required>
                    <div class="input-container">
                        <label for="password">Contraseña</label>
                        <input type="password" name="password" id="password" required>
                        <div class="see-pwd-icon" onmousedown="seePassword()" onmouseup="hidePassword()"><img src="../assets/see-password.png"/></div>
                    </div>
                    <button type="submit" style="margin-left:30%; margin-top:2vh;">Entrar</button>
                </form>
                <div class="login-action-wrapper">
                    <span>
                        ¿No tienes cuenta?
                    </span>
                    <a href="registro.php">
                        <span>
                            Regístrate aquí
                        </span>
                    </a>
                </div>
           </div>
           
        </section>
        <?php
        include("../components/footer.php");
        ?>

        

