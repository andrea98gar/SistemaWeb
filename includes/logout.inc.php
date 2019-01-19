<?php

//fuente https://7php.com/php-5-3-how-to-completely-destroy-session-variables-in-php/
//clear session from globals
if (isset($_COOKIE[session_name()])) {
    setcookie(session_name(), "", time() - 3600, "/");
}

//clear session from globals
$_SESSION = array();
//clear session from disk
session_destroy();
header("Location: ../index.php?sesioncerrada");
?>
