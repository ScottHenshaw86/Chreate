<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>signin-signup</title>
    <!-- CSS link -->
    <link rel="stylesheet" href="./public/css/style.css" />
    <!-- JS link -->
    <script defer src="./public/js/toggleSignInUp.js"></script>
    <!-- ICONS link -->
    <link
      href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css"
      rel="stylesheet"/>
  </head>
  <body>
    <div class="container">
      <!-- SIGN IN -->
      <div class="signin-signup">
        <form action="" class="sign-in-form">
          <h2 class="title">Sign In</h2>
          <!-- user -->
          <div class="input-field">
            <i class="bx bxs-user"></i>
            <input type="text" placeholder="Username" />
          </div>
          <!-- password -->
          <div class="input-field">
            <i class="bx bxs-lock"></i>
            <input type="password" placeholder="Password" />
          </div>
          <input type="submit" value="Login" class="btn" />
        </form>

        <!-- SIGN UP -->
        <form action="" class="sign-up-form">
          <h2 class="title">Sign Up</h2>
          <!-- user -->
          <div class="input-field">
            <i class="bx bxs-user"></i>
            <input type="text" placeholder="Username" />
          </div>
          <!-- email -->
          <div class="input-field">
            <i class='bx bxs-envelope' ></i>
            <input type="text" placeholder="email" />
          </div>
          <!-- password -->
          <div class="input-field">
            <i class="bx bxs-lock"></i>
            <input type="password" placeholder="Password" />
          </div>
          <input type="submit" value="Sign up" class="btn" />
        </form>
      </div>
      <div class="panals-controller">
        <!-- SIGN IN PANAL -->
        <div class="panel left-panel">
            <div class="content">
                <h3>Member of Chreate?</h3>
                <p>WAKE UP JOHNNY IT'S TIME TO TAKE A PISS AND SIGN IN!</p>
                <button class="btn" id="sign-in-btn">Sign in</button>
            </div>
            <img class="image1 img" src="./public/images/signin.svg" alt="">
        </div>

        <!-- SIGN UP PANAL -->
        <div class="panel right-panel">
            <div class="content">
                <h3>New to Chreate?</h3>
                <p>STOP SMOKIN CRACK AND SIGN UP JOHNNY!</p>
                <button class="btn" id="sign-up-btn">Sign up</button>
            </div>
            <img class="image2 img" src="./public/images/signup.svg" alt="">
        </div>
      </div>
    </div>
  </body>
</html>
