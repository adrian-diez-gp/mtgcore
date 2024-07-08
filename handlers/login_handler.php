<?php
include(__DIR__ . "/../db/DB.php");

function login() {
    if (!isset($_POST['username'], $_POST['password'])) {
        echo json_encode(array("success" => false, "message" => "Username and password are required."));
        return;
    }

    $username = htmlspecialchars(trim($_POST['username']));
    $password = trim($_POST['password']);

    if (empty($username) || empty($password)) {
        echo json_encode(array("success" => false, "message" => "Username and password cannot be empty."));
        return;
    }

    $loginResult = DB::login($username, $password);
    
    if ($loginResult['success']) {
        $user = $loginResult['user'];
        $rol = $user['rol'];
        $idUser = $user['idUser'];
        setcookie("rol", $rol, time() + 3600, "/");
        setcookie("idUser", $idUser, time() + 3600, "/");
        setcookie('creado', 1, time() + 5, '/');
        echo json_encode(array("success" => true, "message" => "Login successful."));
    } else {
        setcookie('error', 1, time() + 5, '/');
        echo json_encode(array("success" => false, "message" => "Incorrect username or password"));
    }
}

if (!empty($_POST)) {
    login();
    exit;
}
?>