<?php

require 'query.php';

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}
if($_SERVER["REQUEST_METHOD"] == "POST" && $_POST['msg']!='') {
    $obj=new Query();
    $obj->insertData('messages', array('mesage' => $_POST['msg'], 'toUserId' => '100', 'fromUserId' => $_SESSION['user']['id']));
}

function showChats()
{
    $obj=new Query();
    $con_arr = array('toUserId' => '100');
    $result = $obj->getData('msgs', '*', $con_arr, '', 'date', 'asc');
    if ($result != 0) {
        foreach ($result as $item) {
            ?>
            <li class="chat">
                <p class="name"><?php echo $item['fromUser'].'- ';?></p>
                <p><?php echo $item['mesage'];?></p>
                <p class="time"><?php echo date_format(date_create($item['date']),"jS M Y @ g:i A");?></p>
            </li>
            <?php
        }
    } else {
        ?>
        <li class="chat">
            <p>No Chats Found !!</p>
        </li>
        <li class="chat">
            <p>start Your Chit-Chat in General</p>
        </li>
        <?php
    }
}