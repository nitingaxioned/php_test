<?php

require 'validate.php';

$nameErr = $phoneErr = $mailErr = $passErr = $confPassErr = "";
$name = $phone = $mail = $pass = $confPass = "";
$remember = "unchecked";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $mail = $_POST['mail'];
    $pass = $_POST['password'];
    $confPass = $_POST['conform-password'];
    $remember = "unchecked";

    if (isset($_COOKIE['remember'])) {
        $GLOBALS['remember'] = $_COOKIE['remember'];
    }
    if (isset($_POST['clear'])) {
        $nameErr = $phoneErr = $mailErr = $passErr = $confPassErr = "";
        $name = $phone = $mail = $pass = $confPass = "";
        $genM = "checked";
        $genF = "unchecked";
    } elseif (isset($_POST['submit'])) {
        validateRrgister();
    } 
}

function validateRrgister() {
    $flag = 0;
    $obj = new Validate();
    $obj->nameValidate($GLOBALS['name'],$GLOBALS['nameErr']) || $flag++ ;
    $obj->phoneValidate($GLOBALS['phone'],$GLOBALS['phoneErr']) || $flag++ ;
    if($obj->checkRegisteredMail($GLOBALS['mail'])) {
        $flag++ ;
        $GLOBALS['mailErr'] = 'This mail is alredy registerd.';
    }
    $obj->emailValidate($GLOBALS['mail'],$GLOBALS['mailErr']) || $flag++ ;
    $obj->passwordValidate($GLOBALS['pass'],$GLOBALS['passErr']) || $flag++ ;
    $obj->confPassValidate($GLOBALS['pass'],$GLOBALS['confPass'],$GLOBALS['confPassErr']) || $flag++ ;
    if($flag == 0) {
        $hash = password_hash($GLOBALS['pass'],PASSWORD_BCRYPT);
        $data_arr=array('name'=>$GLOBALS['name'], 'phone'=>$GLOBALS['phone'], 'email'=>$GLOBALS['mail'], 'password'=>$hash);
        $obj->insertData('users',$data_arr);
        $result = $obj->getData('users','*',$data_arr);
        foreach ($result as $item) {
            getLogin($item);
        }
    }
}

function getLogin($user) {
    if($GLOBALS['remember']=='checked'){
        unset($user['password']); 
        setcookie('logedUsre',json_encode($user, true),time()+(1*24*60*60));
        setcookie('remember',"checked",time()+(1*24*60*60));
    }
    $_SESSION["user"] = $user;
    header("Location: ../index.php");
    exit;
}