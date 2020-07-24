<!DOCTYPE html>
<?php require("../fonctions/config.php");?>

<html>
    <head>
        <title>connexion</title>
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
                <?php include('header.php');
                    if(isset($_SESSION['login']))
                    {
                        header('Location: ../');
                    }
                ?>
            </div>
            <div id="content">
                <?php
                    if(isset($_POST['send_email'])) 
                    {
                        if(!empty($_POST['email']))
                        {
                            $email = htmlspecialchars($_POST['email']);
                            $mailexist = "SELECT id, login FROM utilisateurs WHERE email = '$email'";
                            $execute_mailexist = mysqli_query($base, $mailexist);
                            $ifexist = mysqli_num_rows($execute_mailexist);

                            if($ifexist != 0)
                            {
                                $resultat_mailexist = mysqli_fetch_array($execute_mailexist);
                                $login =  $resultat_mailexist['login'];

                                $_SESSION['email'] = $email;
                                $_SESSION['user'] = $login;
  

                                $chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                                $recup_code = '';
                                for($i=0; $i < 10; $i++){
                                    $recup_code .= $chars[rand(0, strlen($chars)-1)];
                                }

                                $recup_insert = "INSERT INTO recuperation VALUES (NULL, '$email', '$recup_code')";
                                $execute_recup_insert = mysqli_query($base, $recup_insert);

                                 $header="MIME-Version: 1.0\r\n";
                                 $header.='From:"[GPA]"<adrien1361@mail.com>'."\n";
                                 $header.='Content-Type:text/html; charset="utf-8"'."\n";
                                 $header.='Content-Transfer-Encoding: 8bit';
                                 $message = '
                                 <html>
                                 <head>
                                   <title>Récupération de mot de passe - Votresite</title>
                                   <meta charset="utf-8" />
                                 </head>
                                 <body>
                                   <font color="#303030";>
                                     <div align="center">
                                       <table width="600px">
                                         <tr>
                                           <td>
                                             <div align="center">Bonjour <b>'.$login.'</b>,</div>
                                             Voici votre code de récupération: <b>'.$recup_code.'</b><br>
                                           </td>
                                         </tr>
                                         <tr>
                                           <td align="center">
                                             <font size="2">
                                               Ceci est un email automatique, merci de ne pas y répondre
                                             </font>
                                           </td>
                                         </tr>
                                       </table>
                                     </div>
                                   </font>
                                 </body>
                                 </html>
                                 ';
                                mail($email, "Récupération de mot de passe - Votresite", $message, $header);
                               
                            } else {
                                $error_email = "Cette adresse email n'est pas enregistrée";
                            }
                        } else {
                            $error_email = "Veuillez entrer votre adresse email";
                        }
                    } 
                    if(isset($_POST['send_code'])) 
                    {
                        if(!empty($_POST['code']))
                        {
                            // $delete_code = "DELETE from annonce where DATEDIFF('$date' , date_validite) > 60";

                            $code = $_POST['code'];
                            $code_exist = "SELECT id FROM recuperation WHERE code = '$code'";
                            $execute_code_exist = mysqli_query($base, $code_exist);
                            $ifcode_exist = mysqli_num_rows($execute_code_exist);

                            if($ifcode_exist != 0)
                            {   
                                $_SESSION['code'] = true;
                                unset($_SESSION['email']);
                                $result_ifcode_exist = mysqli_fetch_array($execute_code_exist);
                                $id_code = $result_ifcode_exist['id'];
                                $delete_recuperation = "DELETE FROM recuperation WHERE id = '$id_code'";
                                mysqli_query($delete_recuperation);
                            }
                            else
                            {
                                $error_code = "Code non valide"; 
                            }
                        }
                    }
                    if(isset($_POST['update_pass']))
                    {
                        if(!empty($_POST['pass1']) && !empty($_POST['pass2']))
                        {
                            if($_POST['pass1'] == $_POST['pass2'])
                            {
                                if(strlen($_POST['pass1']) >= 8)
                                {   
                                    $user =  $_SESSION['user'];
                                    $password_hash=password_hash($_POST['pass1'], PASSWORD_BCRYPT, ["cost" => 12]);
                                    $update_pass = "UPDATE utilisateurs SET password = '$password_hash' WHERE login = '$user'";
                                    mysqli_query($base, $update_pass);
                                    session_destroy();
                                    header('Location: connexion.php');
                                }
                                else
                                {
                                    $error_pass = "Mots de passe trop court";
                                }
                            }
                            else
                            {
                                $error_pass = "Mots de passe différents";
                            }
                        }
                        else
                        {
                            $error_pass = "Champ(s) vides";
                        }
                        
                    }

                    if(isset($_SESSION['code']))
                    {
                    ?>
                    <div class="limiter m-t-100">
                        <div class="container-login100">
                            <section class="form_admin shadow">
                                <form class="login100-form validate-form" method="post" action="">
                                    <span class="login100-form-title p-b-70">
                                       RESET MOT DE PASSE
                                    </span>
                                    <div class="rs1-wrap-input100 validate-input m-b-20 taille1">
                                        <?php if(isset($error_pass))
                                        {
                                            ?><p class="error"><?php echo $error_pass ?></p><?php
                                        }
                                        ?>
                                    </div>
                                    <div class="login wrap-input100 rs1-wrap-input100 validate-input m-b-20 taille1">
                                        <input class="input100" type="password" name="pass1" placeholder="Mot de passe" required>
                                        <span class="focus-input100"></span>
                                    </div>  
                                    <div class="password1 wrap-input100 rs1-wrap-input100 validate-input m-b-20 taille1" >
                                        <input class="input100" type="password" name="pass2" placeholder="Confirmation mot de passe" required>
                                        <span class="focus-input100"></span>
                                    </div>  
                                    <div class="container-login100-form-btn">
                                        <input type="submit" name="update_pass" class="responsive_button login100-form-btn" value="Modifier"> 
                                    </div>
                               </form>
                            </section>
                        </div>
                    </div>
                    <?php
                    }
                    else if(isset($_SESSION['email']))
                    {
                    ?>
                        <div class="text-center m-t-200">
                            <form class="m-b-20" method="post" action="">
                                <label>Votre code :</label>
                                <input name="code" type="text">
                                <input class="button_design" name="send_code" required type="submit" value="Vérifier">
                            </form>
                            <?php if(isset($error_code))
                            {
                                ?><p class="error"><?php echo $error_code ?></p><?php

                            }?>
                        </div>
                    <?php 
                    }
                    else if(!isset($_SESSION['email']) && !isset($_SESSION['code']))
                    {
                    ?>
                        <div class="text-center m-t-200">
                            <form class="m-b-20" method="post" action="">
                                <label>Votre email :</label>
                                <input name="email" required type="email">
                                <input class="button_design" name="send_email" required type="submit" value="Envoyer">
                            </form>
                            <?php if(isset($error_email))
                            {
                                ?><p class="error"><?php echo $error_email ?></p><?php

                            }?>
                        </div>
                    <?php
                    }
                    ?>
            </div>
            <div id="footer">
                <?php include('footer.php');?>
            </div>
        </div>
    </main>
</body>
</html>

