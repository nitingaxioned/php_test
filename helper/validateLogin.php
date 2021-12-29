<?php

require 'validate.php';

$mail = $mailErr = $logpass_err = "";
$remember = 'unchecked';

if(isset($_COOKIE['remember'])) {
    $GLOBALS['remember'] = $_COOKIE['remember'];
}

if(isset($_COOKIE['logedUsre'])) {
    getLogin(json_decode($_COOKIE['logedUsre'], true));
}

if(isset($_COOKIE['logedmail'])) {
    $mail = $_COOKIE['logedmail'];
}

if($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST['mail'])) {
        $mail = $_POST['mail'];
    } 
    if(isset($_POST['remember']) && $_POST['remember']=='remember') {
        $remember = 'checked';
    }
    if(isset($_POST['submit'])) {
        validateLogin();
    } elseif(isset($_POST['signin'])) {
        header("Location: signin.php");
        exit;
    } else {
        $mail = $mailErr = $logpass_err = "";
        $remember = 'unchecked';
    }
}

function validateLogin() {
    $obj = new Validate();
    if($obj->emailValidate($GLOBALS['mail'],$GLOBALS['mailErr'])) {
        if($obj->checkRegisteredMail($GLOBALS['mail'])) {
            matchLogin();
        } else {
            $GLOBALS['mailErr'] = "This email is not registerd with Chit-Chat.";
        }
    }
}

function matchLogin(){
    $obj = new Validate();
    $data = array("email"=>$GLOBALS['mail']);
    $resultx = $obj->getData('users','*' ,$data);
    if($obj->passwordValidate($_POST['password'],$GLOBALS['logpass_err'])) {
        foreach($resultx as $item){
            if(password_verify($_POST['password'],$item['password'])) {
                getLogin($item);
            } else {
                $GLOBALS['logpass_err'] = "Password dose not matched.";
            }
        }
    }
}

function getLogin($user) {
    if($GLOBALS['remember']=='checked'){
        unset($user['password']); 
        setcookie('logedUsre',json_encode($user, true),time()+(1*24*60*60),);
    }
    $_SESSION["user"] = $user;
    header("Location: ../index.php");
    exit;
}
