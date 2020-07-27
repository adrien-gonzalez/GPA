<!DOCTYPE html>
<?php require("fonctions/config.php");?>

<html>
	<head>
		<title>Global Prestations Annexes</title>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=0.7">
		<!-- CSS -->
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
		<link href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/css/bootstrap-select.min.css" rel="stylesheet" />
		<link href="css/style.css" rel="stylesheet">
		<!-- JQUERY -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
		<!-- MON SCRIPT -->
		<script type="text/javascript" src="js/script.js"></script>
		<script type="text/javascript" src="js/selectpicker.js"></script>
		<!-- BOOTSTRAP -->
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
	</head>

<body id="test" class="accueil">
<main class="ie-stickyFooter">
    <div id="page">
		<div id="header_content">	
			<?php include('sources/header.php');

			date_default_timezone_set('Europe/Paris');
			$now = new DateTime();
			$date=$now->format('Y-m-d');

			//DELETE ANNONCE > 60 JOURS
			$delete_annonce = "DELETE from annonce where DATEDIFF('$date' , date_validite) > 60";
            mysqli_query($base, $delete_annonce);

            // AVANTAGE BOOST ANNONCE (7, 30 ou 60 jours)
            $select_avantage = "SELECT date_avantage, duree, id_service FROM avantage INNER JOIN services on id_service = services.id";
            $execute_req_avantage = mysqli_query($base, $select_avantage);
           	$nombre_avantage = mysqli_num_rows($execute_req_avantage);

           	if($nombre_avantage != 0)
           	{	
           		while($resultat_select_avantage = mysqli_fetch_array($execute_req_avantage))
           		{
           			$duree = $resultat_select_avantage['duree'];
           			$id_service = $resultat_select_avantage['id_service'];
           			$delete_avantage = "DELETE from avantage where DATEDIFF('$date', date_avantage) > '$duree' and id_service = '$id_service'";
           			mysqli_query($base, $delete_avantage);
           		}

           		// MET DATE A JOUR POUR ANNONCES QUI ONT DES AVANTAGES POUR METTRE EN TETE DE LISTE
           		$select_annonce_avantage = "SELECT annonce.id FROM annonce INNER JOIN avantage on annonce.id = id_annonce";
           		$execute_annonce_avantage = mysqli_query($base, $select_annonce_avantage);
           		$nombre_annonce = mysqli_num_rows($execute_annonce_avantage);

           		if($nombre_annonce != 0)
           		{
           			while($resultat_annonce_avantage = mysqli_fetch_array($execute_annonce_avantage))
           			{
           				$id_annonce = $resultat_annonce_avantage['id'];
           				$update_date_annonce = "UPDATE annonce SET date_annonce = '$date' WHERE id = '$id_annonce'";
           				mysqli_query($base, $update_date_annonce);
           			}
           		}

           	}
			?>
		</div>
        <div id="content">
			<div class="header_accueil">
				<div class="content_header">
					<div class="option_recherche">
						<form action="" method="get">	
							<div class="option">
								<div class="container2">
								   	<input id="selected_attestation" type="hidden" 
								   	<?php if(isset($_GET['type_attestation']))
								   	{
								   	?> 
										value="<?php echo $_GET['type_attestation'];?>"
									<?php
									}
									?>>
								   <select id="type_attestation" name="type_attestation" class="selectpicker show-tick" title="Type d'attestation">
										<option id="Tout" value="Tout">Tout</option>
								     	<option id="Commissionnaire" value="Commissionnaire">Commissionnaire</option>
								     	<option id="Marchandisesdemoinsde3_5T" value="Marchandisesdemoinsde3_5T">Marchandises - 3.5T</option>
								     	<option id="Marchandisesdeplusde3_5T" value="Marchandisesdeplusde3_5T">Marchandises + 3.5T</option>
								     	<option id="Voyageurs" value="Voyageurs">Voyageurs</option>
								    </select>
								</div>
								<div class="container2">
									<input id="selected_region" type="hidden" 
								   	<?php if(isset($_GET['region']))
								   	{
								   	?> 
										value="<?php echo $_GET['region'];?>"
									<?php
									}
									?>>
									<select id="region" name="region" class="selectpicker show-tick" title="Région">
										<option id="Toutes_les_régions" value="Toutes_les_régions">Toutes les régions</option>
										<option id="Auvergne-Rhône-Alpes" value="Auvergne-Rhône-Alpes">Auvergne-Rhône-Alpes</option>
										<option id="Bourgogne-Franche-Comté" value="Bourgogne-Franche-Comté">Bourgogne-Franche-Comté</option>
										<option id="Bretagne" value="Bretagne">Bretagne</option>
										<option id="Centre-Val_de_Loire" value="Centre-Val_de_Loire">Centre-Val de Loire</option>
										<option id="Corse" value="Corse">Corse</option>
										<option id="Grand_Est" value="Grand_Est">Grand Est</option>
										<option id="Hauts-de-France" value="Hauts-de-France">Hauts-de-France</option>
										<option id="Île-de-France" value="Île-de-France">Île-de-France</option>
										<option id="Normandie" value="Normandie">Normandie</option>
										<option id="Nouvelle-Aquitaine" value="Nouvelle-Aquitaine">Nouvelle-Aquitaine</option>
										<option id="Occitanie" value="Occitanie">Occitanie</option>
										<option id="Pays_de_la_Loire" value="Pays_de_la_Loire">Pays de la Loire</option>
										<option id="Provence-Alpes-Côte_d2Azur" value="Provence-Alpes-Côte_d2Azur">Provence-Alpes-Côte d'Azur</option>
								    </select>
								</div>
								<div class="container2">
									<input id="selected_disponibilite" type="hidden" 
								   	<?php if(isset($_GET['disponibilite']))
								   	{
								   	?> 
										value="<?php echo $_GET['disponibilite'];?>"
									<?php
									}
									?>>
									<select id="disponibilite" name="disponibilite" class="selectpicker show-tick" title="Disponibilité">
										<option id="Toutes" value="Toutes">Toutes</option>
										<option id="Disponible" value="Disponible">Disponible</option>									
										<option id="Sous_3_mois" value="Sous_3_mois">Sous 3 mois</option>
									</select>	
								</div>
								<div class="container2">
									<input id="selected_statut" type="hidden" 
								   	<?php if(isset($_GET['statut']))
								   	{
								   	?> 
										value='<?php echo json_encode($_GET["statut"]);?>'
									<?php
									}
									?>>
									<select id="statut" name="statut[]" class="selectpicker show-tick" multiple="multiple" title="Statut">
										<option id="Associé" value="Associé">Associé</option>									
										<option id="Salarié" value="Salarié">Salarié</option>
										<option id="Externe" value="Externe">Externe</option>
									</select>
								</div>						
								<input type="submit" id="recherche_accueil" class="button_design" value="Rechercher">
							</div>
						</form>
					</div>
					<div>
					</div>	
				</div>
			</div>
			<div id="affichage_annonces">
				<?php
				  	$condition = [];
				  	$page = 1;
					if(sizeof($_GET) == "0")
					{	
						$condition[] = "annonce.id_utilisateur=utilisateurs.id";
					}
					else
					{
						foreach ($_GET as $get => $val){            
					        $cond = $val;
					        if($cond != "" && $cond != "Toutes_les_régions" && $cond != "Toutes" && $cond != "Tout")
					        {	
					        	if($get == "type_attestation")
					        	{
					        		$val = str_replace("de", " ", $val);
					        		$val = str_replace("moins", "-", $val);
					        		$val = str_replace("plus", "+", $val);
					        		$val = str_replace("_", ".", $val);
					        		$type = $get.'='.'"'.$val.'"';

					        	}
					        	if($get == "region" || $get == "disponibilite")
					        	{
					        		$val = str_replace("_", " ", $val);
					        		$val = str_replace("2", "'", $val);
					        		if($get == "region")
					        		{
					        			$region = $get.'='.'"'.$val.'"'; 
					        		}
					        		else
					        		{
					        			$dispo = $get.'='.'"'.$val.'"'; 
					        		}
					        	}
					        	if($get == "statut")
					        	{
					        		if (isset($type) && isset($region) && isset($dispo))
					        		{
					        			$val = implode('" or '.$type.' and '.$region.' and '.$dispo.' and statut="',$val);
					        		}
					        		else if (isset($type) && isset($region)) 
					        		{
					        			$val = implode('" or '.$type.' and '.$region.' and statut="',$val);
					        		}
					        		else if(isset($type) && isset($dispo))
					        		{
					        			$val = implode('" or '.$type.' and '.$dispo.' and statut="',$val);
					        		}
					        		else if(isset($type))
					        		{
					        			$val = implode('" or '.$type.' and statut="',$val);
					        		}
					        		else if(isset($region))
					        		{
					        			$val = implode('" or '.$region.' and statut="',$val);
					        		}
					        		else if(isset($dispo))
					        		{
					        			$val = implode('" or '.$dispo.' and statut="',$val);	
					        		}
					        		else
					        		{
					        			$val = implode('" or statut="',$val);
					        		}
					        	}
					        	if($get != "page")	
					        	{
					        		$var = $get.'='.'"'.$val.'"';
					        		array_push($condition, $var);
					        	}
					        	else
					        	{
					        		$page = $cond;
					        	}
					        }
					    }
					}
					if(sizeof($condition) == 0)
					{
						$condition[] = "annonce.id_utilisateur=utilisateurs.id";
					}
					// ANNONCES
					$condition = implode(" and ", $condition);
					$limit = 16;
					if(isset($_GET['page']))
					{
						$page = $_GET['page'];
					}
					else
					{	
						$page = 1;
					}
					if($page > 1)
					{
						$offset = ($page-1)*$limit;
					}
					else
					{
						$offset = 0;
					}

					$req_annonces="SELECT annonce.id, profil, nom, prenom, region, type_attestation, tel, email, prix, disponibilite FROM utilisateurs INNER JOIN annonce on $condition WHERE annonce.id_utilisateur=utilisateurs.id and verif = '1' ORDER BY date_annonce DESC LIMIT $limit OFFSET $offset";
					$execute_req_annonces=mysqli_query($base, $req_annonces);
					$element=mysqli_num_rows($execute_req_annonces);

					// SI AUCUN ELEMENT RENVOIE A LA PREMIERE PAGE
					if(isset($_GET['page']))
					{
						if($element == 0)
						{
				    		$tab = explode("&", $_SERVER['QUERY_STRING']);
						  	unset($tab[array_search($tab[sizeof($tab)-1], $tab)]);
						  	
						   	$url = implode("&",$tab);
						   	// echo $url;
						   	?>
						   		<meta http-equiv="refresh" content="0;?<?php echo $url;?>">
			    			<?php
						}
					}
					// NOMBRE DANNONCE
					$req_nbr_annonces="SELECT annonce.id, profil, nom, prenom, region, type_attestation, tel, email, prix, disponibilite FROM utilisateurs INNER JOIN annonce on $condition WHERE annonce.id_utilisateur=utilisateurs.id";
					$execute_nbr_annonce = mysqli_query($base, $req_nbr_annonces);
					$nbr_annonces = mysqli_num_rows($execute_nbr_annonce);

					// ANNONCES EN FAVORIS
					$req_favoris = "SELECT *FROM favoris";
					$execute_req_favoris = mysqli_query($base, $req_favoris);
					$element_favoris=mysqli_num_rows($execute_req_favoris);
					
					// REQUETE ID UTILISATEUR
					if(isset($_SESSION['login']))
					{	
						$login = $_SESSION['login'];
						$req_user = "SELECT id FROM utilisateurs WHERE login = '$login'";
			            $execute_req_user = mysqli_query($base, $req_user);
			            $resultat_req_user = mysqli_fetch_array($execute_req_user);
					}
					if($element != 0)
					{
					?>
						<div class="resultat_recherche">
						<?php
						while($data = mysqli_fetch_array($execute_req_annonces))
						{
						?>
							<div class="liste_profil Marchandises - 3.5T" id="<?php echo $data['id'];?>">
								<img class="image_profil rounded-circle" id="<?php echo $data['id'];?>" src="<?php echo "img/profil/".$data['profil'];?>" width="125">
								<div id="name_24"><?php echo $data['nom'].' '.$data['prenom'];?></div>
								<div id="region_24"><?php echo $data['region']; ?></div>
								<div class="attestation" id="attestation_24"><?php echo $data['type_attestation'];?></div>
								<div style="font-weight: bold;" id="tarif_24"><?php echo $data['prix'].' €';?></div>
								<div class="<?php echo str_replace(' ','',$data['disponibilite']);?>" id="dispo_24"><?php echo $data['disponibilite'];?></div>
								<?php if(isset($_SESSION['login'])){?>
									<input id="lien_fonction" type="hidden" value="fonctions/fonction_favoris.php">
									<svg <?php 
										if($element_favoris != 0)
										{
											$execute_req_favoris = mysqli_query($base, $req_favoris);
											$fav = false;
											while($resultat_req_favoris = mysqli_fetch_array($execute_req_favoris))
											{
												if($resultat_req_favoris['id_annonce'] == $data['id'] && $resultat_req_favoris['id_utilisateur'] == 
													$resultat_req_user['id'])
												{	
													$fav = true;
												}
											}
											if($fav == true)
											{
												?> class="bi bi-star-fill add_favoris"<?php
											}
											else
											{
												?> class="bi bi-star-fill none_favoris"<?php
											}
										}
										else
										{
										?>
											class="bi bi-star-fill none_favoris"
										<?php	
										}
										?>
									id="<?php echo "star_".$data['id'];?>" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
									<path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.283.95l-3.523 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
									</svg>
								<?php } ?>
							</div>
						<?php
						}
						?></div><?php
					}
					else
					{
					?>
						<div class="w-100 d-flex justify-content-center">
							<div class="d-flex flex-column align-items-center">
								<h3>Aucun résultat !</h3>
								<img class="mt-5" width="30%" src="img/images_site/messagerie_vide.jpg">
							</div>
						</div>
					<?php
					}
				?>
			</div>
			<nav class="d-flex w-100 justify-content-center pagination"aria-label="Page navigation example">
			    <?php  

			    	$tab = explode("&", $_SERVER['QUERY_STRING']);
			    	$page_suivante = $page + 1;
			    	$page_precedente = $page - 1;
			    	if(isset($_GET['page']))
			    	{	
					 	unset($tab[array_search($tab[sizeof($tab)-1], $tab)]);
					  }
					$url = implode("&",$tab);

			    	if($nbr_annonces > $limit)
			    	{
			    	?>
			    	<ul class="pagination">
					    <li class="page-item">
					     	<a class="page-link" href="<?php echo "?".$url."&page=".$page_precedente;?>" aria-label="Previous">
					        	<span aria-hidden="true">&laquo;</span>
					        	<span class="sr-only">Previous</span>
					      	</a>
					    </li>
			    	<?php
			    		for($i=0; $i < $nbr_annonces; $i++)
			    		{	
			    			$j = $i+1;
			    			if($i+1 == $page)
			    			{
			    			?>
			    				<li id="<?php echo $i;?>" class="page-item active"><a class="page-link" href="<?php echo "?".$url."&page=".$j;?>"><?php echo $j;?></a></li>
			    			<?php
			    			}
			    			else
			    			{
			    			?>
			   					<li id="<?php echo $i;?>" class="page-item"><a class="page-link" href="<?php echo "?".$url."&page=".$j;?>"><?php echo $j;?></a></li>
			    			<?php	
			    			}
			    		}
			    		?>
			    			<a class="page-link" href="<?php echo "?".$url."&page=".$page_suivante;?>" aria-label="Next">
			        			<span aria-hidden="true">&raquo;</span>
			        			<span class="sr-only">Next</span>
			      			</a>
			    		</li>
			  		</ul>
			    	<?php
			    	}
			    ?> 
			</nav>	
		</div>
		<div id="footer">
            <?php include('sources/footer.php');?>
        </div>
	</div>
</main>
</body>
</html>