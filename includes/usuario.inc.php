<?php
require "config.inc.php";
session_start();
if (isset($_POST['update-submit'])) {
    //Se obtienen los campos del usuario
    $usuario = mysqli_real_escape_string($conexion, $_SESSION['userId']);
    $nombre = mysqli_real_escape_string($conexion, $_POST['nombre']);
    $apellidos = mysqli_real_escape_string($conexion, $_POST['apellidos']);
    $dni = mysqli_real_escape_string($conexion, $_POST['dni']);
    $tel = mysqli_real_escape_string($conexion, $_POST['telefono']);
    $fecha = mysqli_real_escape_string($conexion, $_POST['fecha']);
    $email = mysqli_real_escape_string($conexion, $_POST['email']);

    //Se comprueba que la letra del dni es correcta
    $num = substr($dni, 0, 8);
    $char = substr($dni, -1);
    $resto = $num % 23;
    if (!($resto == 0 && $char == 'T') && !($resto == 1 && $char == 'R') && !($resto == 2 && $char == 'W') && !($resto == 3 && $char == 'A') &&
        !($resto == 4 && $char == 'G') && !($resto == 5 && $char == 'M') && !($resto == 6 && $char == 'Y') && !($resto == 7 && $char == 'F') &&
        !($resto == 8 && $char == 'P') && !($resto == 9 && $char == 'D') && !($resto == 10 && $char == 'X') && !($resto == 11 && $char == 'B') &&
        !($resto == 12 && $char == 'N') && !($resto == 13 && $char == 'J') && !($resto == 14 && $char == 'Z') && !($resto == 15 && $char == 'S') &&
        !($resto == 16 && $char == 'Q') && !($resto == 17 && $char == 'V') && !($resto == 18 && $char == 'H') && !($resto == 19 && $char == 'L') &&
        !($resto == 20 && $char == 'C') && !($resto == 21 && $char == 'K') && !($resto == 22 && $char == 'E')) {
        header("Location: ../usuario.php?error=wrongdni");
        exit();
    }

    //Se comprueba que todos los campos estén rellenos
    if (empty($email) || empty($nombre) || empty($apellidos) || empty($dni) || empty($tel) || empty($fecha)) {
        header("Location: ../usuario.php?error=emptyfields");
        exit();
    } else {
        //Para evitar sqlinjection
        $sql = "SELECT * FROM USUARIOS WHERE Usuario=?";
        $stmt = mysqli_stmt_init($conexion);
        // Comprobamos si hay algun problema con el comando sql
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            // Si hay un error, enviamos al usuario otra vez a la página de registro.
            header("Location: ../signup.php?error=sqlerror1");
            exit();
        } else {
            // Enlazamos los "?" con los datos que queramos.
            // "s" -> "string", "i" -> "integer", "b" -> "blob", "d" -> "double".
            mysqli_stmt_bind_param($stmt, "s", $usuario);
            // Ejecutamos el comando
            mysqli_stmt_execute($stmt);
            // Guardamos el resultado
            mysqli_stmt_store_result($stmt);
            // Guardamos el número de rows afectadas
            $resultCount = mysqli_stmt_num_rows($stmt);
            // Cerramos el statement
            mysqli_stmt_close($stmt);
            // Comprobamos si hay usuarios con ese nombre de usuario
            if ($resultCount == 0) {
                header("Location: ../usuario.php?error=usernotfound");
                exit();
            } else {
                // Se actualizan los datos del usuario
                $sql1 = "UPDATE USUARIOS SET Nombre = ?, Apellidos = ?, DNI = ?, Tel = ?, Fecha = ?, email = ? WHERE Usuario = ?";
                $stmt = mysqli_stmt_init($conexion);
                if (!mysqli_stmt_prepare($stmt, $sql1)) {
                    header("Location: ../usuario.php?error=sqlerror2");
                    exit();
                } else {
                    //Enlazamos
                    mysqli_stmt_bind_param($stmt, "sssssss", $nombre, $apellidos, $dni, $tel, $fecha, $email, $usuario);
                    //Ejecutamos
                    mysqli_stmt_execute($stmt);
                    //Redirigimos
                    header("Location: ../usuario.php?usuario.php=success");
                    exit();
                }
            }
        }
    }
} else {
    //Ingreso desde otra parte
    header("Location: ../index.php?error=hucker");
    exit();
}
?>
