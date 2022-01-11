<?php
	function addComment($content,$userid,$movie){
		include('include/process/connect_process.php');
		$state  = $connection->prepare("INSERT INTO comments(movieID,comment,userID) VALUES(?,?,?)");
		$state->bind_param('sss',$movie,$content,$userid);
		$state->execute();

	}

	function addToList($v,$movie,$order,$userID){
		include('include/process/connect_process.php');
		$state  = $connection->prepare("INSERT INTO movie_list(listID,movieID,orderinlist,userID) VALUES(?,?,?,?)");
		$state->bind_param('ssss',$v,$movie,$order,$userID);
		$state->execute();
	}

	function fetchList($listID){
       	 	//connect to db
       		include('include/process/connect_process.php');
        
        	//fetch relevant data
        	$query = "SELECT * from movie_list where listID = '$listID' ORDER BY orderinlist ASC";
        	$result = $connection->query($query);
        	if($connection->query($query) !== FALSE) {
           		$connection->close(); 
           		return $result;
			}
		}
		
	function fetchRecentLists($userID){
        	include('include/process/connect_process.php');        
		
        	$query = "SELECT * from lists where userID = '$userID' ORDER BY listID LIMIT 3";
        	$result = $connection->query($query);
       		if($connection->query($query) !== FALSE) {
            		$connection->close();
            	return $result;
        }else{
            	echo "Error: " . $query . "<br>" . $connection->error;
            	$connection->close();
        }
    }
	
	function fetchMovieRating($movieID){
        	include('include/process/connect_process.php');
        
        	$query = "SELECT rating from movies2 WHERE movieID = '$movieID'";
        	$result = $connection->query($query);
        	if($connection->query($query) !== FALSE) {
            	$connection->close(); 
            	return $result;
        }else{
            	echo "Error: " . $query . "<br>" . $connection->error;
            	$connection->close();
        }
    }
	
    function fetchRecentlyWatched($userID){
        include('include/process/connect_process.php');
        
        $query = "SELECT movieID, rating FROM movies2 WHERE userID = '$userID' LIMIT 3"; // Fixa order by, tre senaste
        $result = $connection->query($query);
        if($connection->query($query) !== FALSE) {
            $connection->close();
            return $result;
        }
    }

function getTitle($listid){
	include('include/process/connect_process.php');
	$query = "select name from lists where listID = '$listid'";
	$check = $connection->query($query);
	$res = $check -> fetch_array();
	$connection->close();
	return $res['name'];
}

function getUsername($userid){
	include('include/process/connect_process.php');
	$query = "select username from users where userID = '$userid'";
	$check = $connection->query($query);
	$res = $check -> fetch_array();
	$connection->close();
	return $res['username'];
}

function getComments($movie){
	include('include/process/connect_process.php');
	$query = "select * from comments where movieID = '$movie' order by timestamp desc";//välj inlägg med nyast först
	$check = $connection->query($query);
	return $check;
}

function setRating($id,$userid){
	include('include/process/connect_process.php');
	$query2 = "SELECT rating FROM movies2 WHERE movieID = '$id' AND userID = '$userid'";
	$check2 = $connection->query($query2);
	if ($check2 ->num_rows === 0){
		$connection->close();
		return "0";
	}
	else
	{
		while($rowtwo = $check2->fetch_assoc())
		{
		$connection->close();
			return $rowtwo['rating'];
		}
	}
}

function orderInList($id){
	include('include/process/connect_process.php');
	$result = mysqli_query($connection, "SELECT * FROM movie_list where movieID = '$id'");
	$row = mysqli_fetch_array($result);
	$connection->close();
	return $row['orderinlist'];

}

function returnOrder($x){
	include('include/process/connect_process.php');
	$result = mysqli_query($connection, "SELECT * FROM movie_list where listID = '$x' ORDER BY orderinlist DESC LIMIT 1");
	$row = mysqli_fetch_array($result);
	$length=$row['orderinlist'];
	if(!is_numeric($length))
	{
		$length = 0;
	}
	$connection->close();
	return $length;
}

function getList($userid){
	include('include/process/connect_process.php');
	$query = "select * from lists where userID = '$userid'";
	return $connection->query($query);
}

function fetchMovies($x){
	include('include/process/connect_process.php');
	$query = "select * from movie_list where listID = '$x' order by orderinlist asc";
	$check = $connection->query($query);
	$connection->close();
	return $check;
}
?>
