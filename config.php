<?php
   define('DB_SERVER', 'localhost');
   define('DB_USERNAME', 'root');
   define('DB_PASSWORD', 'MetlG0710');
   define('DB_DATABASE', 'COMPUSHOP');
   $conexion = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
   $GLOBALS['usuario'] = '';

  function iniciarSesion($usuario){
    $GLOBALS['usuario'] = $usuario;
  }

  function cerrarSesion(){
    $GLOBALS['usuario'] = '';
    echo 'Sesión cerrada';
  }

  function menu(){
    if ($GLOBALS['usuario'] != ''){
         echo '<a href="usuario.php">Usuario</a>';
    }else{
         echo '<a href="signin.html">Iniciar Sesión</a>';
    }
  }
  

?>
