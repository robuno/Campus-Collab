<?php 
include "config.php";
include "funcs.php";

$userid_2 = $_SESSION["userid"];
$mail_2 = $_SESSION["mail"];
$firstName_2 = $_SESSION["firstName"];
$lastName_2 = $_SESSION["lastName"];

// echo $_GET["post_id"];

if (isset($_GET['get_posts'])) {
    $sql = "SELECT * FROM posts ORDER BY id DESC";
    //execute the query
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        //output data of each row
        while ($row = $result->fetch_assoc()) {
            $post_owner_id = $row['postownerid'];
            $post_id = $row['id'];

    // echo  $firstName_2." ".$lastName_2 ==$row['postowner'] ;   
      
    ?>


    <div class="home-event-post">
        <div class="event-post-user">
            <div class="event-post-user-img ">
                <!-- <img src="img/gilfoyle.jpg"> -->
                <?php 
                    $userIDofPost= $row['postownerid'];
                    $sql2 = "SELECT * FROM users WHERE `id`=$userIDofPost";
                    $result2 = $conn->query($sql2);

                    if ($result2->num_rows > 0) {
                        //output data of each row
                        while ($row2 = $result2->fetch_assoc()) { 
                            $img_name_new = $row2["image_url"];

                            if ($img_name_new =="") {
                                echo "<img src='img/default.jpg'>";
                            } else {
                                // echo $row2["image_url"];
                                echo '<img src="uploads/'.$img_name_new.'">';

                            }
                            

                        }
                    }

                    ?>
                
            </div>
            <div class="event-post-user-text">
                <a href="profile.php?postownerid=<?php echo $post_owner_id; ?>"><?php 
                    $userIDofPost= $row['postownerid'];
                    $sql2 = "SELECT * FROM users WHERE `id`=$userIDofPost";
                    $result2 = $conn->query($sql2);

                    if ($result2->num_rows > 0) {
                        //output data of each row
                        while ($row2 = $result2->fetch_assoc()) { 
                            echo $row2["firstName"]." ".$row2["lastName"];

                        }
                    }

                    ?></a>
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
                            $studentClubId = $row['studentbranch'];
                            $sql2 = "SELECT * FROM studentclubs WHERE `id`=$studentClubId";
                            $result2 = $conn->query($sql2);
        
                            if ($result2->num_rows > 0) {
                                //output data of each row
                                while ($row2 = $result2->fetch_assoc()) {
                                    $courseName = $row2["clubname"];
                                    // echo "<p>$courseName</p>";

                                }
                            }
                            echo "$courseName";
                        }
                        
                        ?>
                    </p>

                </div>

            </div>

            <div class="row">
                <div class="col-md-6">
                    <?php 
                        $count_attend =0;
                        $sql5 = "SELECT * FROM attendings WHERE postid=$post_id";
                        //execute the query
                        $result4 = $conn->query($sql5);
                        
                        if ($result4->num_rows > 0) {
                            //output data of each row
                            while ($row3 = $result4->fetch_assoc()) {
                                $count_attend +=1;                       
                            }
                        }
                    ?>


                    <p class="event-tag-text" id="event-attendee-text"><i class="fa-solid fa-user-group"></i><?php echo $count_attend; ?> attendee</p>
                </div>
                <div class="col-md-6">
                    <p class="event-tag-text" id="event-attendee-text"><i class="fa-solid fa-crown"></i><?php echo $row['mentorinfo']; ?></p>
                </div>
            </div>

            
            <p class="event-tag-text" id="event-expectlist-text"><i class="fa-solid fa-hashtag"></i>Organizer wants to meet with <?php echo $row['maxparticipants']; ?> people.</p>
        </div>

        <div class="event-post-buttons">



            

            <button class="btn " onclick="attend_record(<?php echo $post_id; ?>)"><i class="fa-solid fa-plus"></i>Attend</button>
            <a href="#attendee-list-id"><button class="btn " onclick="myClickToSinglePostAttendeeList(<?php echo $post_id; ?>)"><i class="fa-solid fa-list"></i>Show Attendees</button></a>
            <a href="#singlePostComments"><button class="btn " type="submit"><i class="fa-solid fa-comments"></i>Comments</button></a>  
            <button class="btn " onclick="myClickToSinglePost(<?php echo $post_id; ?>)"><i class="fa-solid fa-share-nodes"></i>Share</button>  
           
            <script>
                function myClickToSinglePost($post_id) {
                    // alert($post_id);
                    document.location.href ="single_post.php?post_id="+$post_id;
                }

                function myClickToSinglePostAttendeeList($post_id) {
                    // alert($post_id);
                    document.location.href ="single_post.php?post_id="+$post_id+"#attendee-list-id";
                }

                function attend_record(id) {
                    // alert(id);
                    if(confirm("Are you sure? You want to attend this meeting?")){
                        $.ajax({
                            type : "GET",
                            url : "process2.php?attend_post_id="+id,
                            dataType : 'json',
                            beforeSend : function() {
                                toastr.info("Please wait..");
                                // toastr.warning("Your attendance is saved!");
                                // document.location.href ="single_post.php?post_id="+$post_id;
                                
                            },
                            success : function(response) {
                                console.log(response);
                                
                                if (response.status) { //if response status is true show success message
                                    toastr.warning(response.message);
                                    // get_all_users();
                                    
                                }else{
                                //  alert(response.message);
                                }
                            }
                        });
                    }else{
                    alert('ok');
                    }
                    
                }
            </script>

            <?php 

            $post_id_delete = $row['id'];;
            
            if ($userid_2 ==$row['postownerid']) {
                echo "<button class='btn bg-danger'  onclick='delete_record($post_id_delete)' ><i class='fa-solid fa-trash-can'></i>Delete</button>";
            }
            ?>
            <!-- <button class="btn bg-danger"  onclick="delete_record(<?php echo $row['id']; ?>)" ><i class="fa-solid fa-trash-can"></i>Delete</button> -->
            <button class="btn bg-info"  onclick="bookmark_record(<?php echo $post_id; ?>)" ><i class="fa-solid fa-bookmark"></i>Add Bookmarks</button>

            <script>
                function bookmark_record(id) {
                        // alert(id);
                        if(confirm("Are you sure? You want to your bookmarks this meeting?")){
                            $.ajax({
                                type : "GET",
                                url : "process2.php?bookmark_post_id="+id,
                                dataType : 'json',
                                beforeSend : function() {
                                    toastr.info("Please wait..");
                                },
                                success : function(response) {
                                    console.log(response);
                                    if (response.status) { //if response status is true show success message
                                        toastr.warning(response.message);
                                        get_all_users();
                                        
                                    }else{
                                    //  alert(response.message);
                                    }
                                }
                            });
                        }else{
                        alert('ok');
                        }   
                    }
            </script>
        </div>                   
    </div>
 
                
    <?php
        }
    }
}

