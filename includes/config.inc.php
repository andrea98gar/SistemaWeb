<?php
   define('DB_SERVER', 'localhost');
   define('DB_USERNAME', 'root');
   define('DB_PASSWORD', 'MetlG0710');
   define('DB_DATABASE', 'COMPUSHOP');

   //Crear conexion
   $conexion = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);

   //Comprobar conexion
   if (!$conexion) {
     die("Fallo en la conexion: " . mysqli_connect_error());
   }
?>
