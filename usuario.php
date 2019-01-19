<?php
require "header.php";
require "includes/config.inc.php";
require "includes/sesion.inc.php";

//Si el usuario esta idenfificado en el sistema se obtienen sus datos y se permiten modificar
if (isset($_SESSION['userId'])) {
    $usuario = mysqli_real_escape_string($conexion, $_SESSION['userId']);
    $usuario = htmlspecialchars($usuario, ENT_COMPAT);

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
        $cBancariaDB = $row["cBancaria"];
        $splitCBancaria = explode(':', $cBancariaDB);
        //obtenemos la cuenta bancaria del usuario
        $cBancariaEncriptada = $splitCBancaria[1];
        $iv = $splitCBancaria[0];

        //Desencriptar cuenta bancaria
        $cBancariaDesencriptada = openssl_decrypt(
            "$cBancariaEncriptada", 'aes-256-cbc', "$iv:$usuario", null, $iv
        );

        echo '
    <main>
        <div class="wrapper-main">
          <section class="section-default">
            <h1> Datos </h1>
              <form class="form-signup" action="includes/usuario.inc.php" method="post">
                <input type="text" name="nombre" value="' . $nombre . '" placeholder="Nombre" pattern="[a-zA-Z]+" required><br><br>
                <input type="text" name="apellidos" value="' . $apellidos . '" placeholder="Apellidos" pattern="[a-zA-Z ]+" required><br><br>
                <input type="text" name="dni" value="' . $dni . '" placeholder="DNI" pattern="[0-9]{8}[-][A-Z]" required><br><br>
                <input type="tel" name="telefono" value="' . $tel . '" placeholder="Teléfono" pattern="[0-9]{9}" required><br><br>
                <input type="date" name="fecha" value="' . $fecha . '" placeholder="Fecha de nacimiento (dd-mm-aaaa)" required><br><br>
                <input type="email" name="email" value="' . $email . '" placeholder="E-mail" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" required><br><br>
                <input type="text" name="cBancaria" value="' . $cBancariaDesencriptada . '" placeholder="Cuenta Bancaria" pattern="[0-9]{20}" required><br><br>
                <input type="hidden" name="ivBancaria" value="' . $iv . '"><br><br>
                <br>
                <button type="submit" name="update-submit">Modificar</button>
              </form>
          </section>
        </div>
    </main>';


    }

} else {
    //Ingreso desde otra parte
    header("Location: ../index.php?error=hucker");
    exit();
}
?>
