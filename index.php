<?php
  require "header.php";
?>

  <main>
    <div class="wrapper-main">
      <section class="section-default">
        <?php
          if (isset($_SESSION['userId'])) {
            echo '<p class="login-status"> ENtro </p>';
          }else {
            echo '<p class="login-status"> Fuera </p>';          }
          ?>
      </section>
    </div>
  </main>


