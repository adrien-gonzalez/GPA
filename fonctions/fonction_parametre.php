<?php

session_start();
require "config.php";

$login = $_SESSION['login'];

if(isset($_POST['nom']))
{
	$nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
   	$adresse = $_POST['adresse'];
    $login = $_POST['login'];
    $naissance = $_POST['naissance'];
    $genre = $_POST['genre'];

    $update_info = "UPDATE utilisateurs SET nom = '$nom', prenom = '$prenom', adresse = '$adresse', naissance = '$naissance', genre = '$genre' WHERE login = '$login'";
    mysqli_query($base, $update_info);
}
else if(isset($_POST['email']) && isset($_POST['password']))
{

	$email = $_POST['email'];
	$password = $_POST['password'];

	$req_user = "SELECT password FROM utilisateurs WHERE login ='$login'";
	$execute_req_user = mysqli_query($base, $req_user);
	$resultat_req_user = mysqli_fetch_array($execute_req_user);

	if(password_verify($password, $resultat_req_user['password']))
	{
		$update_user = "UPDATE utilisateurs set email = '$email' WHERE login ='$login'";
		mysqli_query($base, $update_user);
	}
	else
	{
		echo "wrong_pass";
	}
}
else if(isset($_POST['password_update']))
{
	$password_update = $_POST['password_update'];
	$password2 = $_POST['password2'];

	$req_user = "SELECT password FROM utilisateurs WHERE login ='$login'";
	$execute_req_user = mysqli_query($base, $req_user);
	$resultat_req_user = mysqli_fetch_array($execute_req_user);

	if(password_verify($password2, $resultat_req_user['password']))
	{
		$new_password = password_hash($password_update, PASSWORD_BCRYPT, ["cost" => 12]);
		$update_user = "UPDATE utilisateurs set password = '$new_password' WHERE login ='$login'";
		mysqli_query($base, $update_user);
	}
	else
	{
		echo "wrong_pass";
	}
}
else if(isset($_POST['delete_account']))
{	
	$req_id = "SELECT * FROM utilisateurs WHERE login='$login'";
	$execute_req_id = mysqli_query($base, $req_id);
	$resultat_req_id = mysqli_fetch_array($execute_req_id);
	$id = $resultat_req_id['id'];
	$profil = $resultat_req_id['profil'];

	if($profil != "profil_defaut.png")
	{
		unlink("../img/profil/".$profil);
	}

	// DELETE ANNONCE
	$req_delete_annonce = "DELETE FROM annonce WHERE id_utilisateur = '$id'";
	mysqli_query($base, $req_delete_annonce);

	// DELETE USER
	$req_delete = "DELETE FROM utilisateurs WHERE login = '$login'";
	mysqli_query($base, $req_delete);
}
?>