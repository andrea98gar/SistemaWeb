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
      <a class="active" href="listado.php">Listado</a>
      <?php
        if (document.referrer) //si es verdadero quiere decir que vienes de algun lado
          alert("Aqui vienes desde: " + document.referrer);
          <a href="ajustes.html">Ajustes</a>
        else
          alert("Aqui entras directamente");
          <a href="signin.html">Sign in</a>
          <a href="signup.html">Sign up</a>
      ?>
    </div>
  </div>

  <body>

  </body>



</html>
