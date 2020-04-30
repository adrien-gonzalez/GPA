<html>
	<head>
		<title>Inscription</title>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=0.7">
		<!-- CSS -->
		<link href="../css/style.css" rel="stylesheet">
		<link rel="stylesheet" type="text/css" href="../css/formulaire/form.css">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
		<!--===============================================================================================-->
		<!-- JQUERY -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
		<!-- MON SCRIPT -->
		<script type="text/javascript" src="../js/log/connexion.js"></script>
		<!-- BOOTSTRAP -->
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>	
		<!--===============================================================================================-->
	</head>

<body id="test" class="inscription">

<?php include('header.php');?>


<div class="limiter m-t-100">
	<div class="container-login100">
		<div class="wrap-login100">
			<form class="login100-form validate-form">
				<span class="login100-form-title p-b-34">
					Inscription
				</span>
				<div class="rs1-wrap-input100 validate-input m-b-20" data-validate="Type user name">
					<div>
						Mr
						<input id="homme"  type="radio" name="genre" >
						<span class="focus-input100"></span>
					</div>
					<div>
						Mme
						<input id="femme"  type="radio" name="genre" >
						<span class="focus-input100"></span>
					</div>
				</div>
				<div class="flex-row">
					<div class="wrap-input100 rs1-wrap-input100 validate-input m-b-20 taille2" >
						<input id="nom" class="input100" type="text" name="nom" placeholder="Nom">
						<span class="focus-input100"></span>
					</div>
					<div class="wrap-input100 rs1-wrap-input100 validate-input m-b-20 taille2">
						<input id="prenom" class="input100" type="text" name="prenom" placeholder="Prénom">
						<span class="focus-input100"></span>
					</div>	
				</div>				
				
				<div class="wrap-input100 rs1-wrap-input100 validate-input m-b-20 taille1">
						<input id="adresse" class="input100" type="text" name="adresse" placeholder="Adresse">
						<span class="focus-input100"></span>
				</div>
				<div class="wrap-input100 rs1-wrap-input100 validate-input m-b-40 taille1">
						<input id="email" class="input100" type="email" name="email" placeholder="Email">
						<span class="focus-input100"></span>
				</div>
				<div class="flex-row">
					<div>
						<label>Photo de profil (optionnel) :</label>
						<div class="wrap-input100 rs1-wrap-input100 validate-input m-b-20 taille2">
							<input class="input100" required type="file" name="fileToUpload" id="fileToUpload">	
							<span class="focus-input100"></span>
						</div>
					</div>
					<div>	
						<label>Date de naissance :</label>
						<div class="wrap-input100 rs1-wrap-input100 validate-input m-b-20 taille2">
								<input id="naissance" class="input100" type="date" name="date" placeholder="Date de naissance">
								<span class="focus-input100"></span>
						</div>
					</div>
				</div>	
				<div class="wrap-input100 rs1-wrap-input100 validate-input m-b-20 taille1">
						<input id="login" class="input100" type="text" name="login" placeholder="Login">
						<span class="focus-input100"></span>
				</div>	
				
				<div class="flex-row">
				<div class="wrap-input100 rs1-wrap-input100 validate-input m-b-20 taille2" >
						<input id="password1" class="input100" type="password" name="password1" placeholder="Password">
						<span class="focus-input100"></span>
				</div>	
				<div class="wrap-input100 rs1-wrap-input100 validate-input m-b-20 taille2" >
						<input id="password2" class="input100" type="password" name="password2" placeholder="Confirm Password">
						<span class="focus-input100"></span>
				</div>	
				</div>	
				<div class="container-login100-form-btn">
					<button class="login100-form-btn">
						Valider
					</button>
				</div>
				<div class="w-full text-center p-t-27 m-b-40">
					<span class="txt1">
						Forgot
					</span>
					<a href="#" class="txt2">
						User name / password?
					</a>
				</div>
				<div class="w-full text-center">
					Vous avez un compte ?
					<a href="connexion.php" class="txt3">
						Se connecter
					</a>

				</div>
			</form>
			<div class="login100-more" style="background-image: url('../img/bg-01.jpg');"></div>
		</div>
	</div>
</div>

</body>

</html>