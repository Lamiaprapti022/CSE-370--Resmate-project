<?php
session_start();

if (isset($_SESSION['authenticated'])) {
  if ($_SESSION['auth_user']['is_admin'] == TRUE) {
    $_SESSION['status'] = "You are already Logged In.";
    header('Location: home_admin.php');
    exit(0);
  } else {
    $_SESSION['status'] = "You are already Logged In.";
    header('Location: home_user.php');
    exit(0);
  }
}



include("includes/header.php");
include("includes/navbar.php");
?>

<style>
  .alert-div-login {
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 14px;
    color: rgb(33, 139, 89);
  }
</style>

<section class="container forms custom-margin">

  <div class="form login">
    <div class="alert-div-login">
      <?php
      if (isset($_SESSION['status'])) {
        echo '<h4>' . $_SESSION['status'] . '</h4>';
        // unset($_SESSION['status']);
      }

      ?>
    </div>
    <div class="form-content">
      <header>Login</header>


      <form action="logincode.php" method="POST">
        <div class="field input-field">
          <input type="email" name="email" placeholder="Email" class="input">
        </div>
        <div class="field input-field">
          <input type="password" name="password" placeholder="Password" class="password">
          <i class='bx bx-hide eye-icon'></i>
        </div>
        <!-- <div class="form-link">
          <a href="#" class="forgot-pass">Forgot password?</a>
        </div> -->
        <div class="field button-field">
          <button type="submit" name="login_now_btn">Login</button>
        </div>
      </form>


      <div class="form-link">
        <span>Don't have an account? <a href="register.php" class="link signup-link">Signup</a></span>
      </div>
    </div>
    <!-- <div class="line"></div>
    <div class="media-options">
      <a href="#" class="field facebook">
        <img class="imgcls" src="images/facebook-svgrepo-com.svg" alt="">
        <span>Login with Facebook</span>
      </a>
    </div>
    <div class="media-options">
      <a href="#" class="field google">
        <img class="imgcls2" src="images/google-color-svgrepo-com.svg" alt="">
        <span>Login with Google</span>
      </a>
    </div>
  </div> -->
</section>


<?php
include("includes/footer.php")
?>