<?php
require_once "../template/navbar.php";

?>
<link rel="stylesheet" href="../css/login.css">

<div class="container" id="container">
  <!-- sign in page -->
  <div class="form-container sign-in-container">
    <form method="POST" action="#" class="form" id="login">
      <h1 class="form__title">Login</h1>
      <div class="form__input-group">
        <label for="username">Username: </label>
        <input type="text" class="form__input" name="username" id="username" maxlength="20" required>
      </div>
      <div class="form__input-group">
        <label for="pass">Password: </label>
        <input type="password" class="form__input" name="pass" id="pass" maxlength="20" required>
      </div>
      <div class="form__input-group">
        <button type="submit" class="form__button">Submit</button>
      </div>
    </form>
  </div>

  <!--  create account page -->
  <div class="form-container sign-up-container">
    <form method="POST" action="../registration/index.php" class="form" id="register">
      <h1 class="form__title">Register</h1>
      <div class="form__input-group">
        <label for="username"> Username: </label>
        <input type="text" class="form__input" name="username" id="username" maxlength="20" required>
      </div>
      <div class="form__input-group">
        <label for="pass">Password: </label>
        <input type="password" class="form__input" name="pass" id="pass" maxlength="20" required>
      </div>
      <button class="form__button" type="submit">Sign Up</button>
    </form>
  </div>

  <div class="overlay-container">
    <div class="overlay">
      <div class="overlay-panel overlay-left">
        <h1>Welcome Back!</h1>
        <p>Please login with your personal info</p>
        <button class="ghost" id="signIn">Sign In</button>
      </div>
      <div class="overlay-panel overlay-right">
        <h1>Not registered?</h1>
        <p>Click below and start your journey with us</p>
        <button class="ghost" id="signUp">Sign Up</button>
      </div>
    </div>
  </div>
</div>

<script src="../js/login.js"></script>

<?php
require_once "../template/footer.php";
?>