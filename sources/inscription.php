<html>
	<head>
		<title>Inscription</title>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=0.7">
		<!-- CSS -->
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
		<link rel="stylesheet" type="text/css" href="../css/formulaire/form.css">
		<link href="../css/style.css" rel="stylesheet">
		<!--===============================================================================================-->
		<!-- JQUERY -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
		<!-- MON SCRIPT -->
		<script type="text/javascript" src="../js/log/inscription.js"></script>
		<script type="text/javascript" src="../js/script.js"></script>
		<!-- BOOTSTRAP -->
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>	
		<script type="text/javascript" src="https://unpkg.com/@popperjs/core@2"></script>
		<!--===============================================================================================-->
	</head>

<body id="test" class="inscription">

<?php
	date_default_timezone_set('Europe/Paris');
	$now = new DateTime();
	// MINIMUM 18 ANS
	$annee = $now->format('Y') - 18;
	$date=$now->format('m-d'); 
	$date_max = $annee."-".$date;
?>

<main class="ie-stickyFooter">
	<div id="page">
		<div id="header_content">
			<?php include('header.php');?>
		</div>
		<div id="content">
			<div class="limiter m-t-100">
				<div class="container-login100">
					<div class="wrap-login100 shadow">
						<form class="login100-form validate-form" enctype="multipart/form-data">
							<span class="login100-form-title p-b-70">
								Inscription
							</span>
							<div class="genre rs1-wrap-input100 validate-input m-b-20">
								<div>
									Mr
									<input id="homme"  value="Homme" type="radio" name="genre">
									<span class="focus-input100"></span>
								</div>
								<div>
									Mme
									<input id="femme"  value="Femme" type="radio" name="genre">
									<span class="focus-input100"></span>
								</div>
							</div>
							<div class="flex-row">
								<div class="nom wrap-input100 rs1-wrap-input100 validate-input m-b-20 taille2" >
									<input id="nom" class="input100" type="text" name="nom" placeholder="Nom">
									<span class="focus-input100"></span>
								</div>
								<div class="prenom wrap-input100 rs1-wrap-input100 validate-input m-b-20 taille2">
									<input id="prenom" class="input100" type="text" name="prenom" placeholder="Prénom">
									<span class="focus-input100"></span>
								</div>	
							</div>				
							
							<div class="adresse wrap-input100 rs1-wrap-input100 validate-input m-b-20 taille1">
									<input id="adresse" class="input100" type="text" name="adresse" placeholder="Adresse">
									<span class="focus-input100"></span>
							</div>
							<div class="email wrap-input100 rs1-wrap-input100 validate-input m-b-40 taille1">
									<input id="email" class="input100" type="email" name="email" placeholder="Email">
									<span class="focus-input100"></span>
							</div>
							<div class="flex-row">
								<div>
								<div class="d-flex flex-column container2 align-items-center">
									<label id="label_image" class="label" for="input">Photo de profil (optionnel)</label>

									<div class="input">
										<input name="input" id="fileToUpload" accept="image/*" type="file">
									</div>
								</div>

								</div>
								<div class="naissance_input">	
									<label>Date de naissance :</label>
									<div class="naissance wrap-input100 rs1-wrap-input100 validate-input m-b-20 taille2">
											<input id="naissance" class="input100-2" type="date" name="date" placeholder="Date de naissance"
											  min="1930-01-01" max='<?php echo $date_max; ?>'>
											<span class="focus-input100"></span>
									</div>
								</div>
							</div>	
							<div class="login wrap-input100 rs1-wrap-input100 validate-input m-b-20 taille1">
									<input id="login" class="input100" type="text" name="login" placeholder="Login (5 caractères minimum)">
									<span class="focus-input100"></span>
							</div>	
							<div class="password1 wrap-input100 rs1-wrap-input100 validate-input m-b-20 taille1" >
									<input id="password1" class="input100" type="password" name="password1" placeholder="Mot de passe">
									<span class="focus-input100"></span>
							</div>	
							<div class="password2 wrap-input100 rs1-wrap-input100 validate-input m-b-20 taille1" >
									<input id="password2" class="input100" type="password" name="password2" placeholder="Confirmation mot de passe">
									<span class="focus-input100"></span>
							</div>	
							<div class="container-login100-form-btn">
								<input type="button" id="validate_register" class="responsive_button login100-form-btn" value="Valider">	
							</div>
							<div class="text-center m-t-40">
								Vous avez un compte ?
								<a href="connexion.php" class="txt3">
									Se connecter
								</a>

							</div>
						</form>
						 <div id="background_log" class="login100-more"></div>
					</div>
				</div>
			</div>
		</div>
		<div id="footer">
			<?php include('footer.php'); ?>
		</div>
	</div>
</main>


</body>

</html>