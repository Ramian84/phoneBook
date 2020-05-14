<?php

require_once 'includes/config.php';
checkUserLogin();

$selectContactsString = "SELECT u.*,c.*,ph.label,ph.number,addr.street,addr.building,cities.name 
                                       FROM `users` AS u
                                       LEFT JOIN contacts AS c ON u.id=c.user_id
                                       LEFT JOIN contact_phones AS ph ON c.id=ph.contact_id
                                       LEFT JOIN contact_addresses AS addr ON c.id=addr.contact_id
                                       LEFT JOIN cities ON addr.city_id=cities.id
                                       WHERE u.id=".$_SESSION['id']."
                                       ORDER BY c.id";;

$selectContactsQuery = mysqli_query($conn, $selectContactsString);

if(!$selectContactsQuery) {
    $message = "Cannot export user";
    die("QUERY FAILED" . mysqli_error($conn));
}

$currentDate = date('Y_m_d_h_i_sa');

$fileName = "export_".$currentDate.".csv";
$myFile = fopen($fileName, "w");


if (!$myFile){
    die("Cannot open file to write");
}

$fileHeader = "id,FirstName,LastName,Telephone,Label,Street,Building,City \r\n";
fwrite($myFile, $fileHeader);



while($res=mysqli_fetch_assoc($selectContactsQuery)) {

    $currentLine  = $res["id"].",".$res["first_name"].",".$res['last_name'].",";
    $currentLine .= $res['number'].",".$res['label'].",";
    $currentLine .= $res['street'].",".$res['building'].",".$res['name']."\r\n";

    fwrite($myFile, $currentLine);
    
}

fclose($myFile);

header('Content-Type: application/csv');
header("Content-Transfer-Encoding: Binary");
header("Content-disposition: attachment; filename=\"" . basename($fileName) . "\"");
readfile($fileName); 


?>