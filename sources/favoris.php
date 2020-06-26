<?php require "../fonctions/config.php"; ?>
<html>
	<head>
		<title>Global Prestations Annexes</title>
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
		<script type="text/javascript" src="../js/script.js"></script>
		<!-- BOOTSTRAP -->
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

	</head>

<body id="test" class="accueil">
<main class="ie-stickyFooter">
    <div id="page">
		<div id="header_content">	
			<?php include('header.php');?>
		</div>
        <div id="content">
			<?php 
				if(isset($_SESSION['login']))
				{
				if(isset($_POST['delete']))
				{
					$id_annonce = $_POST['id_annonce'];
					$delete_favoris = "DELETE FROM favoris WHERE id ='$id_annonce'";
					mysqli_query($base, $delete_favoris);
				}
				
				$login = $_SESSION['login'];
				$req_id_user = "SELECT id FROM utilisateurs WHERE login= '$login'";
				$execute_req_id_user = mysqli_query($base, $req_id_user);
				$resultat_req_id_user = mysqli_fetch_array($execute_req_id_user);
				$id_user = $resultat_req_id_user['id'];

				$req_favoris = "SELECT login, profil, favoris.id as favoris_id, annonce.id, annonce.id_utilisateur, type_attestation, region, prix, favoris.id_utilisateur, id_annonce FROM favoris INNER JOIN annonce INNER JOIN utilisateurs on favoris.id_utilisateur = '$id_user' and annonce.id = favoris.id_annonce and utilisateurs.id=annonce.id_utilisateur";
				$execute_req_favoris = mysqli_query($base, $req_favoris);
				$ifnotnull = mysqli_num_rows($execute_req_favoris);
				?> 
			<div class="nombre_favoris w-100">
				<h5>Retrouvez vos annonces sauvegardées sur tous vos appareils.</h5>
				<?php
				if($ifnotnull != 0)
				{
					while($resultat_req_favoris = mysqli_fetch_array($execute_req_favoris))
					{
					?>
				        <div id="<?php echo $resultat_req_favoris['id_annonce'];?>" class="w-75 liste_annonces_poste shadow">
				        <div class="image_user">
				        	<img width="100px" height="100px" src="../img/profil/<?php echo $resultat_req_favoris['profil'];?>">
				        </div>
				        <div class="detail_annonce">
				        	<h6 id="type_<?php echo $resultat_req_favoris['id'];?>"><?php echo $resultat_req_favoris['type_attestation']?></h6>
				        	<p id="prix_annonce"><?php echo $resultat_req_favoris['prix']." €";?></p>
				        	<div ><?php echo $resultat_req_favoris['login']?></div>
				        	<div ><?php echo $resultat_req_favoris['region']?></div>
				        </div>
						</div>	
						<div class="w-75 d-flex justify-content-end p-40">
							<div class="d-flex button_del">
								<form action="" method="post">
									<input type="hidden" name="id_annonce" value="<?php echo $resultat_req_favoris['favoris_id'];?>">
									<input type="submit" name="delete" class="button_design w-10" value="Supprimer">
								</form>
								<button id="<?php echo $resultat_req_favoris['id_annonce'];?>" class="button_design w-10 send_message">Envoyer un message</button>	
							</div>
						</div>	        	        
			        <?php
					}
				}
				else
				{
				?>
					<h5>Vous n‘avez pas encore d‘annonce sauvegardée</h5>
					<a href="../"><button class="button_design">Faire une recherche</button></a>
					<img width="40%" src="../img/images_site/messagerie_vide.jpg" style="margin-top: 30px; min-width: 300px;">
				<?php
				}
			?>
			</div>
			<?php
			}
			else
			{
				require "../fonctions/form_connexion.php";
				?>
				<script type="text/javascript" src="../js/log/connexion.js"></script>
				<?php
			}
			?>
		</div>
		<div id="footer">
            <?php include('footer.php');?>
        </div>
	</div>
</main>
</body>

</html>
