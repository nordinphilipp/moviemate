<?php
//include('include/process/connect_process.php');
//include('include/methods/functions.php');

/* $user = "root";
$pw = "";
$host = "localhost";
$db = "moviemate";
$connect = new mysqli($host, $user, $pw, $db);

$rating = $_GET['rating'];
$userid = ($_GET['userID']);
$movieid = $_GET['movie'];


$check = $connect->prepare("select * from movies2 where userID = '$userid' and movieID = '$movieid'");
$check->execute();
$check->store_result();
$rows = $check->num_rows;
if($rows > 0)
{
	$sql = "update movies2 set rating = '$rating' where userID = '$userid' and movieID = '$movieid'";
	mysqli_query($connect,$sql);
}
else
{
	$state  = $connect->prepare("INSERT INTO movies2(userID,movieID,rating) VALUES(?,?,?)");
	$state->bind_param('sss',$userid,$movieid,$rating);
	$state->execute();
}
$connect->close();
?>
*/
