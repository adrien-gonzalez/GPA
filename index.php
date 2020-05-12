<html>
	<head>
		<title>Global Prestations Annexes</title>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=0.7">
		<!-- CSS -->
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
		<link href="css/style.css" rel="stylesheet">
		<!--===============================================================================================-->
		<!-- JQUERY -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
		<!-- MON SCRIPT -->
		<script type="text/javascript" src="js/script.js"></script>
		<!-- BOOTSTRAP -->
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

	</head>

<body id="test" class="accueil">

<?php include('sources/header.php');?>


<div class="header_accueil">
	<div class="content_header">
		<div class="option_recherche">
			<div class="option">	
				<div class="container2">	
				    <div class="dropdown2">
				        <div class="select">
				        	<span>Type d'attestation</span>
				          	<svg class="bi bi-chevron-down" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
							<path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 01.708 0L8 10.293l5.646-5.647a.5.5 0 01.708.708l-6 6a.5.5 0 01-.708 0l-6-6a.5.5 0 010-.708z" clip-rule="evenodd"/>
							</svg>
				        </div>
				        <input type="hidden" name="attestation">
				        <ul class="dropdown2-menu">
							<li>Commissionnaire    </li>
							<li>Marchandises - 3.5T</li>
							<li>Marchandises + 3.5T</li>
							<li>Voyageurs          </li>
				        </ul>
				        
				     </div>
				</div>
				<div class="container2">	
				    <div class="dropdown2">
				        <div class="select">
				        	<span>Région</span>
				          	<svg class="bi bi-chevron-down" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
							<path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 01.708 0L8 10.293l5.646-5.647a.5.5 0 01.708.708l-6 6a.5.5 0 01-.708 0l-6-6a.5.5 0 010-.708z" clip-rule="evenodd"/>
							</svg>
				        </div>
				        <input type="hidden" name="region">
				        <ul class="dropdown2-menu">
							<li>Auvergne-Rhône-Alpes      </li>
							<li>Bourgogne-Franche-Comté   </li>
							<li>Bretagne                  </li>
							<li>Centre-Val de Loire       </li>
							<li>Corse                     </li>
							<li>Grand Est                 </li>
							<li>Hauts-de-France           </li>
							<li>Île-de-France             </li>
							<li>Normandie                 </li>
							<li>Nouvelle-Aquitaine        </li>
							<li>Occitanie				  </li>
							<li>Pays de la Loire		  </li>
							<li>Provence-Alpes-Côte d'Azur</li>
				        </ul>
				     </div>
				</div>
				<div class="container2">	
				    <div class="dropdown2">
				        <div class="select">
				        	<span>Disponibilité</span>
				        	<svg class="bi bi-chevron-down" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
							<path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 01.708 0L8 10.293l5.646-5.647a.5.5 0 01.708.708l-6 6a.5.5 0 01-.708 0l-6-6a.5.5 0 010-.708z" clip-rule="evenodd"/>
							</svg>
				        </div>
				        <input type="hidden" name="disponibilitee">
				        <ul class="dropdown2-menu">
							<li>Immédiate    </li>
							<li>Sous 3 mois  </li>
				        </ul>
				     </div>
				</div>				
				<button class="button_design">Rechercher</button>
			</div>
		</div>
		<div>
		</div>	
	</div>
</div>


</body>

</html>