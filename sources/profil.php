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
				            	<button id="envoyer_message" class="button_gpa">
				            		<svg class="bi bi-reply-fill" width="1.2em" height="1.2em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
									<path d="M9.079 11.9l4.568-3.281a.719.719 0 0 0 0-1.238L9.079 4.1A.716.716 0 0 0 8 4.719V6c-1.5 0-6 0-7 8 2.5-4.5 7-4 7-4v1.281c0 .56.606.898 1.079.62z"/>
									</svg>
									Partager
								</button>
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