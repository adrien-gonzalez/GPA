<?php

session_start();
require "../../fonctions/config.php";
require "../../stripe-php/init.php";

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
	date_default_timezone_set('Europe/Paris');
	$now = new DateTime();
	$date_annonce = $now->format('Y-m-d'); 

	$id_annonce_validate = $_POST['id_annonce_validate'];
	$req_annonce_validate = "UPDATE annonce SET verif = '1', date_annonce = '$date_annonce' WHERE id = '$id_annonce_validate'";
	mysqli_query($base, $req_annonce_validate);
	
$sujet = "Annonce déposée";
$email = $_POST['email'];
$header="MIME-Version: 1.0\r\n";
$header.='From:"[GPA]"<adrien1361@mail.com>'."\n";
$header.='Content-Type:text/html; charset="utf-8"'."\n";
$header.='Content-Transfer-Encoding: 8bit';
$message = '
                                 <html>
                                 <head>
                                   <title>GPA</title>
                                   <meta charset="utf-8" />
                                 </head>
                                 <body>
                                   <font color="#303030";>
                                     <div align="center">
                                       <table width="600px">
                                         <tr>
                                           <td>
                                             <div align="center">Bonjour, votre annonce a été acceptée et postée !</div><br>
                                             <div align="center"><a href="https://adrien-gonzalez.students-laplateforme.io/gpa">Revenir sur le site</a></div>
                                           </td>
                                         </tr>
                                         <tr>

                                         </tr>
                                       </table>
                                     </div>
                                   </font>
                                 </body>
                                 </html>
                                 ';

