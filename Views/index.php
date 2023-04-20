<?php
require_once  "../Models/config.php";
?>
<!DOCTYPE html>
<html lang="en">
<!-- The index page welcoming users to either register or login -->

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="css/sign.css" />
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <style>
    .error-message {
      color: red;
      font-size: 0.8em;
    }

    #error {
      font-size: 0.8em;
    }

    .ok {
      color: green;
    }

    .error {
      color: red;
    }
  </style>
  <title>Kahuna Inc</title>
</head>

<body>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous" />

  <h1>
    <logo style="color: #f56501">Kahuna Inc.</logo> Smart Home Appliances
  </h1>

  <!--Registration form-->
  <div class="container" id="container">
    <div class="form-container sign-up-container">
      <form id="sign-up" action="../Controllers/registerUser.php?action=register" method="POST">
        <h1>Create Account</h1>

        <input type="text" id="name" placeholder="FullName" name="name" />
        <input type="text" id="email" placeholder="Email" name="email" onblur="checkEmail()" onkeyup="checkEmail()" />
        <?php if (isset($_GET['register']) && $_GET['register'] == "emailtakenx") {
          echo "<span style='color:red;'>Email Taken</span>";
        } ?>
        <span id="error"></span>

        <input type=" tel" id="mobile" placeholder="Phone Number" name="number" />
        <input type="password" placeholder="Password" id="password" name="password" />
        <input type="password" placeholder="Confirm Password" id="cpassword" name="cpassword" />

        <button type="submit" name="registerSubmit">Register Now</button>
      </form>
    </div>

    <!--Login form-->
    <div class="form-container sign-in-container">

      <form id="sign-in" action="../Controllers/login.php" method="POST">
        <?php if (isset($_GET['register']) && $_GET['register'] == "complete") {
          echo "<p style='font-size:23px;'><span style='color:#f56501;font-size:23px;'>Registration complete</span> please sign in to continue</p>";
        } ?>

        <h1>Sign in</h1>

        <!--FACEBOOK LOGIN BUTTON -->
        <div class="social-container">
          <a href="<?php echo $loginUrl ?>" class="social"><i class="fab fa-facebook-f"></i></a>
        </div>

        <span>or use your account</span>
        <input type="text" id="emailLog" name="emailLog" placeholder="Email" />

        <?php if (isset($_GET['signin']) && $_GET['signin'] == "error") {
          echo "<span style='color:#ff0000;font-size:20px;'>Invalid username or Password</span>";
          $url = "http://localhost/Kahuna/Views/index";
          $sec = 1;
          header("refresh: $sec; url=$url");
        } ?>

        <?php if (isset($_GET['logout']) && $_GET['logout'] == "success") {
          echo "<span style='color:#ff0000;font-size:20px;'>LOG OUT SUCCESSFULL</span>";
          $url = "http://localhost/Kahuna/Views/index";
          $sec = 1;
          header("refresh: $sec; url=$url");
        } ?>
        <input type="password" id="passwordLog" name="passwordLog" placeholder="Password" />

        <span>Keep me signed in</span>
        <input type="checkbox" />

        <a href="#">Forgot your password?</a>

        <button type="signin" name="signin">Sign In</button>

      </form>
    </div>

    <div class="overlay-container">
      <div class="overlay">

        <div class="overlay-panel overlay-left">
          <h1>Welcome Back!</h1>
          <p>
            To keep connected with us please login with your personal info
          </p>
          <button class="ghost" id="signIn">Sign In</button>
        </div>

        <div class="overlay-panel overlay-right">
          <h1>New to Kahuna?</h1>
          <p>Enter your details to get signed up now!</p>
          <button class="ghost" id="signUp">Sign Up</button>
        </div>

      </div>
    </div>

  </div>

</body>

<script src="js/validation.js"></script>
<script src="js/forms.js"></script>
<script src="js/ajax.js"></script>

</html>