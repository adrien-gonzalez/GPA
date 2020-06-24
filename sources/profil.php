<?php require "../fonctions/config.php"; ?>
<html>
	<head>
		<title>Annonce</title>
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
        <script type="text/javascript" src="../js/annonce/mes_annonces.js"></script>
		<!-- BOOTSTRAP -->
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>	
		<script type="text/javascript" src="https://unpkg.com/@popperjs/core@2"></script>

		<!--===============================================================================================-->
    </head>
    

<body class="profil">
    <main class="ie-stickyFooter">
        <div id="page">
            <div id="header_content">    
                <?php include('header.php');?>
            </div>
            <div id="content">
            	<!-- AFFICHAGE DES INFORMATIONS DE L'UTILISATEUR -->
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
		           	$nombre_annonce = mysqli_num_rows($execute_req_annonce);     
            	?>
		        <input type="hidden" class="nom_user" id="<?php echo $resultat_req_user['login'];?>">
            	<div class="header_profil"></div>
            	<div class="id_profil">
            		<div class="detail_profil shadow">
            			<div class="info_general_user">
	            			<div>
		            			<img src="../img/profil/<?php echo $resultat_req_user['profil'];?>">
		            			<p><?php echo $resultat_req_user['nom']." ".$resultat_req_user['prenom'];?></p>
	            			</div>
	            			<div>
	            				<a href="envoie_messages.php?annonce=<?php echo $resultat_req_annonce['id'];?>">
				            		<button id="envoyer_message" class="button_gpa">
				            			<svg class="bi bi-chat-square-dots" width="1.2em" height="1.2em" viewBox="0 0 16 16" fill="white" xmlns="http://www.w3.org/2000/svg">
										<path fill-rule="evenodd" d="M14 1H2a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h2.5a2 2 0 0 1 1.6.8L8 14.333 9.9 11.8a2 2 0 0 1 1.6-.8H14a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1zM2 0a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h2.5a1 1 0 0 1 .8.4l1.9 2.533a1 1 0 0 0 1.6 0l1.9-2.533a1 1 0 0 1 .8-.4H14a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z"/>
										<path d="M5 6a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm4 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm4 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>
										</svg>
										Envoyer un message
									</button>
								</a>
	            			</div>
            			</div>
            			<hr>
            			<div class="date_nbr_annonce">
            				<div><?php echo "Inscrit le : ".$resultat_req_user['date'];?></div>
            				<div><?php echo "Annonces en ligne : ".$nombre_annonce;?></div>
            			</div>
            		</div>
            	</div>
            	<div class="nombre_annonce w-100">
            		<div class="nombre w-75">
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