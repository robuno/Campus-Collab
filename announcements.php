<?php 
include "config.php";

//write the query to get data from users table

$sql = "SELECT * FROM posts";
//execute the query
$result = $conn->query($sql);

$userid_2 = $_SESSION["userid"];
$mail_2 = $_SESSION["mail"];
$firstName_2 = $_SESSION["firstName"];
$lastName_2 = $_SESSION["lastName"];



?>

<!DOCTYPE html>
<html>


<head>
<title>Announcements</title>
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

        </div>
    </div>

</header>


<body>
    <div class="container">
        <div class="row">
            <div class="row">
                <div class="col-md-8">
                <button type="button" class="btn float-right " data-toggle="modal" data-target="#userformModal" id="buttonCreateMeeting"><i class="fa-solid fa-circle-plus"></i>New Announcement</button>  
                </div>
                
                <div class="col-md-4">
                <div class="buttonCreateMeeting">Welcome, <?php echo $firstName_2." ".$lastName_2; ?></div>  
                </div>
            

            </div>
                
            <div class="col-md-8" id="col-events">
              
                



            </div>

            <div class="col-md-4">
                <?php include "rightmenu.php" ?>
            </div>
        </div>
    

    
        
        <div class="modal fade" id="userformModal" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">New Announcement Form</h5>
                        <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;Close</span>
                        </button> -->
                    </div>
                    <div class="modal-body">
                        <form action="" method="POST" id="user_form">
                            <div class="form-group">
                            <!-- <label>Announcement Owner</label> -->
                            <input type="hidden" name="annowner" id="annowner" class="form-control"  value="<?php echo $firstName_2." ".$lastName_2; ?>">
                            <input type="hidden" name="annownerid" id="annownerid" class="form-control"  value="<?php echo $userid_2; ?>">
                            <input type="hidden" name="post_id" id="post_id" class="form-control">
                            </div>

                            <div class="form-group">
                            <label>Post Text</label>
                            <textarea type="text" name="posttext" class="form-control" rows="6"></textarea>
                            <!-- <input type="text" name="posttext" id="posttext" class="form-control"> -->
                            </div>

                            <div class="form-group">
                            <label>Date</label>
                            <input type="date" name="date" id="date" class="form-control">
                            </div>

                        
                            <br><br>
                            <button type="submit" class="btn">Share</button>
                            <button type="button" class="close btn bg-secondary" data-dismiss="modal">
                            Close
                            </button>
                        </form>
                    </div>
                </div>
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
            url : "process2.php?get_posts_announcements=1",
            dataType : 'html',
            success : function(response) {
                console.log(response);
                $("#col-events").html(response);

            }
        });
    }

    get_all_users();
</script>
</body>
</html>