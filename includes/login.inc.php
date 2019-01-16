<?php
if (isset($_POST['login-submit'])) {
    //Conexión con la base de datos
    require "config.inc.php";
    session_start();

    $usuario = mysqli_real_escape_string($conexion, $_POST["usuario"]);
    $contrasena = mysqli_real_escape_string($conexion, $_POST['contra']);

    //Se comprueba si hay algún campo vacío
    if (empty($usuario) || empty($contrasena)) {
        header("Location: ../index.php?error=emptyfields");
        exit();
    } else {
        //Se comprueba si el usuario está en registrado en el sistema
        $sql = "SELECT * FROM USUARIOS WHERE Usuario='" . $usuario . "'";
        $result = $conexion->query($sql);
        if ($row = $result->fetch_assoc()) {

            //Se comprueba que la contraseña obtenida de la BBDD coincida con la introducida
            if ($contrasena !== $row['Contrasena']) {
                header("Location: ../index.php?error=wrongpwd");
                exit();
            } else {
                //En una variable de sesión se guarda elusuario que se ha identificado.
                $_SESSION['userId'] = $row['Usuario'];
                $_SESSION['identificado'] = "si";
                $_SESSION["ultimoAcceso"] = time();
                header("Location: ../index.php?login=success");
                exit();
            }
        } else {
            header("Location: ../index.php?login=wronguidpwd");
            exit();
        }
    }
    //Acceso desde un sitio incorrecto
} else {
    header("Location: ../index.php?error=hucker");
    exit();
}
