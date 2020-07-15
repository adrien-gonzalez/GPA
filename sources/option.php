<!DOCTYPE html>
<?php
    require "../fonctions/config.php"; 
    require "../stripe-php/init.php";
?>

<script>
    if(sessionStorage.getItem("option") == null)
    {
        document.location.href="../"
    }
</script>

<html>
	<head>
		<title>Déposer une annonce</title>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=0.7">
		<!-- CSS -->
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
		<link rel="stylesheet" type="text/css" href="../css/formulaire/form.css">
        <link href="../css/style.css" rel="stylesheet">
		<!-- JQUERY -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
		<!-- MON SCRIPT -->
        <script type="text/javascript" src="../js/script.js"></script>
        <script type="text/javascript" src="../js/annonce/option.js"></script>
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
                <?php include('header.php');?>
            </div>
            <div id="content">
                <div class="limiter m-t-100">
                    <div class="container-login100">
                        <section class="avantage">
                            <?php

                                $select_produit = "SELECT *FROM services WHERE categorie = 'Annonce'";
                                $execute_select_produit = mysqli_query($base, $select_produit);
                                $element = mysqli_num_rows($execute_select_produit);

                                if($element != 0)
                                {
                                    while($resultat_select_produit = mysqli_fetch_array($execute_select_produit))
                                    {           
                                    ?>
                                        <div class="card" style="width: 18rem;">
                                            <div class="card-body">
                                                <h5 class="card-title"><?php echo $resultat_select_produit['nom']?></h5>
                                                <p class="card-text">Voulez-vous utilisez ce service pour <?php echo $resultat_select_produit['prix']." € ?" ?></p>
                                                <input id="id_product" type="hidden" value="<?php echo  $resultat_select_produit['id_produit'] ?>">
                                                    <form action="" method="post">
                                                        <input name="name" type="hidden" value="<?php echo $resultat_select_produit['nom']?>">
                                                        <input name="description" type="hidden" value="<?php echo $resultat_select_produit['description']?>">
                                                        <input name="prix" type="hidden" value="<?php echo $resultat_select_produit['prix']?>">
                                                    </form>
                                                    <form action="paiement.php" method="POST">
                                                        <input type="hidden" name="prix" value="<?php echo $resultat_select_produit['prix'] ?>">
                                                        <input type="hidden" name="description" value="<?php echo $resultat_select_produit['description']?>">
                                                        <input type="hidden" name="id" value="<?php echo $resultat_select_produit['id']?>">
                                                        <script
                                                            src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                                                            data-key="pk_test_51H2BsNKouFi2buoUlba3dKbK4ZTYxcZvTiIRE0C2XAXqoDFM34hElyPjz6rWqZQDhktUATKW7BoQos1UzdMn7pjJ00yd1jcvEM"
                                                            data-amount="<?php echo $resultat_select_produit['prix']*100 ?>"
                                                            data-name="<?php echo $resultat_select_produit['nom']?>"
                                                            data-description="<?php echo $resultat_select_produit['description'] ?>"
                                                            data-locale="auto"
                                                            data-currency="eur"
                                                            data-label="Acheter">
                                                        </script>
                                                    </form>
                                                </div>
                                            </div>
                                        <?php 
                                        }
                                    }   
                                ?>
                        </section>
                        <form method="post">
                            <input name="refuse" type="button" id="refuse" class="button_design shadow" value="Déposer mon annonce sans avantages">
                        </form>
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
