<?php 
include "config.php";
include "funcs.php";

$userid_2 = $_SESSION["userid"];
// echo "userid_2: ".$userid_2;
?>

<ul class="right-menu-ul ">
     <div class="right-nav-list">

        <!-- <a href="#"><li class="right-menu-list-item"><i class="fa-solid fa-circle-plus"></i>New Meeting</li></a> -->
        <a href="index.php"><li class="right-menu-list-item"><i class="fa-solid fa-house"></i>Meetings</li></a>
        <a href="profile.php?postownerid=<?php echo $userid_2; ?>"><li class="right-menu-list-item"><i class="fa-solid fa-user"></i>My Profile</li></a>
        <a href="single_user_bookmarks.php"><li class="right-menu-list-item"><i class="fa-solid fa-bookmark"></i>Bookmarks</li></a>
        <a href="announcements.php"><li class="right-menu-list-item"><i class="fa-solid fa-bullhorn"></i>Announcements</li></a>
        <a href="studygroups.php"><li class="right-menu-list-item"><i class="fa-solid fa-user-group"></i>Study Groups</li></a>
        <a href="studentbranches.php"><li class="right-menu-list-item"><i class="fa-solid fa-code-branch"></i>Student Branches</li></a>
        <a href="index.php?action=exit"><li class="right-menu-list-item"><i class="fa-solid fa-xmark"></i>Logout</li></a>


     </div>
                    
    
</ul>