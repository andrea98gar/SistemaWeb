<?php
  include("config.php");
  session_start();

  if($_SERVER["REQUEST_METHOD"] == "POST") {

    $usuario = $_POST['usuario'];
    $contrasena = $_POST['contra1'];
    $nombre = $_POST['nombre'];
    $apellidos = $_POST['apellidos'];
    $dni = $_POST['dni'];
    $tel = $_POST['telefono'];
    $fecha = $_POST['fecha'];
    $email = $_POST['email'];

    $sql = "SELECT * FROM USUARIOS WHERE Usuario='$usuario'";
    $resul = mysqli_query($conexion,$sql);
    $row = mysqli_fetch_array($resul,MYSQLI_ASSOC);
    $active = $row['active'];
    $count = mysqli_num_rows($resul);
    #echo ""  + $count;

    if ($count==0){
      $result2 = $conexion->query("INSERT INTO USUARIOS VALUES ('$usuario', '$contrasena', '$nombre', '$apellidos', '$dni', '$tel', '$fecha', '$email')");
      echo '<script type="text/javascript"> window.location = "usuario.html";</script>';
    }else{
      echo "<script type='text/javascript'>alert('Usuario existente');</script>";
      echo '<script type="text/javascript"> window.location = "signup.html";</script>';
     }
    mysqli_close($conexion);
  }
  ?>
