<?php
header('Content-Type: text/html');
header("Cache-Control: no-store, no-cache, must-revalidate"); // HTTP/1.1
header("X-Frame-Options: deny");
header("X-XSS-Protection: 1; mode=block");
header("X-Content-Type-Options: nosniff",false);

//Esto nos permite guardar variables de sesion (identificación)
require "includes/sesion.inc.php";

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="description" content="Web">
    <meta name="viewport" content="with=device-width, initial-scale=1">
    <title></title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
<header>
    <script type=text/javascript>
        try {
            if (top.location.hostname !== self.location.hostname) throw 1;
        } catch (e) {
            top.location.href = self.location.href;
        }
    </script>

    <nav class="nav-header-main">
        <ul>
            <li><a href="index.php"> COMPUSHOP </a></li>
        </ul>
    </nav>
    <div class="header-login">
        <?php
        //Comprobamos si se ha iniciado sesión
        //Si no ha iniciado sesión el header mostrará la posibilidad de loguearse y/o registrarse
        if (!isset($_SESSION['userId'])) {
            echo '
                    <form action="includes/login.inc.php" method="post">
                      <label for="usuario" class="visuallyhidden"> Usuario</label>
                      <input type="text"  name="usuario" id="usuario" placeholder="Usuario">
                      
                      <label for="contra" class="visuallyhidden"> Contraseña</label>
                      <input type="password" name="contra" id="contra" placeholder="Constraseña" autocomplete="off">
                      <button type="submit" name="login-submit"> Acceder </button>
                    </form>
                    <div class="header-signup">
                      <a href="signup.php"> Registro </a>
                    </div>';

            //Si se ha iniciado sesión el header mostrará la posibilidad cambiar la configuración del usuario y cerrar sesión
        } else if (isset($_SESSION['userId'])) {
            echo '
                    <form action="productos.php" method="post">
                      <button type="submit" name="productos-submit"> Productos </button>
                    </form>
                    <form action="usuario.php" method="post">
                      <button type="submit" name="config-submit"> Configuración </button>
                    </form>
                    <form action="includes/logout.inc.php" method="post">
                      <button type="submit" name="logout-submit"> Cerrar Sesión </button>
                    </form>';

        }
        function mostrarDato($dato)
        {
            echo $dato;
        }

        ?>
    </div>
</header>
</body>
</html>
