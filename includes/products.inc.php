<?php

if (isset($_POST['show-product'])) {
  require "config.inc.php";

  $sql = "SELECT * FROM PRODUCTOS";
    // Check connection
    if ($conexion->connect_error) {
        die("Connection failed: " . $conexion->connect_error);
    }

    $sql = "SELECT * FROM PRODUCTOS";
    $result = $conexion->query($sql);

    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            $SESSION['Modelo'] = $row["Modelo"];
            $SESSION['Modelo'] = $row["Modelo"];
            $SESSION['Modelo'] = $row["Modelo"];
            $SESSION['Modelo'] = $row["Modelo"];
            $SESSION['Modelo'] = $row["Modelo"];

            <script type="text/javascript">
              function mostrar(){
                document.getElementById("modelo").innerHTML = $SESSION['Modelo'];
              }
              mostrar();
            </script>

            echo $SESSION['Modelo'];
            echo "Modelo: " . $row["Modelo"]. "<br>";
            echo "RAM: " . $row["RAM"]. "<br>";
            echo "Bateria: " . $row["Bateria"]. "<br>";
            echo "Procesador: " . $row["Procesador"]. "<br>";
            echo "Precio: " . $row["Precio"]. "<br>";
            echo "<br>";
        }
    } else {
        echo "0 results";
    }
    $conn->close();
}


if (isset($_POST['product-submit'])) {

  require "config.inc.php";

  $modelo = $_POST['modelo'];
  $ram = $_POST['ram'];
  $bateria = $_POST['bateria'];
  $procesador = $_POST['procesador'];
  $precio = $_POST['precio'];

  if (empty($modelo) || empty($ram) || empty($bateria) || empty($procesador)
       || empty($precio)) {
    header("Location: ../index.php?error=emptyfields");
    exit();
  }
  else {
        //Para evitar sqlinjection
        $sql = "SELECT * FROM PRODUCTOS WHERE Modelo=?";

        $stmt = mysqli_stmt_init($conexion);
        // Comprobamos si hay algun problema con el comando sql
        if (!mysqli_stmt_prepare($stmt, $sql)) {
          // Si hay un error, enviamos al usuario otra vez a la página de registro.
          header("Location: ../index.php?error=sqlerror1");
          exit();
        }
        else {
          // Enlazamos los "?" con los datos que queramos.
          // "s" -> "string", "i" -> "integer", "b" -> "blob", "d" -> "double".
          mysqli_stmt_bind_param($stmt, "s", $modelo);
          // Ejecutamos el comando
          mysqli_stmt_execute($stmt);
          // Guardamos el resultado
          mysqli_stmt_store_result($stmt);
          // Guardamos el número de rows afectadas
          $resultCount = mysqli_stmt_num_rows($stmt);
          // Cerramos el statement
          mysqli_stmt_close($stmt);
          // Comprobamos si hay usuarios con ese nombre de usuario
          if ($resultCount > 0) {
            header("Location: ../index.php?error=usertaken");
            exit();
          }
          else {
            // A partir de aquí se supone que el usuario ha hecho todo bien

            $sql = "INSERT INTO PRODUCTOS  VALUES (?, ?, ?, ?, ?)";

            $stmt = mysqli_stmt_init($conexion);
            if (!mysqli_stmt_prepare($stmt, $sql)) {
              header("Location: ../index.php?error=sqlerror2");
              exit();
            }
            else {
              //Enlazamos
              mysqli_stmt_bind_param($stmt, "sssss", $modelo, $ram, $bateria, $procesador, $precio);
              //Ejecutamos
              mysqli_stmt_execute($stmt);
              //Redirigimos
              header("Location: ../index.php?signup=success");
              exit();

            }
          }
        }
   }


 // Cerramos el statement y la conexion con la db
 mysqli_stmt_close($stmt);
 mysqli_close($conexion);
 }
 else {
 // Si el usuario trata de acceder a esta página de alguna manera inapropiada
 header("Location: ../index.php");
 exit();
 }

 ?>
