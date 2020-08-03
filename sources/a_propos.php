<!DOCTYPE html>

<html>
	<head>
		<title>A propos</title>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<!-- CSS -->
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
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
    

<body class="a_propos">
    <main class="ie-stickyFooter">
        <div id="page">
            <div id="header_content">    
               <?php include('header.php'); ?> 
            </div>
            <div id="content">
                <section class="mt-5 d-flex justify-content-center w-100">
                    <div class="jumbotron w-75">
                        <h1 class="display-4 taille">Comment créer une société transport ?</h1>
                        <p class="lead">Pour créer une société transport il faut avant tout commencer par demander une autorisation d’exercer la profession de transport routier auprès de la Dreal ou Driea de sa Région.</p>
                        <hr class="my-4">
                        <p>Cette demande se réalise à partir d’un CERFA 14557*03.</p>
                        <a href="https://www.service-public.fr/professionnels-entreprises/vosdroits/R14156" role="button"><button class="button_design">CERFA 14557*03</button></a>
                        <p class="mt-5">Plus d'informations<a href="https://www.ecologique-solidaire.gouv.fr/acces-et-exercice-profession-transporteur-marchandises-0"> ici</a></p>
                    </div>
                </section>
            </div>
            <div id="footer">
                <?php include('footer.php');?>
            </div>
        </div>
    </main>
</body>
</html>