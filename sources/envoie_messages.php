<?php require "../fonctions/config.php"; ?>

<html>
	<head>
		<title>Global Prestations Annexes</title>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=0.7">
		<!-- CSS -->
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
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

<body id="test" class="envoie_message">
<main class="ie-stickyFooter">
    <div id="page">
		<div id="header_content">	
			<?php include('header.php');
				if(!isset($_SESSION['login']))
                {
                    header('location: connexion.php');
                }
            ?>
		</div>
        <div id="content">
			<div class="container-fluid">
				<!-- AFFICHAGE DES INFORMATIONS DE L'ANNONCE -->
		        <?php 
		           	$id_user = $_GET['id'];
	           		$req_user = "SELECT *FROM utilisateurs WHERE id = '$id_user'";
	          		$execute_req_user = mysqli_query($base, $req_user);
	           		$resultat_req_user = mysqli_fetch_array($execute_req_user);
	           		$ifnotnull = mysqli_num_rows($execute_req_user);

	           		if($ifnotnull == 0)
		           			header('Location: ../');

		           	$req_annonce = "SELECT *FROM annonce WHERE id_utilisateur='$id_user'";
		           	$execute_req_annonce = mysqli_query($base, $req_annonce);
		           	$resultat_req_annonce = mysqli_fetch_array($execute_req_annonce);      		
	         	?>
	         	<article class="w-50 message_user shadow">
		         	<div class="profil_user d-flex flex-column w-100" id="<?php echo $resultat_req_user['login']?>">
			            <img class="rounded-circle" src="../img/profil/<?php echo $resultat_req_user['profil'];?>" width="125">
			            <div class="nom_prenom">
			            	<div><?php echo $resultat_req_user['nom'] ?>  <?php echo $resultat_req_user['prenom'] ?><br><?php echo $resultat_req_user['login']?></div>
			            </div>
			        </div>
			        <div class="d-flex flex-column message">
			        	<p>Votre message</p>
			        	<textarea placeholder="Envoyez votre message..."></textarea>
			        	<button id="envoie_message_button">
			        		<svg class="bi bi-cursor-fill" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
							<path fill-rule="evenodd" d="M14.082 2.182a.5.5 0 0 1 .103.557L8.528 15.467a.5.5 0 0 1-.917-.007L5.57 10.694.803 8.652a.5.5 0 0 1-.006-.916l12.728-5.657a.5.5 0 0 1 .556.103z"/>
							</svg>
			        		Envoyer
			        	</button>
			        </div>
		   		</article>
		   		<article class="w-50 shadow info">
		   			<div class="resume_annonce d-flex flex-column w-100">
			            <div class="titre">
			            	<h4>Type d'attestation</h4>
			            	<div><?php echo $resultat_req_annonce['type_attestation']?></div>
			            </div>
			            <hr>
			            <div class="descriptif">
			            	<h4>Description</h4>
			            	<div class="prix_annonce"><?php echo $resultat_req_annonce['prix']?> €</div>
			            	<div>
			            		<?php
			            		if(strlen($resultat_req_annonce['descriptif']) > 550)
			            		{
			            			echo substr($resultat_req_annonce['descriptif'],0,500)."..." ;
			            		}
			            		else
			            		{
			            			echo $resultat_req_annonce['descriptif'];

			            		}
			            		?>
			            	</div>
			            </div>
			        </div>
		   		</article>
			</div>
		</div>
		<div id="footer">
            <?php include('footer.php');?>
        </div>
	</div>
</main>
</body>

</html>