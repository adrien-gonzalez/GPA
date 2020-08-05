<!DOCTYPE html>
<?php
session_start();
require "../fonctions/config.php"; 
require "../stripe-php/init.php";
?>

<script>
	if(localStorage.getItem("option") == null)
    {
	    document.location.href="../"
	}
	else
	{
	   	localStorage.removeItem('option');
	}
	</script>
<?php

\Stripe\Stripe::setApiKey("sk_test_51H2BsNKouFi2buoUWmyNEiPXAfPA7hNDpZH6vbsPJ8cWRnWESRXEZCR8p1qSUS1RdEKq35YnFy68eZ4fygBYmSUf00kTzuIVfe");

$token  = $_POST['stripeToken'];
$email  = $_POST['stripeEmail'];
$prix = $_POST['prix'];
$description = $_POST['description'];
$id = $_POST['id'];

$customer = \Stripe\Customer::create(array(
  'email' => $email,
  'source'  => $token
));

$charge = \Stripe\Charge::create(array(
  'customer' => $customer->id,
  'amount'   => $prix*100,
  'currency' => 'eur',
  'description' => $description,
  'receipt_email' => $email
));

if(isset($_POST['contrat']) && $charge != null)
{
	$login = $_SESSION['login'];
	$req_id_user = "SELECT id FROM utilisateurs WHERE login='$login'";
	$execute_id_user = mysqli_query($base, $req_id_user);
	$resultat_id_user = mysqli_fetch_array($execute_id_user);
	$id = $resultat_id_user['id'];

	$insert_contrat = "INSERT INTO contrat VALUES(NULL,'$id')";
	mysqli_query($base, $insert_contrat);
	$_SESSION['contrat'] = true;
}
?> 



<html>
	<head>
		<title>Global Prestations Annexes</title>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=0.7">
		<!-- MON SCRIPT -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
        <script type="text/javascript" src="../js/annonce/paiement.js"></script>
		<!-- CSS -->
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
		<link href="../css/style.css" rel="stylesheet">
	</head>

<body class="paiement">
	<section>
		<div class="paiement_accepted">
			<?php
			
			if($charge != null)
			{	
			?>	
				<input id="id_avantage" value="<?php echo $id?>" type="hidden">
				<div class="alert alert-success w-100" role="alert">
					<h4 class="alert-heading">Paiement accepté !</h4>
					<hr>
					<div class="d-flex justify-content-between">
						<p>Merci pour votre achat !</p>
						<a href="../"><button class="button_design">Retourner sur le site</button></a>
					</div>
			 	</div>
			<?php
			}
			else
			{
			?>
				<div class="alert alert-danger w-100" role="alert">
					<h4 class="alert-heading">Paiement refusé !</h4>
					<hr>
					<div class="d-flex justify-content-between">
						<p>Une erreur s'est produite, veuillez rééssayer plus tard</p>
						<a href="../"><button class="button_design">Retourner sur le site</button></a>
					</div>
			 	</div>
			<?php
			}
			?>
		</div>
	</section>
</body>
</html>