<?php

error_reporting(E_ALL);
ini_set('display_errors',1);
?>
<h2>Add Property</h2>
<p>Please use the form below to add a property.</p>
<form action="insert.php" method="post" enctype="multipart/form-data">
	<label>County</label>
	<input type="text" name="county" /><br>
	<label>Country</label>
	<input type="text" name="country" /><br>	
	<label>Town</label>
	<input type="text" name="town" /><br>	
	<label>URL</label>
	<input type="text" name="url" /><br>
	<label>Address</label>
	<textarea name="address"></textarea><br>
    <label>Description</label>
    <textarea name="description"></textarea><br>
	<label>Image</label>
	<input type="file" name="image" /><br>
    <label>Latitude</label>
    <input type="text" name="latitude" /><br>
    <label>Longitude</label>
    <input type="text" name="longitude" /><br>
	<label>Number of bedrooms</label>
	<select name="num_bedrooms">
		<?php 
		for($i=1;$i<=10;$i++){
			?>
		<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
			<?php
		}
		?>
	</select><br>	
	<label>Number of bathrooms</label>	
	<select name="num_bathrooms">
		<?php 
		for($i=1;$i<=10;$i++){
			?>
			<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
			<?php
		}
		?>
	</select>
	<br>
	<label>Price</label>	
	<input type="text" name="price" /><br>
	<label>Property Type by Id</label>
	<select name="property_type_id">
		<?php 
		for($i=1;$i<=30;$i++){
			?>
			<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
			<?php
		}
		?>
	</select><br>
	<label>For Sale/ For Rent</label><br>
	For Sale <input type="radio" name="type" value="sale" /><br>
	For Rent <input type="radio" name="type" value="rent" /><br>
	
	<br><input type="submit" name="submit" value="Submit" />
</form>