if (isset($_GET['get_bookmarks'])) {
    $post_id_array = array();

    $sql2 = "SELECT * FROM bookmarks WHERE userid=$userid_2";
    //execute the query
    $result4 = $conn->query($sql2);

    if ($result4->num_rows > 0) {
        //output data of each row
        while ($row3 = $result4->fetch_assoc()) {
            $id = $row3["id"];
            $post_id = $row3["postid"];
            $userid = $row3["userid"];

            array_push($post_id_array, $post_id);

            // echo "--".$postid."--";
        }
        
    }

    echo '<div class="home-event-post"> 
    You have '.count($post_id_array).' meetings in your bookmarks.
    </div>';

    // print_r($post_id_array);



    for ($x = 0; $x < count($post_id_array); $x++) {

        // echo $post_id_array[$x];

        $sql = "SELECT * FROM posts WHERE `id`='$post_id_array[$x]' ";
        //execute the query
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            //output data of each row
            while ($row = $result->fetch_assoc()) {
                $post_owner_id = $row['postownerid'];
                $post_id = $row['id'];
                $post_date_old = $row['date'];
                $post_text = $row['posttext'];
                $mentorinfo = $row['mentorinfo'];
                $location = $row['location'];
                $posttype = $row['posttype'];
                $coursecode = $row['coursecode'];
                $studentbranch = $row['studentbranch'];
                $maxparticipants = $row['maxparticipants'];

        // echo  $firstName_2." ".$lastName_2 ==$row['postowner'] ;  

        
    }


     
      
    ?>


    <div class="home-event-post">
        
        <div class="event-post-user">
            <div class="event-post-user-img ">
                <!-- <img src="img/gilfoyle.jpg"> -->
                <?php 
                    $sql2 = "SELECT * FROM users WHERE `id`=$post_owner_id";
                    $result2 = $conn->query($sql2);

                    if ($result2->num_rows > 0) {
                        //output data of each row
                        while ($row2 = $result2->fetch_assoc()) { 
                            $img_name_new = $row2["image_url"];

                            if ($img_name_new =="") {
                                echo "<img src='img/default.jpg'>";
                            } else {
                                // echo $row2["image_url"];
                                echo '<img src="uploads/'.$img_name_new.'">';

                            }
                            

                        }
                    }

                    ?>
                
            </div>
            <div class="event-post-user-text">
                <a href="profile.php?postownerid=<?php echo $post_owner_id; ?>"><?php 
                    $sql2 = "SELECT * FROM users WHERE `id`=$post_owner_id";
                    $result2 = $conn->query($sql2);

                    if ($result2->num_rows > 0) {
                        //output data of each row
                        while ($row2 = $result2->fetch_assoc()) { 
                            echo $row2["firstName"]." ".$row2["lastName"];

                        }
                    }

                    ?></a>
                <p>
                    
                <?php 

                $postDate = strftime("%e %B %Y", strtotime($post_date_old));
                echo $postDate;
                
                ?></p>
            </div>

        </div>
        

        <div class="event-post-text">
            <p id="event-info"><?php echo $post_text; ?> </p>

            <div class="row">
            <div class="col-md-6">
                    <p class="event-tag-text" id="event-location-text"><i class="fa-solid fa-location-dot"></i><?php echo $location; ?></p>

                </div>

                <div class="col-md-6">
                    <p class="event-tag-text" id="event-location-text"><i class="fa-solid fa-circle-info"></i>
                        <?php if ($coursecode != "") {
                            echo $coursecode;
                        } else {
                            $sql2 = "SELECT * FROM studentclubs WHERE `id`=$studentbranch";
                            $result2 = $conn->query($sql2);
        
                            if ($result2->num_rows > 0) {
                                //output data of each row
                                while ($row2 = $result2->fetch_assoc()) {
                                    $courseName = $row2["clubname"];
                                    // echo "<p>$courseName</p>";

                                }
                            }
                            echo "$courseName";
                        }
                        
                        ?>
                    </p>

                </div>

            </div>

            <div class="row">
                <div class="col-md-6">
                    <?php 
                        $count_attend =0;
                        $sql5 = "SELECT * FROM attendings WHERE postid=$post_id";
                        //execute the query
                        $result4 = $conn->query($sql5);
                        
                        if ($result4->num_rows > 0) {
                            //output data of each row
                            while ($row3 = $result4->fetch_assoc()) {
                                $count_attend +=1;                       
                            }
                        }
                    ?>


                    <p class="event-tag-text" id="event-attendee-text"><i class="fa-solid fa-user-group"></i><?php echo $count_attend; ?> attendee</p>
                </div>
                <div class="col-md-6">
                    <p class="event-tag-text" id="event-attendee-text"><i class="fa-solid fa-crown"></i><?php echo $mentorinfo; ?></p>
                </div>
            </div>

            
            <p class="event-tag-text" id="event-expectlist-text"><i class="fa-solid fa-hashtag"></i>Organizer wants to meet with <?php echo $maxparticipants; ?> people.</p>
        </div>

        <div class="event-post-buttons">



            

            <button class="btn " onclick="attend_record(<?php echo $post_id; ?>)"><i class="fa-solid fa-plus"></i>Attend</button>
            <a href="#attendee-list-id"><button class="btn " onclick="myClickToSinglePostAttendeeList(<?php echo $post_id; ?>)"><i class="fa-solid fa-list"></i>Show Attendees</button></a>
            <a href="#singlePostComments"><button class="btn " type="submit"><i class="fa-solid fa-comments"></i>Comments</button></a>
            <button class="btn " onclick="myClickToSinglePost(<?php echo $post_id; ?>)"><i class="fa-solid fa-share-nodes"></i>Share</button>  
           
            <script>
                function myClickToSinglePost($post_id) {
                    // alert($post_id);
                    document.location.href ="single_post.php?post_id="+$post_id;
                }

                function myClickToSinglePostAttendeeList($post_id) {
                    // alert($post_id);
                    document.location.href ="single_post.php?post_id="+$post_id+"#attendee-list-id";
                }

                function attend_record(id) {
                    // alert(id);
                    if(confirm("Are you sure? You want to attend this meeting?")){
                        $.ajax({
                            type : "GET",
                            url : "process2.php?attend_post_id="+id,
                            dataType : 'json',
                            beforeSend : function() {
                                toastr.info("Please wait..");
                                // toastr.warning("Your attendance is saved!");
                                // document.location.href ="single_post.php?post_id="+$post_id;
                                
                            },
                            success : function(response) {
                                console.log(response);
                                
                                if (response.status) { //if response status is true show success message
                                    toastr.warning(response.message);
                                    // get_all_users();
                                    
                                }else{
                                //  alert(response.message);
                                }
                            }
                        });
                    }else{
                    alert('ok');
                    }
                    
                }
            </script>

            <?php 

            $post_id_delete = $post_id;
            
            if ($userid_2 ==$post_owner_id) {
                echo "<button class='btn bg-danger'  onclick='delete_record($post_id_delete)' ><i class='fa-solid fa-trash-can'></i>Delete</button>";
            }
            ?>
            <!-- <button class="btn bg-danger"  onclick="delete_record(<?php echo $post_id; ?>)" ><i class="fa-solid fa-trash-can"></i>Delete</button> -->
            <!-- <button class="btn bg-info"  onclick="delete_record(<?php echo $post_id; ?>)" ><i class="fa-solid fa-bookmark"></i>Add Bookmarks</button> -->
        </div>                   
    </div>
 
                
    <?php
        }
    }
}

