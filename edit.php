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
$sql = "SELECT * FROM properties WHERE uuid='". $_GET['uuid'] ."'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
	$row = mysqli_fetch_assoc($result);
//print_r($row);

?>
<h2>Edit Property</h2>
<p>Please use the form below to edit a property.</p>
<form action="update.php">
	<input type = "hidden" name="uuid" value="<?php echo $_GET['uuid']; ?>" <br/>
	<label>County</label>
	<input type="text" name="county" value="<?php echo $row['county']; ?>" ><br>
	<label>Country</label>
	<input type="text" name="country" value="<?php echo $row['country']; ?>" ><br>	
	<label>Town</label>
	<input type="text" name="town" value="<?php echo $row['town']; ?>" ><br>	
	<label>Postcode</label>
	<input type="text" name="postcode" value="<?php echo $row['address']; ?>" ><br>	
	<label>Description</label>
	<textarea name="description"><?php echo $row['description']; ?>" </textarea><br>	
	<label>Address</label>
	<input type="text" name="address" value="<?php echo $row['address']; ?>"><br>	
	<label>Image</label>
	<input type="file" name="image" /><br>
	<label>Number of bedrooms</label>
	<select name="num_bedrooms">
		<?php 
		for($i=1;$i<=15;$i++){
		    if($row['num_bedrooms'] == $i){
		 ?>
		        <option value="<?php echo $i; ?>" selected><?php echo $i; ?></option>
         <?php
            }else {
		 ?>
                <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
        <?php
            }
		}
		?>
	</select><br>	
	<label>Number of bathrooms</label>	
	<select name="num_bathrooms">
		<?php 
		for($i=1;$i<=15;$i++) {
            if ($row['num_bathrooms'] == $i) {
                ?>
                <option value="<?php echo $i; ?>" selected><?php echo $i; ?></option>
                <?php
            } else {
                ?>
                <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                <?php
            }
        }
		?>
	</select>
	<br>
	<label>Price</label>	
	<input type="text" name="price" value="<?php echo $row['price']; ?>" ><br>
	<label>Property Type</label>	
	<select name="property_type_id">
		<?php 
		for($i=1;$i<=15;$i++){
			?>
			<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
			<?php
		}
		?>
	</select><br>
	<label>For Sale/ For Rent</label><br>
    <?php
        if($row['type'] == 'sale') {
    ?>
        For Sale <input type="radio" name="type" value="sale" checked/><br>
        For Rent <input type="radio" name="type" value="rent"/><br>
    <?php
        }else{
    ?>
        For Sale <input type="radio" name="type" value="sale"/><br>
        For Rent <input type="radio" name="type" value="rent" checked/><br>
    <?php
        }
    ?>
	<br><input type="submit" name="submit" value="Submit" />
</form>
<?php
}
mysqli_close($conn);
?>