<?php
require "config.inc.php";

//Modificar producto
if (isset($_POST['productm'])) {
    //Se obtienen los campos del producto que se desea modificar (ajax)
    $product_act = mysqli_real_escape_string($conexion, $_POST['productm']);
    $product_new = mysqli_real_escape_string($conexion, $_POST['pmodelo']);
    $ram_new = mysqli_real_escape_string($conexion, $_POST['pram']);
    $bat_new = mysqli_real_escape_string($conexion, $_POST['pbat']);
    $proc_new = mysqli_real_escape_string($conexion, $_POST['pproc']);
    $prec_new = mysqli_real_escape_string($conexion, $_POST['pprec']);

    $sql = "UPDATE PRODUCTOS SET Modelo = ?, RAM = ?, Bateria = ?, Procesador = ?, Precio = ?  WHERE Modelo = ?";

    $stmt = mysqli_stmt_init($conexion);
    // Comprobamos si hay algun problema con el comando sql
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        // Si hay un error, enviamos al usuario otra vez a la página de registro.
        header("Location: ../index.php?error=sqlerror1");
        exit();
    } else {
        // Enlazamos los "?" con los datos que queramos.
        // "s" -> "string", "i" -> "integer", "b" -> "blob", "d" -> "double".
        mysqli_stmt_bind_param($stmt, "ssssss", $product_new, $ram_new, $bat_new, $proc_new, $prec_new, $product_act);
        // Ejecutamos el comando
        mysqli_stmt_execute($stmt);
    }
}

//Eliminar producto
if (isset($_POST['productd'])) {
    //Se obtiene el producto que se desea eliminar (ajax)
    $product = $_POST['productd'];

    $sql = "DELETE FROM PRODUCTOS WHERE Modelo=?";

    $stmt = mysqli_stmt_init($conexion);
    // Comprobamos si hay algun problema con el comando sql
    if (!mysqli_stmt_prepare($stmt, $sql)) {
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
    }
}


//Añadir producto
if (isset($_POST['product-submit'])) {
    //Se obtienen los campos del producto que se desea añadir
    $modelo = $_POST['modelo'];
    $ram = $_POST['ram'];
    $bateria = $_POST['bateria'];
    $procesador = $_POST['procesador'];
    $precio = $_POST['precio'];

    //Se comprueba que no haya ningún campo vacío
    if (empty($modelo) || empty($ram) || empty($bateria) || empty($procesador)
        || empty($precio)) {
        header("Location: ../index.php?error=emptyfields");
        exit();
    } else {
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
            // Comprobamos si hay productos con ese nombre
            if ($resultCount > 0) {
                header("Location: ../index.php?error=productrepeat");
                exit();
            } else {
                // Si el producto no existe en la base de datos entonces se añade.
                $sql = "INSERT INTO PRODUCTOS VALUES (?, ?, ?, ?, ?)";

                $stmt = mysqli_stmt_init($conexion);
                if (!mysqli_stmt_prepare($stmt, $sql)) {
                    header("Location: ../index.php?error=sqlerror2");
                    exit();
                } else {
                    // Enlazamos los "?" con los datos que queramos.
                    // "s" -> "string", "i" -> "integer", "b" -> "blob", "d" -> "double".
                    mysqli_stmt_bind_param($stmt, "sssss", $modelo, $ram, $bateria, $procesador, $precio);
                    //Ejecutamos
                    mysqli_stmt_execute($stmt);
                    //Redirigimos
                    header("Location: ../index.php?productadd=success");
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
