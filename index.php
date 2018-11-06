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

          <div class = "form-show-products">
            <form name="product-table">
              <table>
              <?php

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
                        echo "<td><input type="text" /> </td>";
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
                  $conexion->close();
              ?>
             </table>
              <!--<button type="submit" name="show-product"> Mostrar </button> -->
            </form>
          </div>




      </section>
    </div>
  </main>
