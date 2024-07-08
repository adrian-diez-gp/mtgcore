<?php
    include(__DIR__ . "/../db/DB.php");

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    if ($_POST) {
        $username = $_POST['username'];
        $email = $_POST['email'];
        if(isset($_POST['rol'])) {
            $rol =  $_POST['rol'];
        } else {$rol = 'user';}
        $password = $_POST['password'];
        $nombre = $_POST['nombre'];
        $apellidos = $_POST['apellidos'];
        $sourcePage = $_POST['sourcePage'];

        $username = htmlspecialchars(trim($username));
        $email = htmlspecialchars(trim($email));
        $nombre = htmlspecialchars(trim($nombre));
        $apellidos = htmlspecialchars(trim($apellidos));
        $password = trim($password);

        if(!empty($username) && !empty($password) && !empty($email) && !empty($nombre) && !empty($apellidos)) {
            if (DB::emailExists($email)) {
                echo "Email already exists.";
                return;
            }
            if (DB::usernameExists($username)) {
                echo "Nombre de usuario ya elegido.";
                return;
            }
            echo "Email does not exist. Proceeding with registration.";
            $user = DB::register($nombre, $apellidos, $rol, $email, $username, $password)['user'];

            if ($sourcePage === 'users_admin.php') {
                setcookie('creado', 1, time() + 5, '/');
                header("Location: ../pages/users_admin.php");
            } elseif ($sourcePage === 'registro.php') {
                setcookie('idUser', $user['idUser'], time() + 3600, '/');
                setcookie('rol', $user['rol'], time() + 3600, '/');
                setcookie('creado', 1, time() + 5, '/');
                header("Location: ../index.php");
            } else {
                header("Location: ../index.php");
            }
            exit();
        } else {
            echo "Username and password cannot be empty.";
        }
    }
?>