<?php
session_start();

include("includes/header.php");
include("includes/navbar.php");
?>

<style>
  .alert-div {
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 20px;
  }
</style>

<!-- Signup Form -->
<section class="container forms custom-margin">
  <div class="form login">
    <div class="form-content">
      <div class="alert-div">
        <?php
        if (isset($_SESSION['status'])) {
          echo '<h4>' . $_SESSION['status'] . '</h4>';
          unset($_SESSION['status']);
        }

        ?>
      </div>

      <header>Sign up</header>


      <form action="code.php" method="POST">
        <div class="field input-field">
          <input type="text" name="name" placeholder="Full Name" class="input">
        </div>
        <div class="field input-field">
          <input type="text" name="phone" placeholder="Phone Number" class="input">
        </div>
        <div class="field input-field">
          <input type="email" name="email" placeholder="Email" class="input">
        </div>
        <div class="field input-field">
          <input type="password" name="password" placeholder="Password" class="password">
          <i class='bx bx-hide eye-icon'></i>
        </div>
        <div class="field input-field">
          <input type="password" name="confirm_pass" placeholder="Confirm Password" class="password">
          <i class='bx bx-hide eye-icon'></i>
        </div>
        <!-- <div class="form-link">
          <a href="#" class="forgot-pass">Forgot password?</a>
        </div> -->
        <div class="field button-field">
          <button type="submit" name="register_btn">Sign up</button>
        </div>
      </form>


      <div class="form-link">
        <span>Already have an account? <a href="login.php" class="link signup-link">Login</a></span>
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
    </div> -->
  </div>
</section>

<?php
include("includes/footer.php")
?>