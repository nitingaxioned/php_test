<?php
session_start();
session_unset();
session_destroy();
setcookie('logedUsre',"",time()-(1*24*60*60));
setcookie('remember',"",time()-(1*24*60*60));
header("Location: login.php");
exit;