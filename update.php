<?php

error_reporting(E_ALL);
ini_set('display_errors',1);

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mtcmedia";

$property =(object) $_GET;

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "UPDATE properties SET 
		county = '".mysqli_real_escape_string ( $conn ,$property->county)."',
		country = '".mysqli_real_escape_string ( $conn ,$property->country)."',
		town = '".mysqli_real_escape_string ( $conn ,$property->town)."',
		description = '".mysqli_real_escape_string ( $conn ,$property->description)."',
		url = '".mysqli_real_escape_string ( $conn ,$property->uuid)."',
		address = '".mysqli_real_escape_string ( $conn ,$property->address)."',
		image_full = '".mysqli_real_escape_string ( $conn ,$property->image)."',
		image_thumbnail = '".mysqli_real_escape_string ( $conn ,$property->image)."',
		latitude = '".mysqli_real_escape_string ( $conn ,$property->latitude)."',
		longitude = '".mysqli_real_escape_string ( $conn ,$property->longitude)."',
		num_bedrooms = $property->num_bedrooms,
		num_bathrooms = $property->num_bathrooms,
		price = $property->price,
		property_type_id = $property->property_type_id,
		type = '".mysqli_real_escape_string ( $conn ,$property->type)."'
	WHERE 
		uuid = '".mysqli_real_escape_string ( $conn ,$_GET['uuid'])."'";

	echo $sql."<br>";

	if ($conn->query($sql) === TRUE) {
		header('Location: index.php?message=updateSuccess');
	} else {
		header('Location: index.php?message=updateFail&error='.urlencode($conn->error));
	}
	
mysqli_close($conn);
?>