<html>
	<head>
		<title>Global Prestations Annexes</title>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=0.7">
		<!-- CSS -->
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
		<link href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/css/bootstrap-select.min.css" rel="stylesheet" />
		<link rel="stylesheet" type="text/css" href="../css/formulaire/form.css">
		<link href="../css/style.css" rel="stylesheet">
		<!-- JQUERY -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
		<!-- MON SCRIPT -->
		<script type="text/javascript" src="../js/script.js"></script>
		<script type="text/javascript" src="../js/contact/contact.js"></script>
		<!-- BOOTSTRAP -->
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
	</head>

<body id="test" class="accueil">
	<main class="ie-stickyFooter">
	    <div id="page">
			<div id="header_content">	
				<?php include('header.php');?>
			</div>
	        <div id="content">
	        	<div class="limiter m-t-100">
    				<div class="container-login100">
        				<section>
				            <div class="wrap-login100 shadow">
				                <form class="login100-form validate-form">
									<span class="login100-form-title p-b-70">
										Contactez-nous 
									</span>
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
									<div class="nom wrap-input100 rs1-wrap-input100 validate-input m-b-20 taille1" >
										<input id="email" maxlength="35" class="input100" type="text" name="email" placeholder="Email">
						                <span id="span_descriptif" class="focus-input100"></span>
						            </div>
									<div class="nom wrap-input100 rs1-wrap-input100 validate-input m-b-20 taille1" >
										<input id="sujet" maxlength="35" class="input100" type="text" name="sujet" placeholder="Sujet">
						                <span id="span_descriptif" class="focus-input100"></span>
						            </div>
									<div class="d-flex flex-column rs1-wrap-input100 validate-input taille1 m-b-20">
						                <textarea id="message" maxlength="2000" class="input100 wrap-input100" placeholder="Votre message..."></textarea>
						                <span id="span_descriptif" class="focus-input100"></span>
						            </div>	
									<div class="container-login100-form-btn">
										<input type="button" id="send_message" class="responsive_button login100-form-btn" value="Envoyer">	
									</div>
								</form>
				            <div id="background_log" class="login100-more"></div>
				            </div>
        				</section>
    				</div>
				</div>
			</div>
			<div id="footer">
	            <?php include('footer.php');?>
	        </div>
		</div>
	</main>
</body>
</html>