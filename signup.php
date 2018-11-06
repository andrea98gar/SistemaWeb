<?php
  require "header.php";
?>

  <main>
    <div class="wrapper-main">
      <section class="section-default">
        <h1> Registro </h1>
          <form class="form-signup" action="includes/signup.inc.php" method="post">
            <label>Nombre</label><br>
            <input type="text" name="nombre" placeholder="Introduzca su nombre"><br><br>
            <label>Apellidos</label><br>
            <input type="text" name="apellidos" placeholder="Introduzca sus apellidos"><br><br>
            <label>DNI</label><br>
            <input type="text" name="dni" placeholder="Introduzca su DNI"><br><br>
            <label>Teléfono</label><br>
            <input type="tel" name="telefono" placeholder="Introduzca su teléfono"><br><br>
            <label>Fecha de nacimiento (dd-mm-aaaa)</label><br>
            <input type="date" name="fecha" placeholder="Introduzca su fecha de nacimiento"><br><br>
            <label>E-mail</label><br>
            <input type="email" name="email" placeholder="Introduzca su e-mail"><br><br>
            <label for="upass">Nombre de usuario</label><br>
            <input type="text" name="usuario" placeholder="Introduzca su nombre de usuario"><br><br>
            <label>Contraseña</label><br>
            <input type="password" name="contra1" placeholder="Introduzca su contraseña"><br><br>
            <label for="upass">Repita la contraseña</label><br>
            <input type="password" name="contra2" placeholder="Introduzca su contraseña"><br>
            <br><br>
            <button type="submit" name="signup-submit"> Registrarse</button>
          </form>
      </section>
    </div>
  </main>


<?php
  require "footer.php";
?>
