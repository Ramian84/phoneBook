<?php


$conn = mysqli_connect('localhost', 'root', '', 'agenda');

if(!$conn) {
	echo "Eroare: Nu a fost posibilă conectarea la MySQL." . PHP_EOL;
    echo "Valoarea errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Valoarea error: " . mysqli_connect_error() . PHP_EOL;
    exit;    
} 

?>