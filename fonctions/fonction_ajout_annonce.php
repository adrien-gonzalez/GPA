<?php

session_start();
require "config.php";

$type 		= $_POST['type'];
$region 	= str_replace("'", "''", $_POST['region']);
$descriptif = str_replace("'", "''",$_POST['descriptif']);
$tel 		= $_POST['tel'];
$prix		= $_POST['prix'];
$login = $_SESSION['login'];
$disponibilite = $_POST['disponibilite'];
$statut = $_POST['statut'];
$file_name= $_POST['file_name'];

// SELECT ID FROM LOGIN
$req_id_user = "SELECT id FROM utilisateurs WHERE login='$login'";
$execute_req_id_user = mysqli_query($base, $req_id_user);
$result_req_id_user = mysqli_fetch_array($execute_req_id_user);
$id_user = $result_req_id_user['id'];

// INSERT ANNONCE
date_default_timezone_set('Europe/Paris');
$now = new DateTime();
$date=$now->format('Y-m-d'); 

$insert_annonce = "INSERT INTO annonce VALUES (NULL, '$id_user', '$type', '$region', '$descriptif', '$tel', '$prix', '$file_name', '$disponibilite', '$statut', '0','$date', '$date')";
mysqli_query($base, $insert_annonce);

if(isset($_POST['id_avantage']))
{
	// SELECT ID
	$req_id="SELECT id FROM annonce ORDER BY id DESC";
	$execute_req_id=mysqli_query($base, $req_id);
	$result_req_id=mysqli_fetch_array($execute_req_id);
	$id_annonce = $result_req_id['id'];
	$id_avantage = $_POST['id_avantage'];

	date_default_timezone_set('Europe/Paris');
	$now = new DateTime();
	$date=$now->format('Y-m-d'); 

	$insert_avantage = "INSERT INTO avantage VALUES (NULL, '$id_annonce', '$id_avantage', '$date')";
	echo $insert_avantage;
	mysqli_query($base, $insert_avantage);
}
else
{
	echo "ok";
}

?>