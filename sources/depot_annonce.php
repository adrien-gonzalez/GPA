<html>
	<head>
		<title>Déposer une annonce</title>
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
		<script type="text/javascript" src="../js/ajout_annonce/ajout_annonce.js"></script>
        <script type="text/javascript" src="../js/script.js"></script>
		<!-- BOOTSTRAP -->
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>	
		<script type="text/javascript" src="https://unpkg.com/@popperjs/core@2"></script>

		<!--===============================================================================================-->
    </head>
    

<body class="ajout_annonce">
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
                <div class="limiter m-t-100">
                    <div class="container-login100">
                        <div class="wrap-login100 shadow">
                            <form class="login100-form validate-form" enctype="multipart/form-data">
                                <span class="login100-form-title p-b-34">
                                    Déposer une annonce
                                </span>
                                <div class="flex-row">
                                    <div class="rs1-wrap-input100 validate-input m-b-20 taille2">      
                                        <select id='attestation' class="input100 wrap-input100">
                                            <option value="0">Type d'attestation</option>                                         
                                            <option>Commissionnaire    </option>
                                            <option>Marchandises - 3.5T</option>
                                            <option>Marchandises + 3.5T</option>                                          
                                            <option>Voyageurs          </option>
                                        </select>
                                        <span class="focus-input100"></span>
                                    </div>	
                                    <div class="rs1-wrap-input100 validate-input m-b-20 taille2">
                                        <select id="region" class="input100 wrap-input100">
                                            <option value="0">Région</option>
                                            <option>Auvergne-Rhône-Alpes</option>
                                            <option>Bourgogne-Franche-Comté</option>
                                            <option>Bretagne</option>
                                            <option>Centre-Val de Loire</option>
                                            <option>Corse</option>
                                            <option>Grand Est</option>
                                            <option>Hauts-de-France</option>
                                            <option>Île-de-France</option>
                                            <option>Normandie</option>
                                            <option>Nouvelle-Aquitaine</option>
                                            <option>Occitanie</option>
                                            <option>Pays de la Loire</option>
                                            <option>Provence-Alpes-Côte d'Azur</option>
                                        </select>
                                        <span class="focus-input100"></span>
                                    </div>
                                </div>
                                <div class="d-flex flex-column rs1-wrap-input100 validate-input taille1">
                                    <textarea id="descriptif" class="input100 wrap-input100" placeholder="Descriptif de parcours / expériences / objectifs"></textarea>
                                    <span class="focus-input100"></span>
                                </div>
                                    <div class="d-flex justify-content-between taille1">
                                        <div class="caractères_minimum">100 caractères minimum</div>
                                        <div class="nombre_caractere m-b-20"></div>
                                    </div>
                                <div id="container2" class="d-flex flex-column taille1 m-b-40">
                                    <div class="affichage_image"></div>
                                    <label id="label_image" class="label" for="input" >Mon attestation :</label>
                                    <div class="input">
                                        <input name="input" id="fileToUpload" type="file" accept="application/pdf">     
                                    </div>
                                        <p class="type_fichier">Types de fichiers acceptés: pdf</p>
                                </div>
                                <div class="flex-row m-b-40">
                                    <div class="nom wrap-input100 rs1-wrap-input100 validate-input taille2">
                                        <input id="tel" class="input100" type="tel" name="tel" pattern="^((\+\d{1,3}(-| )?\(?\d\)?(-| )?\d{1,5})|(\(?\d{2,6}\)?))(-| )?(\d{3,4})(-| )?(\d{4})(( x| ext)\d{1,5}){0,1}$" placeholder="Téléphone">
                                        <span class="focus-input100"></span>
                                    </div>
                                    <div class="nom wrap-input100 rs1-wrap-input100 validate-input taille2">
                                        <input id="prix" class="input100" type="number" name="prix" placeholder="Prix">
                                        <span class="focus-input100"></span>
                                    </div>
                                </div>
                                <div class="container-login100-form-btn">
                                    <input type="button" id="validate_annonce" class="responsive_button login100-form-btn" value="valider">	
                                </div>
                            </form>
                                <div id="background_log" class="login100-more"></div>
                        </div>
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


