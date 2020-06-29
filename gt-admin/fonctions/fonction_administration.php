<?php

session_start();
require "../../fonctions/config.php";

if(isset($_POST['id_annonce']))
{
	$id_annonce = $_POST['id_annonce'];
	$req_annonce = "SELECT annonce.id as annonce_id, type_attestation, region, prix, descriptif, document, login, nom, prenom  FROM annonce INNER JOIN utilisateurs on utilisateurs.id = id_utilisateur WHERE annonce.id = '$id_annonce'";
	$execute_req_annonce = mysqli_query($base, $req_annonce);
	$element=mysqli_num_rows($execute_req_annonce);

	if($element > 0)
	{
		while($data = mysqli_fetch_assoc($execute_req_annonce)) {	
		    $json[] = $data;
		}
		echo json_encode($json);
	}
}
else if(isset($_POST['id_annonce_validate']))
{
	$id_annonce_validate = $_POST['id_annonce_validate'];
	$req_annonce_validate = "UPDATE annonce SET verif = '1' WHERE id = '$id_annonce_validate'";
	mysqli_query($base, $req_annonce_validate);
}
else if(isset($_POST['id_annonce_delete'])){

	$id_annonce_delete = $_POST['id_annonce_delete'];
	$req_annonce_delete = "DELETE FROM annonce WHERE id = '$id_annonce_delete'";
	mysqli_query($base, $req_annonce_delete);
}
?>