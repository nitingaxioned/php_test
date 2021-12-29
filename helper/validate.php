<?php

require 'query.php';

class Validate extends Query
{

  public function phoneValidate($phone,&$errStr)
  {
    $flag = true;
    if (trim($phone) != "") {
      if (strlen($phone) == 10) {
        if (!preg_match("/^[6789]\d{9}$/", $_POST['phone'])) {
          $errStr = "The phone number format is invalid.";
          $flag = false;
        }
      } else {
        $errStr = "The phone number must be 10 digit.";
        $flag = false;
      }
    } else {
      $errStr = "The phone number is required.";
      $flag = false;
    }
    return $flag;
  }

  public function emailValidate($email, &$errStr)
  {
    $flag = true;
    if (trim($email) != "") {
      if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errStr = "This email is invalid.";
        $flag = false;
      }
    } else {
      $errStr = "The email is required.";
      $flag = false;
    }
    return $flag;
  }

  public function nameValidate($str, &$errStr)
  {
    $flag = true;
    if (trim($str) != "") {
      if (!preg_match("/^[A-Za-z ]+$/",$str)) {
        $errStr = "This is an invalid input.";
        $flag = false;
      }
    } else {
      $errStr = "This field is required.";
      $flag = false;
    }
    return $flag;
  }

  public function passwordValidate($str, &$errStr)
  {
    $flag = true;
    $uppercase = preg_match('@[A-Z]@', $str);
    $lowercase = preg_match('@[a-z]@', $str);
    $number    = preg_match('@[0-9]@', $str);
    $specialChars = preg_match('@[^\w]@', $str);
    if (trim($str) != "") {
      if (strlen($str)<=16 && strlen($str)>=8) {
        if (!$uppercase || !$lowercase || !$number || !$specialChars) {
          $errStr = "Password must include at least a upper & lower case, a number & a special character.";
          $flag = false;
        }
      } else {
        $errStr = "Password must be 8 to 16 characters only.";
        $flag = false;
      }
    } else {
      $errStr = "This field is required.";
      $flag = false;
    }
    return $flag;
  }

  public function confPassValidate($str1, $str2, &$errStr)
  { 
    $flag = true;
    if ($str1 != $str2) {
      $flag = true;
      $errStr = "Password dose not matched.";
    } 
    return $flag;
  }

  public function checkRegisteredMail($mail)
  {
    $flag = false;
    $objx = new Query();
    $resultx = $objx->getData('users');
    foreach ($resultx as $item) {
      if ( $item['email'] == $mail) {
        $flag = true;
      }
    }
    return $flag;
  }
}