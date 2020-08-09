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

$sql = "DELETE FROM properties WHERE uuid = '".mysqli_real_escape_string ( $conn ,$_GET['uuid'])."'";

	if ($conn->query($sql) === TRUE) {
		header('Location: index.php?message=deleteSuccess');
	} else {
		header('Location: index.php?message=deleteFail&error='.urlencode($conn->error));
	}
	
mysqli_close($conn);
?>