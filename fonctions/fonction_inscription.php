<?php


session_start();
require "config.php";

$genre		= $_POST['genre'];
$nom        = $_POST['nom'];
$prenom     = $_POST['prenom'];
$adresse	= $_POST['adresse'];
$email      = $_POST['email'];
$naissance	= $_POST['naissance'];
$login  	= $_POST['login'];
$password1  = $_POST['password1'];
$password2  = $_POST['password2'];

// CARACTERES NON ACCEPTES
$subject = [$login];
$pattern = '/^[ÀÁÂÃÄÅàáâãäåÒÓÔÕÖØòóôõöøÈÉÊËèéêëÇçÌÍÎÏìíîïÙÚÛÜùúûüÿÑñ]*$/i';
$erreurs = false;

// SECURITE
$genre     = trim(htmlspecialchars($genre));
$nom       = trim(htmlspecialchars($nom));
$prenom    = trim(htmlspecialchars($prenom));
$email     = trim(htmlspecialchars($email));
$naissance = trim(htmlspecialchars($naissance));
$login 	   = trim(htmlspecialchars($login));
$password1 = trim(htmlspecialchars($password1));
$password2 = trim(htmlspecialchars($password2));

// REQUETE LOGIN
$sql_login = "SELECT *FROM utilisateurs WHERE login='$login'";
$req_login = mysqli_query($base, $sql_login);

// REQUETE EMAIL
$sql_email = "SELECT *FROM utilisateurs WHERE email='$email'";
$req_email = mysqli_query($base, $sql_email);


// REGARDE SI LA CHAINE CONTIENT PAS DE CARACTERE(S) NON ACCEPETE
for($i=0; $i < sizeof($subject); $i++)
{
	
	if (preg_match($pattern, $subject[$i], $matches))
	{
    	$erreurs = true;
	}
}
if($erreurs == true)
{	
	$tab_erreur["Character"]="character_not_accepted";
	// echo "character_not_accepted";
}
if (mysqli_num_rows($req_login) > 0)
{	
	$tab_erreur["Login_exist"]="user_already_exist";
	// echo "user_already_exist";
}
if(strlen($login) < 5)
{	
	$tab_erreur["Login_short"]= "user_to_short";
	// echo "user_to_short";
}
if (mysqli_num_rows($req_email) > 0)
{	
	$tab_erreur["Email"]= "email_already_exist";
	// echo "email_already_exist";
}
if(strlen($password1) < 8)
{
	$tab_erreur["Password1"]= "password_to_short";
	// echo "password_to_short";
}
if($password1 != $password2)
{	
	$tab_erreur["Password2"]= "different_password";
	// echo "different_password";
}


if(isset($tab_erreur))
{
	echo json_encode($tab_erreur);
}
else
{
	$password_hash=password_hash($password1, PASSWORD_BCRYPT, ["cost" => 12]);
	$insert="INSERT INTO utilisateurs VALUES (NULL, '$genre', '$nom', '$prenom', '$adresse', '$email', '$naissance', '$login', '$password_hash', '../img/profil/profil_defaut.jpg')";
	mysqli_query($base, $insert);
	echo "ok";
}


?>