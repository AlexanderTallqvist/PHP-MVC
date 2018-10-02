<?php require APPROOT . "/views/inc/header.php"; ?>
  <div class="register-form">
    <h2 class="register-form--title">Sign Up</h2>
    <p class="register-form--description">Please fill out the form below.</p>
    <form class="register-form--form" action="<?php echo URLROOT; ?>/users/register" method="post">

      <div class="register-form--form__group">
        <label for="name">Name</label>
        <input type="text" name="name" value="<?php echo $data['name'] ?>" class="<?php echo empty($data['name_error']) ? "correct" : "invalid" ?>">
        <span><?php echo $data['name_error'] ?></span>
      </div>

      <div class="register-form--form__group">
        <label for="email">Email</label>
        <input type="email" name="email" value="<?php echo $data['email'] ?>" class="<?php echo empty($data['email_error']) ? "correct" : "invalid" ?>">
        <span><?php echo $data['email_error'] ?></span>
      </div>

      <div class="register-form--form__group">
        <label for="password">Password</label>
        <input type="password" name="password" value="<?php echo $data['password'] ?>" class="<?php echo empty($data['password_error']) ? "correct" : "invalid" ?>">
        <span><?php echo $data['password_error'] ?></span>
      </div>

      <div class="register-form--form__group">
        <label for="confirm_password">Confirm password</label>
        <input type="password" name="confirm_password" value="<?php echo $data['confirm_password'] ?>" class="<?php echo empty($data['confirm_password_error']) ? "correct" : "invalid" ?>">
        <span><?php echo $data['confirm_password_error'] ?></span>
      </div>

      <div class="register-form--form__buttons">
        <input class="register-form--form__buttons__register" type="submit" value="Register">
        <a class="register-form--form__buttons__login" href="<?php echo URLROOT; ?>/users/login">Have an account?</a>
      </div>
    </form>
  </div>
<?php require APPROOT . "/views/inc/footer.php"; ?>
