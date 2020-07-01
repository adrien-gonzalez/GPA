<?php
// DEBAN UTILISATEURS SI BAN 30 JOURS
$deban = "DELETE from ban where DATEDIFF(date_ban, CURDATE()) >= 30";
mysqli_query($base, $deban);

?>

<div class="limiter m-t-100">
    <div class="container-login100">
        <section>
             <div class="wrap-login100 shadow">
                    <form class="login100-form validate-form">
                        <span class="login100-form-title p-b-70">
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
                            <input type="button" id="validate_connect" class="responsive_button login100-form-btn" value="valider">	
                        </div>
                        <div class="text-center m-t-40 ">
                            <p>Besoin d'un compte ? <a class="txt3" href="inscription.php">Inscrivez-vous</a></p>
                            <p>Mot de passe oublié ? <a href="" class="txt3">Cliquez ici</a></p>
                        </div>
                    </form>
                <div id="background_log" class="login100-more"></div>
            </div>
        </section>
    </div>
</div>