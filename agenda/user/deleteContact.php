<?php
require_once('includes/config.php');
checkUserLogin();

$id=$_GET['id'];

//FIXME -- verifica daca id-ul de iti vine e al userului logat !!!!!! 
// $actionAuthorID = $_SESSION['userId'];
// $contactAuthorID = select user_id from contcts where id = $id

// if ($contactAtug != $actionAutor ){
// --- problem 

// Validate User with Contact Owner
$actionAuthorId = $_SESSION['id'];
$userId   = $_SESSION['id'];

$contactAuthorId = "SELECT user_id FROM contacts WHERE id=$id";
$contactAuthorIdQuery = mysqli_query($conn,$contactAuthorId);
if(!$contactAuthorIdQuery){
    echo "Error:".mysqli_error($conn);
    
}
$res = mysqli_fetch_assoc($contactAuthorIdQuery);
$contactAuthorIdResult = $res['user_id'];

if($contactAuthorIdResult != $actionAuthorId) {
  
    header("Location: 404.php");
    die();
    
}

if(isset($id) && is_numeric($id)) {
    
	$deleteAddressesString = "DELETE FROM contact_addresses WHERE contact_id=".$id;
	$deletePhonesString    = "DELETE FROM contact_phones WHERE contact_id=".$id;
	$deleteNamesString     = "DELETE FROM contacts WHERE id=".$id;
	
	$errors = 0;
	mysqli_query($conn,"START TRANSACTION;");

	$deleteAddresses = mysqli_query($conn,$deleteAddressesString);
	if(!$deleteAddresses) {
		$errors++;
		echo "Error:".mysqli_error($conn);
		mysqli_query($conn,"ROLLBACK;"); 		  
 	}	

	$deletePhones = mysqli_query($conn,$deletePhonesString);	
	if(!$deletePhones) {
		$errors++;
		echo "Error:".mysqli_error($conn);
		mysqli_query($conn,"ROLLBACK;"); 		  
 	}	


	$deleteNames = mysqli_query($conn,$deleteNamesString);
	if(!$deleteNames) {
		$errors++;
		echo "Error:".mysqli_error($conn);
		mysqli_query($conn,"ROLLBACK;");
		die();
 	}	
	
	mysqli_query($conn,"COMMIT;");	

	$mesajId = 3;
	if ($errors != 0){
		$mesajId=5;
	}

 	header("Location: index.php?mesaj=".$mesajId."&errors=".$errors);
	die();
	
 	// echo "Contactul cu nr " . $id . " a fost sters cu succes.<br>";	
} else {
    echo 'GET NOT SET';
}



?>


