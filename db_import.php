<?php

error_reporting(E_ALL);
ini_set('display_errors',1);

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mtcmedia";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

// various functions
function checkProperty($uuid) {
	global $conn;
	$sql = "SELECT uuid FROM properties WHERE uuid='".$uuid."'";
	$result = mysqli_query($conn, $sql);

	if (mysqli_num_rows($result) > 0) {
		while($row = mysqli_fetch_assoc($result)) {
			return true;
		}
	} 

	return false;	
}

function insertProperty($property) {
	global $conn;	
	$sql = "INSERT INTO properties (
		uuid,
		property_type_id,
		county,
		country,
		town,
		description,
		url,
		address,
		image_full,
		image_thumbnail,
		latitude,
		longitude,
		num_bedrooms,
		num_bathrooms,
		price,
		type
	) 
	VALUES (
		'".mysqli_real_escape_string ( $conn ,$property->uuid)."',
		$property->property_type_id,
		'".mysqli_real_escape_string ( $conn ,$property->county)."',
		'".mysqli_real_escape_string ( $conn ,$property->country)."',
		'".mysqli_real_escape_string ( $conn ,$property->town)."',
		'".mysqli_real_escape_string ( $conn ,$property->description)."',
		'".mysqli_real_escape_string ( $conn ,$property->uuid)."',
		'".mysqli_real_escape_string ( $conn ,$property->address)."',
		'".mysqli_real_escape_string ( $conn ,$property->image_full)."',
		'".mysqli_real_escape_string ( $conn ,$property->image_thumbnail)."',
		'".mysqli_real_escape_string ( $conn ,$property->latitude)."',
		'".mysqli_real_escape_string ( $conn ,$property->longitude)."',
		$property->num_bedrooms,
		$property->num_bathrooms,
		$property->price,
		'".mysqli_real_escape_string ( $conn ,$property->type)."'
	)";


	if ($conn->query($sql) === TRUE) {
		echo "New record for Property created successfully<br/>";
	} else {
		echo "<strong>Error: " . $sql . "<br>" . $conn->error."</strong>";
	}

	$sql = "INSERT INTO propertyType (
		id,
		title,
		description
	) 
	VALUES (
		".$property->property_type->id.",
		'".mysqli_real_escape_string ( $conn ,$property->property_type->title)."',
		'".mysqli_real_escape_string ( $conn ,htmlentities ( $property->property_type->description))."'
	)";

	if ($conn->query($sql) === TRUE) {
		echo "New record for Property type created successfully<br/>";
	} else {
		echo "<strong>Error: " . $sql . "<br>" . $conn->error."</strong>";
	}
}

function updateProperty($property) {
	global $conn;	

	$sql = "UPDATE properties SET 
		property_type_id = $property->property_type_id,
		county = '".mysqli_real_escape_string ( $conn ,$property->county)."',
		country = '".mysqli_real_escape_string ( $conn ,$property->country)."',
		town = '".mysqli_real_escape_string ( $conn ,$property->town)."',
		description = '".mysqli_real_escape_string ( $conn ,$property->description)."',
		url = '".mysqli_real_escape_string ( $conn ,$property->uuid)."',
		address = '".mysqli_real_escape_string ( $conn ,$property->address)."',
		image_full = '".mysqli_real_escape_string ( $conn ,$property->image_full)."',
		image_thumbnail = '".mysqli_real_escape_string ( $conn ,$property->image_thumbnail)."',
		latitude = '".mysqli_real_escape_string ( $conn ,$property->latitude)."',
		longitude = '".mysqli_real_escape_string ( $conn ,$property->longitude)."',
		num_bedrooms = $property->num_bedrooms,
		num_bathrooms = $property->num_bathrooms,
		price = $property->price,
		type = '".mysqli_real_escape_string ( $conn ,$property->type)."'
	WHERE 
		uuid = '".mysqli_real_escape_string ( $conn ,$property->uuid)."'";

	if ($conn->query($sql) === TRUE) {
		echo "Record updated for properties successfully<br/>";
	} else {
		echo "Error updating record: " . $conn->error;
	}	
	
	$sql = "
	UPDATE propertyType SET 
		title = '".mysqli_real_escape_string ( $conn ,$property->property_type->title)."',
		description = '".mysqli_real_escape_string ( $conn ,htmlentities ( $property->property_type->description))."'
	WHERE 
		id = ".$property->property_type->id;


	if ($conn->query($sql) === TRUE) {
		echo "Record updated for property type successfully<br/>";
	} else {
		echo "<strong>Error: " . $sql . "<br>" . $conn->error."</strong>";
	}
}

// let's fetch the property api data in order to import it into the db
$url = "http://trialapi.craig.mtcdevserver.com/api/properties?api_key=3NLTTNlXsi6rBWl7nYGluOdkl2htFHug";
$json = file_get_contents($url);
$obj = json_decode($json);
$properties = $obj->data;

// loop over each property record and insert or update it in the db
foreach($properties as $property){
	// check to see if we already have this and need to update or insert it
	if(checkProperty($property->uuid))
		updateProperty($property);
	else
		insertProperty($property);
}
echo "All records done!";
mysqli_close($conn);
?>