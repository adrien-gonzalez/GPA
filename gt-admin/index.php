<!DOCTYPE html>
<?php 
	require("../fonctions/config.php");
	require "../stripe-php/init.php";
?>
<html>
	<head>
		<title>Global Prestations Annexes</title>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<!-- CSS -->
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
		<link href="../css/style.css" rel="stylesheet">
		<link href="../css/formulaire/form.css" rel="stylesheet">
		<link href="css/administration.css" rel="stylesheet">
		<!--===============================================================================================-->
		<!-- JQUERY -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
		<!-- MON SCRIPT -->
		<script type="text/javascript" src="../js/script.js"></script>
		<script type="text/javascript" src="js/connexion.js"></script>
		<script type="text/javascript" src="js/administration.js"></script>
		<!-- BOOTSTRAP -->
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
	</head>

<body class="admin">
<main class="ie-stickyFooter">
    <div id="page">
		<div id="header_content">	
			<?php include('sources/header_admin.php');?>
		</div>
        <div id="content">
			<?php 
				if(!isset($_SESSION['admin']))
				{
				?>
					<div class="limiter m-t-100">
    					<div class="container-login100">
					        <section class="form_admin shadow">
					            <form class="login100-form validate-form">
					                <span class="login100-form-title p-b-70">
					                    Administration
					                </span>
					                <div class="login wrap-input100 rs1-wrap-input100 validate-input m-b-20 taille1">
					                    <input id="login" class="input100" type="text" name="login" placeholder="Login">
					                    <span class="focus-input100"></span>
					                </div>	
					                <div class="password1 wrap-input100 rs1-wrap-input100 validate-input m-b-20 taille1" >
					                    <input id="password" class="input100" type="password" name="password" placeholder="Mot de passe">
					                    <span class="focus-input100"></span>
					                </div>	
					                <div class="container-login100-form-btn">
					                    <input type="button" id="validate_connect" class="responsive_button login100-form-btn" value="valider">	
					                </div>
					           </form>
					        </section>
    					</div>
					</div>
				<?php
				}
				else
				{
				?>
				<section class="w-100">
				<?php
					$limit = 6;
					$val = "";
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
					$req_annonce = "SELECT annonce.id as annonce_id, type_attestation, region, descriptif, login, date_annonce, email FROM annonce INNER JOIN utilisateurs on utilisateurs.id = id_utilisateur WHERE verif = '0' ORDER BY annonce.id ASC LIMIT $limit OFFSET $offset";
					$execute_req_annonce = mysqli_query($base, $req_annonce);
					$ifelement = mysqli_num_rows($execute_req_annonce);
					
					// NOMBRE DANNONCE
					$req_nbr_annonces="SELECT *FROM annonce WHERE verif = '0'";
					$execute_nbr_annonce = mysqli_query($base, $req_nbr_annonces);
					$nbr_annonces = mysqli_num_rows($execute_nbr_annonce);
				?>
					<div class="card list_panel shadow">
						<ul class="list-group list-group-flush">
					    	<a href="index.php?panel=validation_annonce"><li id="validation_annonce" class="list-group-item">Validation annonces &nbsp;
					    		<?php if($nbr_annonces > 0)
					    		{
					    		?>
					    		<svg width="0.6em" height="0.6em" viewBox="0 0 16 16" class="bi bi-circle-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
									<circle cx="8" cy="8" r="8"/>
								</svg>
								<?php
								}
								?>
					    		</li>
					    	</a>
					    		<a href="index.php?panel=liste_utilisateurs"><li id="liste_utilisateurs" class="list-group-item">Liste des utilisateurs</li></a>
					    		<a href="index.php?panel=parametres"><li id="parametres" class="list-group-item">Paramètres</li></a>
					    		<a href="index.php?panel=mes_produits"><li id="mes_produits" class="list-group-item">Mes services</li></a>
					    		<a href="index.php?panel=liste_paiements"><li id="liste_paiements" class="list-group-item">Paiements effectués</li></a>
					 	</ul>
					</div>
					<div class="pannel_result">
					<?php 
					 	if(isset($_GET['panel']))
					 	{
					 		foreach ($_GET as $get => $val){            
					       		$cond = $val;
					       	}
					       	$panel_list = $_GET['panel'];

					       	// SI PANNEL FOCUS SUR LA VALIDATION ANNONCE
						    if($_GET['panel'] == "validation_annonce")
					       	{					      
							 	$tab = explode("&", $_SERVER['QUERY_STRING']);
						    	if(isset($_GET['page']))
						    	{	
								 	unset($tab[array_search($tab[sizeof($tab)-1], $tab)]);
								 	$page = $_GET['page'];

								 	if($ifelement == 0)
									{
							    		$tab = explode("&", $_SERVER['QUERY_STRING']);
									  	unset($tab[array_search($tab[sizeof($tab)-1], $tab)]);
									  	
									   	$url = implode("&",$tab);
									   	?>
									   		<meta http-equiv="refresh" content="0;?<?php echo $url;?>">
						    			<?php
									}
								}
								else
								{
									$page = 1;
								}
								$page_suivante = $page + 1;
						    	$page_precedente = $page - 1;
								$url = implode("&",$tab);

					       		if($ifelement != 0)
					       		{	
					       			while($resultat_req_annonce = mysqli_fetch_array($execute_req_annonce))
					       			{
					       			?>
					       			<div class="card" style="width: 18rem;">
										<div class="card-body">
									    	<h5 class="card-title"><?php echo $resultat_req_annonce['type_attestation']?></h5>
									    	<h6 class="card-subtitle mb-2 text-muted"><?php echo "Publié par ".$resultat_req_annonce['login']?></h6>
									    	<p class="card-text"><?php echo substr($resultat_req_annonce['descriptif'],0,80)."..." ?></p>
									    	<!-- Button trigger modal -->
											<button id="<?php echo $resultat_req_annonce['annonce_id']?>" type="button" class="btn btn-primary m-b-20 button_card info_annonce" data-toggle="modal" data-target="#exampleModal">
											  Voir détail
											</button><br>
									    	<button id="valid_<?php echo $resultat_req_annonce['annonce_id']?>" class="card-link validate">Valider</button>
									    	<button data-toggle="modal" data-target="#note" id="delete_<?php echo $resultat_req_annonce['annonce_id']?>" class="card-link delete">Supprimer</button>
									  	</div>
									</div>
									<input type="hidden" id="<?php echo $resultat_req_annonce['annonce_id'] ?>email" value="<?php echo $resultat_req_annonce['email'] ?>">
									<?php
					       			}				       		
					       		}
					       		if($nbr_annonces > $limit)
						    	{
						    	?>
					       		<div class="pagination">
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
							    			if($j == $page)
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
							  	</div>
					       	<?php
					       		}
				        	}
				        	else if($_GET['panel'] == "liste_utilisateurs")
				        	{
				        		$req_user = "SELECT *FROM utilisateurs ORDER By login";
				        		$execute_req_user = mysqli_query($base, $req_user);
				        		$number_user = mysqli_num_rows($execute_req_user);

				        		if($number_user != 0)
				        		{
				        		?>
				        			<div class="list-group list_user">
				        				<h6  class="list-group-item">
				        					<?php echo "Nombre d'utilisateurs: ".$number_user;?>
				        				</h6>
				        		<?php
				        			while($resultat_req_user = mysqli_fetch_array($execute_req_user))
				        			{
				        			?>
				        				<div class="list-group-item list-group-item-action détail_user">
									    <div><?php echo $resultat_req_user['login'];?></div>
									    	<button id="<?php echo $resultat_req_user['id']?>" type="button" class="btn btn-primary m-b-20 button_card info_user" data-toggle="modal"data-target="#list_user">
											Voir détail
											</button>
									  	</div>
				        			<?php
				        			}
				        		?>
				        			</div>
				        		<?php
				        		}
				        	}
				        	else if($_GET['panel'] == "parametres")
				        	{
				        		$login_admin = $_SESSION['admin'];
				        		$password_admin = $_SESSION['password'];
				        	?>
				        		<div class="limiter admin_form">
			    					<div class="container-login100">
								        <section class="form_admin shadow">
								            <form class="login100-form validate-form">
								                <span class="login100-form-title p-b-70">
								                    informations
								                </span>
								                <div class="alignement align-items-center m-b-20">
									                <div class="login wrap-input100 rs1-wrap-input100 validate-input taille2 admin_login_change">
									                    <input id="login" disabled class="input100" type="text" name="login" placeholder="Login" value="<?php echo $login_admin?>">
									                    <span class="focus-input100"></span>
									                </div>	
									                <input type="button" id="change_login" class="modif_button w-25 responsive_button login100-form-btn" value="Changer">
								            	</div>
								            	<div class="input-pass alignement align-items-center">
									                <div class="password1 wrap-input100 rs1-wrap-input100 validate-input taille2" >
									                    <input id="password" disabled class="input100" type="password" name="password" placeholder="Mot de passe" value="<?php echo $password_admin ?>">
									                    <span class="focus-input100"></span>
									                </div>
									                <input type="button" id="change_pass" class="modif_button w-25 responsive_button login100-form-btn" value="Changer">
									            </div>
								           </form>
								        </section>
			    					</div>
								</div>
				        	<?php
				        	}
				        	else if($_GET['panel'] == "mes_produits")
				        	{
								$req_produit = "SELECT *FROM services";
								$execute_req_produit = mysqli_query($base, $req_produit);
								$number_produit = mysqli_num_rows($execute_req_produit);
							?>
							<div class="table_produits w-75">
								<table class="table w-100 table_produit shadow">
									  <thead>
									    <tr>
									      <th scope="col">Nom service</th>
									      <th scope="col">Description</th>
									      <th scope="col">Prix</th>
									      <th scope="col"></th>
									      <th scope="col"></th>
									    </tr>
									  </thead>
									  <tbody>
								<?php

								if($number_produit != 0)
								{
									while($resultat_req_produit = mysqli_fetch_array($execute_req_produit))
									{									
									?>
										<tr>
										    <td><?php echo $resultat_req_produit['nom']; ?></td>
										    <td><?php echo $resultat_req_produit['description']; ?></td>
										    <td><?php echo $resultat_req_produit['prix']." €"; ?></td>
										    <td>
										    	<svg id="<?php echo $resultat_req_produit['id']?>"  width="1em" height="1em" viewBox="0 0 16 16" data-toggle="modal" data-target="#update_produit" class="bi bi-pencil affiche_produit" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
													<path fill-rule="evenodd" d="M11.293 1.293a1 1 0 0 1 1.414 0l2 2a1 1 0 0 1 0 1.414l-9 9a1 1 0 0 1-.39.242l-3 1a1 1 0 0 1-1.266-1.265l1-3a1 1 0 0 1 .242-.391l9-9zM12 2l2 2-9 9-3 1 1-3 9-9z"/>
													<path fill-rule="evenodd" d="M12.146 6.354l-2.5-2.5.708-.708 2.5 2.5-.707.708zM3 10v.5a.5.5 0 0 0 .5.5H4v.5a.5.5 0 0 0 .5.5H5v.5a.5.5 0 0 0 .5.5H6v-1.5a.5.5 0 0 0-.5-.5H5v-.5a.5.5 0 0 0-.5-.5H3z"/>
												</svg>
											 </td>
											 <td>
											 	<svg id="<?php echo $resultat_req_produit['id_produit']?>" width="1.2em" height="1.2em" viewBox="0 0 16 16" data-toggle="modal" data-target="#delete_produit" class="bi bi-x delete_produit" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
													<path fill-rule="evenodd" d="M11.854 4.146a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708-.708l7-7a.5.5 0 0 1 .708 0z"/>
											  		<path fill-rule="evenodd" d="M4.146 4.146a.5.5 0 0 0 0 .708l7 7a.5.5 0 0 0 .708-.708l-7-7a.5.5 0 0 0-.708 0z"/>
												</svg>
										 	</td>
										</tr>
									<?php
									}
								}
								?>
								 </tbody>
									</table>
									<svg width="2.5em" height="2.5em" viewBox="0 0 16 16" class="add_product bi bi-plus-circle-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
										<path fill-rule="evenodd" d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4a.5.5 0 0 0-1 0v3.5H4a.5.5 0 0 0 0 1h3.5V12a.5.5 0 0 0 1 0V8.5H12a.5.5 0 0 0 0-1H8.5V4z"/>
									</svg>
								</div>
							<?php
				        	}
				        	else if($_GET['panel'] == "ajout_produit")
				        	{
				        	?>
				        		<div class="limiter m-t-100 admin_form form_service">
			    					<div class="container-login100">
								        <section class="form_admin shadow">
								            <form class="login100-form validate-form">
								                <span class="login100-form-title p-b-70">
								                    Ajout d'un service
								                </span>
								                <div class="d-flex alignement rs1-wrap-input100 validate-input taille1 m-b-20 statut">
								                	<div class="wrap-input100 rs1-wrap-input100 validate-input m-b-20 taille2">
								                    	<input id="nom_produit" class="input100" type="text" placeholder="Nom du service">
								                    	<span class="focus-input100"></span>
								                    </div>
								                    <div class="wrap-input100 rs1-wrap-input100 validate-input m-b-20 taille2">
								                    	<input id="prix" class="input100" type="number" placeholder="Prix">
								                    	<span class="focus-input100"></span>
								                	</div>
								                </div>
								                <div class="d-flex flex-column rs1-wrap-input100 validate-input m-b-20 taille1">
			                                        <textarea id="description_produit" class="input100 wrap-input100" placeholder="Description..."></textarea>
			                                        <span id="span_descriptif" class="focus-input100"></span>
			                                    </div>
			                                    <div class="categorie d-flex flex-column rs1-wrap-input100 validate-input m-b-20 taille1">
			                                    	<select id="categorie" class="input100 wrap-input100">
			                                    		<option value="">Catégorie</option>
			                                    		<option value="Annonce">Annonce</option>
			                                    		<option value="Contrat">Contrat</option>
			                                    	</select>
			                                        <span class="focus-input100"></span>		                                    	
			                                    </div>
								                <div class="container-login100-form-btn">
								                    <input type="button" id="valid_ajout" class="responsive_button login100-form-btn" value="Ajouter">	
								                </div>
								           </form>
								        </section>
			    					</div>
								</div>	
				        	<?php
				        	}
				        	else if($_GET['panel'] == "liste_paiements")
				        	{
				        		$stripe = new \Stripe\StripeClient(
								  'sk_test_51H2BsNKouFi2buoUWmyNEiPXAfPA7hNDpZH6vbsPJ8cWRnWESRXEZCR8p1qSUS1RdEKq35YnFy68eZ4fygBYmSUf00kTzuIVfe'
								);
								$paiement = $stripe->charges->all(['limit' => 50]);
				        	?>
				        	<div class="table_produits w-75 tab_paiement shadow">
								<table class="table w-100 table_produit">
									  <thead>
									    <tr>
									      <!-- <th scope="col">Nom service</th> -->
									      <th scope="col">Prix</th>
									      <th scope="col">Status</th>
									      <th scope="col">Nom </th>
									      <th scope="col">Date </th>
									      <th scope="col"></th>
									      <th scope="col"></th>								    							    
									    </tr>
									  </thead>
									  <tbody>
								<?php

								if(sizeof($paiement) > 0)
								{
									for($i=0; $i < sizeof($paiement); $i++)
									{								
									?>
										<tr>
										    <td><?php  echo $paiement["data"][$i]["amount"]/100 ?> €</td>
										    <?php 
										    	if($paiement["data"][$i]['status'] == "succeeded" && $paiement["data"][$i]["refunded"] != true)
										    	{
										    	?>
										    	<td>
											    	<svg data-toggle="popover" title="Popover title" data-content="And here's some amazing content. It's very engaging. Right?" width="1.5em" height="1.5em" viewBox="0 0 16 16" class="bi bi-check" fill="green" xmlns="http://www.w3.org/2000/svg">
														<path fill-rule="evenodd" d="M10.97 4.97a.75.75 0 0 1 1.071 1.05l-3.992 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.236.236 0 0 1 .02-.022z"/>
													</svg>
												</td>
										    	<?php
										    	}
										    	else if($paiement["data"][$i]['status'] != "succeeded" && $paiement["data"][$i]["refunded"] != true)
										    	{
										    	?>
										    	<td>
											    	<svg  width="1.2em" height="1.2em" viewBox="0 0 16 16" class="bi bi-x" fill="red" xmlns="http://www.w3.org/2000/svg">
														<path fill-rule="evenodd" d="M11.854 4.146a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708-.708l7-7a.5.5 0 0 1 .708 0z"/>
												  		<path fill-rule="evenodd" d="M4.146 4.146a.5.5 0 0 0 0 .708l7 7a.5.5 0 0 0 .708-.708l-7-7a.5.5 0 0 0-.708 0z"/>
													</svg>
												</td>
										    	<?php
										    	}
										    	else if($paiement["data"][$i]["refunded"] == true)
										    	{
										    	?>
										    	<td>
											    	<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-arrow-90deg-left" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
														<path fill-rule="evenodd" d="M6.104 2.396a.5.5 0 0 1 0 .708L3.457 5.75l2.647 2.646a.5.5 0 1 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 0 1 .708 0z"/>
														<path fill-rule="evenodd" d="M2.75 5.75a.5.5 0 0 1 .5-.5h6.5a2.5 2.5 0 0 1 2.5 2.5v5.5a.5.5 0 0 1-1 0v-5.5a1.5 1.5 0 0 0-1.5-1.5h-6.5a.5.5 0 0 1-.5-.5z"/>
													</svg>
												</td>
										    	<?php
										    	}

										    ?>
										    <td><?php  echo $paiement["data"][$i]['billing_details']["name"] ?></td>
										    <?php
										    	date_default_timezone_set('Europe/Paris');
										    ?>
										    <td><?php  echo date('d/m/Y H:i', $paiement["data"][$i]["created"]);  ?></td>
										    <td>
										    	<svg id="<?php echo $paiement["data"][$i]["id"]?>" data-toggle="modal" data-target="#remboursement" width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-reply-fill rembourser" fill="black" xmlns="http://www.w3.org/2000/svg">
													<path d="M9.079 11.9l4.568-3.281a.719.719 0 0 0 0-1.238L9.079 4.1A.716.716 0 0 0 8 4.719V6c-1.5 0-6 0-7 8 2.5-4.5 7-4 7-4v1.281c0 .56.606.898 1.079.62z"/>
												</svg>
										    </td>										   
										    <td>
										    	<svg id="<?php echo $paiement["data"][$i]["id"]?>" width="1em" data-toggle="modal" data-target="#info_paiement" height="1em" viewBox="0 0 16 16" class="bi bi-card-text info_paiement" fill="black" xmlns="http://www.w3.org/2000/svg">
													<path fill-rule="evenodd" d="M14.5 3h-13a.5.5 0 0 0-.5.5v9a.5.5 0 0 0 .5.5h13a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13z"/>
											  		<path fill-rule="evenodd" d="M3 5.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zM3 8a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9A.5.5 0 0 1 3 8zm0 2.5a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5z"/>
												</svg>
											</td>
										</tr>
									<?php
									}
								}
								?>
								 </tbody>
									</table>
								</div>	
				        	<?php
				        	}
				        	?> <input id="panel" type="hidden" value="<?php echo $panel_list;?>"> <?php
				 		}
				 	}
				 	?>
				 	</div>
				</section>
		</div>

		<!-- Modal Validation d'annonce-->
		<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				 <div class="modal-content">
				    <div class="modal-header">
				        <h5 class="modal-title" id="ModalLabel"></h5>
				        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				         	<span aria-hidden="true">&times;</span>
				        </button>
				    </div>
				    <div class="modal-body">
				    	<p class="h6 text-muted" id="region"></p>
				    	<p class="h6 text-muted" id="tarif"></p>
				    	<p class="h6 text-muted" id="user"><p>
				    <hr>
				        <p class="descriptif"></p>
				    <hr>
				      	<div class="d-flex align-items-center">
				      		<img width="50" src="../img/attestations/logo_pdf.png">
				      		<a href="" class="document_pdf">Attestation transport</a>
				      	</div>
				    </div>		     
				    <div class="modal-footer">
				        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
				    </div>
				</div>
			</div>
		</div>
		<!-- Modal Validation d'annonce-->

		<!-- Modal note annonce refusé -->
		<div class="modal fade" id="note" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
			<div class="modal-dialog" role="document">
		    	<div class="modal-content">
		      		<div class="modal-header">
		        		<h5 class="modal-title" id="exampleModalLongTitle">Annonce refusée</h5>
		        		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          			<span aria-hidden="true">&times;</span>
		        		</button>
		      		</div>
		      		<div class="modal-body">
		      			<form class="login100-form validate-form">
                            <div style="height: 200px;" class="wrap-input100 rs1-wrap-input100 validate-input m-b-20 taille1">
                                <textarea id="note_annonce" class="input100" placeholder="Note"></textarea>
                                <span class="focus-input100"></span>
                            </div> 
                        </form>
		      		</div>
		      	<div class="modal-footer">
		        	<button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
		        	<button id="envoie_note" type="button" class="btn btn-primary">Envoyer</button>
		      	</div>
		    	</div>
		  	</div>
		</div>
		<!-- Modal note annonce refusé -->
		
		<!-- Modal info utilisateurs-->
		<div class="modal fade" id="list_user" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				 <div class="modal-content">
				    <div class="modal-header">
				        <h5 class="modal-title" id="login"></h5>
				        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				         	<span aria-hidden="true">&times;</span>
				        </button>
				    </div>
				    <div class="modal-body">
				    	<p class="h6 text-muted" id="nom_prenom"></p>
				    	<p class="h6 text-muted" id="age"></p>
				    	<p class="h6 text-muted" id="inscription_date"><p>
				    	<img id="profil_user" src="">
				    </div>		     
				    <div class="modal-footer">
				    	<input type="hidden" id="id_user_hidden">
				        <button id="ban" type="button" class="btn btn-secondary">Ban 30 jours</button>
				        <button id="ban_perm" type="button" class="btn btn-secondary">Ban perm</button>
				        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
				    </div>
				</div>
			</div>
		</div>
		<!-- Modal info utilisateurs-->

		<!-- Modal update produit-->
		<div class="modal fade" id="update_produit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
			<div class="modal-dialog" role="document">
		    	<div class="modal-content">
		      		<div class="modal-header">
		        		<h5 class="modal-title" id="exampleModalLongTitle">Mise à jour produit</h5>
		        		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          			<span aria-hidden="true">&times;</span>
		        		</button>
		      		</div>
		      		<div class="modal-body">
						<div class="limiter">
		      				<div class="container-login100">
								<div class="update_form">
		      	 					<form class="login100-form validate-form">
		      	 						<div class="d-flex alignement rs1-wrap-input100 validate-input taille1 m-b-20 statut">
											<div class="wrap-input100 rs1-wrap-input100 validate-input m-b-20 taille2">
												<input id="produit_update" class="input100" type="text" placeholder="Nom produit">
												<span class="focus-input100"></span>
											</div>
											<div class="wrap-input100 rs1-wrap-input100 validate-input m-b-20 taille2">
												<input id="prix_update" class="input100" type="number" placeholder="Prix">
												<span class="focus-input100"></span>
											</div>
										</div>
										<div class="d-flex flex-column rs1-wrap-input100 validate-input m-b-20 taille1">
											<textarea id="description_update" class="input100 wrap-input100" placeholder="Description..."></textarea>
			                                <span id="span_descriptif" class="focus-input100"></span>
										</div>
									</form>
								</div>
							</div>
						</div>
		      		</div>
		      	<div class="modal-footer">
		      		<input id="id_produit" type="hidden">
		        	<button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
		        	<button id="update" type="button" class="btn btn-primary">Valider</button>
		      	</div>
		    	</div>
		  	</div>
		</div>
		<!-- Modal update produit -->

		<!-- Modal delete produit -->
		<div class="modal fade" id="delete_produit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
			<div class="modal-dialog" role="document">
		    	<div class="modal-content">
		      		<div class="modal-header">
		        		<h5 class="modal-title" id="exampleModalLongTitle">Suppression du produit</h5>
		        		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          			<span aria-hidden="true">&times;</span>
		        		</button>
		      		</div>
		      		<div class="modal-body">	
		      			<p>Voulez-vous supprimer le produit ?</p>		
		      		</div>
		      	<div class="modal-footer">
		      		<input id="id_produit" type="hidden">
		        	<button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
		        	<button id="delete" type="button" class="btn btn-primary">Supprimer</button>
		      	</div>
		    	</div>
		  	</div>
		</div>
		<!-- Modal delete produit -->

		<!-- Modal info paiement -->
		<div class="modal fade" id="info_paiement" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
			<div class="modal-dialog" role="document">
		    	<div class="modal-content">
		      		<div class="modal-header">
		        		<h5 class="modal-title" id="exampleModalLongTitle">Information Paiement</h5>
		        		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          			<span aria-hidden="true">&times;</span>
		        		</button>
		      		</div>
		      		<div class="modal-body">
		      			<p class="h6 text-muted" id="moyen_paiement"></p>
				    	<p class="h6 text-muted" id="origine"></p>
				    	<p class="h6 text-muted" id="dernier_chiffre"><p>
		      		<hr>
		      			<p class="h6">Description :</p>
		      			<p class="h6 text-muted" id="description_paiement"></p>
		      		</div>
		      	<div class="modal-footer">
		        	<button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
		      	</div>
		    	</div>
		  	</div>
		</div>
		<!-- Modal info paiement -->

		<!-- Modal remboursement paiement -->
		<div class="modal fade" id="remboursement" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
			<div class="modal-dialog" role="document">
		    	<div class="modal-content">
		      		<div class="modal-header">
		        		<h5 class="modal-title" id="exampleModalLongTitle">Information Paiement</h5>
		        		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          			<span aria-hidden="true">&times;</span>
		        		</button>
		      		</div>
		      		<div class="modal-body">
		      			<p>Voulez-vous rembourser le paiement ?</p>
		      		</div>
		      	<div class="modal-footer">
		        	<button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
		        	<button id="rembourser" type="button" class="btn btn-primary" data-dismiss="modal">Oui</button>
		      	</div>
		    	</div>
		  	</div>
		</div>
		<!-- Modal remboursement paiement -->
		
		<div id="footer">
            <?php include('sources/footer_admin.php');?>
        </div>
	</div>
</main>
</body>

</html>