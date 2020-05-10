<?php
include('includes/db.php');

if(isset($_POST['submit'])) {

  $id=$_POST['nameId'];
  $firstName=$_POST['firstName'];
  $lastName=$_POST['lastName'];
  $phone=$_POST['telephone'];
  $label=$_POST['label'];
  $street=$_POST['street'];
  $building=$_POST['building'];
  $city=$_POST['cityId'];
  

  $errors = 0;
  mysqli_query($conn, "START TRANSACTION;");


    // if($city=""){
    //  $insertAddressessString = "INSERT INTO addresses (name_id,city_id,street,building) VALUES (".$id.",".$city.",'".$street."', '".$building."');";
    //  $insertAdresses = mysqli_query($conn,$insertAddressessString);
    //    if(!$insertAdresses) {
    //      $errors++;
    //       printf("Error: %s\n", mysqli_error($conn));
    //           mysqli_query($conn,"ROLLBACK;"); 
    //      }
    // } else {

    $updateAddresessString = "UPDATE addresses SET street='$street',building='$building',city_id='$city' WHERE name_id='$id'";
      $updateAdresses = mysqli_query($conn,$updateAddresessString);
        if(!$updateAdresses) {
          $errors++;
           printf("Error: %s\n", mysqli_error($conn));
             mysqli_query($conn,"ROLLBACK;"); 
        }
    // }   

    $updatePhonesString = "UPDATE phones SET `number`='$phone',label='$label' WHERE name_id='$id'";

      $updatePhones= mysqli_query($conn,$updatePhonesString);
      if(!$updatePhones) {
        $errors++;
        printf("Error: %s\n", mysqli_error($conn));
        mysqli_query($conn,"ROLLBACK;"); 
      }
    

    $updateNamesString = "UPDATE names SET first_name='$firstName',last_name='$lastName' WHERE id='$id'";
      $updateNames = mysqli_query($conn,$updateNamesString);
      if(!$updateNames) {
         $errors++;
         printf("Error: %s\n", mysqli_error($conn));
         mysqli_query($conn,"ROLLBACK;");
        }
        
  mysqli_query($conn,"COMMIT;");  
  
  $mesajId = 6;
  if ($errors != 0){
    $mesajId=7;
  }


header("Location: editcontact.php?mesaj=".$mesajId."&errors=".$errors);
die();

}



?>