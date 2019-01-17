<?php
require "header.php";
?>

<!-- Registro del usuario -->
<!-- Para entender el funcionamiento de los pattern: https://www.w3schools.com/tags/att_input_pattern.asp -->

<main>
    <div class="wrapper-main">
        <section class="section-default">
            <h1> Registro </h1>
            <form class="form-signup" action="includes/signup.inc.php" method="post">
                <!-- Nombre: Solo se permite introducir letras en minúsculas y en mayúsculas -->
                <label for="nombre" class="visuallyhidden"> Nombre</label>
                <input type="text" name="nombre" placeholder="Nombre" id="nombre" pattern="[a-zA-Z]+" required><br><br>

                <!-- Apellidos: Solo se permite introducir letras en minúsculas, en mayúsculas y espacio-->
                <label for="apellidos" class="visuallyhidden"> Apellidos</label>
                <input type="text" name="apellidos" placeholder="Apellidos" id="apellidos" pattern="[a-zA-Z ]+" required><br><br>

                <!-- DNI: Solo se permite introducir 8 números, un guión y una letra de la A a la Z en mayúsculas-->
                <label for="dni" class="visuallyhidden"> DNI</label>
                <input type="text" name="dni" placeholder="DNI (00000000-A)" id="dni" pattern="[0-9]{8}[-][A-Z]" required><br><br>

                <!-- Teléfono: Solo se permite introducir 9 números-->
                <label for="telefono" class="visuallyhidden"> Telefono</label>
                <input type="tel" name="telefono" placeholder="Teléfono" id="telefono" pattern="[0-9]{9}" required><br><br>

                <label for="fecha" class="visuallyhidden"> Fecha</label>
                <input type="date" name="fecha" placeholder="Fecha de nacimiento (dd-mm-aaaa)" id="fecha" required><br><br>

                <!-- Email: Tiene el formato hola@gmail.com-->
                <label for="email" class="visuallyhidden"> Email</label>
                <input type="email" name="email" placeholder="E-mail" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" id="email" required><br><br>

                <label for="user" class="visuallyhidden"> Usuario</label>
                <input type="text" name="usuario" placeholder="Nombre de usuario" id="user" required><br><br>

                <label for="contra1" class="visuallyhidden"> Contra1</label>
                <input type="password" name="contra1" placeholder="Contraseña" pattern="(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[.@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$" id="contra1" required><br><br>

                <label for="contra2" class="visuallyhidden"> Contra2</label>
                <input type="password" name="contra2" placeholder="Repita su contraseña" pattern="(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[.@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$" id="contra2" required><br>
            <!--<input type="password" name="contra1" placeholder="Contraseña"  required><br><br>
                <input type="password" name="contra2" placeholder="Repita su contraseña" required><br>-->
                <br><br>

                <button type="submit" name="signup-submit"> Registrarse</button>
            </form>


        </section>
    </div>


</main>
