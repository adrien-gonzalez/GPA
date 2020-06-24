<?php

session_start();
require "config.php";

// REQUETE ID USER
$login = $_SESSION['login'];
$req_user = "SELECT id FROM utilisateurs WHERE login = '$login'";
$execute_req_user = mysqli_query($base, $req_user);
$resultat_req_user = mysqli_fetch_array($execute_req_user);
$id_user = $resultat_req_user['id'];
$id_annonce = $_POST['id_annonce'];

if(isset($_POST['del']))
{
	// DELETE FAVORIS
	$delete_favoris = "DELETE FROM favoris WHERE id_utilisateur = '$id_user' and id_annonce = '$id_annonce'";
	mysqli_query($base, $delete_favoris);
}
else
{
	// ADD FAVORIS
	$add_favoris = "INSERT INTO favoris VALUES (NULL, '$id_annonce', '$id_user')";
	mysqli_query($base, $add_favoris);
}

?>