
<?php 

require_once('user/includes/config.php');

if(isset($_POST['submit'])) {
    
   $picture               = $_FILES['image']['name'];
   $temp_location_picture = $_FILES['image']['tmp_name'];
    
}

move_uploaded_file($temp_location_picture, "user/img/$picture");

$uploadPhotoString = "INSERT INTO photos (filename, user_id) VALUES ('$picture', 3)";
$uploadPhotoQuery  =mysqli_query($conn,$uploadPhotoString);
if(!$uploadPhotoQuery) {
    echo "Error: ".mysqli_error($conn);
}


$selectPhotoString = "SELECT * FROM photos";
$selectPhotoQuery  = mysqli_query($conn,$selectPhotoString);

while($row=mysqli_fetch_assoc($selectPhotoQuery)) {
    $picture = $row['filename'];
    echo "<img width='100' src='user/img/$picture'>";
}

?>



<form type="form-control "method="post" action="" enctype="multipart/form-data" >

	<div class="form-control">
		<label> Upload picture </label><br>
		<input type="file" name="image">	
	</div>
	<br><br>
	<div class="form-control">
	 	<input class="btn btn-primary" type="submit" name="submit" value="Upload">	
	</div>
	


</form>