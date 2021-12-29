<!doctype html>
<html lang="en">
<?php
    session_start();
    require 'helper/loadUsers.php';
?>
<head>
  <meta charset="utf-8">
  <title>Chit-Chat | Home</title>
  <link rel="shortcut icon" href="favicon.ico" />
  <link rel="stylesheet" media="screen" href="assets/css/style.css">
</head>

<body>
  <!--container start-->
  <div class="container">
    <!--header section start-->
    <header>
      <ul class="navbar">
        <li><a href='view/logout.php' title='Logout'>Logout</a></li>
      </ul>
      <h1>Chit-Chat Users</h1>
    </header>
    <!--header section end-->
    <!--main section start-->
    <main>
      <ul class="users-list all-users">
        <li class="user">
          <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" class="user-form">
            <button type="submit" class="cancelbtn" name="general-btn">General Group</button>
          </form>
        </li>
        <?php
          showUsers();
        ?>
      </ul>
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