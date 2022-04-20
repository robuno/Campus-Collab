<?php 
include "config.php";

//write the query to get data from users table

$sql = "SELECT * FROM posts";
//execute the query
$result = $conn->query($sql);



?>

<!DOCTYPE html>
<html>


<head>
<title>View Page</title>
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
            <div class="col-md-8" id="header-logo">
                
                <img src="img/logowtext.png">
                
            </div>
            <div class="col-md-4" id="header-search-col">
                <button class="btn" type="submit"><i class="fa-solid fa-circle-plus" data-toggle="modal" data-target="#userformModal"></i>New Meeting</button>

                <div class="input-group" id="header-search-input">
                    <!-- <input type="text" class="form-control" placeholder="Search" aria-label="Search word" aria-describedby="basic-addon2"> -->
                    <!-- <div class="input-group-append"> -->
                      <!-- <button class="btn" type="button">Search</button> -->
                    <!-- </div> -->
                    
                </div>
            </div>
        </div>
    </div>

</header>


<body>
    <div class="container">
        <div class="row">
           <div class="col-md-8" id="profile-page">
                
                <div class="profile-page-head">
                    <div class="row">
                        <div class="col-md-4" id="profile-pic">
                                <img src="img/gilfoyle.jpg">
                        </div>
                        <div class="col-md-6" id="profile-name-text">
                            <h3>Unat Teksen</h3>
                            <h4>Computer Engineering</h4>
                            <a href="http://www.google.com">
                                <i class="fa-brands fa-linkedin"></i>
                                    Linkedin
                            </a>
                        </div>
                        <div class="col-md-2 " id="profile-button-options">
                            <button class="btn" type="submit">Edit Profile</button>
                            <button class="btn" type="submit">Upload Profile Picutre</button>
                        </div>
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

</body>
</html>