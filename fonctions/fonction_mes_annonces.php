<?php

session_start();
require "config.php";

if(isset($_POST['id_annonce']))
{
	$id_annonce = $_POST['id_annonce'];
	$del_annonce = "DELETE FROM annonce WHERE id = '$id_annonce'";
	mysqli_query($base, $del_annonce);
}
else
{
	$login = $_POST['login'];
	$req_id_user = "SELECT id FROM utilisateurs WHERE login='$login'";
	$execute_req_id_user = mysqli_query($base, $req_id_user);
	$resultat_req_id_user = mysqli_fetch_array($execute_req_id_user);
	$id = $resultat_req_id_user['id'];

	$req_annonces = "SELECT annonce.id, login, profil, type_attestation, region, prix, verif, date_validite FROM annonce INNER JOIN utilisateurs on annonce.id_utilisateur = '$id' and utilisateurs.id = '$id' ORDER BY annonce.id ASC";
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
}
?>