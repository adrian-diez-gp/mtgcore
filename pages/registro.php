<!DOCTYPE html>
<?php

    $crumb="registro";
    chdir(__DIR__);
    include(__DIR__ . "/../db/DB.php");

    include("../components/head.php");
?>
<link rel="stylesheet" href="../styles/login.css">
</head>
<body>
<div class="body-wrapper">
    <?php
    $crumb = $crumb;
    include_once("../components/navbar.php");
    ?>
        <section id="middle-section">
           <div class="form-wrapper">
            <div class="login-action-wrapper">
                <span>
                    ¿Ya tienes cuenta?
                </span>
                <a href="login.php">
                    <span>
                        Loguéate aquí
                    </span>
                </a>
            </div>
            <div class="form-wrapper">
                <form id="registerForm" action="../handlers/registro_handler.php" method="POST">
                    <input type="hidden" name="sourcePage" value="<?php echo basename($_SERVER['PHP_SELF']); ?>">
                    <label for="username">Nombre de usuario</label>
                    <input type="text" name="username" id="username" required/>
                    <div class="input-container">
                        <label for="password">Contraseña</label>
                        <input type="password" name="password" id="password" required/> 
                        <div class="see-pwd-icon" onmousedown="seePassword()" onmouseup="hidePassword()"><img src="../assets/see-password.png"/></div>
                    </div>
                    <label for="email">Correo electrónico</label>
                    <input type="email" name="email" id="email" required/>
                    <label for="nombre">Nombre</label>
                    <input type="nombre" name="nombre" id="nombre" required/>
                    <label for="apellidos">Apellidos</label>
                    <input type="apellidos" name="apellidos" id="apellidos" required/>
                    <button type="submit" value="Registrarse" style="margin-left:30%; margin-top:2vh;">
                    Registrarse
                    </button>
                </form>
            </div>
           </div>
        </section>
        <?php
        include("../components/footer.php");
        ?>
    </div>
</body>
</html>
