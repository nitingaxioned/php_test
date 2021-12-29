<!doctype html>
<html lang="en">
<?php
 session_start();
//  require '../helper/validateRegister.php';
 ?>
<head>
  <meta charset="utf-8">
  <title>Chit-Chat | Sign In</title>
  <link rel="shortcut icon" href="favicon.ico" />
  <link rel="stylesheet" media="screen" href="../assets/css/style.css">
</head>

<body>
  <!--container start-->
  <div class="container">
    <!--header section start-->
    <header>
      <ul class="navbar">
        <li><a href="../index.php" title="Home Page">Home</a></li>
        <li><a href="login.php" title="Login Page">Login</a></li>
      </ul>
      <h1>Sign in To Chit-Chat</h1>
    </header>
    <!--header section end-->
    <!--main section start-->
    <main>
      <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <div class="container">
          <div class="form-group">
            <label for="name">Name</label>
            <input type="text" id="name" name="name" placeholder="Enter Name" value="<?php echo $name; ?>">
            <span class="error hide-me name-err">
              <?php echo $nameErr; ?> 
            </span>
          </div>
          <div class="form-group">
            <label for="phone">Phone Number</label>
            <input type="text" id="phone" name="phone" placeholder="Enter Phone Number" value="<?php echo $phone; ?>">
            <span class="error hide-me phone-err">
              <?php echo $phoneErr; ?> 
            </span>
          </div>
          <div class="form-group">
            <label for="mail">E-mail</label>
            <input type="text" id="mail" name="mail" placeholder="Enter E-mail" value="<?php echo $mail; ?>">
            <span class="error hide-me mail-err">
              <?php echo $mailErr; ?> 
            </span>
          </div>
          <div class="form-group">
            <label for="password">Password</label>
            <input type="password" id="password" placeholder="Enter Password" name="password">
            <span class="error hide-me password-err">
              <?php echo $passErr; ?> 
            </span>
          </div>
          <div class="form-group">
            <label for="conform-password">Conform Password</label>
            <input type="password" id="conform-password" name="conform-password" placeholder="Renter Password to Conform" value="">
            <span class="error hide-me conform-password-err">
                <?php echo $confPassErr ;?> 
            </span>
        </div>
          <label>
            <input type="checkbox" <?php echo $remember; ?> name="remember"> Remember me
          </label>
          <div class="form-controls">
            <input type="submit" id="submit-btn" name="submit" value="submit">
            <input type="submit" id="clear-btn" value="clear" name="clear">
          </div>
        </div>
      </form>
    </main>
    <!--main section end-->

    <!--footer section start-->
    <footer>

    </footer>
    <!--footer section end-->
  </div>
  <!--container end-->
  <script src="assets/js/script.js"></script>
</body>

</html>