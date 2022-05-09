<?php 
include "config.php";
include "funcs.php";

//write the query to get data from users table


if (isset($_GET["postownerid"])) {  $postownerid = $_GET["postownerid"]; }


$sql = "SELECT * FROM posts";
//execute the query
$result = $conn->query($sql);

$userid_2 = $_SESSION["userid"];
$mail_2 = $_SESSION["mail"];
$firstName_2 = $_SESSION["firstName"];
$lastName_2 = $_SESSION["lastName"];


// echo "userid2: ".$userid_2;

?>

<!DOCTYPE html>
<html>


<head>
<title>CampusCollab | Profile</title>
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
           <div class="col-md-8" id="profile-page">
                <div class="profile-page-head">
                    <div class="row">
                        <div class="col-md-4" id="profile-pic">
                            <?php 
                            
                                $sql2 = "SELECT * FROM users WHERE `id`=$postownerid";
                                $result2 = $conn->query($sql2);
                                
                                if ($result2->num_rows > 0) {
                                    //output data of each row
                                    while ($row2 = $result2->fetch_assoc()) { 
                                        $img_name_new = $row2["image_url"];
                                        $department2 = $row2["department"];

                                        if ($img_name_new =="") {
                                            // echo "You don't have a profile picture!";
                                            echo "<img src='img/default.jpg'>";
                                        } else {
                                            // echo $row2["image_url"];
                                            echo '<img src="uploads/'.$img_name_new.'">';
                                        }     
                                    }
                                }
                            ?>
                                
                        </div>
                        
                        <div class="col-md-6" id="profile-name-text">


                        <?php 

                               
                            
                            $sql2 = "SELECT * FROM users WHERE `id`=$postownerid";
                            $result2 = $conn->query($sql2);
                            
                            if ($result2->num_rows > 0) {
                                //output data of each row
                                while ($row2 = $result2->fetch_assoc()) { 
                                    echo '<h3>'.$row2['firstName'].' '.$row2['lastName'].'</h3>';
                                    echo '<h4>'.$row2['department'].'</h4>';

                                }
                            }

                            ?>
                            <!-- <a href="https://www.linkedin.com/checkpoint/lg/sign-in-another-account">
                                <i class="fa-brands fa-linkedin"></i>
                                    Linkedin
                            </a>
                            <a href="https://www.instagram.com/accounts/login/">
                                <i class="fa-brands fa-instagram"></i>
                                    Instagram
                            </a>
                            <a href="https://github.com/login">
                                <i class="fa-brands fa-github"></i>
                                    Github
                            </a>
                            <a href="https://accounts.spotify.com/tr/login/?continue=https%3A//open.spotify.com/__noul__%3Fl2l%3D1%26nd%3D1&_locale=tr-TR">
                                <i class="fa-brands fa-spotify"></i>
                                    Spotify
                            </a> -->
                        </div>
                        <div class="col-md-2 " id="profile-button-options">
                            <?php 
                                if( $postownerid == $userid_2) {
                                    echo '<button class="btn" type="submit" data-toggle="modal" data-target="#userformModal" >Edit Profile</button>
                                    <button class="btn" type="submit"><a href="#change-profile-pic">Upload Profile Picutre</a></button>';
                                }
                            
                            
                            ?>
                            
                        </div>
                    </div>

                </div>

                <div class="page-bio">
                    <div class="row">
                    <?php 
                            
                            $sql2 = "SELECT * FROM users WHERE `id`=$postownerid";
                            $result2 = $conn->query($sql2);
                            
                            if ($result2->num_rows > 0) {
                                //output data of each row
                                while ($row2 = $result2->fetch_assoc()) { 
                                    echo '<p>'.$row2['bio'].'</p>';

                                }
                            }

                            ?>
   
                    </div>

                </div>

                <div class="page-sites">
                    <div class="sites">
                        <h3>Social Media Accounts</h3>
                        <div class="row">
                            
                        <?php 
                            
                            $sql2 = "SELECT * FROM users WHERE `id`=$postownerid";
                            $result2 = $conn->query($sql2);
                            
                            if ($result2->num_rows > 0) {
                                //output data of each row
                                while ($row2 = $result2->fetch_assoc()) { 
                                    $githubLink = $row2["githubLink"];
                                    $instaLink = $row2["instaLink"];
                                    $linkedinLink = $row2["linkedinLink"];
                                    $twitterLink = $row2["twitterLink"];
                                    $spotifyLink = $row2["spotifyLink"];
                                    $personalWeb = $row2["personalWeb"];

                                    echo '
                                    <div class="col-md-6">
                                <ul>

                                    <li><a href="'.'https://'.$githubLink.'">
                                        <i class="fa-brands fa-github"></i>
                                            Github
                                        </a>
                                    </li>

                                    <li><a href="'.'https://'.$spotifyLink.'">
                                        <i class="fa-brands fa-spotify"></i>
                                            Spotify
                                        </a> 
                                    </li>

                                    <li><a href="'.'https://'.$instaLink.'">
                                        <i class="fa-brands fa-instagram"></i>
                                            Instagram
                                        </a>
                                    </li>
                                </ul>

                            </div>

                                    <div class="col-md-6">
                                <ul>
                                    <li><a href="'.'https://'.$linkedinLink.'">
                                                <i class="fa-brands fa-linkedin"></i>
                                                    Linkedin
                                            </a> 
                                        </li>

                                        <li><a href="'.'https://'.$twitterLink.'">
                                            <i class="fa-brands fa-twitter"></i>
                                                    Twitter
                                            </a>
                                        </li>

                                        <li><a href="'.'https://'.$personalWeb.'">
                                            <i class="fa-solid fa-globe"></i>
                                                    Personal Web
                                            </a> 
                                        </li>

                                </ul>
                            </div>';  

                                }
                            }

                            ?>             
                        </div>
                    </div>

                </div> 

                <?php 
                    if( $postownerid == $userid_2) {
                        echo "<div class='profile-page-edit' id='change-profile-pic'>
                        <div class='row'>
                            <h3>Change Your Profile Picture</h3>

                            <form action='upload.php'
                                method='post'
                                enctype='multipart/form-data'>
    
                                <input type='file'
                                        name='my_image'>
    
                                <input type='hidden'
                                        name='useridnew'
                                        value=".$postownerid.">
    
                                <input type='submit' 
                                        name='submit'
                                        value='Upload'>
    
                                
                            </form>
                        </div>
                    </div>";
                    }
                            
                            
                ?>
                

                <div class="modal fade" id="userformModal" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Edit Profile Form</h5>
                                <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;Close</span>
                                </button> -->
                            </div>

                            <?php 
                                    
                                    $sql2 = "SELECT * FROM users WHERE `id`=$userid_2";
                                    $result2 = $conn->query($sql2);
                                    
                                    if ($result2->num_rows > 0) {
                                        //output data of each row
                                        while ($row2 = $result2->fetch_assoc()) { 
                                            $firstName = $row2["firstName"];
                                            $lastName = $row2["lastName"];
                                            $department = $row2["department"];
                                            $mail = $row2["mail"];
                                            $password2 = $row2["password2"];
                                            $bio = $row2["bio"];
                                            $githubLink = $row2["githubLink"];
                                            $instaLink = $row2["instaLink"];
                                            $linkedinLink = $row2["linkedinLink"];
                                            $twitterLink = $row2["twitterLink"];
                                            $spotifyLink = $row2["spotifyLink"];
                                            $personalWeb = $row2["personalWeb"];
                                        }
                                    }

                                    ?> 
                            <div class="modal-body">
                                <form action="" method="POST" id="user_form">
                                    <div class="form-group">
                                    <label>First Name</label>
                                    <input type="text" name="firstName" id="firstName" class="form-control"  value="<?php echo $firstName; ?>">
                                    <input type="hidden" name="id_user" id="id_user" class="form-control"  value="<?php echo $postownerid; ?>">
                                    </div>

                                    <div class="form-group">
                                    <label>Last Name</label>
                                    <input type="text" name="lastName" id="lastName" class="form-control"  value="<?php echo $lastName; ?>">
                                    </div>

                                    <div class="form-group">
                                    <label>Department</label>
                                    <input type="text" name="department" id="department" class="form-control"  value="<?php echo $department; ?>">
                                    </div>

                                    <div class="form-group">
                                    <label>E-Mail</label>
                                    <input type="text" name="mail" id="mail" class="form-control"  value="<?php echo $mail; ?>">
                                    </div>

                                    <input type="hidden" name="password2" id="password2" class="form-control"  value="<?php echo $password2; ?>">

                                    <div class="form-group">
                                    <label>New Password (If you don't want to update password, left it blank.)</label> 
                                    <input type="password" name="passwordNew" id="passwordNew" class="form-control"  value="">
                                    </div>

                                    <div class="form-group">
                                    <label>Bio</label>
                                    <textarea type="text" name="bio" class="form-control" rows="6"><?php echo $bio; ?></textarea>
                                    <!-- <input type="text" name="posttext" id="posttext" class="form-control"> -->
                                    </div>

                                    <div class="form-group">
                                    <label>Github Link</label>
                                    <input type="text" name="githubLink" id="githubLink" class="form-control"  value="<?php echo $githubLink; ?>">
                                    </div>

                                    <div class="form-group">
                                    <label>Instagram Link</label>
                                    <input type="text" name="instaLink" id="instaLink" class="form-control"  value="<?php echo $instaLink; ?>">
                                    </div>

                                    <div class="form-group">
                                    <label>Twitter Link</label>
                                    <input type="text" name="twitterLink" id="twitterLink" class="form-control"  value="<?php echo $twitterLink; ?>">
                                    </div>

                                    <div class="form-group">
                                    <label>LinkedIn Link</label>
                                    <input type="text" name="linkedinLink" id="linkedinLink" class="form-control"  value="<?php echo $linkedinLink; ?>">
                                    </div>

                                    <div class="form-group">
                                    <label>Spotify Link</label>
                                    <input type="text" name="spotifyLink" id="spotifyLink" class="form-control"  value="<?php echo $spotifyLink; ?>">
                                    </div>

                                    <div class="form-group">
                                    <label>Personal Web</label>
                                    <input type="text" name="personalWeb" id="personalWeb" class="form-control"  value="<?php echo $personalWeb; ?>">
                                    </div>
                                
                                    <button type="submit" class="btn">Change</button>
                                    <button type="button" class="close btn bg-secondary" data-dismiss="modal">
                                    Close
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    
                </div>

                    
                
            </div> <!-- profile page-->

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
                        location.reload();
                    }else{
                        toastr.error(response.message);
                    }
                }
            });
        });

    });

</script>
</body>
</html>