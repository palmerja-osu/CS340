<?php
//error reporting 
ini_set('display_errors', 'On');

$mysqli = new mysqli('oniddb.cws.oregonstate.edu', 'palmerja-db', '0pw9EnF5GTR6Mu6U', 'palmerja-db');

if($mysqli->connect_errno){
	echo "Connection error " . $mysqli->connect_errno . " " . $mysqli->connect_error;
	}
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
    <head>
	<meta charset="utf-8"/>
	
	<link rel="stylesheet" type="text/css" href="projectOutline.css" />

	
</head>
	<?php
if(!($stmt = $mysqli->prepare("INSERT INTO wine(name, wine_type, region_id, variety_id, temp_id) VALUES (?,?,?,?,?)"))){
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}
if(!($stmt->bind_param("ssiii",$_POST['name'],$_POST['wine_type'],$_POST['region'],$_POST['grape'], $_POST['temp']))){
	echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
}
if(!$stmt->execute()){
	echo "Execute failed: "  . $stmt->errno . " " . $stmt->error;
} else {
	echo "You added " . $stmt->affected_rows . " row to our wine list, thank you!";
}
?>
       	<div class="button"><a href="food-wine-DB-main.php">Return To Main Page</a></div>
    </html>