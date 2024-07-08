<?php
include ".env.php";
class DB {
    public static function conn() {
        $errorCon = false;
        $conexion = new mysqli(HOST, USUARIO, PASSWORD, DB);
        if ($conexion->connect_errno) {
            echo "Connect error = $conexion->connect_errno <br>";
            $errorCon = true;
        }
        if ($conexion == null || $errorCon == true) {
            echo "No se puede crear la conexión con la base de datos";
        } 
        return $conexion;
    }

    public static function register($nombre, $apellidos, $rol, $email, $username, $password) {
        $conexion = self::conn();

        $insertSql = $conexion->prepare("INSERT INTO users_data (nombre, apellidos, email) VALUES (?,?,?)");

        if ($insertSql === false) {
            echo "Error: " . $conexion->error;
            return;
        }

        $insertSql->bind_param("sss", $nombre, $apellidos, $email);

        if($insertSql->execute()) {
            echo "Se han insertado $conexion->affected_rows filas en esta acción";
            echo "En la inserción se ha asignado el id $conexion->insert_id";
        } else {
            echo "Error: " . $conexion->error;
        }

        $idUserSql = $conexion->prepare("SELECT idUser FROM users_data WHERE email = ?");
        $idUserSql->bind_param("s", $email);
        $idUserSql->execute();

        $result = $idUserSql->get_result();
         // Check if we got a result and fetch the row
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $idUser = $row['idUser'];
        } else {
            $idUser = null;
        }

        $insertSql = $conexion->prepare("INSERT INTO users_login (idUser, usuario, `password`, rol) VALUES (?,?,?,?)");

