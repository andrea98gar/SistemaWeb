<?php
require "header.php";
?>

<main>
    <div class="wrapper-main">
        <section class="section-default">

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

            <div class="table-show-products">
                <form action="includes/products.inc.php" method="post">
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
                        $sql = "SELECT * FROM PRODUCTOS";
                        $result = $conexion->query($sql);
                        $i = 0;
                        if ($result->num_rows > 0) {
                            // output data of each row
                            while ($row = $result->fetch_assoc()) {
                                $i++;
                                $modelo = $row["Modelo"];
                                $ram = $row["RAM"];
                                $bateria = $row["Bateria"];
                                $procesador = $row["Procesador"];
                                $precio = $row["Precio"];
                                echo "<tr>";
                                echo "<td>" . $modelo . "</td>";
                                echo "<td>" . $ram . "</td>";
                                echo "<td>" . $bateria . "</td>";
                                echo "<td>" . $procesador . "</td>";
                                echo "<td>" . $precio . "</td>";
                                echo "<td><button name='eli_" . $modelo . "'>Eliminar</button></td>";
                                echo "</tr>";
                                echo "<br>";

                                echo "<tr id>";
                                echo "<td> <input type='text' name='" . $modelo . "' value=$modelo placeholder='Modelo'></td>";
                                echo "<td> <input type='text' name='ram_" . $modelo . "' value=$ram placeholder='RAM'></td>";
                                echo "<td> <input type='text' name='bat_" . $modelo . "' value=$bateria placeholder='Bateria'></td>";
                                echo "<td> <input type='text' name='proc_" . $modelo . "' value=$procesador placeholder='Procesador'></td>";
                                echo "<td> <input type='text' name='prec_" . $modelo . "'value=$precio placeholder='Precio'></td>";
                                echo "<td><button name='mod_" . $modelo . "'>Modificar</button></td>";
                                echo "</tr>";
                                echo "<br>";
                            }
                        }

                        ?>

                        <script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
                        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
                        <script type=text/javascript>

                            //Evento que detecta el boton que se ha pulsado
                            $(':button').click(function () {
                                //Comprobamos segun el nombre si se desea eliminar o modificar
                                if ($(this).attr('name').substr(0, 4) == 'eli_') { //Eliminar
                                    var buttonElementName = $(this).attr('name').substr(4); //Cogemos el nombre del producto
                                    if (confirm('Esta seguro de eliminar?')) {//Confirmacion de borrado
                                        //utilizando ajax pasamos el elemento que queremos eliminar al products.inc.php
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
                                    var buttonElementName = $(this).attr('name').substr(4);
                                    var modelo = $("input[name=" + buttonElementName + "]").val();
                                    var ram = $("input[name=ram_" + buttonElementName + "]").val();
                                    var bat = $("input[name=bat_" + buttonElementName + "]").val();
                                    var proc = $("input[name=proc_" + buttonElementName + "]").val();
                                    var prec = $("input[name=prec_" + buttonElementName + "]").val();

                                    //alert (buttonElementName);
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
