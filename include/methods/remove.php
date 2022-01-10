<?php

$user = "root";
$pw = "";
$host = "localhost";
$db = "moviemate";
$connection = new mysqli($host, $user, $pw, $db);

$listID = $_GET['listID'];
$movie = $_GET['movie'];
mysqli_query($connection, "delete from movie_list where movieID = '$movie' and listID = '$listID'");

?>
