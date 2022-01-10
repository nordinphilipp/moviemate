<?php
//include('include/process/connect_process.php');
//include('include/methods/functions.php');
/*$user = "root";
$pw = "";
$host = "localhost";
$db = "moviemate";
$connection = new mysqli($host, $user, $pw, $db);*/

$listID = $_GET['listID'];
$movieid = $_GET['movie'];
$userid= $_SESSION['userID'];

$result = mysqli_query($connection, "SELECT orderinlist FROM movie_list where listID = '$listID' ORDER BY orderinlist DESC LIMIT 1");
		$row = mysqli_fetch_array($result);
		$length=$row['orderinlist'];
		if(!is_numeric($length))
		{
			$length = 0;
		}
		$order = $length + 1;
		$state  = $connection->prepare("INSERT INTO movie_list(listID,movieID,orderinlist,userid) VALUES(?,?,?,?)");
		$state->bind_param('ssss',$listID,$movieid,$order,$userid);
		$state->execute();

