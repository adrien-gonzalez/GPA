<?php
require "../stripe-php/init.php";
?>

<script>
    if(sessionStorage.getItem("option") == null)
    {
        document.location.href="../"
    }
</script>

<?php
\Stripe\Stripe::setApiKey("sk_test_51H2BsNKouFi2buoUWmyNEiPXAfPA7hNDpZH6vbsPJ8cWRnWESRXEZCR8p1qSUS1RdEKq35YnFy68eZ4fygBYmSUf00kTzuIVfe");

$token  = $_POST['stripeToken'];
$email  = $_POST['stripeEmail'];
$prix = $_POST['prix'];
$description = $_POST['description'];

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
?>


<html>
	<head>
		<title>Global Prestations Annexes</title>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=0.7">
		<!-- CSS -->
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
		<link href="../css/style.css" rel="stylesheet">
	</head>

<body class="paiement">
	<section>
		<div class="paiement_accepted shadow">
			<div class="titre_svg">
				<?php
				if($charge != null)
				{
				?>
					<h1>Paiement accepté !</h1>
					<svg style="color:green;"width="4em" height="4em" viewBox="0 0 16 16" class="bi bi-check" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
				  		<path fill-rule="evenodd" d="M10.97 4.97a.75.75 0 0 1 1.071 1.05l-3.992 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.236.236 0 0 1 .02-.022z"/>
					</svg>
				<?php	
				}
				else
				{
				?>
					<h1>Paiement refusé !</h1>
					<svg style="color: red;" width="4em" height="4em" viewBox="0 0 16 16" class="bi bi-x" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
						<path fill-rule="evenodd" d="M11.854 4.146a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708-.708l7-7a.5.5 0 0 1 .708 0z"/>
					  	<path fill-rule="evenodd" d="M4.146 4.146a.5.5 0 0 0 0 .708l7 7a.5.5 0 0 0 .708-.708l-7-7a.5.5 0 0 0-.708 0z"/>
					</svg>
				<?php
				}
				?>
				
			</div>
			<a href="../"><button class="button_design">Retourner sur le site</button></a>
		</div>
	</section>
	<script>
    	localStorage.clear();
	</script>
</body>

