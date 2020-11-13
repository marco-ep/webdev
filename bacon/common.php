<?php

$servername = "www.watzekdi.net";
$username = "watzekdi_cs393";
$password = "KevinBac0n";
$db = "watzekdi_imdb";
$dbport = 3306;


/****** connect to database **************/


$dbh = new PDO("mysql:host=$servername;dbname=$db;charset=utf8;port=$dbport", $username, $password);

//Gets the searched actor's id
$q1 = "SELECT id 
		FROM actors 
		WHERE (first_name LIKE '".$_GET['firstname']." %' OR first_name = '".$_GET['firstname']."') AND last_name = '".$_GET['lastname']."' 
		AND film_count >= all(SELECT film_count 
								FROM actors 
								WHERE (first_name LIKE'".$_GET['firstname']." %' OR first_name = '".$_GET['firstname']."') 
								AND last_name = '".$_GET['lastname']."')";
$id = null;
//only returns 1 row
foreach($dbh->query($q1) as $row){
    $id = $row['id']	;
}
//if actor is not in the database
if($id == null){
    echo "Actor ";
    echo $_GET['firstname'];
    echo " ";
    echo $_GET['lastname'];
    echo " not found.";
}
?>
