<?php

//Tranmisión segura de la cookie de sesión
ini_set('session.cookie_httponly', 1);
ini_set('session.use_only_cookies', 1);
session_start();

/*http://www.forosdelweb.com/f18/como-cerrar-sesion-del-usuario-despues-10-min-inactividad-1014212/*/
/*CIERRE DE SESIÓN TRAS 1 MINUTO DE INACTIVIDAD*/
if ($_SESSION["identificado"] == "si") {
    //sino, calculamos el tiempo transcurrido
    $fechaGuardada = $_SESSION["ultimoAcceso"];
    $ahora = time();
    $tiempo_transcurrido = $ahora - $fechaGuardada;

    $tiempo = 60;
    //comparamos el tiempo transcurrido
    if ($tiempo_transcurrido > $tiempo) {//si pasa 1 minutos o más
        header("Location: includes/logout.inc.php");
    } else { //sino, actualizo la fecha de la sesión
        $_SESSION["ultimoAcceso"] = $ahora;
    }
}

