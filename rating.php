<?php
<?php
include('include/bootstrap.php');
include('include/process/fetchUser_process.php');
include('include/process/connect_process.php');
include('include/methods/functions.php');
//Använd include/methods/rating.php- filen istället för denna<-----


$rating = $_GET['rating'];
$userid = $_SESSION['userID'];
$movieid = $_GET['movie'];


$check = $connection->prepare("select * from movies2 where userID = '$userid' and movieID = '$movieid'");
$check->execute();
$check->store_result();
$rows = $check->num_rows;
if($rows > 0)
{
	$sql = "update movies2 set rating = '$rating' where userID = '$userid' and movieID = '$movieid'";
	mysqli_query($connection,$sql);
}
else
{
	$state  = $connection->prepare("INSERT INTO movies2(userID,movieID,rating) VALUES(?,?,?)");
	$state->bind_param('sss',$userid,$movieid,$rating);
	$state->execute();
}
$connection->close();
?>
