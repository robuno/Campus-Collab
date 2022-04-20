<?php 
include "config.php";


if (isset($_GET['get_posts'])) {
    $sql = "SELECT * FROM posts ORDER BY id DESC";
    //execute the query
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        //output data of each row
        while ($row = $result->fetch_assoc()) {
    ?>


    <div class="home-event-post">
        <div class="event-post-user">
            <div class="event-post-user-img ">
                <img src="img/gilfoyle.jpg">
                
            </div>
            <div class="event-post-user-text">
                <a href="#"><?php echo $row['postowner']; ?></a>
                <p><?php 

                $postDate = strftime("%e %B %Y", strtotime($row['date']));
                echo $postDate;
                
                ?></p>
            </div>

        </div>
        

        <div class="event-post-text">
            <p id="event-info"><?php echo $row['posttext']; ?> </p>


            <div class="row">
            <div class="col-md-6">
                    <p class="event-tag-text" id="event-location-text"><i class="fa-solid fa-location-dot"></i><?php echo $row['location']; ?></p>

                </div>

                <div class="col-md-6">
                    <p class="event-tag-text" id="event-location-text"><i class="fa-solid fa-circle-info"></i>
                        <?php if ($row['coursecode'] != "") {
                            echo $row['coursecode'];
                        } else {
                            echo "Independent meeting";
                        }
                        
                        ?>
                    </p>

                </div>

            </div>

            <p class="event-tag-text" id="event-attendee-text"><i class="fa-solid fa-user-group"></i>5 attendee</p>
            <p class="event-tag-text" id="event-mentor-text"><i class="fa-solid fa-crown"></i><?php echo $row['mentorinfo']; ?></p>
            <p class="event-tag-text" id="event-expectlist-text"><i class="fa-solid fa-hashtag"></i>Organizer wants to study/meet with <?php echo $row['maxparticipants']; ?> people.</p>
        </div>

        <div class="event-post-buttons">
            <button class="btn " type="submit"><i class="fa-solid fa-plus"></i>Attend</button>
            <button class="btn " type="submit"><i class="fa-solid fa-list"></i>Show Attendees</button>
            <button class="btn " type="submit"><i class="fa-solid fa-comments"></i>Comments</button>  
            <button class="btn " type="submit"><i class="fa-solid fa-share-nodes"></i>Share</button>  
            <button class="btn bg-danger"  onclick="delete_record(<?php echo $row['id']; ?>)" ><i class="fa-solid fa-trash-can"></i>Delete</button>
            <button class="btn bg-info"  onclick="delete_record(<?php echo $row['id']; ?>)" ><i class="fa-solid fa-bookmark"></i>Add to Bookmarks</button>
        </div>                   
    </div>
 
                
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
    // $posttype       = $_POST['posttype'];
    $coursecode       = $_POST['coursecode'];
    $studentbranch       = $_POST['studentbranch'];

    if ($post_id == '') {
        $sql = "INSERT INTO `posts`(`postowner`, `posttext`, `date`, `mentorinfo`, `location`, `maxparticipants`,  `coursecode`, `studentbranch`) VALUES 
        ('$postowner','$posttext','$date','$mentorinfo','$location','$maxparticipants','$coursecode','$studentbranch')";
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

if (isset($_POST['annowner'])) {
    $annowner    = $_POST['annowner'];
    $post_id      = $_POST['post_id'];
    $posttext     = $_POST['posttext'];
    $date        = $_POST['date'];


    if ($post_id == '') {
        $sql = "INSERT INTO `announcements` (`annowner`, `posttext`, `date`) VALUES 
        ('$annowner','$posttext', '$date')";
        $message = "Record created successfully.";
    }else{
        // write the update query
        $sql = "UPDATE `announcements` SET `postowner`='$postowner',`annowner`='$posttext',`date`='$date',`mentorinfo`='$mentorinfo',`location`='$location',`maxparticipants`='$maxparticipants' WHERE `id`='$post_id'";
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

if (isset($_GET['get_posts_study_groups'])) {
    $sql = "SELECT * FROM posts WHERE `coursecode`!='' ORDER BY id DESC";
    //execute the query
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        //output data of each row
        while ($row = $result->fetch_assoc()) {
    ?>


    <div class="home-event-post">
        <div class="event-post-user">
            <div class="event-post-user-img ">
                <img src="img/gilfoyle.jpg">
                
            </div>
            <div class="event-post-user-text">
                <a href="#"><?php echo $row['postowner']; ?></a>
                <p><?php 

                $postDate = strftime("%e %B %Y", strtotime($row['date']));
                echo $postDate;
                
                ?></p>
            </div>

        </div>
        

        <div class="event-post-text">
            <p id="event-info"><?php echo $row['posttext']; ?> </p>

            <div class="row">
            <div class="col-md-6">
                    <p class="event-tag-text" id="event-location-text"><i class="fa-solid fa-location-dot"></i><?php echo $row['location']; ?></p>

                </div>

                <div class="col-md-6">
                    <p class="event-tag-text" id="event-location-text"><i class="fa-solid fa-circle-info"></i>
                        <?php if ($row['coursecode'] != "") {
                            echo $row['coursecode'];
                        } else {
                            echo "This is an independent meeting";
                        }
                        
                        ?>
                    </p>

                </div>

            </div>
            <p class="event-tag-text" id="event-attendee-text"><i class="fa-solid fa-user-group"></i>5 attendee</p>
            <p class="event-tag-text" id="event-mentor-text"><i class="fa-solid fa-crown"></i><?php echo $row['mentorinfo']; ?></p>
            <p class="event-tag-text" id="event-expectlist-text"><i class="fa-solid fa-hashtag"></i>Organizer wants to study/meet with <?php echo $row['maxparticipants']; ?> people.</p>
        </div>

        <div class="event-post-buttons">
            <button class="btn " type="submit"><i class="fa-solid fa-plus"></i>Attend</button>
            <button class="btn " type="submit"><i class="fa-solid fa-list"></i>Show Attendees</button>
            <button class="btn " type="submit"><i class="fa-solid fa-comments"></i>Comments</button>  
            <button class="btn " type="submit"><i class="fa-solid fa-share-nodes"></i>Share</button>  
            <button class="btn bg-danger"  onclick="delete_record(<?php echo $row['id']; ?>)" ><i class="fa-solid fa-trash-can"></i>Delete</button>
            <button class="btn bg-info"  onclick="delete_record(<?php echo $row['id']; ?>)" ><i class="fa-solid fa-bookmark"></i>Add to Bookmarks</button>
        </div>                   
    </div>
 
                
    <?php
                }
            }
        }

        if (isset($_GET['get_posts_student_branch'])) {
            $sql = "SELECT * FROM posts WHERE `studentbranch`!='1' ORDER BY id DESC";
            //execute the query
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                //output data of each row
                while ($row = $result->fetch_assoc()) {
    ?>


    <div class="home-event-post">
        <div class="event-post-user">
            <div class="event-post-user-img ">
                <img src="img/gilfoyle.jpg">
                
            </div>
            <div class="event-post-user-text">
                <a href="#"><?php echo $row['postowner']; ?></a>
                <p><?php 

                $postDate = strftime("%e %B %Y", strtotime($row['date']));
                echo $postDate;
                
                ?></p>
            </div>

        </div>
        

        <div class="event-post-text">
            <p id="event-info"><?php echo $row['posttext']; ?> </p>

            <div class="row">
            <div class="col-md-6">
                    <p class="event-tag-text" id="event-location-text"><i class="fa-solid fa-location-dot"></i><?php echo $row['location']; ?></p>
                </div>

                <div class="col-md-6">
                    <p class="event-tag-text" id="event-location-text"><i class="fa-solid fa-circle-info"></i>
                        <?php if ($row['coursecode'] != "") {
                            echo $row['coursecode'];
                        } else {
                            echo "This is an independent meeting";
                        }
                        ?>
                    </p>
                </div>

            </div>
            <p class="event-tag-text" id="event-attendee-text"><i class="fa-solid fa-user-group"></i>5 attendee</p>
            <p class="event-tag-text" id="event-mentor-text"><i class="fa-solid fa-crown"></i><?php echo $row['mentorinfo']; ?></p>
            <p class="event-tag-text" id="event-expectlist-text"><i class="fa-solid fa-hashtag"></i>Organizer wants to study/meet with <?php echo $row['maxparticipants']; ?> people.</p>
        </div>

        <div class="event-post-buttons">
            <button class="btn " type="submit"><i class="fa-solid fa-plus"></i>Attend</button>
            <button class="btn " type="submit"><i class="fa-solid fa-list"></i>Show Attendees</button>
            <button class="btn " type="submit"><i class="fa-solid fa-comments"></i>Comments</button>  
            <button class="btn " type="submit"><i class="fa-solid fa-share-nodes"></i>Share</button>  
            <button class="btn bg-danger"  onclick="delete_record(<?php echo $row['id']; ?>)" ><i class="fa-solid fa-trash-can"></i>Delete</button>
            <button class="btn bg-info"  onclick="delete_record(<?php echo $row['id']; ?>)" ><i class="fa-solid fa-bookmark"></i>Add to Bookmarks</button>
        </div>                   
    </div>
 
                
    <?php
        }
    }
}

if (isset($_GET['get_posts_announcements'])) {
    $sql = "SELECT * FROM announcements ORDER BY id DESC";
    //execute the query
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        //output data of each row
        while ($row = $result->fetch_assoc()) {
    ?>


    <div class="home-event-post">
        <div class="event-post-user">
            <div class="event-post-user-img ">
                <img src="img/gilfoyle.jpg">
                
            </div>
            <div class="event-post-user-text">
                <a href="#"><?php echo $row['annowner']; ?></a>
                <p><?php 

                $postDate = strftime("%e %B %Y", strtotime($row['date']));
                echo $postDate;
                
                ?></p>
            </div>

        </div>
        

        <div class="event-post-text">
            <p id="event-info"><?php echo $row['posttext']; ?> </p>
        </div>

        <div class="event-post-buttons">
            <button class="btn " type="submit"><i class="fa-solid fa-share-nodes"></i>Share</button>  
            <button class="btn bg-danger"  onclick="delete_record(<?php echo $row['id']; ?>)" ><i class="fa-solid fa-trash-can"></i>Delete</button>
        </div>                   
    </div>
 
                
    <?php
        }
    }
}


if (isset($_GET['delete_announc_id'])) {
	$post_id = $_GET['delete_announc_id'];

	// write delete query
	$sql = "DELETE FROM `announcements` WHERE `id`='$post_id'";

	// Execute the query

	$result = $conn->query($sql);

	if ($result) {
        $result = array('status' => true, 'message' => 'Record deleted successfully.');
	}else{
        $result = array('status' => true, 'message' => $conn->error);
	}

    echo json_encode($result);exit();
}


?>