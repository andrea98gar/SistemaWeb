<?php
require "config.inc.php";

//Modify productm
if (isset($_POST['productm'])) {
    $product_act = mysqli_real_escape_string($conexion, $_POST['productm']);
    $product_new = mysqli_real_escape_string($conexion, $_POST['pmodelo']);
    $ram_new = mysqli_real_escape_string($conexion, $_POST['pram']);
    $bat_new = mysqli_real_escape_string($conexion, $_POST['pbat']);
    $proc_new = mysqli_real_escape_string($conexion, $_POST['pproc']);
    $prec_new = mysqli_real_escape_string($conexion, $_POST['pprec']);

    $sql2 = "UPDATE PRODUCTOS SET Modelo = ?, RAM = ?, Bateria = ?, Procesador = ?, Precio = ?  WHERE Modelo = ?";

    $stmt = mysqli_stmt_init($conexion);
    // Comprobamos si hay algun problema con el comando sql
    if (!mysqli_stmt_prepare($stmt, $sql2)) {
        // Si hay un error, enviamos al usuario otra vez a la página de registro.
        header("Location: ../index.php?error=sqlerror1");
        exit();
    } else {
        // Enlazamos los "?" con los datos que queramos.
        // "s" -> "string", "i" -> "integer", "b" -> "blob", "d" -> "double".
        mysqli_stmt_bind_param($stmt, "ssssss", $product_new, $ram_new, $bat_new, $proc_new, $prec_new, $product_act);
        // Ejecutamos el comando
        mysqli_stmt_execute($stmt);
        // Guardamos el resultado
    }
}

//Delete productd
if (isset($_POST['productd'])) {
    $product = $_POST['productd'];
    $sql2 = "DELETE FROM PRODUCTOS WHERE Modelo=?";
    // echo "hola";
    $stmt = mysqli_stmt_init($conexion);
    // Comprobamos si hay algun problema con el comando sql
    if (!mysqli_stmt_prepare($stmt, $sql2)) {
        // Si hay un error, enviamos al usuario otra vez a la página de registro.
        header("Location: ../index.php?error=sqlerror1");
        exit();
    } else {
        // Enlazamos los "?" con los datos que queramos.
        // "s" -> "string", "i" -> "integer", "b" -> "blob", "d" -> "double".
        echo $product;
        mysqli_stmt_bind_param($stmt, "s", $product);
        // Ejecutamos el comando
        mysqli_stmt_execute($stmt);
        // Guardamos el resultado
    }
}


//Add product
if (isset($_POST['product-submit'])) {
    $modelo = $_POST['modelo'];
    $ram = $_POST['ram'];
    $bateria = $_POST['bateria'];
    $procesador = $_POST['procesador'];
    $precio = $_POST['precio'];

    if (empty($modelo) || empty($ram) || empty($bateria) || empty($procesador)
        || empty($precio)) {
        header("Location: ../index.php?error=emptyfields");
        exit();
    } else {
        //Para evitar sqlinjection
        $sql = "SELECT * FROM PRODUCTOS WHERE Modelo=?";

        $stmt = mysqli_stmt_init($conexion);
        // Comprobamos si hay algun problema con el comando sql
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            // Si hay un error, enviamos al usuario otra vez a la página de registro.
            header("Location: ../index.php?error=sqlerror1");
            exit();
        } else {
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
            } else {
                // A partir de aquí se supone que el usuario ha hecho todo bien

                $sql = "INSERT INTO PRODUCTOS  VALUES (?, ?, ?, ?, ?)";

                $stmt = mysqli_stmt_init($conexion);
                if (!mysqli_stmt_prepare($stmt, $sql)) {
                    header("Location: ../index.php?error=sqlerror2");
                    exit();
                } else {
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

} else {
    // Si el usuario trata de acceder a esta página de alguna manera inapropiada
    header("Location: ../index.php");
    exit();
}

?>
