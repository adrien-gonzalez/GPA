<?php

session_start();
require "config.php";

$login=$_POST['login'];
$password=$_POST['password'];
$requete1="SELECT password FROM utilisateurs WHERE login='$login'";
$query= mysqli_query ($base,$requete1);
$resultat=mysqli_fetch_array($query);

if(password_verify($password, $resultat['password']))
{
    $_SESSION['login']=$login;
    $_SESSION['password']=$_POST['password'];
    // header("Location: " . $_SERVER["HTTP_REFERER"]);
} 
else
{ 
    echo "erreur";
}
?>


