<header>

  <div class="primary-header">
    <a href="<?php echo $template_vars["get_hierarchy"]; ?>" class="nsu-logo">
      <img src="<?php echo $template_vars["get_hierarchy"]; ?>src/img/logo-wide.png" alt="" srcset="">
    </a>
    <div class="header-right">
      <?php
      if (USERS::isLogged()) {
      ?>
        <a href="#profile">Welcome, <?php echo $_COOKIE['logged_user']; ?></a>
      <?php
      } else {
      ?>
        <a href="./credits_page.php">Credits</a>
      <?php
      }
      ?>
    </div>
  </div>


</header>