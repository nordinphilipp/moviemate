<?php
include('include/bootstrap.php');
include('include/process/connect_process.php');


$list = $_GET['listID'];
$title = $_GET['newtitle'];

$query = "UPDATE lists SET name = '$title' WHERE listID = '$list'";
mysqli_query($connection,$query);   
?> 
