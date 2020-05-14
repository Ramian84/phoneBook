<?php

include('includes/config.php');
checkUserLogin();

if(isset($_POST['submit'])) {

  $id       =$_POST['nameId'];
  $firstName=$_POST['firstName'];
  $lastName =$_POST['lastName'];
  $phone    =$_POST['telephone'];
  $label    =$_POST['label'];
  $street   =$_POST['street'];
  $building =$_POST['building'];
  $city     =$_POST['cityId'];
  

  $errors = 0;
  
  mysqli_query($conn, "START TRANSACTION;");

  $updateContactAddresessString = "UPDATE contact_addresses SET street='$street',building='$building',city_id='$city' WHERE contact_id='$id'";
  $updateContactAdresses = mysqli_query($conn,$updateContactAddresessString);
  if(!$updateContactAdresses) {
           $errors++;
           echo "Error: ".mysqli_error($conn);
           mysqli_query($conn,"ROLLBACK;"); 
        }
  

  $updateContactPhonesString = "UPDATE contact_phones SET `number`='$phone',label='$label' WHERE contact_id='$id'";

  $updateContactPhones= mysqli_query($conn,$updateContactPhonesString);
  if(!$updateContactPhones) {
        $errors++;
        echo "Error: ".mysqli_error($conn);
        mysqli_query($conn,"ROLLBACK;"); 
      }
    

  $updateContactsString = "UPDATE contacts SET first_name='$firstName',last_name='$lastName' WHERE id='$id'";
  
  $updateContacts = mysqli_query($conn,$updateContactsString);
  if(!$updateContacts) {
         $errors++;
         echo "Error: ".mysqli_error($conn);
         mysqli_query($conn,"ROLLBACK;");
        }
        
  mysqli_query($conn,"COMMIT;");  
  
  $mesajId = 6;
  if ($errors != 0){
    $mesajId=7;
  }

 header("Location: index.php?mesaj=".$mesajId."&errors=".$errors);
 die();

}



?>