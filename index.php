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
            <form action="includes/products.inc.php" method="post">
              <button type="submit" name="show-product"> Mostrar </button>

            </form>
          </div>


      </section>
    </div>
  </main>
