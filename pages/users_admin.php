<!DOCTYPE html>
<?php
    $crumb="admin";
    chdir(__DIR__);
    include("../components/head.php");
?>

<link rel="stylesheet" href="../styles/login.css">

<body>
<?php if(isset($_COOKIE['creado']) && $_COOKIE['creado'] == 1): 
           setcookie('creado', 0, time() - 3600);
            ?>
        <div id="banner-creado" style="display:none;">
            USUARIO CREADO.
        </div>
        <?php endif ?>
        <?php if(isset($_COOKIE['actualizado']) && $_COOKIE['actualizado'] == 1): 
        setcookie('actualizado', 0, time() - 3600);
    ?>
        <div id="banner-actualizado">
            EL USUARIO HA SIDO ACTUALIZADO.
        </div>
    <?php endif; ?>
    <?php if(isset($_COOKIE['eliminado']) && $_COOKIE['eliminado'] == 1): 
        setcookie('eliminado', 0, time() - 3600);
    ?>
        <div id="banner-eliminado">
        EL USUARIO HA SIDO BORRADO CORRECTAMENTE.
        </div>
    <?php endif; ?>
<div class="body-wrapper">
    <?php
    $crumb = $crumb;
    include_once("../components/navbar.php");
    ?>
    <section id="middle-section">
        <h1>USUARIOS</h1>
        <div id="crear-usuarios">
            <h3>CREAR USUARIO</h3>
                <form id="crear-usuario-form" action="../handlers/registro_handler.php" method="POST">
                    <input type="hidden" name="sourcePage" value="<?php echo basename($_SERVER['PHP_SELF']); ?>">
                    <label for="username">Nombre de usuario</label>
                    <input type="text" name="username" id="username" required/>
                    <label for="password">Contraseña</label>
                    <input type="password" name="password" id="password" required/>
                    <div><label for="rol">Rol</label></div>
                    <input list="rol" name="rol">
                    <datalist id="rol">
                        <option value="admin">
                        <option value="user">
                    </datalist>
                    <div><label for="email">Email</label></div>
                    <input type="email" name="email" id="email" required/>
                    <label for="nombre">Nombre</label>
                    <input type="nombre" name="nombre" id="nombre" required/>
                    <label for="apellidos">Apellidos</label>
                    <input type="apellidos" name="apellidos" id="apellidos" required/>
                    <button type="submit" value="Registrarse">
                        Crear usuario
                    </button>
                </form>
           </div>
        <table id="tabla-usuarios">
            <tr id="tabla-usuarios-head">
                <th>Username</th>
                <th>Nombre</th>
                <th>Apellidos</th>
                <th>Rol</th>
                <th>Editar</th>
                <th>Eliminar</th>
            </tr>
            <?php
                include("../db/DB.php");
                $usuarios = DB::getUsuarios();

                foreach($usuarios as $usuario) {
                    $id = $usuario['idUser'];
                    echo '<tr id="'. $id .'">';
                    echo '<td id="currentUsername-' . $id . '">' . $usuario['usuario'] . '</td>';
                    echo '<td id="currentNombre-' . $id . '">' . $usuario['nombre'] . '</td>';
                    echo '<td id="currentApellidos-' . $id . '">' . $usuario['apellidos'] . '</td>';
                    echo '<td  id="currentRol-' . $id . '">' . $usuario['rol'] . '</td>';
                    if($usuario['rol'] == 'user'): {
                        echo '<td onclick="toggleAdminUserEdit(' . $usuario['idUser'] . ')">Editar</td>';
                        echo '<td onclick="verifyDeleteUser(' . $usuario['idUser'] . ')">Eliminar</td>';
                    }
                endif;
                    echo '</tr>';

                    echo '<tr id="'. $id .'-edit" style="display: none;">';
                    echo '<td> <input type="text" id="newUsername-' . $id . '" value="' . $usuario['usuario'] . '"</td>';
                    echo '<td> <input type="text" id="newNombre-' . $id . '" value="' . $usuario['nombre'] . '"</td>';
                    echo '<td> <input type="text" id="newApellidos-' . $id . '" value="' . $usuario['apellidos'] . '"</td>';
                    echo '<td>' . $usuario['rol'] . '</td>';
                    echo '<td onclick="actualizarUsuario(' . $usuario['idUser'] . ')">Guardar</td>';
                    echo '<td onclick="toggleAdminUserEdit(' . $usuario['idUser'] . ')">Cancelar</td>';
                    echo '</tr>';
                }
            ?>
        </table>
    </section>
    <?php
    include("../components/footer.php");
    ?>