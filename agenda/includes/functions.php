<?php

function checkUserLogin(){
  
  if(!isset($_SESSION['username'])){
      header("Location: login.php");
      die();
    } 
}


function displayErrorMessage($messageId){

	    
	    switch($messageId){

	      case '1':
	        $m =  "Ai adaugat un contact nou! <br>";
	      break;

	      case '2':
	        $m =  "Eroare la adaugare user <br>";
	      break;
	     
	      case '3':
	        $m =  "Contactul a fost sters cu successss <br>";
	      break;

	      case '4':
	        $m =  "Contactul a fost actualizat cu successss <br>";
	      break;

	      case '5':
	        $m =  "Usersul nu s-a putut sterge <br>";
	      break;

	      case '6':
	        $m =  "Usersul a fost actualizat cu succes! <br>";
	      break;

          case '7':
	        $m =  "Usersul nu a putut fi actualizat! <br>";
	      break;


	      default:
	        $m =  "Nu stiu ce plm eroare e asta !!!!" ;	      
	    }

	    return $m;
}


?>

