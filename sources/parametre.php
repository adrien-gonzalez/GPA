<!DOCTYPE html>
<?php require("../fonctions/config.php");?>

<html>
	<head>
		<title>Global Prestations Annexes</title>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<!-- CSS -->
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
		<link href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/css/bootstrap-select.min.css" rel="stylesheet" />
		<link href="../css/style.css" rel="stylesheet">
		<link href="../css/formulaire/form.css" rel="stylesheet">
		<!-- JQUERY -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
		<!-- MON SCRIPT -->
		<script type="text/javascript" src="../js/script.js"></script>
		<script type="text/javascript" src="../js/parametre/parametre.js"></script>
		<!-- BOOTSTRAP -->
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
	</head>

<body class="parametre">
<main class="ie-stickyFooter">
    <div id="page">
		<div id="header_content">    
                <?php include('header.php');
                	if(!isset($_SESSION['login']))
                	{
                		header('Location: ../');
                	}
                ?>
        </div>
        <div id="content">
        	<section class="w-100">
        		<div class="card list_panel shadow">
					<ul class="list-group list-group-flush">
				    	<a href="parametre.php?panel=mon_contrat"><li id="mon_contrat" class="list-group-item">Mon contrat</li></a>
				    	<a href="parametre.php?panel=mes_informations"><li id="mes_informations" class="list-group-item">Mes informations</li></a>
				    	<a href="parametre.php?panel=photo_profil"><li id="photo_profil" class="list-group-item">Photo de profil</li></a>
				    	<a href="parametre.php?panel=email"><li id="email" class="list-group-item">Email</li></a>
				    	<a href="parametre.php?panel=password"><li id="password" class="list-group-item">Mot de passe</li></a>
				   		<a href="parametre.php?panel=delete"><li id="delete" class="list-group-item">Supprimer mon compte</li></a>

					</ul>
				</div>
				<div class="pannel_result">
					<?php
						if(isset($_GET['panel']))
					 	{
					 		$login = $_SESSION['login'];
					 		$req_user = "SELECT *FROM utilisateurs WHERE login ='$login'";
					 		$execute_req_user = mysqli_query($base, $req_user);
					 		$resultat_req_user = mysqli_fetch_array($execute_req_user);

					 		if($_GET['panel'] == "mon_contrat")
					 		{
					 			$id_user = $resultat_req_user['id'];
					 			$access_contrat = "SELECT *FROM contrat WHERE id_user ='$id_user'";
					 			$execute_access_contrat = mysqli_query($base, $access_contrat);
					 			$ifaccess = mysqli_num_rows($execute_access_contrat);

					 			if($ifaccess != 0)
					 			{
					 			?>
						 			<div class="d-flex justify-content-center w-100">
								    	<div class="card" style="width: 18rem;">
								  			<img src="../img/images_site/contrat.jpg" class="card-img-top" alt="...">
								  			<div class="card-body">
											    <h5 class="card-title">Contrat disponible</h5>
											    <p class="card-text">Model contrat de prestations de services - Gestionnaire transport - commissionnaire transport</p>
											    <object type="application/vnd.oasis.opendocument.text" data="data/test.odt">
													<a href="../contrat/$2y$12$JMV0HTgmddRLvgJRopuAQpfes08GNsvRI6F0R54wC3Ekaguo3egCYa.odt"><button class="button_design">Télécharger le modèle de contrat</button></a>
												</object>
								  			</div>
										</div>
									</div>
								<?php
					 			}
					 			else
					 			{
					 			?>
					 				<div class="d-flex justify-content-center w-100">
								    	<div class="card" style="width: 18rem;">
								  			<img src="../img/images_site/error.jpg" class="card-img-top" alt="...">
								  			<div class="card-body">
											    <h5 class="card-title">Contrat non disponible</h5>
											    <p class="card-text">Afin d'établir un contrat, veuillez acheter son modéle</p>
											    <object type="application/vnd.oasis.opendocument.text" data="data/test.odt">
													<a href="contrat.php"><button class="button_design">Acheter le modèle de contrat</button></a>
												</object>
								  			</div>
										</div>
									</div>
								<?php
					 			}
					 		}
					 		else if($_GET['panel'] == "mes_informations")
					 		{	
					 		?>
					 			<div class="limiter">
			    					<div class="container-login100 parametre_form form1">
								        <section class="shadow bg-white">
								            <form class="login100-form validate-form">
								                <span class="login100-form-title p-b-70">
								                    informations
								                </span>
								                <div class="genre rs1-wrap-input100 validate-input m-b-20">
													<div>
														Mr
														
														<input id="homme"  value="Homme" <?php if($resultat_req_user['genre'] == "Homme"){?>  checked <?php }?> type="radio" name="genre">
														<span class="focus-input100"></span>
													</div>
													<div>
														Mme
														<input id="femme"  <?php if($resultat_req_user['genre'] == "Femme"){?>  checked <?php }?>value="Femme" type="radio" name="genre">
														<span class="focus-input100"></span>
													</div>
												</div>
									            <div class="login wrap-input100 rs1-wrap-input100 validate-input taille1 m-b-20">
									                <input id="nom" class="input100" type="text" name="nom" placeholder="Nom" value="<?php echo $resultat_req_user['nom']?>">
									                <span class="focus-input100"></span>
									            </div>
									            <div class="login wrap-input100 rs1-wrap-input100 validate-input taille1 m-b-20">
									                <input id="prenom" class="input100" type="text" name="prenom" placeholder="Prenom" value="<?php echo $resultat_req_user['prenom']?>">
									                <span class="focus-input100"></span>
									            </div>
									            <div class="password1 wrap-input100 rs1-wrap-input100 validate-input taille1 m-b-20">
									                <input id="adresse" class="input100" type="text" name="adresse" placeholder="Adresse" value="<?php echo $resultat_req_user['adresse']?>">
									                <span class="focus-input100"></span>
									            </div>
									            <div class="login wrap-input100 rs1-wrap-input100 validate-input taille1 m-b-20">
									                <input id="naissance" class="input100" type="date" name="naissance" placeholder="Date de naissance" value="<?php echo $resultat_req_user['naissance']?>">
									                <span class="focus-input100"></span>
									            </div>
								            	<input type="button" id="change_information" class="responsive_button login100-form-btn" value="Enregistrer les modifications">
								           </form>
								        </section>
			    					</div>
								</div>
					 		<?php
					 		}
					 		else if($_GET['panel'] == "email")
					 		{
					 		?>
					 			<div class="limiter">
			    					<div class="container-login100 parametre_form form2">
								        <section class="shadow bg-white">
								            <form class="login100-form validate-form">
								                <span class="login100-form-title p-b-34">
								                    Email
								                </span>
								                <div class="flex-row align-items-center input-email w-100">
									                <div class="login wrap-input100 rs1-wrap-input100 validate-input w-60 admin_login_change">
									                    <input id="email" disabled class="input100" type="text" name="email" placeholder="Email" value="<?php echo $resultat_req_user['email'] ?>">
									                    <span class="focus-input100"></span>
									                </div>	
									                <input type="button" id="change_email" class="modif_button w-25 responsive_button login100-form-btn" value="Changer">
								            	</div>
								           </form>
								        </section>
			    					</div>
								</div>
					 		<?php
					 		}
					 		else if($_GET['panel'] == "password")
					 		{
					 		?>
					 			<div class="limiter">
			    					<div class="container-login100 parametre_form form3">
								        <section class="shadow bg-white">
								            <form class="login100-form validate-form">
								                <span class="login100-form-title p-b-34">
								                    Mot de passe
								                </span>
								                <div class="flex-row align-items-center input-password w-100">
									                <div class="login wrap-input100 rs1-wrap-input100 validate-input w-60 admin_login_change">
									                    <input id="email" disabled class="input100" type="password" name="email" placeholder="Email" value="<?php echo substr($resultat_req_user['password'],0,10) ?>">
									                    <span class="focus-input100"></span>
									                </div>	
									                <input type="button" id="change_password" class="modif_button w-25 responsive_button login100-form-btn" value="Changer">
								            	</div>
								           </form>
								        </section>
			    					</div>
								</div>
					 		<?php
					 		}
					 		else if($_GET['panel'] == "delete")
					 		{
					 		?>
					 			<div class="div_delete alert alert-danger w-50" role="alert">
								  	Supprimer mon compte de façon définitive
								  	<button data-toggle="modal" data-target="#supprimer_compte" type="button" class="btn btn-danger">Supprimer</button>
								</div>

								<!-- Modal delete account -->
								<div class="modal fade" id="supprimer_compte" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
								  <div class="modal-dialog">
								    <div class="modal-content">
								      <div class="modal-header">
								        <h5 class="modal-title" id="exampleModalLabel">Suppression de mon compte</h5>
								        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
								          <span aria-hidden="true">&times;</span>
								        </button>
								      </div>
								      <div class="modal-body">
								        <p>Voulez-vous vraiment supprimer votre compte ?</p>
								      </div>
								      <div class="modal-footer">
								        <button type="button" class="btn btn-secondary" data-dismiss="modal">Non</button>
								        <button id="delete_account" type="button" class="btn btn-danger">Oui</button>
								      </div>
								    </div>
								  </div>
								</div>
					 		<?php
					 		}
					 		else if($_GET['panel'] == "photo_profil")
					 		{
					 		?>
					 			<div class="profil_user_image shadow">
					 				<form class="form_new_image" method="post" action="" enctype="multipart/form-data" runat="server">
					 					<img id="new_image" src="../img/profil/<?php echo $resultat_req_user['profil']?>">
										<div class="image-upload">
						   	    			<label for="fileToUpload">
												<svg width="1.5em" height="1.5em" viewBox="0 0 16 16" class="bi bi-camera-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
												    <path d="M10.5 8.5a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"/>
												    <path fill-rule="evenodd" d="M2 4a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2h-1.172a2 2 0 0 1-1.414-.586l-.828-.828A2 2 0 0 0 9.172 2H6.828a2 2 0 0 0-1.414.586l-.828.828A2 2 0 0 1 3.172 4H2zm.5 2a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1zm9 2.5a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0z"/>
												</svg>
								 		    </label>
											<input id="fileToUpload" type="file" />
										</div>
									</form>
									<!-- <div>
										<button class="button_design">Valider</button>
										<button class="button_design">Annuler</button>
									</div> -->
					 			</div>
					 		<?php
					 		}
						    $panel_list = $_GET['panel'];
						    ?><input id="panel" type="hidden" value="<?php echo $panel_list;?>"><?php
						}
					?>
				</div>
			</section>

			
		</div>
		<div id="footer">
            <?php include('footer.php');?>
        </div>
	</div>
</main>
</body>
</html>