<?php
/*** connection credentials *******/
$servername = "www.watzekdi.net";
$username = "watzekdi_cs393";
$password = "KevinBac0n";
$database = "watzekdi_imdb";
$dbport = 3306;


/****** connect to database **************/

try {
$db = new PDO("mysql:host=$servername;dbname=$database;charset=utf8;port=$dbport", $username, $password);
//print("it worked");
}
catch(PDOException $e) {
echo $e->getMessage();
} 

try {
$stmt = $db->prepare("select * from movies limit 100");

$stmt->execute();
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

/** see the resulting array **/
//echo "<pre>";  
//var_dump($rows)  
//echo "</pre>";

/** loop through the rows: **/	
foreach ($rows as $row){
$id=$row["id"];
$name=$row["name"];
$year=$row["year"];
echo "id: $id, name: $name, year: $year <br/>";
}

} 
catch (Exception $e) {

echo $e;
} 
?>