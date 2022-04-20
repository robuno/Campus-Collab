<?php
include "config.php";


if (isset($_POST['postowner'])) {
    $firstName    = $_POST['firstName'];
    $lastName      = $_POST['lastName'];
    $mail     = $_POST['mail'];
    $password2        = $_POST['password2'];


    if ($post_id == '') {
        $sql = "INSERT INTO `users`( `mail`, `password2`,`firstName`, `lastName`,) VALUES
        ('$mail','$password2','$firstName','$lastName')";
        $message = "Record created successfully.";
    }else{
        // write the update query
        // $sql = "UPDATE `posts` SET `mail`='$mail',`password2`='$password2',`date`='$date',`firstName`='$firstName',`lastName`='$lastName' WHERE `id`='$post_id'";
        $message = "Record upated successfully.";
    }
    // execute the query
    $result = $conn->query($sql);

    if ($result) {
        $response = array('status' => true, 'message' => $message);
    }else{
        $response = array('status' => false, 'message' => $conn->error);
    }

    echo json_encode($response);exit();
}


?>