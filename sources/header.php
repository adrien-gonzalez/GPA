<?php 

session_start();

$url = $_SERVER['PHP_SELF']; 
$reg = '#^(.+[\\\/])*([^\\\/]+)$#';
define('ma_courante', preg_replace($reg, '$2', $url)); ?>
 
<header>
<nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
    <div class="container">
    	<button class="green  navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
      		<span class="navbar-toggler-icon"></span>
      	</button>
	    <div class="collapse navbar-collapse" id="navbarResponsive"> 
	    	<?php if(ma_courante == "index.php")
 			{
 			?>
				<a style="color:white; text-decoration: none;" href="sources/depot_annonce.php"><button class="button_design">Déposer une annonce</button></a>
			<?php
			}
			else
			{
			?>
				<a style="color:white; text-decoration: none;" href="depot_annonce.php"><button class="button_design">Déposer une annonce</button></a>
			<?php	
			}
			?>	
	        <ul class="navbar-nav  ml-auto ">
	        <?php if(ma_courante == "index.php")
 			{
 			?>
	         	<li class="nav-item text-uppercase">
	            	<a class="nav-link js-scroll-trigger"  href="">Accueil</a>
	          	</li>
			  	<li class="nav-item text-uppercase">
	            	<a class="nav-link js-scroll-trigger" href="sources/contact.php">Contact</a>
	          	</li>
	          	<li class="nav-item text-uppercase">
	            	<a class="nav-link js-scroll-trigger" href="sources/a_propos.php">A propos</a>
	          	</li>
	        <?php
	    	}
	    	else
	    	{
	    	?>
	    		<li class="nav-item text-uppercase">
	            	<a class="nav-link js-scroll-trigger"  href="../">Accueil</a>
	          	</li>
			  	<li class="nav-item text-uppercase">
	            	<a class="nav-link js-scroll-trigger" href="contact.php">Contact</a>
	          	</li>
	          	<li class="nav-item text-uppercase">
	            	<a class="nav-link js-scroll-trigger" href="a_propos.php">A propos</a>
	          	</li>
	    	<?php
	    	}
	    	?>
			<div class="dropdown">
				<a class="nav-link js-scroll-trigger text-light dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				MON COMPTE
				</a>
			<?php if(isset($_SESSION['login']))
 			{
 			?>
				<div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
				<?php if(ma_courante == "index.php")
				{
				?>
				   	<a class="dropdown-item" href="sources/messages.php">Messagerie</a>
				   	<a class="dropdown-item" href="sources/favoris.php">Favoris</a>
				    <a class="dropdown-item" href="sources/mes_annonces.php">Annonce</a>
				    <a class="dropdown-item" href="sources/parametre.php">Paramètre</a>
				    <a class="dropdown-item" href="sources/deconnexion.php">Se déconnecter</a>

				<?php
				}
				else
				{
				?>
					<a class="dropdown-item" href="messages.php">Messagerie</a>
				   	<a class="dropdown-item" href="favoris.php">Favoris</a>
				    <a class="dropdown-item" href="mes_annonces.php">Annonce</a>
				    <a class="dropdown-item" href="parametre.php">Paramètre</a>
				    <a class="dropdown-item" href="deconnexion.php">Se déconnecter</a>
				<?php	
				}
				?>
				</div>
			<?php
			}
			else
			{
			?>
				<div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
					<?php if(ma_courante == "index.php")
					{
					?>
						<a class="dropdown-item" href="sources/connexion.php">Se connecter</a>
					    <a class="dropdown-item" href="sources/inscription.php">S'inscrire</a>
					<?php
					}
					else
					{
					?>
						<a class="dropdown-item" href="connexion.php">Se connecter</a>
					    <a class="dropdown-item" href="inscription.php">S'inscrire</a>
					<?php
					}
					?>
					   
				</div>
			</div>
			<?php
			}
			?>
	        </ul>
	    </div>
    </div>
</nav>
</header>


