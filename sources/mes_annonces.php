<!DOCTYPE html>
<?php require("../fonctions/config.php");?>

<html>
	<head>
		<title></title>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=0.7">
		<!-- CSS -->
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
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
    

<body class="mes_annonces">
   <main class="ie-stickyFooter">
    <div id="page">
		<div id="header_content">	
			<?php include('header.php');
				if(!isset($_SESSION['login']))
				{
					header('Location: ../');
				}
				//DELETE ANNONCE > 60 JOURS
				$delete_annonce = "DELETE from annonce where DATEDIFF(date_validite, CURDATE()) > 60";
	            mysqli_query($base, $delete_annonce);
			?>
		</div>
		<input type="hidden" class="nom_user" id="<?php echo $_SESSION['login'];?>">
        <div id="content">
        	<div class="nombre_annonce w-100">
        		<div class="nombre w-75">
	        		<div id="nombre_annonce" class="shadow">
	        			Annonces en ligne ()
	        		</div>
        		</div>
        	</div>
		</div>
		<div id="footer">
            <?php include('footer.php');?>
        </div>
	</div>
</main>



<div class="modal fade"  id="delete" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Supprimer une annonce</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Voulez-vous supprimer votre annonce ?</p>
      </div>
      <div class="modal-footer">
        <button type="button" id="delete_ok" class="btn btn-primary">Oui</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
      </div>
    </div>
  </div>
</div>


</body>
</html>