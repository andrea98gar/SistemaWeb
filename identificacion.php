<?php
  $conexion = new mysqli("localhost", "root", "MetlG0710", "COMPUSHOP");
  if ($conexion->connect_errno){
    echo "ERROR: (" . $conexion->connect_errno .")" . $conexion->connect_error;
  }

  $usuario = $_POST['usuario'];
  $contrasena = $_POST['contra'];

  $consulta = "SELECT EXISTS (SELECT * FROM USUARIOS WHERE Usuario='$usuario' && Contrasena='$contrasena' LIMIT 1 )";


  if($resultado = $conexion->query($consulta)){
    while ($fila = $resultado->fetch_row()){
      if ($fila[0] == 1){
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
              <a class="active" href="ajustes.html">Ajustes</a>
            </div>
          </div>

          <body>
            Registro completado.

          </body>
        </html>

        <?PHP




      }
    }
    $resultado->close();
  }
  mysqli_close($conexion);
?>
