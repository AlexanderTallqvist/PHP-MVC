<nav class="main-navigation">
  <ul class="main-navigation--link-container">
    <li><a class="main-navigation--link-container__link" href="<?php echo URLROOT; ?>">Home</a></li>
    <li><a class="main-navigation--link-container__link" href="<?php echo URLROOT; ?>/pages/about">About</a></li>
    <?php if (isset($_SESSION['user_id'])) : ?>
      <li><a class="main-navigation--link-container__link" href="<?php echo URLROOT; ?>/users/logout">Log out</a></li>
    <?php else : ?>
      <li><a class="main-navigation--link-container__link" href="<?php echo URLROOT; ?>/users/register">Register</a></li>
      <li><a class="main-navigation--link-container__link" href="<?php echo URLROOT; ?>/users/login">Sign in</a></li>
    <?php endif ?>
  </ul>
</nav>
