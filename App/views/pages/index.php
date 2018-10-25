<?php require APPROOT . "/views/inc/header.php"; ?>
  <div class="pages--front">
    <div class="pages--front__container">
      <h1 class="pages--front__container__title"><?php echo $data['title']; ?></h1>
      <p class="pages--front__container__description"><?php echo $data['description']; ?></p>
      <a class="pages--front__container__register" href="<?php echo URLROOT; ?>/users/register">Register</a>
      <a class="pages--front__container__login" href="<?php echo URLROOT; ?>/users/login">Sign in</a>
    </div>
  </div>
<?php require APPROOT . "/views/inc/footer.php"; ?>
