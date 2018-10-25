<nav class="main-navigation">
  <div class="main-navigation--logo-container"><a class="fas fa-ghost fa-3x" href="<?php echo URLROOT; ?>"></a></div>
  <ul class="main-navigation--link-container">
    <li><a class="main-navigation--link-container__link" href="<?php echo URLROOT; ?>/pages/about">About</a></li>
    <?php if (isset($_SESSION['user_id'])) : ?>
      <li><a class="main-navigation--link-container__link" href="<?php echo URLROOT; ?>/users/logout">Log out</a></li>
    <?php else : ?>
      <li><a class="main-navigation--link-container__link" href="<?php echo URLROOT; ?>/users/register">Register</a></li>
      <li><a class="main-navigation--link-container__link" href="<?php echo URLROOT; ?>/users/login">Sign in</a></li>
    <?php endif ?>
  </ul>
</nav>
<div class="flash-container">
  <div class="flash-container--register"><?php $messages::flashMessage('register_success') ?></div>
  <div class="flash-container--login"><?php $messages::flashMessage('login_success') ?></div>
  <div class="flash-container--post__success"><?php $messages::flashMessage('post_success') ?></div>
  <div class="flash-container--post__not-found"><?php $messages::flashMessage('post_not_found') ?></div>
  <div class="flash-container--post__edited"><?php $messages::flashMessage('post_edited') ?></div>
</div>
