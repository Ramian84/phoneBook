<?php


$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME, DB_PORT);

if(!$conn) {
	echo "Eroare: Nu a fost posibilă conectarea la MySQL." . PHP_EOL;
    echo "Valoarea errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Valoarea error: " . mysqli_connect_error() . PHP_EOL;
    exit;    
}
?>