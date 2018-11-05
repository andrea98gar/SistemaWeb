<?php
  include("config.php");
  session_start();

?>

<html>
  <head>
      <title>
          ProyectoSeguridad
      </title>
      <link rel="stylesheet" type="text/css" href="css/index.css">
      <script type="text/javascript" src="index.js"></script>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

  </head>

  <!--HEADER https://www.w3schools.com/howto/howto_css_responsive_header.asp-->
  <div class="header">
    <a href="#default" class="logo">Compushop</a>
    <div class="header-right">
      <a  href="index.php">Productos</a>
      <a class="active" href="usuario.php">Usuario</a>
    </div>
  </div>

  <body>

    <input type="submit" class="button" name="cerrarsesion" onclick="cerrarSesion()">
    <script>
      function cerrarSesion(){
        alert('<?php echo cerrarSesion();?>')
        window.location = "index.php";
      }
    </script>

    <?php echo $valor ?>
  </body>



</html>