// send email
mail($email, $sujet ,$message, $header);


}
else if(isset($_POST['id_annonce_delete']) && isset($_POST['note'])){

	$id_annonce_delete = $_POST['id_annonce_delete'];
	$note = $_POST['note'];
	$req_annonce_delete = "DELETE FROM annonce WHERE id = '$id_annonce_delete'";
	mysqli_query($base, $req_annonce_delete);
	
$sujet = "Annonce refusée";
$email = $_POST['email'];
$header="MIME-Version: 1.0\r\n";
$header.='From:"[GPA]"<adrien1361@mail.com>'."\n";
$header.='Content-Type:text/html; charset="utf-8"'."\n";
$header.='Content-Transfer-Encoding: 8bit';
$message = '
                                 <html>
                                 <head>
                                   <title>GPA</title>
                                   <meta charset="utf-8" />
                                 </head>
                                 <body>
                                   <font color="#303030";>
                                     <div align="center">
                                       <table width="600px">
                                         <tr>
                                           <td>
                                             <div align="center">Bonjour, votre annonce a été refusée !</div><br>
                                             <div align="center">'.$note.'</div><br><br>
                                              <div align="center"><a href="https://adrien-gonzalez.students-laplateforme.io/gpa">Revenir sur le site</a></div>
                                           </td>
                                         </tr>
                                         <tr>
                                         </tr>
                                       </table>
                                     </div>
                                   </font>
                                 </body>
                                 </html>
                                 ';

// send email
mail($email, $sujet ,$message, $header);
}
else if(isset($_POST['id_user'])){

	$id_user= $_POST['id_user'];
	$req_user = "SELECT *FROM utilisateurs WHERE id='$id_user'";
	$execute_req_user = mysqli_query($base, $req_user);
	$element=mysqli_num_rows($execute_req_user);
	$email = $_POST['email'];

	if($element > 0)
	{
		while($data = mysqli_fetch_assoc($execute_req_user)) {	
		    $json[] = $data;
		}
	}

	$if_ban = "SELECT *FROM ban WHERE id_utilisateur = '$id_user'";
	$execute_if_ban = mysqli_query($base, $if_ban);
	$rowCount = mysqli_num_rows($execute_if_ban);

	if($rowCount != 0)
	{
		$json[0]["ban"]="oui";
	}
	else
	{
		$json[0]["ban"]="non";
	}
	echo json_encode($json);
}
else if(isset($_POST['id_user_ban'])) {

	$id_user_ban = $_POST['id_user_ban'];
	$verif_ban = "SELECT *FROM ban WHERE id_utilisateur = '$id_user_ban'";
	$execute_verif_ban = mysqli_query($base, $verif_ban);
	$verif = mysqli_num_rows($execute_verif_ban);

	if($verif != 0)
	{
		$deban = "DELETE FROM ban WHERE id_utilisateur='$id_user_ban'";
		mysqli_query($base, $deban);
	}
	else
	{
		date_default_timezone_set('Europe/Paris');
		$now = new DateTime();
		$date_ban=$now->format('Y-m-d'); 

		$req_user_ban = "INSERT INTO ban VALUES (NULL, '$id_user_ban', '$date_ban')";
		mysqli_query($base, $req_user_ban);	
	}	
}
else if(isset($_POST['id_user_ban_perm'])) {

	$id_user_ban_perm = $_POST['id_user_ban_perm'];
	$ban_perm = "DELETE FROM utilisateurs WHERE id='$id_user_ban_perm'";
	mysqli_query($base, $deban);
}
else if(isset($_POST['new_login']))
{	
	$login = $_POST['login'];
	$new_login = $_POST['new_login'];
	$password = $_POST['password'];

	$req_admin = "SELECT password FROM admin WHERE login ='$login'";
	$execute_req_admin = mysqli_query($base, $req_admin);
	$resultat_req_admin = mysqli_fetch_array($execute_req_admin);

	if(password_verify($password, $resultat_req_admin['password']))
	{
		$update_admin = "UPDATE admin set login = '$new_login' WHERE login ='$login'";
		mysqli_query($base, $update_admin);
		$_SESSION['admin'] = $new_login;
	}
	else
	{
		echo "wrong_pass";
	}
}
else if(isset($_POST['new_pass']))
{
	$login = $_POST['login'];
	$new_pass = $_POST['new_pass'];
	$password = $_POST['password'];

	$req_admin = "SELECT password FROM admin WHERE login ='$login'";
	$execute_req_admin = mysqli_query($base, $req_admin);
	$resultat_req_admin = mysqli_fetch_array($execute_req_admin);

	if(password_verify($password, $resultat_req_admin['password']))
	{
		$new_pass = password_hash($new_pass, PASSWORD_BCRYPT, ["cost" => 12]);
		$update_admin = "UPDATE admin set password = '$new_pass' WHERE login ='$login'";
		mysqli_query($base, $update_admin);
	}
	else
	{
		echo "wrong_pass";
	}
}
else if(isset($_POST['nom_produit']) && isset($_POST['description_produit']) && isset($_POST['prix']))
{
	$nom_produit = $_POST['nom_produit'];
	$description_produit = $_POST['description_produit'];
	$prix = $_POST['prix'];
	$categorie = $_POST['categorie'];

	if($_POST['duree'] != false)
	{
		$duree = $_POST['duree'];
	}
	else
	{
		$duree = 0;
	}

	$stripe = new \Stripe\StripeClient(
  	'sk_test_51H2BsNKouFi2buoUWmyNEiPXAfPA7hNDpZH6vbsPJ8cWRnWESRXEZCR8p1qSUS1RdEKq35YnFy68eZ4fygBYmSUf00kTzuIVfe'
	);
	
	// CREER UN PRODUIT
	$product = $stripe->products->create([
	  'name' => $nom_produit,
	  'description' => $description_produit,
	  ['metadata' => ['categorie' => $categorie]],
	]);

	$id_produit = $product['id'];

	// REQUETE INSERT PRODUIT
	$insert_produit = "INSERT INTO services VALUES (NULL, '$id_produit', '$nom_produit', '$description_produit', '$prix', '$categorie', '$duree')";
	mysqli_query($base, $insert_produit);

}
else if(isset($_POST['id_produit']))
{
	$id_produit = $_POST['id_produit'];

	$info_produit = "SELECT *FROM services WHERE id='$id_produit'";
	$execute_info_produit = mysqli_query($base, $info_produit);
	$element = mysqli_num_rows($execute_info_produit);

	if($element > 0)
	{
		while($data = mysqli_fetch_assoc($execute_info_produit)) {	
		    $json[] = $data;
		}
		echo json_encode($json);
	}	
}
else if(isset($_GET['update_nom']) && isset($_GET['update_prix']) && isset($_GET['update_description']) && isset($_GET['id_produit']))
{
	$nom = $_GET['update_nom'];
	$prix_update = $_GET['update_prix'];
	$description = $_GET['update_description'];
	$id_produit = $_GET['id_produit'];

	$stripe = new \Stripe\StripeClient(
  		'sk_test_51H2BsNKouFi2buoUWmyNEiPXAfPA7hNDpZH6vbsPJ8cWRnWESRXEZCR8p1qSUS1RdEKq35YnFy68eZ4fygBYmSUf00kTzuIVfe'
	);

	$stripe->products->update(
	  $id_produit,
	  ['name' => $nom]
	);

	$stripe->products->update(
	  $id_produit,
	  ['description' => $description]
	);

	$update_produit = "UPDATE services SET nom = '$nom', description = '$description', prix = '$prix_update' WHERE id_produit = '$id_produit'";
	mysqli_query($base, $update_produit);
}
else if(isset($_GET['id_product_delete']))
{
	$id_product_delete = $_GET['id_product_delete'];

	$stripe = new \Stripe\StripeClient(
	  'sk_test_51H2BsNKouFi2buoUWmyNEiPXAfPA7hNDpZH6vbsPJ8cWRnWESRXEZCR8p1qSUS1RdEKq35YnFy68eZ4fygBYmSUf00kTzuIVfe'
	);


	$stripe->products->delete(
  	$id_product_delete,
	  []
	);

	$delete_produit = "DELETE FROM services WHERE id_produit = '$id_product_delete'";
	mysqli_query($base, $delete_produit);
}
else if(isset($_GET['id_paiement']))
{
	$id_paiement = $_GET['id_paiement'];

	$stripe = new \Stripe\StripeClient(
  		'sk_test_51H2BsNKouFi2buoUWmyNEiPXAfPA7hNDpZH6vbsPJ8cWRnWESRXEZCR8p1qSUS1RdEKq35YnFy68eZ4fygBYmSUf00kTzuIVfe'
	);

	$info = $stripe->charges->retrieve(
	  $id_paiement,
	  []
	);

	echo '['.json_encode($info).']';
}
else if(isset($_POST['id_paiement_rembouser']))
{

	$remboursement = $_POST['id_paiement_rembouser'];

	$stripe = new \Stripe\StripeClient(
  		'sk_test_51H2BsNKouFi2buoUWmyNEiPXAfPA7hNDpZH6vbsPJ8cWRnWESRXEZCR8p1qSUS1RdEKq35YnFy68eZ4fygBYmSUf00kTzuIVfe'
	);
	$stripe->refunds->create([
	  'charge' => $remboursement,
	]);
}
?>