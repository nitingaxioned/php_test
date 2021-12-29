<?php

require 'query.php';

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}
if (!isset($_SESSION['chatId'])) {
    header("Location: ../index.php");
    exit;
}
if($_SERVER["REQUEST_METHOD"] == "POST" && $_POST['msg']!='') {
        $obj=new Query();
        $obj->insertData('messages', array('mesage' => $_POST['msg'], 'toUserId' => $_SESSION['chatId'], 'fromUserId' => $_SESSION['user']['id']));
}

function showChats()
{
    $obj=new Query();
    $con_arr = array('fromUserId' => $_SESSION['user']['id'], 'toUserId' => $_SESSION['chatId']);
    $orcon_arr = array('fromUserId' => $_SESSION['chatId'], 'toUserId' => $_SESSION['user']['id']);
    $result = $obj->getData('msgs', '*', $con_arr, $orcon_arr, 'date', 'asc');
    foreach ($result as $item) {
        ?>
        <li class="chat">
            <p class="name"><?php echo $item['fromUser'].'- ';?></p>
            <p><?php echo $item['mesage'];?></p>
            <p class="time"><?php echo date_format(date_create($item['date']),"jS M Y @ g:i A");?></p>
        </li>
        <?php
    }
}