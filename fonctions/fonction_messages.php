<?php

session_start();
require "config.php";

$login = $_SESSION['login'];
$req_id_user = "SELECT id FROM utilisateurs WHERE login='$login'";
$execute_req_id_user = mysqli_query($base, $req_id_user);
$resultat_req_id_user = mysqli_fetch_array($execute_req_id_user);
$id = $resultat_req_id_user['id'];

if(isset($_POST['conv_user']))
{
	$login_user_distant = $_POST['conv_user'];
	$req_login_user = "SELECT id FROM utilisateurs WHERE login='$login_user_distant'";
	$execute_req_login_user = mysqli_query($base, $req_login_user);
	$resultat_req_login_user = mysqli_fetch_array($execute_req_login_user);
	$id_user_distant = $resultat_req_login_user['id'];

	$req_messages = "SELECT login, profil, message, date_message FROM utilisateurs, message WHERE id_utilisateur = '$id_user_distant' and id_utilisateur_prive='$id' and utilisateurs.id = id_utilisateur or id_utilisateur_prive='$id_user_distant' and id_utilisateur='$id' and utilisateurs.id = id_utilisateur";
	$execute_req_messages = mysqli_query($base, $req_messages);
	$element=mysqli_num_rows($execute_req_messages);

	if($element > 0)
	{
		$i= 0;
		while($data = mysqli_fetch_assoc($execute_req_messages)) {	
		    $json[] = $data;
			$json[$i]["id_user_on"] = $id;
		    $i ++;
		}
		echo json_encode($json);
	}
}
else
{
	// $req_messages="SELECT  id, id_utilisateur_prive, message, date_message FROM message WHERE id_utilisateur='$id'";
	$req_conv="SELECT message.id, id_utilisateur, id_utilisateur_prive, profil FROM message, utilisateurs WHERE id_utilisateur = '$id' and utilisateurs.id = id_utilisateur_prive or id_utilisateur_prive = '$id' and utilisateurs.id = id_utilisateur GROUP BY id_utilisateur_prive";
	$execute_req_conv=mysqli_query($base, $req_conv);
	$element=mysqli_num_rows($execute_req_conv);


	if($element > 0)
	{
		$i= 0;
		while($data = mysqli_fetch_assoc($execute_req_conv)) {	
		    $json[] = $data;

			$id_utilisateur_prive = $data['id_utilisateur_prive'];
			$id_utilisateur = $data['id_utilisateur'];
			$req_login = "SELECT login FROM utilisateurs WHERE id = '$id_utilisateur_prive'";
			$execute_req_login = mysqli_query($base, $req_login);
			$resultat_req_login = mysqli_fetch_array($execute_req_login);
			$login_user_distant = $resultat_req_login['login'];
			
			if($id != $data['id_utilisateur_prive'])
			{
				$json[$i]["nom"] = $login_user_distant;
			}
			else
			{
				$req_login = "SELECT login FROM utilisateurs WHERE id = '$id_utilisateur'";
				$execute_req_login = mysqli_query($base, $req_login);
				$resultat_req_login = mysqli_fetch_array($execute_req_login);
				$login_user_distant = $resultat_req_login['login'];
				$json[$i]['nom']=$login_user_distant;
			}
			$i++;
		}
			echo json_encode($json);
	}
	else
	{
		echo "0";
	}
}
?>