if (isset($_GET['sPostID'])) {
    
    $sPostID=$_GET['sPostID'];
    echo "spostid: ".$sPostID;






    
    
    /*
    $sql = "SELECT * FROM posts where id='' ORDER BY id DESC";
    //execute the query
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        //output data of each row
        while ($row = $result->fetch_assoc()) {
            $post_owner_id = $row['postownerid'];
            $post_id = $row['id'];
            */



}

if (isset($_GET['post_id'])) {
    echo "xx: ".$post_id;
    $sql = "SELECT * FROM posts WHERE `id`=$post_id ";
    //execute the query
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        //output data of each row
        while ($row = $result->fetch_assoc()) {
            $post_owner_id = $row['postownerid'];
            $post_id = $row['id'];

    // echo  $firstName_2." ".$lastName_2 ==$row['postowner'] ;   
      
    ?>


    <div class="home-event-post">
        <div class="event-post-user">
            <div class="event-post-user-img ">
                <!-- <img src="img/gilfoyle.jpg"> -->
                <?php 
                    $userIDofPost= $row['postownerid'];
                    $sql2 = "SELECT * FROM users WHERE `id`=$userIDofPost";
                    $result2 = $conn->query($sql2);

                    if ($result2->num_rows > 0) {
                        //output data of each row
                        while ($row2 = $result2->fetch_assoc()) { 
                            $img_name_new = $row2["image_url"];

                            if ($img_name_new =="") {
                                echo "<img src='img/default.jpg'>";
                            } else {
                                // echo $row2["image_url"];
                                echo '<img src="uploads/'.$img_name_new.'">';

                            }
                            

                        }
                    }

                    ?>
                
            </div>
            <div class="event-post-user-text">
                <a href="profile.php?postownerid=<?php echo $post_owner_id; ?>"><?php echo $row['postowner']; ?></a>
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
                            $studentClubId = $row['studentbranch'];
                            $sql2 = "SELECT * FROM studentclubs WHERE `id`=$studentClubId";
                            $result2 = $conn->query($sql2);
        
                            if ($result2->num_rows > 0) {
                                //output data of each row
                                while ($row2 = $result2->fetch_assoc()) {
                                    $courseName = $row2["clubname"];
                                    // echo "<p>$courseName</p>";

                                }
                            }
                            echo "$courseName";
                        }
                        
                        ?>
                    </p>

                </div>

            </div>

            <div class="row">
                <div class="col-md-6">
                    <p class="event-tag-text" id="event-attendee-text"><i class="fa-solid fa-user-group"></i>5 attendee</p>
                </div>
                <div class="col-md-6">
                    <p class="event-tag-text" id="event-attendee-text"><i class="fa-solid fa-crown"></i><?php echo $row['mentorinfo']; ?></p>
                </div>
            </div>

            
            <p class="event-tag-text" id="event-expectlist-text"><i class="fa-solid fa-hashtag"></i>Organizer wants to meet with <?php echo $row['maxparticipants']; ?> people.</p>
        </div>

        <div class="event-post-buttons">


            

            <button class="btn " onclick="attend_record(<?php echo $post_id; ?>)"><i class="fa-solid fa-plus"></i>Attend</button>
            <a href="#attendee-list-id"><button class="btn " type="submit"><i class="fa-solid fa-list"></i>Show Attendees</button></a>
            <a href="#singlePostComments"><button class="btn " type="submit"><i class="fa-solid fa-comments"></i>Comments</button></a>  
            <button class="btn " onclick="myClickToSinglePost(<?php echo $post_id; ?>)"><i class="fa-solid fa-share-nodes"></i>Share</button>  

            

           
            <script>
                function myClickToSinglePost($post_id) {
                    // alert("asdfasd");
                    document.location.href ="single_post.php?id="+$post_id;
                }
            </script>

            <?php 

            $post_id_delete = $row['id'];;
            
            if ($userid_2 ==$row['postownerid']) {
                echo "<button class='btn bg-danger'  onclick='delete_record($post_id_delete)' ><i class='fa-solid fa-trash-can'></i>Delete</button>";
            }
            ?>
            <!-- <button class="btn bg-danger"  onclick="delete_record(<?php echo $row['id']; ?>)" ><i class="fa-solid fa-trash-can"></i>Delete</button> -->
            <button class="btn bg-info"  onclick="delete_record(<?php echo $row['id']; ?>)" ><i class="fa-solid fa-bookmark"></i>Add to Bookmarks</button>
        </div>                   
    </div>
 
                
    <?php
        }
    }
}
    
