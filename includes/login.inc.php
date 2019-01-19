<?php
if (isset($_POST['login-submit'])) {
    //Conexión con la base de datos
    require "config.inc.php";
    require "sesion.inc.php";


    //SQL INJECTION
    $usuario = mysqli_real_escape_string($conexion, $_POST["usuario"]);
    $contrasena = mysqli_real_escape_string($conexion, $_POST['contra']);

    //XSS
    $usuario = htmlspecialchars($usuario, ENT_COMPAT);
    $contrasena = htmlspecialchars($contrasena, ENT_COMPAT);

    //Se comprueba si hay algún campo vacío
    if (empty($usuario) || empty($contrasena)) {
        header("Location: ../index.php?error=emptyfields");
        exit();
    } else {
        //Intento conexion
        $sql1 = "INSERT INTO LOGS  VALUES (?, ?, ?)";
        $fecha = date('d/m/Y h:i:s A');
        $stmt = mysqli_stmt_init($conexion);


        //Se comprueba si el usuario está en registrado en el sistema
        $sql = "SELECT * FROM USUARIOS WHERE Usuario='" . $usuario . "'";
        $result = $conexion->query($sql);
        if ($row = $result->fetch_assoc()) {
            //obtenemos la contraseña de la bd
            $contrasenaDB = $row['Contrasena'];
            //separamos la información obtenida
            $splitContrasenaBD = explode(':', $contrasenaDB);
            //obtenemos la sal del usuario
            $salBD = $splitContrasenaBD[0];

            //hacemos el resumen criptográfico de la contraseña con la sal obtenida.
            $contrasenaEncriptada = crypt($contrasena, $salBD);
            //concatenamos la el resumen criptográfico y la sal
            $contrasenEncriptada_SAL = "$salBD:$contrasenaEncriptada";
            //comprobamos si coinciden
            if ($contrasenEncriptada_SAL != $contrasenaDB) {
                //Almacenar intento de conexion fallido
                $intento = "Fallido";
                if (!mysqli_stmt_prepare($stmt, $sql1)) {
                    header("Location: ../index.php?error=sqlerror");
                    exit();
                } else {
                    //Enlazamos
                    mysqli_stmt_bind_param($stmt, "sss", $usuario, $fecha, $intento);
                    //Ejecutamos
                    mysqli_stmt_execute($stmt);
                }
                header("Location: ../index.php?error=wrongpwd");
                exit();
            } else {
                //En una variable de sesión se guarda elusuario que se ha identificado.
                $_SESSION['userId'] = $row['Usuario'];
                //CIERRE DE SESIÓN TRAS 1 MINUTO DE INACTIVIDAD
                $_SESSION["ultimoAcceso"] = time();
                $_SESSION["token"] = substr(sha1(mt_rand()), 0, 16);

                echo '<form class="form-signup" action="includes/sesion.inc.php" method="post">';
                echo '<input type="hidden" name="token" value="' . $_SESSION['token'] . '"><br><br>';
                echo '</form>';

                //Almacenar intento de conexion exitoso
                $intento = "Exitoso";
                if (!mysqli_stmt_prepare($stmt, $sql1)) {
                    header("Location: ../index.php?error=sqlerror");
                    exit();
                } else {
                    //Enlazamos
                    mysqli_stmt_bind_param($stmt, "sss", $usuario, $fecha, $intento);
                    //Ejecutamos
                    mysqli_stmt_execute($stmt);
                }

                header("Location: ../index.php?login=success");
                exit();
            }
        } else {
            $intento = "Fallido";
            if (!mysqli_stmt_prepare($stmt, $sql1)) {
                header("Location: ../index.php?error=sqlerror");
                exit();
            } else {
                //Enlazamos
                mysqli_stmt_bind_param($stmt, "sss", $usuario, $fecha, $intento);
                //Ejecutamos
                mysqli_stmt_execute($stmt);
            }
            header("Location: ../index.php?login=wronguidpwd");
            exit();
        }
    }
    //Acceso desde un sitio incorrecto
} else {
    header("Location: ../index.php?error=hucker");
    exit();
}
