<?php

session_start();
require "../../fonctions/config.php";

$login=$_POST['login'];
$password=$_POST['password'];
$requete1="SELECT password FROM admin WHERE login='$login'";
$query= mysqli_query ($base,$requete1);
$resultat=mysqli_fetch_array($query);

if(password_verify($password, $resultat['password']))
{
    $_SESSION['admin']=$login;
    $_SESSION['password']=$_POST['password'];
} 
else
{ 
    echo "erreur";
}
?>


