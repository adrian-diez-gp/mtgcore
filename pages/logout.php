<?php
    if (isset($_COOKIE['rol'])) {
        unset($_COOKIE['rol']);
        setcookie('rol', '', time() + 1, '/');
    }
    if (isset($_COOKIE['idUser'])) {
        unset($_COOKIE['idUser']);
        setcookie('idUser', '', time() + 1, '/');
    }
    echo "<script>window.location.href='home.php';</script>"; //redirect to index
    exit;
?>