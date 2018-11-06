<?php

if (isset($_POST['signup-submit'])) {

  require "config.inc.php";

   $usuario = $_POST['usuario'];
   $contrasena = $_POST['contra1'];
   $contrasena2 = $_POST['contra2'];
   $nombre = $_POST['nombre'];
   $apellidos = $_POST['apellidos'];
   $dni = $_POST['dni'];
   $tel = $_POST['telefono'];
   $fecha = $_POST['fecha'];
   $email = $_POST['email'];

   if (empty($usuario) || empty($email) || empty($contrasena) || empty($contrasena2)
        || empty($nombre) || empty($apellidos) || empty($dni) || empty($tel) || empty($fecha)) {
     header("Location: ../signup.php?error=emptyfields");
     exit();
   }
   else if ($contrasena !== $contrasena2) {
     //header("Location: ../signup.php?error=passwordcheck&uid=".$username."&mail=".$email);

     header("Location: ../signup.php?error=passwordcheck");
     exit();
   }
   else {

        //Para evitar sqlinjection
        $sql = "SELECT * FROM USUARIOS WHERE Usuario=?";

        $stmt = mysqli_stmt_init($conexion);
        // Comprobamos si hay algun problema con el comando sql
        if (!mysqli_stmt_prepare($stmt, $sql)) {
          // Si hay un error, enviamos al usuario otra vez a la página de registro.
          header("Location: ../signup.php?error=sqlerror1");
          exit();
        }
        else {
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
          if ($resultCount > 0) {
            header("Location: ../signup.php?error=usertaken");
            exit();
          }
          else {
            // A partir de aquí se supone que el usuario ha hecho todo bien

            $sql = "INSERT INTO USUARIOS  VALUES (?, ?, ?,?,?,?,?,?)";

            $stmt = mysqli_stmt_init($conexion);
            if (!mysqli_stmt_prepare($stmt, $sql)) {
              header("Location: ../signup.php?error=sqlerror2");
              exit();
            }
            else {
              //HAY QUE CAMBIAR LA COLUMNA DE CONTRASEÑA POR UNA MÁS LARGA
              //Encriptar contraseña
              $hashedPwd = password_hash($contrasena, PASSWORD_DEFAULT);
              //Enlazamos
              mysqli_stmt_bind_param($stmt, "sssssiss", $usuario, $hashedPwd, $nombre,$apellidos,$dni,$tel,$fecha,$email);
              //Ejecutamos
              mysqli_stmt_execute($stmt);
              //Redirigimos
              header("Location: ../signup.php?signup=success");
              exit();

            }
          }
        }
   }


 // Cerramos el statement y la conexion con la db
 mysqli_stmt_close($stmt);
 mysqli_close($conexion);
 }
 else {
 // Si el usuario trata de acceder a esta página de alguna manera inapropiada
 header("Location: ../signup.php");
 exit();
 }
 ?>
