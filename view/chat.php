<!doctype html>
<html lang="en">
<?php
    session_start();
    require '../helper/loadChat.php';
?>
<head>
    <meta charset="utf-8">
    <title>Chit-Chat | Chat</title>
    <link rel="shortcut icon" href="../favicon.ico" />
    <link rel="stylesheet" media="screen" href="../assets/css/style.css">
</head>

<body>
    <div class="container">
        <header>
            <ul class="navbar">
                <li><a href="../index.php" title="Home Page">Home</a></li>
                <li><a href='logout.php' title='Logout'>Logout</a></li>
                <li><a href='chat.php' title='refresh'>Refresh</a></li>
            </ul>
            <h1 class="loginTitel">Chit-Chat with <?php echo $_SESSION['chatUser'];?></h1>
        </header>
        <!--header section end-->
        <!--main section start-->
        <main>
            <div class='chatbox'>
                <ul class="users-list">
                    <?php
                        showChats();
                    ?>
                </ul>
            </div>
            <form class="chat msg-input" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <input type="text" id="msg" name="msg" placeholder="Enter your message..." value="">
                <input type="submit" id="send" name="send" value="send">
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