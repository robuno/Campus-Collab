<?php


$hata='';
$userid=0;
$action='';
if (isset($_POST["action"])) {  $action = $_POST["action"]; } 
if (isset($_GET["action"])) {  $action = $_GET["action"]; } 
if (isset($_POST["mail"])) {  $mail = $_POST["mail"]; } else {$mail = ''; }
if (isset($_POST["password2"])) {$password2 = $_POST["password2"];} else {$password2 = ''; }


if ($action == 'exit') {
  echo 'Exit!';
  unset($_SESSION["mail"]);
  unset($_SESSION["userid"]);
  unset($_SESSION["firstName"]);
  unset($_SESSION["lastName"]);
  session_destroy();
  header('Location: login.php'); 
  exit;
}




?>