<?php

//använd denna fil för att ansluta till databasen

//connect om det finns en aktiv session
if(session_status() === PHP_SESSION_ACTIVE){
    //databasvariabler
    $user = "root";
    $pw = "";
    $host = "localhost";
    $db = "moviemate";

    $connection = new mysqli($host, $user, $pw, $db);

    if($connection->connect_error)
        {
            die("Connection failed: ".$connection.connect_error);
        }
          
}else{
    echo "ERROR: could not establish connection.";
}


?>