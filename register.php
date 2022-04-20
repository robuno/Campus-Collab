<?php 
include "config.php";
include "funcs.php";
//write the query to get data from users table

$sql = "SELECT * FROM posts";
//execute the query
$result = $conn->query($sql);




?>

<!DOCTYPE html>
<html>


<head>
<title>Meetings</title>
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
            <div class="col" id="header-logo">
                
                <img src="img/logowtext.png">
                
            </div>
        </div>
    </div>

</header>


<body>
    <?php 

    if ($mail!='' and $password2!='' and $action=='send')

    {
        
        $data_query = mysqli_query($conn, "SELECT * FROM users WHERE mail='$mail' AND password2='$password2'");
        while ($row = @mysqli_fetch_array($data_query)) {
            $userid = $row["id"];
            $firstName = $row["firstName"];
            $lastName = $row["lastName"];
        }
        
        if ($userid>0)
        {
            //echo $action.$mail.$password2;
            $_SESSION["mail"] = $mail;
            $_SESSION["userid"] = $userid;
            $_SESSION["firstName"] = $firstName;
            $_SESSION["lastName"] = $lastName;
            header('Location: index2.php');
        }
        else
        {
            $hata='Try Again!';
        }
    }
    else
    {

    }


    ?>
    <div class="container" id="maincontainer-index">
         <?php if($hata!='') {echo '<div class="warning-input"><i class="fa-solid fa-circle-info"></i>'.$hata.'</div>';} ?>
            <div class="row" id ="row-login">
                <div class="col-md-6">
                    <h2>CampusCollab</h2>
                    <p>Campus Collab lets you to find or create meeting. You can login from here! If you don't have an account, you can register from there:</p>
                    <a href="#row-register"><button class="btn bg-secondary" type="submit">Register</button></a>


                </div>
                <div class="col-md-6">
                    <form action="login.php" method="POST">
                        <input type="hidden" name="action" value="send"> 

                            <div class="form-group">
                            <label>E-Mail</label>
                            <input type="text" name="mail" class="form-control" value="">
                            </div>
                    
                            <div class="form-group">
                            <label>Password</label>
                            <input type="password" name="password2" class="form-control" value="">
                            </div>
                
                        <div class="form-group">
                            <button type="submit" class="btn btn-dark">Login</button>
                        </div>
                    </form>


                </div>
            </div>

            <div class="row" id ="row-about">
                <h2>What is CampusCollab?</h2>
                <p>camp collab is camp collab is camp collab is camp collab is camp collab is camp collab is camp collab is camp collab is camp collab is camp collab is camp collab is camp collab is camp collab is camp collab is camp collab is camp collab is camp collab is camp collab is camp collab is camp collab is</p> 
    
            </div>

            <div class="row" id ="row-register">
                <h2>Register</h2>

                <div class="col-md-6">
                <form action="" method="POST" id="user_form">
                        <!-- <input type="hidden" name="action" value="send"> -->
                        
                            <div class="form-group">
                            <label>First Name</label>
                            <input type="text" name="firstName" class="form-control" value="">
                            </div>

                            <div class="form-group">
                            <label>Last Name</label>
                            <input type="text" name="lastName" class="form-control" value="">
                            </div>

                            <div class="form-group">
                            <label>Department</label>
                            <input type="text" name="department" class="form-control" value="">
                            </div>

                            <div class="form-group">
                            <label>E-Mail</label>
                            <input type="text" name="mail" class="form-control" value="">
                            </div>                          

                            <!-- <div class="form-group">
                            <label>Birth of Date</label>
                            <input type="date" name="birthOfDate" id="birthOfDate" class="form-control">
                            </div> -->
                    
                            <div class="form-group">
                            <label>Password</label>
                            <input type="password" name="password2" class="form-control" value="">
                            </div>
                
                        <div class="form-group">
                            <button type="submit" class="btn btn-dark">Login</button>
                        </div>
                    </form>


                </div>

                <div class="col-md-6">
                <p>camp collab is camp collab is camp collab is camp collab is camp collab is camp collab is camp collab is camp collab is camp collab is camp collab is camp collab is camp collab is camp collab is camp collab is camp collab is camp collab is camp collab is camp collab is camp collab is camp collab is</p>
 
                
                </div>
                
    
            </div>

            <div class="row" id ="row-faq">
                <h2>Frequently Answered Questions</h2>
                <p>camp collab is camp collab is camp collab is camp collab is camp collab is camp collab is camp collab is camp collab is camp collab is camp collab is camp collab is camp collab is camp collab is camp collab is camp collab is camp collab is camp collab is camp collab is camp collab is camp collab is</p>
            
    
            </div>
  
   
    </div>

    <script type="text/javascript">
    $(document).ready(function() {

        $("#user_form").submit(function(e) {
            e.preventDefault();
            $.ajax({
                type : "POST",
                url : "process3.php",
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
    </script>

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