<?php
  $conexion = new mysqli("localhost", "root", "jsdfh", "COMPUSHOP");
  if ($conexion->connect_errno){
    echo "ERROR: (" . $conexion->connect_errno .")" . $conexion->connect_error;
  }
  $resultado = $conexion->query("INSERT INTO USUARIOS VALUES (nombre, apellidos, dni, telefono, fecha, email, password)");
  mysqli_close($conexion);
?>
