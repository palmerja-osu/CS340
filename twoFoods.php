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
<body>
<div>
	<table>
	  <tr>
			   <td>Wine:</td>
		   </tr>
		       <tr>
			       <td>Name of Wine:</td>
			
		  </tr>
<?php
if(!($stmt = $mysqli->prepare("SELECT DISTINCT qry1.name  
FROM(
SELECT wine.id, wine.name
FROM (( wine 
INNER JOIN pair ON (wine.id=pair.wine_id ))
INNER JOIN food ON (food.id=pair.food_id ))
WHERE (  food.name = ? )) AS qry1 
INNER JOIN (
SELECT wine.id, wine.name
FROM (( wine 
INNER JOIN pair ON (wine.id=pair.wine_id ))
INNER JOIN food ON (food.id=pair.food_id ))
WHERE (  food.name = ? )) AS qry2
WHERE qry1.id = qry2.id"))){
    
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}
if(!($stmt->bind_param("ss", $_GET['food_one'], $_GET['food_two']))){
	echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
}
if(!$stmt->execute()){
	echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
if(!$stmt->bind_result($name)){
	echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
while($stmt->fetch()){
 echo "<tr>\n<td>\n"  . $name . "\n</td>\n</tr>";
}
$stmt->close();
?>
	</table>
</div>

    	<div class="button"><a href="main.php">Return To Main Page</a></div>
    
</body>
</html>