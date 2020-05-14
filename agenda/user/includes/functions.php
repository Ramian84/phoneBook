<?php

function checkUserLogin(){
  
  if(!isset($_SESSION['username'])){
      header("Location: login.php");
      die();
    } 
}



function getErrorMessage($messageId){

	    
	    switch($messageId){

	      case '1':
	        $m =  "Ai adaugat un contact nou! <br>";
	      break;

	      case '2':
	        $m =  "Eroare la adaugare Contact Nou <br>";
	      break;
	     
	      case '3':
	        $m =  "Contactul a fost sters cu successss <br>";
	      break;

	      case '4':
	        $m =  "Contactul a fost actualizat cu successss <br>";
	      break;

	      case '5':
	        $m =  "Contactul nu s-a putut sterge <br>";
	      break;

	      case '6':
	        $m =  "Contactul a fost actualizat cu succes! <br>";
	      break;

          case '7':
	        $m =  "Contact could not be updated! <br>";
	      break;
	      
          case '8':
            $m =  "Profile updated! <br>";
          break;
          
          case '9':
              $m =  "There was an error in updating the profile! <br>";
          break;


	      default:
	        $m =  " Don't know the error !!!!" ;	      
	    }

	    return $m;
}


?>

