<?php

$action='';
if (isset($_POST["action"])) {  $action = $_POST["action"]; } 
if (isset($_GET["action"])) {  $action = $_GET["action"]; } 

if (isset($_POST["postid"])) {  $postid    = $_POST['postid']; } else {$postid = ''; }
if (isset($_POST["commentownerid"])) {  $commentownerid    = $_POST['commentownerid']; } else {$commentownerid = ''; }
if (isset($_POST["commenttext"])) {$commenttext    = $_POST['commenttext'];} else {$commenttext = ''; }





?>