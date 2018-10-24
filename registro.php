<?php
  $conexion = new mysqli("localhost", "root", "MetlG0710", "COMPUSHOP");
  if ($conexion->connect_errno){
    echo "ERROR: (" . $conexion->connect_errno .")" . $conexion->connect_error;
  }
  $usuario = $_POST['usuario'];
  $contrasena = $_POST['contra1'];
  $nombre = $_POST['nombre'];
  $apellidos = $_POST['apellidos'];
  $dni = $_POST['dni'];
  $tel = $_POST['telefono'];
  $fecha = $_POST['fecha'];
  $email = $_POST['email'];
  $resultado = $conexion->query("INSERT INTO USUARIOS VALUES ('$usuario', '$contrasena', '$nombre', '$apellidos', '$dni', '$tel', '$fecha', '$email')");
  mysqli_close($conexion);
?>

<html>
  <head>
      <title>
          ProyectoSeguridad
      </title>
      <link rel="stylesheet" type="text/css" href="css/index.css">
      <script type="text/javascript" src="js/index.js"></script>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

  </head>

  <!--HEADER https://www.w3schools.com/howto/howto_css_responsive_header.asp-->
  <div class="header">
    <a href="#default" class="logo">Compushop</a>
    <div class="header-right">
      <a href="index.php">Listado</a>
      <a href="signin.html">Sign in</a>
      <a class="active" href="signup.html">Sign up</a>
    </div>
  </div>

  <body>
    Registro completado.

  </body>



</html>
