<?php

include('includes/config.php');
checkUserLogin();

if(isset($_POST['editUserDetails'])) {

  $id       =$_POST['userId'];
  $firstName=$_POST['firstName'];
  $lastName =$_POST['lastName'];
  $email    =$_POST['email'];
  $phone    =$_POST['phone'];
  
  

  $errors = 0;
  
  mysqli_query($conn, "START TRANSACTION;");

  $updateUserDetailsString = "UPDATE users_details SET
                                     first_name='$firstName',
                                     last_name='$lastName',
                                     phone='$phone',email='$email' 
                                     WHERE id='$id'";
  $updateUserDetailsQuery = mysqli_query($conn,$updateUserDetailsString);
  if(!$updateUserDetailsQuery) {
           $errors++;
           echo "Error: ".mysqli_error($conn);
           mysqli_query($conn,"ROLLBACK;"); 
        }
        
  mysqli_query($conn,"COMMIT;");  
  
  $mesajId = 8;
  if ($errors != 0){
    $mesajId=9;
  }

 header("Location: profile.php?mesaj=".$mesajId."&errors=".$errors);
 die();

}



?>