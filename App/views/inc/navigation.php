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
  <div class="flas-container">
    <div class="flas-container--register"><?php $messages::flashMessage('register_success') ?></div>
    <div class="flas-container--login"><?php $messages::flashMessage('login_success') ?></div>
    <div class="flas-container--post__success"><?php $messages::flashMessage('post_success') ?></div>
    <div class="flas-container--post__not-found"><?php $messages::flashMessage('post_not_found') ?></div>
  </div>
</nav>
