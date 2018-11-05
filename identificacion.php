<?php
  include("config.php");
  session_start();

  if($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST['usuario'];
    $contrasena = $_POST['contra'];

    $sql = "SELECT * FROM USUARIOS WHERE Usuario='$usuario' && Contrasena='$contrasena'";
    $resul = mysqli_query($conexion,$sql);
    $row = mysqli_fetch_array($resul,MYSQLI_ASSOC);
    $active = $row['active'];
    $count = mysqli_num_rows($resul);
    #echo ""  + $count;

    if ($count==1){
      iniciarSesion($usuario);
      echo '<script type="text/javascript"> window.location = "usuario.php";</script>';
    }else{
      echo "<script type='text/javascript'>alert('Usuario no existe');</script>";
      echo '<script type="text/javascript"> window.location = "signin.html";</script>';
     }
   }


        ?>
