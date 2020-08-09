<?php

error_reporting(E_ALL);
ini_set('display_errors',1);

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mtcmedia";

$uuid = md5(date('Ymdhisu'));

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$image_full = '';
if(isset($_FILES['image']['name'])){
    $image_full = $_FILES['image']['name'];
}

$sql = "INSERT INTO properties (
		uuid,
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
		property_type_id,
		type
	) 
	VALUES (
		'".mysqli_real_escape_string ( $conn ,$uuid)."',
		'".mysqli_real_escape_string ( $conn ,$_POST['county'])."',
		'".mysqli_real_escape_string ( $conn ,$_POST['country'])."',
		'".mysqli_real_escape_string ( $conn ,$_POST['town'])."',
		'".mysqli_real_escape_string ( $conn ,$_POST['description'])."',
		'".mysqli_real_escape_string ( $conn ,$_POST['url'])."',
		'".mysqli_real_escape_string ( $conn ,$_POST['address'])."',
		'".mysqli_real_escape_string ( $conn ,$image_full)."',
		'".mysqli_real_escape_string ( $conn ,$image_full)."',
		'".mysqli_real_escape_string ( $conn ,$_POST['latitude'])."',
		'".mysqli_real_escape_string ( $conn ,$_POST['longitude'])."',
		'".$_POST['num_bedrooms']."',
		'".$_POST['num_bathrooms']."',
		'".$_POST['price']."',
		'".$_POST['property_type_id']."',
		'".mysqli_real_escape_string ( $conn ,$_POST['type'])."'
	)";

	//echo $sql."<br>";

	if ($conn->query($sql) === TRUE) {
		header('Location: index.php?message=addSuccess');
	} else {
		header('Location: index.php?message=addFail&error='.urlencode($conn->error));
	}
	
mysqli_close($conn);
?>