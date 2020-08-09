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
// lets get all the properties
$sql = "SELECT * FROM properties";
$result = mysqli_query($conn, $sql);

?>
<h2>Property Admin</h2>
<p>Please click <a href="add.php">here</a> to add a new property.</p>
<table border="1">
	<thead>
			<tr>
				<th>uuid</th>
				<th>County</th>
				<th>Country</th>
				<th>Town</th>
				<th>Description</th>
				<th>Full URL</th>
				<th>Address</th>
				<th>Image URL</th>
				<th>Latitude</th>
				<th>Longitude</th>
				<th>No. of bedrooms</th>
				<th>No. of bathrooms</th>
				<th>Price</th>
				<th>Type</th>
				<th>Actions</th>
			</tr>
	</thead>
	<tbody>
<?php		
if (mysqli_num_rows($result) > 0) {
	while($row = mysqli_fetch_assoc($result)) {
		?>
			<tr>
				<td><?php echo $row['uuid'] ?></td>
				<td><?php echo $row['county'] ?></td>
				<td><?php echo $row['country'] ?></td>
				<td><?php echo $row['town'] ?></td>
                <td><?php echo $row['description'] ?></td>
                <td><?php echo $row['url'] ?></td>
                <td><?php echo $row['address'] ?></td>
                <td><?php echo $row['image_full'] ?></td>
                <td><?php echo $row['latitude'] ?></td>
                <td><?php echo $row['longitude'] ?></td>
				<td><?php echo $row['num_bedrooms'] ?></td>
				<td><?php echo $row['num_bathrooms'] ?></td>
				<td><?php echo $row['price'] ?></td>
				<td><?php echo $row['type'] ?></td>
				<td><a href="edit.php?uuid=<?php echo $row['uuid'] ?>">Edit</a>&nbsp;<a href="delete.php?uuid=<?php echo $row['uuid'] ?>" onclick=" return confirm('You sure you want to delete?');">Delete</a></td>
			</tr>		
		<?php
	}
} 
?>
	</tbody>
</table>
<?php

mysqli_close($conn);
?>