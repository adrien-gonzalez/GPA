<?php

session_start();

$nom = $_POST['nom'];
$prenom = $_POST['prenom'];
$message = $_POST['message'];
$email = $_POST['email'];
$sujet = $_POST['sujet'];
$msg = $email."\n".$nom." ".$prenom."\n\n".$message;

// send email
mail("adrien.gonzalez@laplateforme.io", $sujet ,$msg);
?>

