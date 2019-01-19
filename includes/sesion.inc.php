<?php

if(isset($_POST['token']) AND $_POST['token'] != $_SESSION['token']){
    header("Location: ../logout.inc.php?login=wrongtoken");
}

//Tranmisión segura de la cookie de sesión

ini_set('session.cookie_httponly', 1);
ini_set('session.use_only_cookies', 1);
session_start();

/*http://www.forosdelweb.com/f18/como-cerrar-sesion-del-usuario-despues-10-min-inactividad-1014212/*/
/*CIERRE DE SESIÓN TRAS 1 MINUTO DE INACTIVIDAD*/

if (isset($_SESSION['userId'])) {
    $fechaGuardada = $_SESSION["ultimoAcceso"];
    $ahora = time();
    $tiempo_transcurrido = $ahora - $fechaGuardada;
    $tiempo = 60;

    if ($tiempo_transcurrido > $tiempo) {
        header("Location: includes/logout.inc.php");
    } else {
        $_SESSION["ultimoAcceso"] = $ahora;
    }
}




