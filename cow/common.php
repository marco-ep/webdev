<?php
	//database connection information
	
$servername = "www.watzekdi.net";
$username = "watzekdi_cs393";
$password = "KevinBac0n";
$dbn = "watzekdi_imdb";
$dbport = 3306;


	//database connection
	try {
		$db = new PDO("mysql:host=$servername;dbname=$dbn;charset=utf8;port=$dbport", $username, $password);
	} catch (PDOException $e) {
    	die("Could not connect to the database:" . $e->getMessage());
	}

	
	function addUser($cowname, $cowpassword, $db) {
    $sql = "INSERT INTO cowusers (username, password) VALUES ('" . $cowname .  "', '" . $cowpassword . "')";
    $db->query($sql);
	}
  
  function getListItems($cowname, $db) {
    $sql = "SELECT * FROM todo WHERE username = '" . $cowname . "'";
    return $db->query($sql);
  }
	
	function addListItem($listItem, $cowname, $db) {
    $sql = "INSERT INTO todo (item, username) VALUES ('" . $listItem .  "', '" . $cowname . "')";
    $db->query($sql);
	}
  
	function deleteListItem($id, $db) {
    $sql = "DELETE FROM todo WHERE id = " . $id;
    $db->query($sql);
	}
	
	function validateNameChars($cowname) {
		if (strlen($cowname)>=3 && strlen($cowname)<=8) {
			return preg_match('/^([a-z])+[a-z\d]+$/', $cowname);
		} else {
			return false;
		}
	}
	
	function validatePassChars($cowpassword) {
		if (strlen($cowpassword)>=6 && strlen($cowpassword)<=12) {
			return preg_match('/^([\d])+[a-zA-Z\d\!\@\#\$\%\^\&\*\(\)\_\-\+\=\|\\\"\`\~\{\[\]\}\,\.]+([\!\@\#\$\%\^\&\*\(\)\_\-\+\=\|\\\"\`\~\{\[\]\}\,\.])+$/', $cowpassword);
		} else {
			return false;
		}
	}
?>