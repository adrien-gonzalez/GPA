<?php

session_start();
require "config.php";

$type 		= $_POST['type'];
$region 	= str_replace("'", "''", $_POST['region']);
$descriptif = $_POST['descriptif'];
$tel 		= $_POST['tel'];
$prix		= $_POST['prix'];
$login = $_SESSION['login'];

// SELECT ID FROM LOGIN
$req_id_user = "SELECT id FROM utilisateurs WHERE login='$login'";
$execute_req_id_user = mysqli_query($base, $req_id_user);
$result_req_id_user = mysqli_fetch_array($execute_req_id_user);
$id_user = $result_req_id_user['id'];

// INSERT ANNONCE
$insert_annonce = "INSERT INTO annonce VALUES (NULL, '$id_user', '$type', '$region', '$descriptif', '$tel', '$prix', NULL)";
mysqli_query($base, $insert_annonce);
echo "ok";




?>