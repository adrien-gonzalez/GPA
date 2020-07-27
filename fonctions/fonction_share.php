<?php

session_start();
require "config.php";

$sujet = "On vous a partagé un profil !";
$email = $_POST['email'];
$url_user = $_POST['url_user'];
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
                                             <div align="center">Bonjour, on vous a partagé un profil <a href="'.$url_user.'">Cliquez ici</a></div>
                                           </td>
                                         </tr>
                                         <tr>

                                         </tr>
                                       </table>
                                     </div>
                                   </font>
                                 </body>
                                 </html>
                                 ';

// send email
mail($email, $sujet ,$message, $header);

?>