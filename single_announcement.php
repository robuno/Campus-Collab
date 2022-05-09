<?php 
include "config.php";
include "funcs.php";

//write the query to get data from users table

if (isset($_GET["post_id"])) {  $post_id = $_GET["post_id"]; }

// echo "php first: ".$post_id;

$sql = "SELECT * FROM announcements WHERE id=$post_id";
//execute the query
$result3 = $conn->query($sql);

if ($result3->num_rows > 0) {
    //output data of each row
    while ($row2 = $result3->fetch_assoc()) {
        $id = $row2["id"];
        $annowner = $row2["annowner"];
        $annownerid = $row2["annownerid"];
        $posttext = $row2["posttext"];
        $date = $row2["date"];

        // echo $annowner." ".$annownerid." ".$posttext." ".$date;
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

?>

<!DOCTYPE html>
<html>


<head>
<title>Announcement</title>
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
                                $sql2 = "SELECT * FROM users WHERE `id`=$annownerid";
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
                            <a href="profile.php?postownerid=<?php echo $annownerid; ?>"><?php 
                                $sql2 = "SELECT * FROM users WHERE `id`=$annownerid";
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

                        $post_id_delete = $post_id;

                        if ($userid_2 ==$annownerid) {
                            echo "<button class='btn bg-danger'  onclick='delete_record($post_id_delete)' ><i class='fa-solid fa-trash-can'></i>Delete</button>";
                        }
                        ?>

                    </div>                   
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
    function delete_record(id) {
        if(confirm("Are you sure? You want to delete this record?")){
            $.ajax({
                type : "GET",
                url : "process2.php?delete_announc_id="+id,
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
        alert(id);
        if(confirm("Are you sure? You want to attend this record?")){
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

    function bookmark_record(id) {
        alert(id);
        if(confirm("Are you sure? You want to attend this record?")){
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