<?php
include(__DIR__ . "/../db/DB.php");

function login() {
    // Check if the required POST parameters are set
    if (!isset($_POST['username'], $_POST['password'])) {
        echo json_encode(array("success" => false, "message" => "Username and password are required."));
        return;
    }

    $username = $_POST['username'];
    $password = $_POST['password'];

    $username = htmlspecialchars(trim($username));
    $password = trim($password);

    if (empty($username) || empty($password)) {
        echo json_encode(array("success" => false, "message" => "Username and password cannot be empty."));
    }
    
    $loginResult = DB::login($username, $password);

    if ($loginResult['success'] == true) {
        echo json_encode(array("success" => true, "message" => "Login successful."));
        $user = $loginResult['user'];
        $rol = $user['rol'];
        $idUser = $user['idUser'];
        setcookie("rol", $rol, time() + 3600, "/");
        setcookie("idUser", $idUser, time() + 3600, "/");
        echo "<script>window.location.href='../index.php';</script>"; 
        return;
    }
        
    echo json_encode(array("success" => false, "message" => "Invalid username or password."));
    return;
}

if (!empty($_POST)) {
    login();
        exit;
}

echo json_encode(array("success" => false, "message" => "Only POST method is allowed."));

?>


