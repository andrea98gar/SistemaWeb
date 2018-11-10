<?php
if (isset($_POST['login-submit'])) {

    require "config.inc.php";
    session_start();
    $usuario = $_POST['usuario'];
    $contrasena = $_POST['contra'];

    if (empty($usuario) || empty($contrasena)) {
        header("Location: ../index.php?error=emptyfields");
        exit();
    } else {


        //Necesitamos coger la contraseña del usuario de la BBDD,
        // lo desencriptamos y comprobamos si es igual a la que ha introducido

        $sql = "SELECT * FROM USUARIOS WHERE Usuario='" . $usuario . "'";
        $result = $conexion->query($sql);
        if ($row = $result->fetch_assoc()) {
            //Comprobamos que la contraseña obtenida de la BBDD coincida con la introducida

            if ($contrasena !== $row['Contrasena']) {
                header("Location: ../index.php?error=wrongpwd");
                exit();
            } else {
                //Creamos variables de sesión para saber que el usuario se ha identificado.
                $_SESSION['userId'] = $row['Usuario'];
                header("Location: ../index.php?login=success");
                exit();
            }
        } else {
            header("Location: ../index.php?login=wronguidpwd");
            exit();
        }
    }

} else {
    header("Location: ../sfdsf.php");
    exit();
}
