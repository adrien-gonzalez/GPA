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
		<script type="text/javascript" src="../js/log/connexion.js"></script>
        <script type="text/javascript" src="../js/script.js"></script>
		<!-- BOOTSTRAP -->
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>	
		<script type="text/javascript" src="https://unpkg.com/@popperjs/core@2"></script>

		<!--===============================================================================================-->
    </head>
    

<body class="connexion">
    <main class="ie-stickyFooter">
        <div id="page">
            <div id="header_content">    
                <?php include('header.php');?>
            </div>
            <div id="content">
                <div class="limiter m-t-100">
                    <div class="container-login100">
                        <div class="wrap-login100 shadow">
                            <form class="login100-form validate-form">
                                <span class="login100-form-title p-b-34">
                                    Connexion
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
                                        <input type="button" id="validate_connect" class="login100-form-btn" value="valider">	
                                    </div>
                                    <div class="text-center m-t-40 ">
                                        <p>Besoin d'un compte ? <a class="txt3" href="inscription.php">Inscrivez-vous</a></p>
                                        <p>Mot de passe oublié ? <a href="" class="txt3">Cliquez ici</a></p>
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