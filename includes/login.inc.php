<?php
if (isset($_POST['login-submit'])) {

  require "config.inc.php";

  $usuario = $_POST['usuario'];
  $contrasena = $_POST['contra'];

  if (empty($usuario) || empty($contrasena)) {
    echo "erro1";
    header("Location: ../index.php?error=emptyfields");
    exit();
  }
  else {

    $sql = "SELECT * FROM USUARIOS WHERE Usuario=? && Contrasena=?";
    $stmt = mysqli_stmt_init($conexion);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
      header("Location: ../index.php?error=sqlerror2");
      exit();
    }
    else {

      mysqli_stmt_bind_param($stmt, "s", $usuario);
      mysqli_stmt_execute($stmt);
      $result = mysqli_stmt_get_result($stmt);
      if ($row = mysqli_fetch_assoc($result)) {
        $pwdCheck = password_verify($contrasena, $row['Contrasena']);
        if ($pwdCheck == false) {
          header("Location: ../index.php?error=wrongpwd");
          exit();
        }
        else if ($pwdCheck == true) {

          session_start();
          $_SESSION['userId'] = $row['Usuario'];
          header("Location: ../index.php?login=success");
          exit();
        }
      }
      else {
        echo "erro5";
        header("Location: ../index.php?login=wronguidpwd");
        exit();
      }
    }
  }
  mysqli_stmt_close($stmt);
  mysqli_close($conn);
}
else {
  echo "string";
  header("Location: ../sfdsf.php");
  exit();
}
