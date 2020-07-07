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
	    	<?php if(isset($_SESSION['admin']))
 			{
				echo "Bonjour ".$_SESSION['admin']." !";
			}
			?>
	        <ul class="navbar-nav  ml-auto ">
	         	<li class="nav-item text-uppercase">
	            	<a class="nav-link js-scroll-trigger"  href="../">Retour au site</a>
	          	</li>
			<div class="dropdown">
				<a class="nav-link js-scroll-trigger text-light dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				MON COMPTE
				</a>
			<?php if(isset($_SESSION['admin']))
 			{
 			?>
				<div class="dropdown-menu" aria-labelledby="dropdownMenuLink">	
				    <a class="dropdown-item" href="sources/deconnexion.php">Se déconnecter</a>
				</div>
			<?php
			}
			?>
	        </ul>
	    </div>
    </div>
</nav>
</header>


