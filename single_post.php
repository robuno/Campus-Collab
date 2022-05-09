<?php 
include "config.php";
include "funcs.php";
include "funcs_comment.php";

//write the query to get data from users table

if (isset($_GET["post_id"])) {  $post_id = $_GET["post_id"]; }

// echo "php first: ".$post_id;

$sql = "SELECT * FROM posts WHERE id=$post_id";
//execute the query
$result3 = $conn->query($sql);

if ($result3->num_rows > 0) {
    //output data of each row
    while ($row2 = $result3->fetch_assoc()) {
        $id = $row2["id"];
        $postowner = $row2["postowner"];
        $postownerid = $row2["postownerid"];
        $posttext = $row2["posttext"];
        $date = $row2["date"];
        $mentorinfo = $row2["mentorinfo"];
        $location = $row2["location"];
        $maxparticipants = $row2["maxparticipants"];
        $posttype = $row2["posttype"];
        $coursecode = $row2["coursecode"];
        $studentbranch = $row2["studentbranch"];
        // echo "<p>$courseName</p>";

    }
}



$userid_2 = $_SESSION["userid"];
$mail_2 = $_SESSION["mail"];
$firstName_2 = $_SESSION["firstName"];
$lastName_2 = $_SESSION["lastName"];


// echo $userid_2,$mail_2;






$count_attend =0;
$sql5 = "SELECT * FROM attendings WHERE postid=$post_id";
//execute the query
$result4 = $conn->query($sql5);

if ($result4->num_rows > 0) {
    //output data of each row
    while ($row3 = $result4->fetch_assoc()) {
        $count_attend +=1;
        $id = $row3["id"];
        $userid = $row3["userid"];

        // echo $userid;
        // echo "\n";
           
    }
}




// $sql6 = "SELECT * FROM comments WHERE postid=$post_id";
// //execute the query
// $result5 = $conn->query($sql6);

// if ($result5->num_rows > 0) {
//     //output data of each row
//     while ($row5 = $result5->fetch_assoc()) {
//         $id = $row5["id"];
//         $postid = $row5["postid"];
//         $commentownerid = $row5["commentownerid"];
//         $commenttext = $row5["commenttext"];
//         // echo "<p>$courseName</p>";

//         // echo $id." ";
//         // echo $commenttext." ";
//     }
// }


?>

<!DOCTYPE html>
<html>


<head>
<title>Meeting</title>
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate"/>
    <meta http-equiv="Pragma" content="no-cache"/>
    <meta http-equiv="Expires" content="0"/>
    
    <link rel="stylesheet" href="css/style.css">  
    <!-- to make it looking good im using bootstrap -->
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" integrity="undefined" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <script src="https://kit.fontawesome.com/893ed9f89c.js" crossorigin="anonymous"></script>

<!--     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->
	
</head>

<header>
    <div class="container" id="headerTopContainer">
        <div class="row">
            <div class="col-md-12" id="header-logo">
                
                <img src="img/logowtext.png">
                
            </div>
            <!-- <div class="col-md-4" id="header-search-col">
                <button class="btn" type="submit"><i class="fa-solid fa-circle-plus" data-toggle="modal" data-target="#userformModal"></i>New Meeting</button>

                <div class="input-group" id="header-search-input">
                    <!-- <input type="text" class="form-control" placeholder="Search" aria-label="Search word" aria-describedby="basic-addon2"> -->
                    <!-- <div class="input-group-append"> -->
                      <!-- <button class="btn" type="button">Search</button> -->
                    <!-- </div> -->
                    
                </div>
            </div>
        </div> -->
    </div>

</header>


