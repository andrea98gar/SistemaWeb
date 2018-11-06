<?php
  require "header.php";
?>

  <main>
    <div class="wrapper-main">
      <section class="section-default">
        <?php
          if (isset($_SESSION['userId'])) {
            echo '<p class="login-status"> Entro </p>';
          }else {
            echo '<p class="login-status"> Fuera </p>';          }
          ?>

          <div class = "form-add-product">

            <form action="includes/products.inc.php" method="post">

              <input type="text" name="modelo" placeholder="Modelo">
              <input type="text" name="ram" placeholder="RAM">
              <input type="text" name="bateria" placeholder="Bateria">
              <input type="text" name="procesador" placeholder="Procesador">
              <input type="text" name="precio" placeholder="Precio">
              <button type="submit" name="product-submit"> Añadir </button>
            </form>
          </div>

          <div class = "table-show-products">
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
                      while($row = $result->fetch_assoc()) {
                          $i ++;
                          $modelo = $row["Modelo"];
                          $ram = $row["RAM"];
                          $bateria = $row["Bateria"];
                          $procesador = $row["Procesador"];
                          $precio =$row["Precio"];
                          echo "<tr>";
                          echo "<td>" .$modelo. "</td>";
                          echo "<td>" .$ram. "</td>";
                          echo "<td>" .$bateria. "</td>";
                          echo "<td>" .$procesador. "</td>";
                          echo "<td>" .$precio. "</td>";
                          echo "<td><button type='submit' name='fila".$i."'>Modificar</button></td>";
                          echo "</tr>";
                          echo "<br>";
                        }
                    } else {
                        echo "0 results";
                    }
                    $_SESSION['cant'] = $i;
                   ?>

                 </table>

               </form>
          </div>




      </section>
    </div>
  </main>
