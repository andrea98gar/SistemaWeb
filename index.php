<?php
require "header.php";
?>
<!-- Para saber cómo son las tablas de html: https://www.w3schools.com/html/html_tables.asp -->
<!-- Detectar botón pulsado con jquery: https://api.jquery.com/click/ -->
<!-- Obtener los valores de un campo por su nombre: https://stackoverflow.com/questions/2109472/how-to-get-a-value-of-an-element-by-name-instead-of-id -->
<!-- Utilizar ajax: https://blog.endeos.com/usando-ajax-con-php-y-jquery/ -->
<!-- Estructura basada en el tutorial de youtube : https://www.youtube.com/watch?v=LC9GaXkdxF8-->
<main>
    <div class="wrapper-main">
        <section class="section-default">
            <h1> Productos </h1>
            <!-- Añadir productos  -->
            <div class="form-add-product">
                <form action="includes/products.inc.php" method="post">
                    <input type="text" name="modelo" placeholder="Modelo">
                    <input type="text" name="ram" placeholder="RAM">
                    <input type="text" name="bateria" placeholder="Bateria">
                    <input type="text" name="procesador" placeholder="Procesador">
                    <input type="text" name="precio" placeholder="Precio">
                    <button type="submit" name="product-submit"> Añadir</button>
                </form>
            </div>

            <!-- Mostrar productos en una lista con posibilidad de eliminarlos y/o modificarlos  -->
            <div class="table-show-products">
                <form action="includes/products.inc.php" method="post">

                    <!-- Generamos la primera fila de la tabla con los títulos correspondientes -->
                    <table>
                        <tr>
                            <th>Modelo</th>
                            <th>RAM</th>
                            <th>Bateria</th>
                            <th>Procesador</th>
                            <th>Precio</th>
                            <th></th>
                        </tr>

                        <?php
                        require "includes/config.inc.php";
                        session_start();
                        //Obtenemos los productos guardados en la base de datos
                        $sql = "SELECT * FROM PRODUCTOS";
                        $result = $conexion->query($sql);
                        $i = 0;
                        if ($result->num_rows > 0) {
                            // Recorremos cada producto
                            while ($row = $result->fetch_assoc()) {
                                $modelo = $row["Modelo"];
                                $ram = $row["RAM"];
                                $bateria = $row["Bateria"];
                                $procesador = $row["Procesador"];
                                $precio = $row["Precio"];
                                //Por cada producto generamos dos filas:

                                //La primera fila muestra los datos del producto
                                echo "<tr>";
                                echo "<td>" . $modelo . "</td>";
                                echo "<td>" . $ram . "</td>";
                                echo "<td>" . $bateria . "</td>";
                                echo "<td>" . $procesador . "</td>";
                                echo "<td>" . $precio . "</td>";
                                //Se genera un botón de eliminar
                                echo "<td><button name='eli_" . $modelo . "'>Eliminar</button></td>";
                                echo "</tr>";
                                echo "<br>";


                                //La segunda fila muestra un input por cada campo de producto
                                echo "<tr id>";
                                echo "<td> <input type='text' name='" . $modelo . "' value=$modelo placeholder='Modelo'></td>";
                                echo "<td> <input type='text' name='ram_" . $modelo . "' value=$ram placeholder='RAM'></td>";
                                echo "<td> <input type='text' name='bat_" . $modelo . "' value=$bateria placeholder='Bateria'></td>";
                                echo "<td> <input type='text' name='proc_" . $modelo . "' value=$procesador placeholder='Procesador'></td>";
                                echo "<td> <input type='text' name='prec_" . $modelo . "'value=$precio placeholder='Precio'></td>";
                                //Se genera un botón para modificar
                                echo "<td><button name='mod_" . $modelo . "'>Modificar</button></td>";
                                echo "</tr>";
                                echo "<br>";
                            }
                        }

                        ?>


                        <script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
                        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
                        <script type=text/javascript>

                            //Evento que detecta el botón que se ha pulsado
                            $(':button').click(function () {
                                //Se obtiene el nombre del producto que se desea eliminar o modificar
                                var buttonElementName = $(this).attr('name').substr(4);

                                //Se comprueba según el nombre del botón pulsado si se desea eliminar o modificar
                                if ($(this).attr('name').substr(0, 4) == 'eli_') { //Eliminar
                                    //Confirmación de borrado
                                    if (confirm('Esta seguro de eliminar?')) {
                                        //Utilizando ajax pasamos el elemento que queremos eliminar al products.inc.php
                                        $.ajax({
                                            url: 'includes/products.inc.php',
                                            data: {productd: buttonElementName},
                                            type: 'POST',
                                            success: function (output) {
                                                alert(output);
                                            }
                                        });
                                    }

                                } else { //Modificar
                                    //Se obtienen los valores de todos los input del producto correspondiente
                                    var modelo = $("input[name=" + buttonElementName + "]").val();
                                    var ram = $("input[name=ram_" + buttonElementName + "]").val();
                                    var bat = $("input[name=bat_" + buttonElementName + "]").val();
                                    var proc = $("input[name=proc_" + buttonElementName + "]").val();
                                    var prec = $("input[name=prec_" + buttonElementName + "]").val();

                                    //Utilizando ajax pasamos los campos de los productos a products.inc.php
                                    $.ajax({
                                        url: 'includes/products.inc.php',
                                        data: {
                                            productm: buttonElementName,
                                            pmodelo: modelo,
                                            pram: ram,
                                            pbat: bat,
                                            pproc: proc,
                                            pprec: prec
                                        },
                                        type: 'POST',
                                        success: function (output) {
                                            alert(output);
                                        }
                                    });
                                }
                            });
                        </script>
                    </table>
                </form>
            </div>


        </section>
    </div>
</main>
