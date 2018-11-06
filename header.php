<?php session_start() ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name = "description" content="Web">
    <meta name="viewport" content="with=device-width, initial-scale=1">
    <title> </title>
    <link rel="stylesheet" href="css/style.css"
  </head>
  <body>


    <header>
      <nav class="nav-header-main">
        <a  class="header-logo" href="index.php">
          <img src="img/logo.png" alt="logo">
        </a>
        <ul>
          <li><a  href="index.php"> COMPUSHOP </a></li>
          <!-- <li><a  href="#"> Otro </a></li>
          <li><a  href="#"> Otro2 </a></li>
          <li><a  href="#"> Otro3 </a></li> -->
        </ul>
        </nav>
        <div class = "header-login">
          <form action="includes/login.inc.php" method="post">
            <input type="text" name="usuario" placeholder="Usuario">
            <input type="password" name="contra" placeholder="Constraseña">
            <button type="submit" name="login-submit"> Acceder </button>
          </form>
          <div class="header-signup">
            <a href="signup.php"> Registro </a>
          </div>
          <form action="includes/logout.inc.php" method="post">
            <button type="submit" name="logout-submit"> Cerrar Sesión </button>
          </form>
        </div>

      </header>
    </body>
    </html>
