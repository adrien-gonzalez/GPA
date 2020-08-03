<!DOCTYPE html>
<?php require("../fonctions/config.php");?>

<html>
	<head>
		<title>connexion</title>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
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
                <?php include('header.php');
                    if(isset($_SESSION['login']))
                    {
                        header('Location: ../');
                    }
                ?>
            </div>
            <div id="content">
               <?php require "../fonctions/form_connexion.php"; ?>
            </div>
            <div id="footer">
                <?php include('footer.php');?>
            </div>
        </div>
    </main>
</body>
</html>