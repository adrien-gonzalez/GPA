<?php

session_start();
require "config.php";

$login = $_POST['login'];
$req_id_user = "SELECT id FROM utilisateurs WHERE login='$login'";
$execute_req_id_user = mysqli_query($base, $req_id_user);
$resultat_req_id_user = mysqli_fetch_array($execute_req_id_user);
$id = $resultat_req_id_user['id'];

$req_annonces = "SELECT annonce.id, login, profil, type_attestation, region, prix, verif, date_annonce FROM annonce INNER JOIN utilisateurs on annonce.id_utilisateur = '$id' and utilisateurs.id = '$id' ORDER BY annonce.id ASC";
$execute_req_annonces = mysqli_query($base, $req_annonces);
$element = mysqli_num_rows($execute_req_annonces);

if($element > 0)
{
	while($data = mysqli_fetch_assoc($execute_req_annonces)){	
	    	$json[] = $data;
	}
	echo json_encode($json);
}
else
{
	echo "0";
}

?>