if (isset($_POST['postowner'])) {
    $postowner    = $_POST['postowner'];
    $postownerid  = $_POST['postownerid'];
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
        $sql = "INSERT INTO `posts`(`postowner`, `postownerid`,`posttext`, `date`, `mentorinfo`, `location`, `maxparticipants`,  `coursecode`, `studentbranch`) VALUES 
        ('$postowner','$postownerid','$posttext','$date','$mentorinfo','$location','$maxparticipants','$coursecode','$studentbranch')";
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
    $annownerid    = $_POST['annownerid'];
    $post_id      = $_POST['post_id'];
    $posttext     = $_POST['posttext'];
    $date        = $_POST['date'];


    if ($post_id == '') {
        $sql = "INSERT INTO `announcements` (`annowner`, `annownerid`,`posttext`, `date`) VALUES 
        ('$annowner','$annownerid','$posttext', '$date')";
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

if (isset($_GET['attend_post_id'])) {

	$post_id = $_GET['attend_post_id'];

    // echo "postid func: ".$post_id."user id2: ".$userid_2;

	// Execute the query

	$sql = "INSERT INTO `attendings` (`postid`, `userid`) VALUES 
        ('$post_id','$userid_2')";
        $message = "Record created successfully.";
    // execute the query
    $result = $conn->query($sql);

    if ($result) {
        
        $response = array('status' => true, 'message' => $message);
        
    }else{
        $response = array('status' => false, 'message' => $conn->error);
    }

    echo json_encode($response);exit();
}




if (isset($_GET['bookmark_post_id'])) {

	$post_id = $_GET['bookmark_post_id'];

    // echo "postid func: ".$post_id."user id2: ".$userid_2;

	// Execute the query

	$sql = "INSERT INTO `bookmarks` (`postid`, `userid`) VALUES 
        ('$post_id','$userid_2')";
        $message = "Record created successfully.";
    // execute the query
    $result = $conn->query($sql);

    if ($result) {
        
        $response = array('status' => true, 'message' => $message);
        
    }else{
        $response = array('status' => false, 'message' => $conn->error);
    }

    echo json_encode($response);exit();
}




if (isset($_GET['get_posts_study_groups'])) {

    echo '<div class="home-event-post" id="category-title"> 
                STUDY GROUPS
            </div>';

    $sql = "SELECT * FROM posts WHERE `coursecode`!='' ORDER BY id DESC";
    //execute the query
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        //output data of each row
        while ($row = $result->fetch_assoc()) {

            $post_owner_id = $row['postownerid'];
            $post_id = $row['id'];

    // echo  $firstName_2." ".$lastName_2 ==$row['postowner'] ;   
      
    ?>


    <div class="home-event-post">
        <div class="event-post-user">
            <div class="event-post-user-img ">
                <!-- <img src="img/gilfoyle.jpg"> -->
                <?php 
                    $userIDofPost= $row['postownerid'];
                    $sql2 = "SELECT * FROM users WHERE `id`=$userIDofPost";
                    $result2 = $conn->query($sql2);

                    if ($result2->num_rows > 0) {
                        //output data of each row
                        while ($row2 = $result2->fetch_assoc()) { 
                            $img_name_new = $row2["image_url"];

                            if ($img_name_new =="") {
                                echo "<img src='img/default.jpg'>";
                            } else {
                                // echo $row2["image_url"];
                                echo '<img src="uploads/'.$img_name_new.'">';

                            }
                            

                        }
                    }

                    ?>
                
            </div>
            <div class="event-post-user-text">
                <a href="profile.php?postownerid=<?php echo $post_owner_id; ?>"><?php 
                    $userIDofPost= $row['postownerid'];
                    $sql2 = "SELECT * FROM users WHERE `id`=$userIDofPost";
                    $result2 = $conn->query($sql2);

                    if ($result2->num_rows > 0) {
                        //output data of each row
                        while ($row2 = $result2->fetch_assoc()) { 
                            echo $row2["firstName"]." ".$row2["lastName"];

                        }
                    }

                    ?></a>
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
                            $studentClubId = $row['studentbranch'];
                            $sql2 = "SELECT * FROM studentclubs WHERE `id`=$studentClubId";
                            $result2 = $conn->query($sql2);
        
                            if ($result2->num_rows > 0) {
                                //output data of each row
                                while ($row2 = $result2->fetch_assoc()) {
                                    $courseName = $row2["clubname"];
                                    // echo "<p>$courseName</p>";

                                }
                            }
                            echo "$courseName";
                        }
                        
                        ?>
                    </p>

                </div>

            </div>

            <div class="row">
                <div class="col-md-6">
                    <?php 
                        $count_attend =0;
                        $sql5 = "SELECT * FROM attendings WHERE postid=$post_id";
                        //execute the query
                        $result4 = $conn->query($sql5);
                        
                        if ($result4->num_rows > 0) {
                            //output data of each row
                            while ($row3 = $result4->fetch_assoc()) {
                                $count_attend +=1;                       
                            }
                        }
                    ?>


                    <p class="event-tag-text" id="event-attendee-text"><i class="fa-solid fa-user-group"></i><?php echo $count_attend; ?> attendee</p>
                </div>
                <div class="col-md-6">
                    <p class="event-tag-text" id="event-attendee-text"><i class="fa-solid fa-crown"></i><?php echo $row['mentorinfo']; ?></p>
                </div>
            </div>

            
            <p class="event-tag-text" id="event-expectlist-text"><i class="fa-solid fa-hashtag"></i>Organizer wants to meet with <?php echo $row['maxparticipants']; ?> people.</p>
        </div>

        <div class="event-post-buttons">



            

            <button class="btn " onclick="attend_record(<?php echo $post_id; ?>)"><i class="fa-solid fa-plus"></i>Attend</button>
            <a href="#attendee-list-id"><button class="btn " onclick="myClickToSinglePostAttendeeList(<?php echo $post_id; ?>)"><i class="fa-solid fa-list"></i>Show Attendees</button></a>
            <a href="#singlePostComments"><button class="btn " type="submit"><i class="fa-solid fa-comments"></i>Comments</button></a>
            <button class="btn " onclick="myClickToSinglePost(<?php echo $post_id; ?>)"><i class="fa-solid fa-share-nodes"></i>Share</button>  
           
            <script>
                function myClickToSinglePost($post_id) {
                    // alert($post_id);
                    document.location.href ="single_post.php?post_id="+$post_id;
                }

                function myClickToSinglePostAttendeeList($post_id) {
                    // alert($post_id);
                    document.location.href ="single_post.php?post_id="+$post_id+"#attendee-list-id";
                }

                function attend_record(id) {
                    // alert(id);
                    if(confirm("Are you sure? You want to attend this meeting?")){
                        $.ajax({
                            type : "GET",
                            url : "process2.php?attend_post_id="+id,
                            dataType : 'json',
                            beforeSend : function() {
                                toastr.info("Please wait..");
                                // toastr.warning("Your attendance is saved!");
                                // document.location.href ="single_post.php?post_id="+$post_id;
                                
                            },
                            success : function(response) {
                                console.log(response);
                                
                                if (response.status) { //if response status is true show success message
                                    toastr.warning(response.message);
                                    // get_all_users();
                                    
                                }else{
                                //  alert(response.message);
                                }
                            }
                        });
                    }else{
                    alert('ok');
                    }
                    
                }
            </script>

            <?php 

            $post_id_delete = $row['id'];;
            
            if ($userid_2 ==$row['postownerid']) {
                echo "<button class='btn bg-danger'  onclick='delete_record($post_id_delete)' ><i class='fa-solid fa-trash-can'></i>Delete</button>";
            }
            ?>
            <!-- <button class="btn bg-danger"  onclick="delete_record(<?php echo $row['id']; ?>)" ><i class="fa-solid fa-trash-can"></i>Delete</button> -->
            <button class="btn bg-info"  onclick="bookmark_record(<?php echo $post_id; ?>)" ><i class="fa-solid fa-bookmark"></i>Add Bookmarks</button>

            <script>
                function bookmark_record(id) {
                        // alert(id);
                        if(confirm("Are you sure? You want to your bookmarks this meeting?")){
                            $.ajax({
                                type : "GET",
                                url : "process2.php?bookmark_post_id="+id,
                                dataType : 'json',
                                beforeSend : function() {
                                    toastr.info("Please wait..");
                                },
                                success : function(response) {
                                    console.log(response);
                                    if (response.status) { //if response status is true show success message
                                        toastr.warning(response.message);
                                        get_all_users();
                                        
                                    }else{
                                    //  alert(response.message);
                                    }
                                }
                            });
                        }else{
                        alert('ok');
                        }   
                    }
            </script>
        </div>                   
    </div>
 
                
    <?php
                }
            }
        }

    if (isset($_GET['get_posts_student_branch'])) {

            echo '<div class="home-event-post" id="category-title"> 
                STUDENT BRANCHES
            </div>';

    
            $sql = "SELECT * FROM posts WHERE `studentbranch`!=' ' ORDER BY id DESC";
            //execute the query
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                //output data of each row
                while ($row = $result->fetch_assoc()) {
                    $post_owner_id = $row['postownerid'];
                    $post_id = $row['id'];
    ?>



    <div class="home-event-post">
            <div class="event-post-user">
                <div class="event-post-user-img ">
                    <!-- <img src="img/gilfoyle.jpg"> -->
                    <?php 
                        $userIDofPost= $row['postownerid'];
                        $sql2 = "SELECT * FROM users WHERE `id`=$userIDofPost";
                        $result2 = $conn->query($sql2);

                        if ($result2->num_rows > 0) {
                            //output data of each row
                            while ($row2 = $result2->fetch_assoc()) { 
                                $img_name_new = $row2["image_url"];

                                if ($img_name_new =="") {
                                    echo "<img src='img/default.jpg'>";
                                } else {
                                    // echo $row2["image_url"];
                                    echo '<img src="uploads/'.$img_name_new.'">';

                                }
                                

                            }
                        }

                    ?>
                
            </div>
            <div class="event-post-user-text">
                <a href="profile.php?postownerid=<?php echo $post_owner_id; ?>"><?php 
                    $userIDofPost= $row['postownerid'];
                    $sql2 = "SELECT * FROM users WHERE `id`=$userIDofPost";
                    $result2 = $conn->query($sql2);

                    if ($result2->num_rows > 0) {
                        //output data of each row
                        while ($row2 = $result2->fetch_assoc()) { 
                            echo $row2["firstName"]." ".$row2["lastName"];

                        }
                    }

                    ?></a>
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
                            $studentClubId = $row['studentbranch'];
                            $sql2 = "SELECT * FROM studentclubs WHERE `id`=$studentClubId";
                            $result2 = $conn->query($sql2);
        
                            if ($result2->num_rows > 0) {
                                //output data of each row
                                while ($row2 = $result2->fetch_assoc()) {
                                    $courseName = $row2["clubname"];
                                    // echo "<p>$courseName</p>";

                                }
                            }
                            echo "$courseName";
                        }
                        
                        ?>
                    </p>

                </div>

            </div>

            <div class="row">
                <div class="col-md-6">
                    <?php 
                        $count_attend =0;
                        $sql5 = "SELECT * FROM attendings WHERE postid=$post_id";
                        //execute the query
                        $result4 = $conn->query($sql5);
                        
                        if ($result4->num_rows > 0) {
                            //output data of each row
                            while ($row3 = $result4->fetch_assoc()) {
                                $count_attend +=1;                       
                            }
                        }
                    ?>


                    <p class="event-tag-text" id="event-attendee-text"><i class="fa-solid fa-user-group"></i><?php echo $count_attend; ?> attendee</p>
                </div>
                <div class="col-md-6">
                    <p class="event-tag-text" id="event-attendee-text"><i class="fa-solid fa-crown"></i><?php echo $row['mentorinfo']; ?></p>
                </div>
            </div>

            
            <p class="event-tag-text" id="event-expectlist-text"><i class="fa-solid fa-hashtag"></i>Organizer wants to meet with <?php echo $row['maxparticipants']; ?> people.</p>
        </div>

        <div class="event-post-buttons">



            

            <button class="btn " onclick="attend_record(<?php echo $post_id; ?>)"><i class="fa-solid fa-plus"></i>Attend</button>
            <a href="#attendee-list-id"><button class="btn " onclick="myClickToSinglePostAttendeeList(<?php echo $post_id; ?>)"><i class="fa-solid fa-list"></i>Show Attendees</button></a>
            <a href="#singlePostComments"><button class="btn " type="submit"><i class="fa-solid fa-comments"></i>Comments</button></a>  
            <button class="btn " onclick="myClickToSinglePost(<?php echo $post_id; ?>)"><i class="fa-solid fa-share-nodes"></i>Share</button>  
           
            <script>
                function myClickToSinglePost($post_id) {
                    // alert($post_id);
                    document.location.href ="single_post.php?post_id="+$post_id;
                }

                function myClickToSinglePostAttendeeList($post_id) {
                    // alert($post_id);
                    document.location.href ="single_post.php?post_id="+$post_id+"#attendee-list-id";
                }

                function attend_record(id) {
                    // alert(id);
                    if(confirm("Are you sure? You want to attend this meeting?")){
                        $.ajax({
                            type : "GET",
                            url : "process2.php?attend_post_id="+id,
                            dataType : 'json',
                            beforeSend : function() {
                                toastr.info("Please wait..");
                                // toastr.warning("Your attendance is saved!");
                                // document.location.href ="single_post.php?post_id="+$post_id;
                                
                            },
                            success : function(response) {
                                console.log(response);
                                
                                if (response.status) { //if response status is true show success message
                                    toastr.warning(response.message);
                                    // get_all_users();
                                    
                                }else{
                                //  alert(response.message);
                                }
                            }
                        });
                    }else{
                    alert('ok');
                    }
                    
                }
            </script>

            <?php 

            $post_id_delete = $row['id'];;
            
            if ($userid_2 ==$row['postownerid']) {
                echo "<button class='btn bg-danger'  onclick='delete_record($post_id_delete)' ><i class='fa-solid fa-trash-can'></i>Delete</button>";
            }
            ?>
            <!-- <button class="btn bg-danger"  onclick="delete_record(<?php echo $row['id']; ?>)" ><i class="fa-solid fa-trash-can"></i>Delete</button> -->
            <button class="btn bg-info"  onclick="bookmark_record(<?php echo $post_id; ?>)" ><i class="fa-solid fa-bookmark"></i>Add Bookmarks</button>

            <script>
                function bookmark_record(id) {
                        // alert(id);
                        if(confirm("Are you sure? You want to your bookmarks this meeting?")){
                            $.ajax({
                                type : "GET",
                                url : "process2.php?bookmark_post_id="+id,
                                dataType : 'json',
                                beforeSend : function() {
                                    toastr.info("Please wait..");
                                },
                                success : function(response) {
                                    console.log(response);
                                    if (response.status) { //if response status is true show success message
                                        toastr.warning(response.message);
                                        get_all_users();
                                        
                                    }else{
                                    //  alert(response.message);
                                    }
                                }
                            });
                        }else{
                        alert('ok');
                        }   
                    }
            </script>
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
            $post_id = $row['id'];
            $ann_owner_id = $row['annownerid'];
    ?>


    <div class="home-event-post">
        <div class="event-post-user">
            <div class="event-post-user-img ">
            <?php 
                    $userIDofPost= $row['annownerid'];
                    $sql2 = "SELECT * FROM users WHERE `id`=$userIDofPost";
                    $result2 = $conn->query($sql2);

                    if ($result2->num_rows > 0) {
                        //output data of each row
                        while ($row2 = $result2->fetch_assoc()) { 
                            $img_name_new = $row2["image_url"];

                            if ($img_name_new =="") {
                                echo "You don't have a profile picture!";
                            } else {
                                // echo $row2["image_url"];
                                echo '<img src="uploads/'.$img_name_new.'">';

                            }
                            

                        }
                    }

                    ?>
                
            </div>
            <div class="event-post-user-text">
            <a href="profile.php?postownerid=<?php echo $ann_owner_id; ?>"><?php 
                    $userIDofPost= $row['annownerid'];
                    $sql2 = "SELECT * FROM users WHERE `id`=$ann_owner_id";
                    $result2 = $conn->query($sql2);

                    if ($result2->num_rows > 0) {
                        //output data of each row
                        while ($row2 = $result2->fetch_assoc()) { 
                            echo $row2["firstName"]." ".$row2["lastName"];

                        }
                    }

                    ?></a>
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

            <button class="btn " onclick="myClickToSingleAnnouncement(<?php echo $post_id; ?>)"><i class="fa-solid fa-share-nodes"></i>Share</button>  
           
            <script>
                function myClickToSingleAnnouncement($post_id) {
                    // alert($post_id);
                    document.location.href ="single_announcement.php?post_id="+$post_id;
                }
            </script>
            <?php 

            $post_id_delete = $row['id'];;
            
            if ($userid_2 ==$row['annownerid']) {

                echo " <button class='btn bg-danger'  onclick='delete_record($post_id_delete)' ><i class='fa-solid fa-trash-can'></i>Delete</button>";
            }
            ?>
           
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

// edit profile
if (isset($_POST['firstName'])) {
    $id_user    = $_POST['id_user'];
    $firstName    = $_POST['firstName'];
    $lastName  = $_POST['lastName'];
    $department      = $_POST['department'];
    $mail     = $_POST['mail'];
    $password2        = $_POST['password2'];
    $passwordNew        = $_POST['passwordNew'];
    $bio          = $_POST['bio'];
    $githubLink       = $_POST['githubLink'];
    $instaLink       = $_POST['instaLink'];
    $linkedinLink       = $_POST['linkedinLink'];
    $twitterLink       = $_POST['twitterLink'];
    $spotifyLink       = $_POST['spotifyLink'];
    $personalWeb       = $_POST['personalWeb'];

    if ($passwordNew !='') {
        $password2 = md5($passwordNew);
    }
    
        // write the update query
    $sql = "UPDATE `users` SET 
    `firstName`='$firstName',`lastName`='$lastName',
    `department`='$department',`mail`='$mail',
    `password2`='$password2',`bio`='$bio' ,
    `githubLink`='$githubLink',`instaLink`='$instaLink',
    `twitterLink`='$twitterLink',`spotifyLink`='$spotifyLink' ,
    `personalWeb`='$personalWeb',`linkedinLink`='$linkedinLink'
    
    WHERE `id`='$id_user'";
    $message = "Record upated successfully.";
    
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