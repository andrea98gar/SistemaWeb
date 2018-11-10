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
                <input type="text" name="nombre" placeholder="Nombre" pattern="[a-zA-Z]+" required><br><br>
                <!-- Apellidos: Solo se permite introducir letras en minúsculas, en mayúsculas y espacio-->
                <input type="text" name="apellidos" placeholder="Apellidos" pattern="[a-zA-Z ]+" required><br><br>
                <!-- DNI: Solo se permite introducir 8 números, un guión y una letra de la A a la Z en mayúsculas-->
                <input type="text" name="dni" placeholder="DNI (00000000-A)" pattern="[0-9]{8}[-][A-Z]" required><br><br>
                <!-- Teléfono: Solo se permite introducir 9 números-->
                <input type="tel" name="telefono" placeholder="Teléfono" pattern="[0-9]{9}" required><br><br>
                <input type="date" name="fecha" placeholder="Fecha de nacimiento (dd-mm-aaaa)" required><br><br>
                <!-- Email: Tiene el formato hola@gmail.com-->
                <input type="email" name="email" placeholder="E-mail" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" required><br><br>
                <input type="text" name="usuario" placeholder="Nombre de usuario" required><br><br>
                <input type="password" name="contra1" placeholder="Contraseña" required><br><br>
                <input type="password" name="contra2" placeholder="Repita su contraseña" required><br>
                <br><br>

                <button type="submit" name="signup-submit"> Registrarse</button>
            </form>


        </section>
    </div>


</main>
