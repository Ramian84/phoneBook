<?php
session_start();
// $pageTitle='Stergere name';
// require_once('header.php');
// require_once('database.php');

$id=$_GET['deleteID'];
if(isset($id)) {

	$deleteAddressesString = "DELETE FROM addresses WHERE name_id=".$id;
	$deletePhonesString = "DELETE FROM phones WHERE name_id=".$id;
	$deleteNamesString = "DELETE FROM names WHERE id=".$id;
	
	$errors = 0;
	mysqli_query($conn,"START TRANSACTION;");

	$deleteAddresses = mysqli_query($conn,$deleteAddressesString);
	if(!$deleteAddresses) {
		$errors++;
		printf("Error: %s\n", mysqli_error($conn));
		mysqli_query($conn,"ROLLBACK;"); 		  
 	}	

	$deletePhones = mysqli_query($conn,$deletePhonesString);	
	if(!$deletePhones) {
		$errors++;
		printf("Error: %s\n", mysqli_error($conn));
		mysqli_query($conn,"ROLLBACK;"); 		  
 	}	


	$deleteNames = mysqli_query($conn,$deleteNamesString);
	if(!$deleteNames) {
		$errors++;
		printf("Error: %s\n", mysqli_error($conn));
		mysqli_query($conn,"ROLLBACK;"); 		  
 	}	
	
	mysqli_query($conn,"COMMIT;");	

	$mesajId = 3;
	if ($errors != 0){
		$mesajId=5;
	}

 	header("Location: deletecontact.php?mesaj=".$mesajId."&errors=".$errors);
	die();
	
 	// echo "Contactul cu nr " . $id . " a fost sters cu succes.<br>";	
} else {
    echo 'GET NOT SET';
}


?>


<?php 
  // require_once('footer.php'); 
?>