<body>
    <div class="container">
        <div class="row">
            <!-- <div class="row">
                <div class="col-md-8">
                <button type="button" class="btn float-right " data-toggle="modal" data-target="#userformModal" id="buttonCreateMeeting"><i class="fa-solid fa-circle-plus"></i>New Meeting</button>  
                </div>
                
                <div class="col-md-4">
                <div class="buttonCreateMeeting">Welcome, <?php echo $firstName_2." ".$lastName_2; ?></div>  
                </div>
               

            </div> -->

            
            <div class="col-md-8 " id="col-events">





                <div class="home-event-post">
                    <div class="event-post-user">
                        <div class="event-post-user-img ">
                            <!-- <img src="img/gilfoyle.jpg"> -->
                            <?php 
                                $sql2 = "SELECT * FROM users WHERE `id`=$postownerid";
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
                            <a href="profile.php?postownerid=<?php echo $postownerid; ?>"><?php 
                                $sql2 = "SELECT * FROM users WHERE `id`=$postownerid";
                                $result2 = $conn->query($sql2);

                                if ($result2->num_rows > 0) {
                                    //output data of each row
                                    while ($row2 = $result2->fetch_assoc()) { 
                                        echo $row2["firstName"]." ".$row2["lastName"];

                                    }
                                }

                                ?></a>
                            <p><?php 

                            $postDate = strftime("%e %B %Y", strtotime($date ));
                            echo $postDate;
                            
                            ?></p>
                        </div>

                    </div>
                    

                    <div class="event-post-text">


                        <p id="event-info"><?php echo $posttext; ?> </p>


                        <div class="row">
                        <div class="col-md-6">
                                <p class="event-tag-text" id="event-location-text"><i class="fa-solid fa-location-dot"></i><?php echo $location; ?></p>

                            </div>

                            <div class="col-md-6">
                                <p class="event-tag-text" id="event-location-text"><i class="fa-solid fa-circle-info"></i>
                                    <?php if ($coursecode != "") {
                                        echo $coursecode;
                                    } else {
                                        $studentClubId = $studentbranch;
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
                        <a href="#attendee-list-id"><button class="btn " type="submit"><i class="fa-solid fa-list"></i>Show Attendees</button></a>
                        <a href="#singlePostComments"><button class="btn " type="submit"><i class="fa-solid fa-comments"></i>Comments</button></a>
                        <button class="btn " onclick="myClickToSinglePost(<?php echo $post_id; ?>)"><i class="fa-solid fa-share-nodes"></i>Share</button>   
                        

                        <script>
                            function myClickToSinglePost($post_id) {
                                alert($post_id);
                                document.location.href ="single_post.php?post_id="+$post_id;
                            }
                        </script>

                        <?php 

                        $post_id_delete = $post_id;
                        
                        if ($userid_2 ==$postownerid) {
                            echo "<button class='btn bg-danger'  onclick='delete_record($post_id_delete)' ><i class='fa-solid fa-trash-can'></i>Delete</button>";
                        }
                        ?>
                        <!-- <button class="btn bg-danger"  onclick="delete_record(<?php echo $post_id; ?>)" ><i class="fa-solid fa-trash-can"></i>Delete</button> -->
                        <button class="btn bg-info"  onclick="bookmark_record(<?php echo $post_id; ?>)" ><i class="fa-solid fa-bookmark"></i>Add Bookmarks</button>
                    </div>                   
                </div>

                <div class="home-event-post">
                <div class="attendee-list" id="attendee-list-id">
                    <h3>Attendee List</h3>
                    <p><?php echo $count_attend; ?> people are attending this meeting.</p>
                <ul>
                <div class="row">
    
                    <?php 
                    $count_attend =0;
                    $sql = "SELECT * FROM attendings WHERE postid=$post_id";
                    //execute the query
                    $result3 = $conn->query($sql);               
                    
                    if ($result3->num_rows > 0) {
                        //output data of each row
                        while ($row2 = $result3->fetch_assoc()) {
                            $count_attend +=1;
                            $id = $row2["id"];
                            $userid = $row2["userid"];

                            // echo $userid;
                            // echo "\n";          

                            $sql2 = "SELECT * FROM users WHERE id=$userid";
                            //execute the query
                            $result4 = $conn->query($sql2);
                            if ($result4->num_rows > 0) {
                                //output data of each row
                                while ($row3 = $result4->fetch_assoc()) {
                                    $user_id2 = $row3["id"];
                                    $firstName = $row3["firstName"];
                                    $lastName = $row3["lastName"];
                                    $imgurl = $row3["image_url"];


                                    echo '
                                        
                                        <div class="col-md-4">
                                        <li>
                                        <a href="profile.php?postownerid='.$user_id2.'">'.$firstName.' '.$lastName.'</a>
                                        </li>   
                                        </div>
                                    
                                    
                                    ';

                                    
                                }
                            }     
                        }
                    }
                    ?>       
                    </div>
                    </ul>

                                    </div>

                </div> 

                

                <div class="home-event-post" id="singlePostComments">
                    <h3>Comments</h3>

                    <?php 
                
                
                    if ($commenttext!='' and $action=='insert') // register

                    {
                        // print_r($_POST);
                        $sql = "INSERT INTO comments (postid, commentownerid, commenttext)
                        VALUES ('$postid', '$commentownerid', '$commenttext')";
                        
                        if (mysqli_query($conn, $sql)) {
                            
                            echo '<div class="warning-input"><i class="fa-solid fa-circle-info"></i>New comment is published successfully!</div>';
                        } else {
                        echo " Error: " . $sql . "<br>" . mysqli_error($conn);
                        }
                        
                        
                    
                    } else if ( $commenttext=='' and  $action=='insert' ) {
                        echo '<div class="warning-input"><i class="fa-solid fa-circle-info"></i>Please fill the comment text form!</div>';
                    }
                    
                    ?>

                    <form action="single_post.php?post_id=<?php echo $post_id; ?>" method="POST">
                        <input type="hidden" name="action" value="insert">

                            <div class="form-group">
                            <!-- <label>Comment Owner</label> -->
                            <input type="hidden" name="commentownerid" class="form-control" value="<?php echo $userid_2; ?>">
                            </div>

                            <div class="form-group">
                            <!-- <label>Post ID </label> -->
                            <input type="hidden" name="postid" class="form-control" value="<?php echo $post_id; ?>">
                            </div>

                            <div class="form-group">
                            <label>Comment Text</label>
                            <input type="text" name="commenttext" class="form-control" value="">
                            </div>

                        <div class="form-group">
                            <button type="submit" class="btn">Send</button>
                        </div>
                    </form>


                    <?php 


                    $sql6 = "SELECT * FROM comments WHERE postid=$post_id";
                    //execute the query
                    $result5 = $conn->query($sql6);

                    if ($result5->num_rows > 0) {
                        //output data of each row
                        while ($row5 = $result5->fetch_assoc()) {
                            $id = $row5["id"];
                            $postid = $row5["postid"];
                            $commentownerid = $row5["commentownerid"];
                            $commenttext = $row5["commenttext"];
                            // echo "<p>$courseName</p>";

                            // echo $id." ";
                            // echo $commenttext." ";

                            echo '<div class="single-comment">';
                            echo '<div class="event-post-user">';
                                echo '<div class="event-post-user-img ">';

                                $sql2 = "SELECT * FROM users WHERE `id`=$commentownerid";
                                $result2 = $conn->query($sql2);
                                if ($result2->num_rows > 0) {
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

                                echo '</div>';
                                echo '<div class="event-post-user-text">
                                    <a href="profile.php?postownerid='.$commentownerid.'">';
                                
                                        $sql2 = "SELECT * FROM users WHERE `id`=$commentownerid";
                                        $result2 = $conn->query($sql2);

                                        if ($result2->num_rows > 0) {
                                            //output data of each row
                                            while ($row2 = $result2->fetch_assoc()) { 
                                                echo $row2["firstName"]." ".$row2["lastName"].": ";

                                            }
                                        }
                                echo '</a>
                                </div>';
                                echo '<div class="event-post-user-text">
                                        <p>'.$commenttext.'</p>
                                    </div>';
                                    
                            echo '</div>';
                            echo '</div>';
                        }
                    }
   
                    ?>
                    
                    

                    
                </div>

            
            






            </div>

            <div class="col-md-4">
                
                <?php include "rightmenu.php" ?>
            </div>
        </div>
    

            




    </div> <!-- container -->
</body>

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<!-- Popper JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script type="text/javascript">
    // $(document).ready(function() {

    //     $("#user_form").submit(function(e) {
    //         e.preventDefault();
    //         $.ajax({
    //             type : "POST",
    //             url : "process2.php?comment_post_id="+id,
    //             data : $("#user_form").serialize(),
    //             dataType : 'json',
    //             beforeSend : function() {
    //                 toastr.info("Please wait..");
    //             },
    //             success : function(response) {
    //                // alert('ok2');
    //                 console.log(response);
    //                 if (response.status) {
    //                     toastr.success(response.message);
    //                     $("#user_form")[0].reset();
    //                     $("#userformModal").modal('hide');
    //                     get_all_users();
    //                 }else{
    //                     toastr.error(response.message);
    //                 }
    //             }
    //         });
    //     });

    // });



    function delete_record(id) {
        if(confirm("Are you sure? You want to delete this meeting?")){
            $.ajax({
                type : "GET",
                url : "process2.php?delete_id="+id,
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


    function attend_record(id) {
        // alert(id);
        if(confirm("Are you sure? You want to attend this meeting?")){
            $.ajax({
                type : "GET",
                url : "process2.php?attend_post_id="+id,
                dataType : 'json',
                beforeSend : function() {
                    toastr.info("Please wait..");
                },
                success : function(response) {
                    console.log(response);
                    if (response.status) { //if response status is true show success message
                         window.location="single_post.php?post_id="+id;
                         toastr.warning(response.message);
                        //  get_all_users();
      
                    }else{
                      //  alert(response.message);
                    }
                }
            });
        }else{
        //  alert('ok');
        }

        // window.location="index.php";
        
    }

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


    function edit_record(id) {
        $.ajax({
            type : "GET",
            url : "process2.php?edit_id="+id,
            dataType : 'json',
            beforeSend : function() {
                toastr.info("Please wait..");
            },
            success : function(response) {
               // alert('ok2');
                console.log(response);
                if (response.status) { //if response status is true show success message
                    $("#firstname").val(response.data.firstname);
                    $("#user_id").val(response.data.id);
                    $("#lastname").val(response.data.lastname);
                    $("#email").val(response.data.email);
                    $("#age").val(response.data.age);
                    $("input[name=gender][value="+response.data.gender+"]").prop("checked",true);
                    $("#userformModal").modal('show');
                  //  setTimeout(function(){ alert(response.message);window.location.reload(); }, 3000);
                    
                }else{
                  //  alert(response.message);
                }
            }
        });
    }
</script>
<script type="text/javascript">
    $(document).ready(function() {

        $("#user_form").submit(function(e) {
            e.preventDefault();
            $.ajax({
                type : "POST",
                url : "process2.php",
                data : $("#user_form").serialize(),
                dataType : 'json',
                beforeSend : function() {
                    toastr.info("Please wait..");
                },
                success : function(response) {
                   // alert('ok2');
                    console.log(response);
                    if (response.status) {
                        toastr.success(response.message);
                        $("#user_form")[0].reset();
                        $("#userformModal").modal('hide');
                        get_all_users();
                    }else{
                        toastr.error(response.message);
                    }
                }
            });
        });

    });

    function get_all_users() {

        $.ajax({
            type : "GET",
            url : "process2.php?post_id="+$post_id,
            dataType : 'html',
            success : function(response) {
                console.log(response);
                $("#col-events").html(response);
                // alert($post_id);

            }
        });
    }

    function sPost(id) {
        // alert('geldi');
        

        $.ajax({
            type : "GET",
            url : "process2.php?sPostID="+id,
            dataType : 'html',
            success : function(response) {
                console.log(response);
                $("#col-events").html(response);

            }
        });

    }

    // alert("scriptsonu: ".$post_id);
    sPost($post_id);
</script>
</body>
</html>