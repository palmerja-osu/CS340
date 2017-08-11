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
     
   <legend class="topLabel"> Final Project CS340: Wine and Food Pairing</legend>
        <br>
		<br>
		<br>
        <br>
        <hr>


                             
    <label >Find food suggestions for your wine:</label>
        <br>          
        <br>
                
<div>
	<form method="get" action="choiceOfWine.php">
            <fieldset>
			<legend > Search for food based on what wine: </legend>
			<select name="wine">
<?php
if(!($stmt = $mysqli->prepare("SELECT id, wine.name FROM wine"))){
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}
if(!$stmt->execute()){
	echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
if(!$stmt->bind_result($id, $name)){
	echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
while($stmt->fetch()){
	echo '<option value=" '. $id . ' "> ' . $name . '</option>\n';
}
$stmt->close();
?>
			</select>
		    </fieldset>
     	
    <p><input type="submit" value="Submit for Food"/></p>
	</form>
</div>           
   
       
        <br>
        <br>
                      
<div>

	<label>Turn food choice into Wine! </label>
        <br>          
        <br>
		
	<form method="get" action="selectWine.php">
            <fieldset>
			<legend>Search for food based of the type of wine. (i.e. red or white whine) </legend>
		
			<p>Wine Type: <input type="text" name="wine_type" /></p>
			<p> <strong>Wine Types include: Red, Light Red, Rose, White, Light White, Sarkling, Dessert</strong> 	
			</p>
	
                    
		   </fieldset>
     	
    <p><input type="submit" value="Find Food"/></p>
	</form>
</div>           
          
     
        <br>          
         
         
    <br>
    <hr>
  
        <label>Search for wine based off of food available. </label>
        <br>          
        <br>      
                   
<div>
	<form method="get" action="choiceOfFood.php">
            <fieldset>
			<legend>Search for wine based off of name of food: </legend>
			<select name="food">
<?php
if(!($stmt = $mysqli->prepare("SELECT id, food.name FROM food"))){
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}
if(!$stmt->execute()){
	echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
if(!$stmt->bind_result($id, $name)){
	echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
while($stmt->fetch()){
	echo '<option value=" '. $id . ' "> ' . $name . '</option>\n';
}
$stmt->close();
?>
			</select>
		    </fieldset>
     	
        <p><input type="submit" value="Find Wine"/></p>
	</form>
</div>      
    
        <br>
        <br>
                      
<div>

	<label>Match two types of food for a wine pairing! </label>
	    <br>          
        <br> 
	<form method="get" action="twoFoods.php">
            <fieldset>
			<legend>Search for pairs by two food names: </legend>

		
			<p>First Food:</p>
			<select name="food">
<?php
if(!($stmt = $mysqli->prepare("SELECT id, food.name FROM food"))){
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}
if(!$stmt->execute()){
	echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
if(!$stmt->bind_result($id, $name)){
	echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
while($stmt->fetch()){
	echo '<option value=" '. $id . ' "> ' . $name . '</option>\n';
}
$stmt->close();
?>
			</select>
			
			<p>Second Food:</p>
			<select name="food">
<?php
if(!($stmt = $mysqli->prepare("SELECT id, food.name FROM food"))){
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}
if(!$stmt->execute()){
	echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
if(!$stmt->bind_result($id, $name)){
	echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
while($stmt->fetch()){
	echo '<option value=" '. $id . ' "> ' . $name . '</option>\n';
}
$stmt->close();
?>
			</select>

		    </fieldset>
     	
       
          <p><input type="submit" value="Find Wine"/></p>
	</form>
</div> 
      
 
    <br>
    <hr>

             
       
        <label >Can't find your wine? Input it into our database! Fill out the appropriate fields below!</label>
        <br>          
        <br>  
<div>
	<form method="post" action="wineUpdate.php"> 


        <fieldset>
			<legend>New Wine Information:</legend>
			<p>Name of Wine: <input type="text" name="name" /></p>
			<p>Type of Wine: <input type="text" name="wine_type" /></p>
		</fieldset>

		<fieldset>
			<legend>Country</legend>
			<select name="region">
<?php
if(!($stmt = $mysqli->prepare("SELECT id, country_name FROM region"))){
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}
if(!$stmt->execute()){
	echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
if(!$stmt->bind_result($id, $country_name)){
	echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
while($stmt->fetch()){
	echo '<option value=" '. $id . ' "> ' . $country_name . '</option>\n';
}
$stmt->close();
?>
			</select>
		</fieldset>


        <fieldset>
			<legend>What kind of wine are we drinking?!?</legend>
			<select name="grape">
<?php
if(!($stmt = $mysqli->prepare("SELECT id, grape_name FROM grape_variety"))){
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}
if(!$stmt->execute()){
	echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
if(!$stmt->bind_result($id, $grape_name)){
	echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
while($stmt->fetch()){
	echo '<option value=" '. $id . ' "> ' . $grape_name . '</option>\n';
}
$stmt->close();
?>
			</select>
		</fieldset>
		
 <fieldset>
			<legend>Serving Temperature</legend>
			<select name="temp">
<?php
if(!($stmt = $mysqli->prepare("SELECT id, temp FROM temperature"))){
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}
if(!$stmt->execute()){
	echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
if(!$stmt->bind_result($id, $temp)){
	echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
while($stmt->fetch()){
	echo '<option value=" '. $id . ' "> ' . $temp . '</option>\n';
}
$stmt->close();
?>
			</select>
		</fieldset>
             
        <p><input type="submit" /></p>
	</form>
</div>

        <br>          
        <br>
        <label >Can't find your food? Input it into our database! Fill out the appropriate fields below!</label>
        <br>          
        <br>  
<div>
	<form method="post" action="foodUpdate.php"> 


        <fieldset>
			<legend>New Food Information:</legend>
			<p>Name of Food: <input type="text" name="name" /></p>
			<p>What type of food is it?: <input type="text" name="food_category" /></p>
		</fieldset>
        
        <p><input type="submit" /></p>
	</form>
</div>
          
    
        <br>          
        <hr>
        <label >If you made an error in your food OR wine input? You can fix that here!</label>
        <br>          
        <br>  

<div>
	<form method="post" action="wineError.php"> 
        <fieldset>
			<legend>Fix Wine Entry:</legend>
			<p>Corrected Wine Name: <input type="text" name="new_wine_name" /></p>
			<p>Incorrect Food Name: <input type="text" name="old_wine_name" /></p>      
		</fieldset>
        
        <p><input type="submit" /></p>
	</form>
</div>

<div>
	<form method="post" action="foodError.php"> 
        <fieldset>
			<legend>Fix Food Entry:</legend>
			<p>Corrected Food Name: <input type="text" name="new_food_name" /></p>
			<p>Incorrect Food Name: <input type="text" name="old_food_name" /></p>      
		</fieldset>
        
        <p><input type="submit" /></p>
	</form>
</div>
    

        <br>          
        <hr>
        <label > Last Section! We always need our database updated! </label>
		<label> Enter food and wine pairings which you believe to work. What do you enjoy? </label>
        <br>          
        <br>  
<div>
	<form method="post" action="twoOfAPair.php"> 
     <fieldset>
	 
	 
			<legend>Food and Wine Pairings:</legend>
			<p>Food Name: <input type="text" name="food_name" /></p>
			<p>Wine Name: <input type="text" name="wine_name" /></p>
		</fieldset>
        
        <p><input type="submit" /></p>
	</form>
</div>   
    
    
    
    
    
    
  </body>
</html>