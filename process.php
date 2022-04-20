<?php 
include "config.php";


if (isset($_GET['get_posts'])) {
    $sql = "SELECT * FROM posts ";
    //execute the query
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        //output data of each row
        while ($row = $result->fetch_assoc()) {
    ?>

    <tr>
        <td><?php echo $row['id']; ?></td>
        <td><?php echo $row['postowner']; ?></td>
        <td><?php echo $row['posttext']; ?></td>
        <td><?php echo $row['date']; ?></td>
        <td><?php echo $row['mentorinfo']; ?></td>
        <td><?php echo $row['location']; ?></td>
        <td><?php echo $row['maxparticipants']; ?></td>
        <td><button class="btn btn-info" onclick="edit_record(<?php echo $row['id']; ?>)" >Edit</button>&nbsp;<button class="btn btn-danger"  onclick="delete_record(<?php echo $row['id']; ?>)" >Delete</button></td>
    </tr>   
                
    <?php
        }
    }
}
    
if (isset($_POST['postowner'])) {
    $postowner    = $_POST['postowner'];
    $post_id      = $_POST['post_id'];
    $posttext     = $_POST['posttext'];
    $date        = $_POST['date'];
    $mentorinfo          = $_POST['mentorinfo'];
    $location       = $_POST['location'];
    $maxparticipants       = $_POST['maxparticipants'];
    if ($post_id == '') {
        $sql = "INSERT INTO `posts`(`postowner`, `posttext`, `date`, `mentorinfo`, `location`, `maxparticipants`) VALUES ('$postowner','$posttext','$date','$mentorinfo','$location','$maxparticipants')";
        $message = "Record created successfully.";
    }else{
        // write the update query
        $sql = "UPDATE `posts` SET `postowner`='$postowner',`posttext`='$posttext',`date`='$date',`mentorinfo`='$mentorinfo',`location`='$location',`maxparticipants`='$maxparticipants' WHERE `id`='$post_id'";
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

if (isset($_GET['delete_id'])) {
	$post_id = $_GET['delete_id'];

	// write delete query
	$sql = "DELETE FROM `posts` WHERE `id`='$post_id'";

	// Execute the query

	$result = $conn->query($sql);

	if ($result) {
        $result = array('status' => true, 'message' => 'Record deleted successfully.');
	}else{
        $result = array('status' => true, 'message' => $conn->error);
	}

    echo json_encode($result);exit();
}

if (isset($_GET['edit_id'])) {
	$post_id = $_GET['edit_id'];

	// write SQL to get post data
	$sql = "SELECT * FROM `posts` WHERE `id`='$post_id'";

	//Execute the sql
	$result = $conn->query($sql);

	if ($result->num_rows > 0) {
		$row = $result->fetch_assoc();
		$response = array('status' => true, 'data' => $row);
	}else{
		$response = array('status' => false, 'data' => $conn->error);
	}
	echo json_encode($response);exit();
} 

?>