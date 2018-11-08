<?php
require "header.php";
require "includes/config.inc.php";
session_start();
if (isset($_SESSION['userId'])) {
    $usuario = $_SESSION['userId'];
    $sql = 'SELECT * FROM USUARIOS WHERE Usuario="' . $usuario . '"';
    $result = $conexion->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $nombre = $row["Nombre"];
        $apellidos = $row["Apellidos"];
        $dni = $row["DNI"];
        $tel = $row["Tel"];
        $fecha = $row["Fecha"];
        $email = $row["email"];

        echo '
    <main>
        <div class="wrapper-main">
          <section class="section-default">
            <h1> Datos </h1>
              <form class="form-signup" action="includes/usuario.inc.php" method="post">
                <label>Nombre</label><br>
                <input type="text" name="nombre" value="' . $nombre . '" placeholder="Introduzca su nombre"><br><br>
                <label>Apellidos</label><br>
                <input type="text" name="apellidos" value="' . $apellidos . '" placeholder="Introduzca sus apellidos"><br><br>
                <label>DNI</label><br>
                <input type="text" name="dni"  value="' . $dni . '" placeholder="Introduzca su DNI"><br><br>
                <label>Teléfono</label><br>
                <input type="tel" name="tel" value="' . $tel . '" placeholder="Introduzca su teléfono"><br><br>
                <label>Fecha de nacimiento (dd-mm-aaaa)</label><br>
                <input type="date" name="fecha" value="' . $fecha . '" placeholder="Introduzca su fecha de nacimiento"><br><br>
                <label>E-mail</label><br>
                <input type="email" name="email" value="' . $email . '" placeholder="Introduzca su e-mail"><br><br>
                <label>Contraseña</label><br>
                <input type="password" name="contra1"  placeholder="Introduzca su contraseña"><br><br>
                <label for="upass">Repita la contraseña</label><br>
                <input type="password" name="contra2" placeholder="Introduzca su contraseña"><br>
                <br><br>
                <button type="submit" name="update-submit"> Modificar</button>
              </form>
          </section>
        </div>
    </main>';


    } else {
        //Pruebas
        echo $sql;
    }


} else {
    echo 'error';
}

?>
