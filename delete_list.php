<?php
    	include('include/bootstrap.php');
	include('include/process/connect_process.php');
    	$listID = $_GET['listID'];
	$list = "SELECT * from lists where listID='$listID'";
	$listresult = $connection ->query($list);
	$res = $listresult -> fetch_array();
	$userID = $res['userID'];
	
	if(!empty($_SESSION['logged_in']))
	{
		if($_SESSION['accessLevel'] == 2)
			{
				$sql = "DELETE FROM lists WHERE listID='$listID'";
				mysqli_query($connection, $sql);
				header("Location: profile.php");
			}
		else if($_SESSION['userID'] == $userID)
			{
				$sql = "DELETE FROM lists WHERE listID='$listID'";
				mysqli_query($connection, $sql);
				header("Location: profile.php");
			}
		else
			{
				echo '<script> displayAlert("Du har ej behörighet")</script>';			
			}
		}
		else
		{
			echo '<script> displayAlert("Du har ej behörighet")</script>';	
		}
?> 