        $options = ['cost' => 10];
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT, $options);

        $insertSql->bind_param("isss", $idUser, $username, $hashedPassword, $rol);

        if($insertSql->execute()) {
            echo "Se han insertado $conexion->affected_rows filas en esta acción";
            echo "En la inserción se ha asignado el id $conexion->insert_id";
        } else {
            echo "Error: " . $conexion->error;
        }

        
        $user = self::login($username, $password);

        $insertSql->close();
        $conexion->close();

        return $user;
    }

    public static function login($username, $password) {
        $conexion = self::conn();

        $loginSql = $conexion->prepare("SELECT * FROM users_login WHERE usuario = ?");
        $loginSql->bind_param("s", $username);
        $loginSql->execute();

        $result = $loginSql->get_result();

        if ($result->num_rows == 0) {
            $res = array("success" => false, "message" => "Incorrect username or password");
            return $res;
        }

        $user = $result->fetch_assoc();
        $hashedPassword = $user['password'];

        if (password_verify($password, $hashedPassword)) {
            return array("success" => true, "user" => $user);
        } else {
            return array("success" => false, "message" => "Incorrect username or password");
        }
    }

    public static function emailExists($email) {
        $conexion = self::conn();
        $stmt = $conexion->prepare("SELECT idUser FROM users_data WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();
    
        $emailExists = $stmt->num_rows > 0;
    
        echo "Debug: Number of rows found for email '$email': " . $stmt->num_rows;

        $stmt->close();
        $conexion->close();
    
        return $emailExists;
    }

    public static function usernameExists($username) {
        $conexion = self::conn();
        $stmt = $conexion->prepare("SELECT idUser FROM users_login WHERE usuario = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->store_result();
    
        $usernameExists = $stmt->num_rows > 0;
    
        echo "Debug: Number of rows found for username '$username': " . $stmt->num_rows;

        $stmt->close();
        $conexion->close();
    
        return $usernameExists;
    }

    public static function actualizarUsuario($username, $nombre, $apellidos, $telefono, $fecha_nacimiento, $sexo, $direccion, $idUser) {
        $conexion = DB::conn();

        $updateSql = $conexion->prepare("UPDATE users_data d
                                    JOIN users_login l ON d.idUser = l.idUser
                                    SET l.usuario = ?, d.nombre = ?, d.apellidos = ?,
                                    d.telefono = ?, d.fecha_nacimiento = ?, d.sexo = ?, d.direccion = ?
                                    WHERE d.idUser = ?");

        if ($updateSql === false) {
            echo "Error: " . $conexion->error;
            return;
        }

        $updateSql->bind_param("sssssssi", $username, $nombre, $apellidos, $telefono, $fecha_nacimiento, $sexo, $direccion, $idUser);

        if ($updateSql->execute()) {
            echo "Usuario actualizado correctamente.";
        } else {
            echo "Error: " . $updateSql->error;
        }

        $updateSql->close();
        $conexion->close();
    }

    public static function actualizarUsuarioPassword($idUser, $password) {
        $conexion = DB::conn();

        $updateSql = $conexion->prepare("UPDATE users_login 
                                    SET `password` = ?
                                    WHERE idUser = ?");

        if ($updateSql === false) {
            echo "Error: " . $conexion->error;
            return;
        }

        $options = ['cost' => 10];
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT, $options);

        print_r($password);
        print_r($hashedPassword);


        $updateSql->bind_param("si", $hashedPassword, $idUser);

        if ($updateSql->execute()) {
            echo "Usuario actualizado correctamente.";
        } else {
            echo "Error: " . $updateSql->error;
        }

        $updateSql->close();
        $conexion->close();
    }

    public static function borrarUsuario($idUser) {
        $conexion = self::conn();

        $deleteSql = $conexion->prepare("UPDATE users_data SET deleted = 1 WHERE idUser = ?");
        $deleteSql->bind_param("i", $idUser);
    
        if ($deleteSql->execute()) {
            echo "Usuario eliminado correctamente.";
        } else {
            echo "Error al eliminar usuario: " . $conexion->error;
        }
    
        $deleteSql->close();
        $conexion->close();
    }

    public static function getUsuarios() {
        $conexion = self::conn();

        $payload = $conexion->query("SELECT d.*, l.idUser, l.usuario, l.rol
                                    FROM users_data d JOIN users_login l
                                    ON d.IdUser = l.idUser
                                    WHERE d.deleted = 0;");

        $result = [];
         
        while($fila = $payload->fetch_array()) {
            array_push($result, $fila);
        }

        return $result;
        $conexion->close();
    }

    public static function getUsuarioById($id) {
        $conexion = self::conn();

        $getSql = $conexion->prepare("SELECT d.*, l.idUser, l.usuario, l.rol
                                    FROM users_data d JOIN users_login l
                                    ON d.IdUser = l.idUser
                                    WHERE d.idUser = ?");

        $getSql->bind_param("i", $id);

        $getSql->execute();

        $result = $getSql->get_result();
        $user = $result->fetch_assoc();

        $getSql->close();

        return $user;
    }

    public static function buscarUsuarios($keyword) {
        $conexion = self::conn();

        $usuarios = self::getUsuarios();

        $searchQuery = "%{$keyword}%";

        $searchSql = $conexion->prepare("SELECT u.*, l.usuario 
        FROM users_data u
        JOIN users_login l ON u.idUser = l.idUser
        WHERE u.nombre LIKE ? 
        OR u.apellidos LIKE ?
        OR u.email LIKE ?
        OR l.usuario LIKE ?");

        $searchSql->bind_param("ssss", $searchQuery, $searchQuery, $searchQuery, $searchQuery);
        $searchSql->execute();
        $users = $searchSql->get_result();

        $result = [];
        while ($row = $users->fetch_assoc()) {
            $result[] = $row;
        }
    
        $searchSql->close();
        $conexion->close();
    
        return $result;
    }

    public static function getNoticias() {
        $conexion = self::conn();

        $noticias = $conexion->query("SELECT n.*, u.nombre, u.apellidos FROM noticias n INNER JOIN users_data u ON n.idUser = u.idUser");

        $lenght_noticias = $noticias->num_rows;


        $result = [];
         
        while($noticia = $noticias->fetch_array()) {
            array_push($result, $noticia);
        }

        $conexion->close();

        return $result;
    }

    public static function getNoticiaById($id) {
        $conn = self::conn();

        $peticion = $conn->prepare("SELECT n.*, u.nombre, u.apellidos 
                                    FROM noticias n JOIN users_data u 
                                    ON n.idUser = u.idUser
                                    WHERE n.idNoticia = ?");
        $peticion->bind_param('i', $id);
        $peticion->execute();

        $result = $peticion->get_result();
        $noticia = $result->fetch_assoc();

        $peticion->close();

        return $noticia;
    }

    public static function crearNoticia($idUser, $titulo, $texto, $imagen, $fecha_creacion) {
        $conexion = self::conn();

        $insertSql = $conexion->prepare("INSERT INTO noticias (idUser, titulo, texto, imagen, fecha_creacion) VALUES (?,?,?,?,?)");

        if ($insertSql === false) {
            echo "Error: " . $conexion->error;
            return;
        }

        $insertSql->bind_param("issss", $idUser, $titulo, $texto, $imagen, $fecha_creacion);

        if($insertSql->execute()) {
            echo "Se han insertado $conexion->affected_rows filas en esta acción";
            echo "En la inserción se ha asignado el id $conexion->insert_id";
        } else {
            echo "Error: " . $conexion->error;
        }

        $insertSql->close();
        $conexion->close();
    }

    public static function actualizarNoticia($idNoticia, $titulo, $texto, $imagen, $fecha_creacion) {
        $conexion = self::conn();
    
        $updateSql = $conexion->prepare("UPDATE noticias SET titulo = ?, texto = ?, imagen = ?, fecha_creacion = ? WHERE idNoticia = ?");
    
        if ($updateSql === false) {
            echo "Error: " . $conexion->error;
            return;
        }
    
        $updateSql->bind_param("ssssi", $titulo, $texto, $imagen, $fecha_creacion, $idNoticia);
    
        if($updateSql->execute()) {
            echo "Se han actualizado $conexion->affected_rows filas en esta acción";
        } else {
            echo "Error: " . $conexion->error;
        }
    
        $updateSql->close();
        $conexion->close();
    }

    public static function borrarNoticia($idNoticia) {
        $conexion = self::conn();
    
        $deleteSql = $conexion->prepare("DELETE FROM noticias WHERE idNoticia = ?");
        
        if ($deleteSql === false) {
            echo "Error: " . $conexion->error;
            return;
        }
    
        $deleteSql->bind_param("i", $idNoticia);
    
        if ($deleteSql->execute()) {
            echo "La noticia con ID $idNoticia ha sido borrada.";
        } else {
            echo "Error: " . $conexion->error;
        }
    
        $deleteSql->close();
        $conexion->close();
    }

    public static function crearTorneo($titulo, $fecha, $hora) {
        $conexion = self::conn();

        $insertSql = $conexion->prepare("INSERT INTO torneos (titulo, fecha, hora) VALUES (?,?, ?)");

        if ($insertSql === false) {
            echo "Error: " . $conexion->error;
            return;
        }

        $insertSql->bind_param("sss", $titulo, $fecha, $hora);

        if($insertSql->execute()) {
            echo "Se han insertado $conexion->affected_rows filas en esta acción";
            echo "En la inserción se ha asignado el id $conexion->insert_id";
        } else {
            echo "Error: " . $conexion->error;
        }

        $insertSql->close();
        $conexion->close();
    }

    public static function getTorneos() {
        $conexion = self::conn();

        $torneos = $conexion->query("SELECT * FROM torneos;");

        $lenght_torneos = $torneos->num_rows;


        $result = [];
         
        while($torneo = $torneos->fetch_array()) {
            array_push($result, $torneo);
        }

        return $result;

        $conexion->close();
    }

    public static function buscarTorneos($keyword) {
        $conexion = self::conn();

        $searchQuery = "%{$keyword}%";

        $searchSql = $conexion->prepare("SELECT * FROM torneos WHERE titulo LIKE ? OR fecha LIKE ? OR hora LIKE ?;");

        $searchSql->bind_param("sss", $searchQuery, $searchQuery, $searchQuery);

        $searchSql->execute();
        $torneos = $searchSql->get_result();

        $result = [];

        while($torneo = $torneos->fetch_array()) {
            array_push($result, $torneo);
        }

        $searchSql->close();
        $conexion->close();

        return $result;
    }

    public static function getTorneosById($idUser) {
        $conexion = self::conn();

        $getSql = $conexion->prepare("SELECT * FROM torneos t
                                    JOIN inscripciones i
                                    ON t.idTorneo = i.idTorneo
                                    WHERE i.idUser = ?");

        $getSql->bind_param("i", $idUser);

        $result = [];

        if ($getSql->execute()) {
            $torneos = $getSql->get_result();
            
            while ($torneo = $torneos->fetch_assoc()) {
                array_push($result, $torneo);
            }
        } else {
            echo "Error en la petición: " . $getSql->error;
        }

        $getSql->close();
        $conexion->close();

        return $result;
    }

    public static function getInscripciones($idTorneo) {
        $conexion = self::conn();

        $inscripciones = $conexion->query("SELECT u.nombre, u.apellidos, l.usuario, i.idUser
                                    FROM inscripciones i 
                                    LEFT JOIN users_data u ON i.idUser = u.idUser
                                    LEFT JOIN users_login l ON u.idUser = l.idUser
                                    WHERE i.idTorneo = $idTorneo;");

        $lenght_torneos = $inscripciones->num_rows;


        $result = [];
         
        while($inscripcion = $inscripciones->fetch_array()) {
            array_push($result, $inscripcion);
        }

        return $result;

        $conexion->close();
    }

    public static function inscribirUsuario($idUser, $idTorneo) {
        $conexion = DB::conn();

        $addSql = $conexion->prepare("INSERT INTO inscripciones (idUser, idTorneo) VALUES (?, ?);");
        if ($addSql === false) {
            echo "Error: " . $conexion->error;
            return;
        }

        $addSql->bind_param("ii", $idUser, $idTorneo);

        if ($addSql->execute()) {
            echo "Usuario inscrito correctamente.";
        } else {
            echo "Error: " . $addSql->error;
        }

        $addSql->close();
        $conexion->close();
    }

    public static function borrarInscripcion($idUser, $idTorneo) {
        $conexion = DB::conn();

        $deleteSql = $conexion->prepare("DELETE FROM inscripciones WHERE idUser = ? AND idTorneo = ?;");

        if ($deleteSql === false) {
            echo "Error: " . $conexion->error;
            return;
        }

        $deleteSql->bind_param("ii", $idUser, $idTorneo);

        if ($deleteSql->execute()) {
            echo "Inscripcion borrada correctamente.";
        } else {
            echo "Error: " . $deleteSql->error;
        }

        $deleteSql->close();
        $conexion->close();
    }

    public static function editarTorneo($idTorneo, $titulo, $fecha, $hora) {
        $conexion = self::conn();
    
        $updateSql = $conexion->prepare("UPDATE torneos SET titulo = ?, fecha = ?, hora = ? WHERE idTorneo = ?");
    
        if ($updateSql === false) {
            echo "Error: " . $conexion->error;
            return;
        }
    
        $updateSql->bind_param("sssi", $titulo, $fecha, $hora, $idTorneo);
    
        if($updateSql->execute()) {
           //
        } else {
            echo "Error: " . $conexion->error;
        }
    
        $updateSql->close();
        $conexion->close();
    }
}


?>


