<?php
if (isset($_POST['login-submit'])) {

  require "config.inc.php";

  $usuario = $_POST['usuario'];
  $contrasena = $_POST['contra'];

  if (empty($usuario) || empty($contrasena)) {
    header("Location: ../index.php?error=emptyfields");
    exit();
  }
  else {


    //Necesitamos coger la contraseña del usuario de la BBDD,
    // lo desencriptamos y comprobamos si es igual a la que ha introducido

    $sql = "SELECT * FROM USUARIOS WHERE Usuario=?";
    $stmt = mysqli_stmt_init($conexion);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
      header("Location: ../index.php?error=sqlerror");
      exit();
    }
    else {

      mysqli_stmt_bind_param($stmt, "s", $usuario);
      mysqli_stmt_execute($stmt);
      $result = mysqli_stmt_get_result($stmt);
      if ($row = mysqli_fetch_assoc($result)) {
        //Comprobamos que la contraseña obtenida de la BBDD coincida con la introducida
        $pwdCheck = password_verify($contrasena, $row['Contrasena']);
        if ($pwdCheck == false) {
          header("Location: ../index.php?error=wrongpwd");
          exit();
        }
        else if ($pwdCheck == true) {
          //Creamos variables de sesión para saber que el usuario se ha identificado.
          session_start();
          $_SESSION['userId'] = $row['Usuario'];
          // Caduca en un año
          setcookie('usuario', $row['Usuario'], time() + 365 * 24 * 60 * 60);
          header("Location: ../index.php?login=success");
          exit();
        }
      }
      else {
        header("Location: ../index.php?login=wronguidpwd");
        exit();
      }
    }
  }
  mysqli_stmt_close($stmt);
  mysqli_close($conn);
}
else {
  header("Location: ../sfdsf.php");
  exit();
}
