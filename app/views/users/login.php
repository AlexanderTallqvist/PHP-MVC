<?php require APPROOT . "/views/inc/header.php"; ?>
  <div class="login-form">
    <h2 class="login-form--title">Login</h2>
    <p class="login-form--description">Please fill out the form below.</p>
    <form class="login-form--form" action="<?php echo URLROOT; ?>/users/login" method="post">

      <div class="login-form--form__group">
        <label for="email">Email</label>
        <input type="email" name="email" value="<?php echo $data['email'] ?>" class="<?php echo empty($data['email_error']) ? "correct" : "invalid" ?>">
        <span><?php echo $data['email_error'] ?></span>
      </div>

      <div class="login-form--form__group">
        <label for="password">Password</label>
        <input type="password" name="password" value="<?php echo $data['password'] ?>" class="<?php echo empty($data['password_error']) ? "correct" : "invalid" ?>">
        <span><?php echo $data['password_error'] ?></span>
      </div>

      <div class="login-form--form__buttons">
        <input class="login-form--form__buttons__register" type="submit" value="Login">
        <a class="login-form--form__buttons__login" href="<?php echo URLROOT; ?>/users/register">Don't have an account?</a>
      </div>
    </form>
  </div>
<?php require APPROOT . "/views/inc/footer.php"; ?>
