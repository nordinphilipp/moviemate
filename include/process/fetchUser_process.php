<?php
    if(!empty($_SESSION['logged_in'])){
        include('include/methods/db.php');   
    $user = fetchUser($_SESSION['userID']);
	$userID = ($_SESSION['userID']);
	$profilelink = "profile.php?userID=$userID";
    }
?>
