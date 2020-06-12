<?php require "../fonctions/config.php"; ?>
<html>
	<head>
		<title>Annonce <?php echo $_GET['type'];?></title>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=0.7">
		<!-- CSS -->
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
		<!-- <link rel="stylesheet" type="text/css" href="../css/formulaire/form.css"> -->
        <link href="../css/style.css" rel="stylesheet">
		<!--===============================================================================================-->
		<!-- JQUERY -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
		<!-- MON SCRIPT -->
        <script type="text/javascript" src="../js/script.js"></script>
		<!-- BOOTSTRAP -->
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>	
		<script type="text/javascript" src="https://unpkg.com/@popperjs/core@2"></script>

		<!--===============================================================================================-->
    </head>
    

<body class="annonce">
    <main class="ie-stickyFooter">
        <div id="page">
            <div id="header_content">    
                <?php include('header.php');?>
            </div>
            <div id="content">
            	<section>
	            	<div class="contenu_annonce shadow">
	            		<!-- AFFICHAGE DES INFORMATIONS DE L'ANNONCE -->
		            	<?php 
		            		$id = $_GET['id'];
		            		$req_annonce = "SELECT *FROM annonce WHERE id='$id'";
		            		$execute_req_annonce = mysqli_query($base, $req_annonce);
		            		$resultat_req_annonce = mysqli_fetch_array($execute_req_annonce);     
		            		$ifnotnull = mysqli_num_rows($execute_req_annonce);
		            			
		            			if($ifnotnull == 0)
		            				header('Location: ../');
		            			
		            		$id_user = $resultat_req_annonce['id_utilisateur'];
		            		$req_user = "SELECT *FROM utilisateurs WHERE id = '$id_user'";
		            		$execute_req_user = mysqli_query($base, $req_user);
		            		$resultat_req_user = mysqli_fetch_array($execute_req_user);
		            	?>
		            	<div class="attestation_prix">
		            		<h4><?php echo $resultat_req_annonce['type_attestation'];?></h4>
		            		<h4><?php echo $resultat_req_annonce['prix'];?> €</h4>
		            	</div>
	            		<div class="affichage_information">

		            		<div class="profil_user shadow">
		            			<img class="rounded-circle" src="../img/profil/<?php echo $resultat_req_user['profil'];?>" width="125">
		            			<div class="nom_prenom">
		            				<div><?php echo $resultat_req_user['nom'];?>  <?php echo $resultat_req_user['prenom'] ?><br><?php echo $resultat_req_user['login'];?></div>
		            			</div>
		            			<a href="envoie_messages?id=<?php echo $resultat_req_user['id'];?>">
			            			<button id="envoyer_message" class="button_gpa">
			            				<svg class="bi bi-chat-square-dots" width="1.2em" height="1.2em" viewBox="0 0 16 16" fill="white" xmlns="http://www.w3.org/2000/svg">
										<path fill-rule="evenodd" d="M14 1H2a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h2.5a2 2 0 0 1 1.6.8L8 14.333 9.9 11.8a2 2 0 0 1 1.6-.8H14a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1zM2 0a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h2.5a1 1 0 0 1 .8.4l1.9 2.533a1 1 0 0 0 1.6 0l1.9-2.533a1 1 0 0 1 .8-.4H14a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z"/>
										<path d="M5 6a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm4 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm4 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>
										</svg>
										Envoyer un message
									</button>
								</a>
								<a class="lien_tel" href="tel:<?php echo $resultat_req_annonce['tel'];?>">
									<button id="num_tel" class="button_gpa">
										<?php echo $resultat_req_annonce['tel']; ?>
									</button>
								</a>
		            		</div>
		            		<div class="lieu">
		            			<iframe src="https://maps.google.com/maps?q=<?php echo $resultat_req_annonce['region'];?>&t=&z=6&ie=UTF8&iwloc=&output=embed" frameborder="0"
									style="border:0" allowfullscreen>
								</iframe>
		            			
		            		</div>
	            		</div>
	            		<div class="detail">
	            			<hr>
	            			<div class="titre_description">Description</div>
		            		
		            		<div class="description">
		            			<div><?php echo $resultat_req_annonce['descriptif'];?></div>
		            		</div>
		            	</div>

	            	</div>
	            </div>
        	</section>
            <div id="footer">
                <?php include('footer.php');?>
            </div>
        </div>
    </main>
</body>
</html>