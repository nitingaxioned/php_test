<?php

require 'query.php';

if(!isset($_SESSION['user'])) {
    header("Location: ./view/login.php");
    exit;
}
if($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST['general-btn'])) {
        header("Location: ./view/genral-group.php");
        exit;
    }
    if(isset($_POST['chatWiht'])) {
        $_SESSION['chatId'] = $_POST['chatWihtId'];
        $_SESSION['chatUser'] = $_POST['chatWihtUser'];
        header("Location: ./view/chat.php");
        exit;
    }
}

function showUsers(){
    $objx=new Query();
    $resultx = $objx->getData('users','id, name');
    foreach($resultx as $item){
        if (!($_SESSION['user']['id'] == $item['id'] || '100' == $item['id'])) {
        ?>
        <li class="user">
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" class="user-form">
                <button type="submit" class="cancelbtn" name="chatWiht"><?php echo $item['name'];?></button>
                <input type="hidden" name="chatWihtId" value="<?php echo $item['id'];?>">
                <input type="hidden" name="chatWihtUser" value="<?php echo $item['name'];?>">
            </form>
        <li>
        <?php
        }
    }
}