<?php
  include('includes/config.php');
  include('includes/classes/Account.php');
  include('includes/classes/Constants.php');
  $account = new Account($conn);


  include('includes/handlers/register-handler.php');
  include('includes/handlers/login-handler.php');

  function getInputValue($name){
    if (isset($_POST[$name])) {
      echo $_POST[$name];
    }
  }
 ?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Welcome to Spotify!</title>

    <link rel="stylesheet" href="assets/css/register.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <script src="assets/js/register.js"></script>


  </head>
  <body>
      <?php
        if(isset($_POST['registerButton'])){
              echo '<script>
                    $(document).ready(function(){
                      $("#loginForm").hide();
                      $("#registerForm").show();
                    });
                    </script>';
        }else {
          echo '<script>
                $(document).ready(function(){
                  $("#loginForm").show();
                  $("#registerForm").hide();
                });
                </script>';
        }

       ?>


    <div id="background">
      <div id="loginContainer">

          <div id="inputContainer">
            <form id="loginForm" action="register.php" method="post">
              <h2>Login to your account</h2>
              <p>
                <?php echo $account->getError(Constants::$loginFailed);?>
              <label for="loginUsername">Username</label>
              <input type="text" name="loginUsername" id="l Failed opening 'includes/classes/constants.php' for inclusion (include_path='.:/usr/share/php') in /dados/Spotify_php/register.php on line 4
oginUsername" placeholder="Username" value="<?php getInputValue('loginUsername')?>" required>
              </p>
              <p>

                <label for="loginPassword">Password</label>
                <input type="password" name="loginPassword" id="loginPassword" required>
              </p>
              <button type="submit" name="loginButton">Login</button>
              <div class="hasAccountText">

                <span id="hideLogin">Don't have an account yet? Signup here.</span>

              </div>
            </form>



            <form id="registerForm" action="register.php" method="post">
              <h2>Create your free account</h2>
              <p>
                <?php echo $account->getError(Constants::$usernameTaken);?>
                <?php echo $account->getError(Constants::$usernameSize);?>
              <label for="username">Username</label>
              <input type="text" name="username" id="username" placeholder="Username" value="<?php getInputValue('username')?>"required>
              </p>
              <p>
                <?php echo $account->getError(Constants::$firstnameSize);?>
              <label for="firstName">First name</label>
              <input type="text" name="firstName" id="firstName" placeholder="First Name" value="<?php getInputValue('firstName')?>"required>
              </p>
              <p>
                  <?php echo $account->getError(Constants::$lastnameSize);?>
              <label for="lastName">Last name</label>
              <input type="text" name="lastName" id="lastName" placeholder="Last Name" value="<?php getInputValue('lastName')?>"required>
              </p>
              <p>
                  <?php echo $account->getError(Constants::$emailDoNotMatch);?>
                  <?php echo $account->getError(Constants::$emailInvalid);?>
                    <?php echo $account->getError(Constants::$emailTaken);?>
              <label for="email">Email</label>
              <input type="email" name="email" id="email" placeholder="email@email.com" value="<?php getInputValue('email')?>"required>
              </p>
              <p>

              <label for="email2">Confirm Email</label>
              <input type="email" name="email2" id="email2" placeholder="confirm email" value="<?php getInputValue('email2')?>"required>
              </p>
              <p>
                  <?php echo $account->getError(Constants::$passwordsDoNotMatch);?>
                  <?php echo $account->getError(Constants::$passwordsNotAlpha);?>
                  <?php echo $account->getError(Constants::$passwordCharacters);?>
                <label for="password">Password</label>
                <input type="password" name="password" id="password" placeholder="your password" value="<?php getInputValue('password')?>"required>
              </p>
              <p>

                <label for="password2">confirm Password</label>
                <input type="password" name="password2" id="password2" placeholder="your password" value="<?php getInputValue('password2')?>"required>
              </p>
              <button type="submit" name="registerButton" >Sign Up</button>
                <div class="hasAccountText">
                <span id="hideRegister">Already have an account? Log in here</span>
                </div>
            </form>

          </div>

            <div id="loginText">
              <h1>Get great music, right now</h1>
              <h2>Listen to loads of songs for free</h2>
              <ul>
                <li>Discover music you'll fall in love with</li>
                <li>Crete your own playlists</li>
                <li>Follow artists to keep up to date</li>
              </ul>
            </div>

        </div>
  </div>
  </body>
</html>
