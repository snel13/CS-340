<?php
//Turn on error reporting
ini_set('display_errors', 'On');
//Connects to the database
$mysqli = new mysqli("oniddb.cws.oregonstate.edu","lallyk-db","2eAZ1GEvgLgqcnDe","lallyk-db");
if($mysqli->connect_errno){
	echo "Connection error " . $mysqli->connect_errno . " " . $mysqli->connect_error;
	}
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
   <head>
	 <meta charset="utf-8"/>
	
	 <link rel="stylesheet" type="text/css" href="foodWineDB.css" />

	
   </head>
<body>
     
   <legend class="topLabel"> Perfect Match: A food and wine pairing application     </legend>
        
        <br>
        <hr>

<!-- ------------------------------------ this starts the section for food search  ---------------------------->                     
                
                             
    <label >Find food suggestions for your wine:</label>
        <br>          
        <br>
               
<!-- -----------------------------------  searching for food by wine name ------------------------------------->                 
<!-- -----------------------------  populating select drop down menu for wines--------------------------------->               
                  
<div>
	<form method="get" action="wineSelect.php">
            <fieldset>
			<legend > Search for pairs by your wine name: </legend>
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
     	
    <p><input type="submit" value="Find Food"/></p>
	</form>
</div>           

   
<!-- ----------------------------------  searching for food by wine type ------------------------------------->        
        <br>
        <br>
                      
<div>
	<form method="get" action="wine-typeSelect.php">
            <fieldset>
			<legend>Search for pairs by your wine type: </legend>

		
			<p>Wine Type: <input type="text" name="wine_type" /></p>
			<p> <strong>Wine Types include:</strong> Bold Red, Medium Red, Light Red, Rose, Rich White,  Light White, Sparkling, Sweet White and Dessert  </p>
	
                    
		   </fieldset>
     	
    <p><input type="submit" value="Find Food"/></p>
	</form>
</div>           
          
     
        <br>          
         
              
<!-- --------------------------------- this starts the section for wine search  ------------------------------->  
         
    <br>
    <hr>
<!-- ------------------------------------ searching for wine by food name ------------------------------------->  
        <label>Find wine suggestions for your menu:</label>
        <br>          
        <br>      
                   
<div>
	<form method="get" action="foodSelect.php">
            <fieldset>
			<legend>Search for pairs by food name: </legend>
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
      
<!-- ---------------------------------- searching for wine by two food names -------------------------------->     
      
        <br>
        <br>
                      
<div>
	<form method="get" action="two-foodSelect.php">
            <fieldset>
			<legend>Search for pairs by two food names: </legend>

		
			<p>Name 1: <input type="text" name="food_one" /></p>
			<p>Name 2: <input type="text" name="food_two" /></p>
            <p> You can use the scroll down above for food name reference  </p>
	
                    
		    </fieldset>
     	
       
          <p><input type="submit" value="Find Wine"/></p>
	</form>
</div> 
      
    
<!-- ------------------------------------ adding to our database ----------------------------------------- -->   
       
    <br>
    <hr>
<!-- ------------------------------------- insert wine section ------------------------------------------- -->
             
       
        <label >Can't find your wine? Input it into our database!</label>
        <br>          
        <br>  
<div>
	<form method="post" action="addWine.php"> 

<!-- ----------------------------------- insert wine name and type -------------------------------------- -->
        <fieldset>
			<legend>Input New Wine:</legend>
			<p>Wine Name: <input type="text" name="name" /></p>
			<p>Wine Type: <input type="text" name="wine_type" /></p>
		</fieldset>
<!-- ------------------------------------- insert wine region ------------------------------------------- -->
		<fieldset>
			<legend>Region</legend>
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
	
<!-- ------------------------------------- insert grape variety ------------------------------------------- -->

        <fieldset>
			<legend>Grape Variety</legend>
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
        
<!-- ------------------------------------- insert temperature ------------------------------------------- -->
        
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

<!-- ------------------------------------- insert food section ------------------------------------------- -->
        <br>          
        <br>
        <label >Can't find your food? Input it into our database!</label>
        <br>          
        <br>  
<div>
	<form method="post" action="addFood.php"> 

<!-- ----------------------------------- insert food name, category and type -------------------------------------- -->
        <fieldset>
			<legend>Input New Food:</legend>
			<p>Food Name: <input type="text" name="name" /></p>
			<p>Main Food Category: <input type="text" name="food_category" /></p>
            <p>Category Type: <input type="text" name="category_type" /></p>
		</fieldset>
        
        <p><input type="submit" /></p>
	</form>
</div>
      
<!-- ----------------------------------- update food or wines -------------------------------------- -->      
    
        <br>          
        <hr>
        <label >Did you make a mistake inputing your food or wine? Fix it!</label>
        <br>          
        <br>  
<!-- ----------------------------------- update food -------------------------------------- -->
<div>
	<form method="post" action="fixFood.php"> 
        <fieldset>
			<legend>Fix Food Entry:</legend>
			<p>Corrected Food Name: <input type="text" name="new_food_name" /></p>
			<p>Old Name: <input type="text" name="old_food_name" /></p>      
		</fieldset>
        
        <p><input type="submit" /></p>
	</form>
</div>
    
<!-- ----------------------------------- update wine -------------------------------------- -->
<div>
	<form method="post" action="fixWine.php"> 
        <fieldset>
			<legend>Fix Wine Entry:</legend>
			<p>Corrected Wine Name: <input type="text" name="new_wine_name" /></p>
			<p>Old Name: <input type="text" name="old_wine_name" /></p>      
		</fieldset>
        
        <p><input type="submit" /></p>
	</form>
</div>
     
 <!-- ------------------------------------- insert new pairs section ------------------------------------------- -->
     
  
        <br>          
        <hr>
        <label > Enter new food and wine pairs into our database!</label>
        <br>          
        <br>  
<div>
	<form method="post" action="addPair.php"> 

<!-- ----------------------------------- insert food name, category and type -------------------------------------- -->
        <fieldset>
			<legend>New Pair:</legend>
			<p>Food Name: <input type="text" name="food_name" /></p>
			<p>Wine Name: <input type="text" name="wine_name" /></p>
		</fieldset>
        
        <p><input type="submit" /></p>
	</form>
</div>   
    
    
    
    
    
    
  </body>
</html>