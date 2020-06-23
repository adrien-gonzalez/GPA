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
		<script type="text/javascript" src="js/annonce/affichage_annonce.js"></script>
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
			<?php include('sources/header.php');?>
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
					if(sizeof($_GET) == "0")
					{	
						$condition[] = "id_utilisateur=utilisateurs.id";
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
					        	$var = $get.'='.'"'.$val.'"';
					        	array_push($condition, $var);
					        }
					    }
					}
					if(sizeof($condition) == 0)
					{
						$condition[] = "id_utilisateur=utilisateurs.id";
					}
					$condition = implode(" and ", $condition);
					$req_annonces="SELECT annonce.id, profil, nom, prenom, region, type_attestation, tel, email, prix, disponibilite FROM utilisateurs INNER JOIN annonce on $condition WHERE id_utilisateur=utilisateurs.id";
					$execute_req_annonces=mysqli_query($base, $req_annonces);
					$element=mysqli_num_rows($execute_req_annonces);

					if($element != 0)
					{
						while($data = mysqli_fetch_array($execute_req_annonces))
						{
						?>
							<div class="liste_profil Marchandises - 3.5T" id="<?php echo $data['id'];?>">
								<img class="image_profil rounded-circle" id="<?php echo $data['id'];?>" src="<?php echo "img/profil/".$data['profil'];?>" width="125">
								<div id="name_24"><?php echo $data['nom'].''.$data['prenom'];?></div>
								<div id="region_24"><?php echo $data['region']; ?></div>
								<div class="attestation" id="attestation_24"><?php echo $data['type_attestation'];?></div>
								<div id="tarif_24"><?php echo $data['prix'].' €';?></div>
								<div class="<?php echo str_replace(' ','',$data['disponibilite']);?>" id="dispo_24"><?php echo $data['disponibilite'];?></div>
							</div>
						<?php
						}
					}
				?>
			</div>	
		</div>
		<div id="footer">
            <?php include('sources/footer.php');?>
        </div>
	</div>
</main>
</body>
</html>