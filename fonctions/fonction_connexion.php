


    <?php


    

    session_start();
    $db=mysqli_connect("localhost","root","","projet-pro");
    $login=$_POST['login'];
    $password=$_POST['password'];
    $requete1="SELECT password FROM utilisateurs WHERE login='$login'";
    $query= mysqli_query ($db,$requete1);
	$resultat=mysqli_fetch_array($query);
	if(password_verify($password, $resultat['password']))
{
	
        $_SESSION['message']="vous êtes connecté :)";

    $_SESSION['login']=$login;
    $_SESSION['password']=$_POST['password'];
	echo "ok";
} else{ 
    echo "erreur";
}

    
    






?>


