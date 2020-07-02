<?php require("../fonctions/config.php");?>
<html>
	<head>
		<title>Global Prestations Annexes</title>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=0.7">
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

					$req_annonce = "SELECT annonce.id as annonce_id, type_attestation, region, descriptif, login FROM annonce INNER JOIN utilisateurs on utilisateurs.id = id_utilisateur WHERE verif = '0' LIMIT $limit OFFSET $offset";
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
									    	<button id="delete_<?php echo $resultat_req_annonce['annonce_id']?>" class="card-link delete">Supprimer</button>
									  	</div>
									</div>
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
								                <div class="flex-row align-items-center m-b-20">
									                <div class="login wrap-input100 rs1-wrap-input100 validate-input taille2 admin_login_change">
									                    <input id="login" disabled class="input100" type="text" name="login" placeholder="Login" value="<?php echo $login_admin?>">
									                    <span class="focus-input100"></span>
									                </div>	
									                <input type="button" id="change_login" class="modif_button w-25 responsive_button login100-form-btn" value="Changer">
								            	</div>
								            	<div class="input-pass flex-row align-items-center">
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
				        	?> <input id="panel" type="hidden" value="<?php echo $panel_list;?>"> <?php
				 		}
				 	?>
				 	</div>
				</section>

				<?php
				}
			?>
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
		
		<div id="footer">
            <?php include('../sources/footer.php');?>
        </div>
	</div>
</main>
</body>

</html>