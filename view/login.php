<!doctype html>
<html lang="en">
<?php
    session_start();
    // require '../helper/validateLogin.php';
?>
<head>
    <meta charset="utf-8">
    <title>Chit-Chat | Login</title>
    <link rel="shortcut icon" href="../favicon.ico" />
    <link rel="stylesheet" media="screen" href="../assets/css/style.css">
</head>

<body>
    <div class="container">
        <header>
            <h1 class="loginTitel">Login To Chit-Chat</h1>
        </header>
        <!--header section end-->
        <!--main section start-->
        <main>
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <div class="container">
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
                            <?php echo $logpass_err; ?> 
                        </span>
                    </div>
                    <button type="submit" name="submit">Login</button>
                    <label>
                        <input type="checkbox" name="remember" value="remember" <?php echo $remember;?>> Remember me
                    </label>
                </div>
                <div class="containerx" style="background-color:#f1f1f1">
                    <button type="submit" class="cancelbtn" name="cancel">Cancel</button>
                    <button type="submit" class="cancelbtn" name="signin">Sign In</button>
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