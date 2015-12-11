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
<div>
	<table>
	  <tr>
			   <td>Wine</td>
		   </tr>
		       <tr>
			       <td>Type</td>
			       <td>Name</td>
			
		  </tr>
<?php
if(!($stmt = $mysqli->prepare("SELECT wine.wine_type, wine.name FROM wine INNER JOIN pair ON wine.id=pair.wine_id
INNER JOIN food ON food.id=pair.food_id
WHERE food.id = ?"))){
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}

if(!($stmt->bind_param("i",$_GET['food']))){
	echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
}

if(!$stmt->execute()){
	echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
if(!$stmt->bind_result($type, $name)){
	echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
while($stmt->fetch()){
 echo "<tr>\n<td>\n" . $type . "\n</td>\n<td>\n" . $name . "\n</td>\n</tr>";
}
$stmt->close();
?>
	</table>
</div>

    	<div class="button"><a href="food-wine-DB-main.php">Return To Main Page</a></div>
    
</body>
</html>