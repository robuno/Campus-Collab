<?php


$hata='';
$userid=0;
$action='';
$actionRegister='';
if (isset($_POST["action"])) {  $action = $_POST["action"]; } 
if (isset($_GET["action"])) {  $action = $_GET["action"]; } 

if (isset($_POST["mail"])) {  $mail = $_POST["mail"]; } else {$mail = ''; }
if (isset($_POST["password2"])) {$password2 = $_POST["password2"];} else {$password2 = ''; }

if (isset($_POST["firstName"])) {  $firstName    = $_POST['firstName']; } else {$firstName = ''; }
if (isset($_POST["lastName"])) {$lastName    = $_POST['lastName'];} else {$lastName = ''; }
if (isset($_POST["department"])) {  $department    = $_POST['department']; } else {$department = ''; }





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