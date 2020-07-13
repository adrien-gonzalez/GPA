<?php

session_start();
require "config.php";

if($_POST['attestation'] != null && $_POST['region'] == null)
{
	$attestation = str_replace("'","''",$_POST['attestation']);
	$req_annonces="SELECT annonce.id, profil, nom, prenom, region, type_attestation, tel, email, prix FROM utilisateurs, annonce WHERE id_utilisateur=utilisateurs.id and type_attestation='$attestation'";
	$execute_req_annonces=mysqli_query($base, $req_annonces);
	$element=mysqli_num_rows($execute_req_annonces);
}
else if($_POST['region'] != null && $_POST['attestation'] == null)
{
	$region = str_replace("'","''", $_POST['region']);
	$req_annonces="SELECT annonce.id, profil, nom, prenom, region, type_attestation, tel, email, prix FROM utilisateurs, annonce WHERE id_utilisateur=utilisateurs.id and region='$region'";
	$execute_req_annonces=mysqli_query($base, $req_annonces);
	$element=mysqli_num_rows($execute_req_annonces);
}
else if($_POST['region'] != null && $_POST['attestation'] != null)
{
	$attestation = str_replace("'","''", $_POST['attestation']);
	$region = str_replace("'","''", $_POST['region']);
	$req_annonces="SELECT annonce.id, profil, nom, prenom, region, type_attestation, tel, email, prix FROM utilisateurs, annonce WHERE id_utilisateur=utilisateurs.id and type_attestation='$attestation' and region='$region'";
	$execute_req_annonces=mysqli_query($base, $req_annonces);
	$element=mysqli_num_rows($execute_req_annonces);
}
else
{
	$req_annonces="SELECT annonce.id, profil, nom, prenom, region, type_attestation, tel, email, prix FROM utilisateurs, annonce WHERE id_utilisateur=utilisateurs.id";
	$execute_req_annonces=mysqli_query($base, $req_annonces);
	$element=mysqli_num_rows($execute_req_annonces);
}

if($element > 0)
{
	while($data = mysqli_fetch_assoc($execute_req_annonces)) {	
	    	$json[] = $data;
	}
	echo json_encode($json);
}
else
{
	echo "0";
}
?>