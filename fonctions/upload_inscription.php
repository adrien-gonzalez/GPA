<?php
session_start();
require "config.php";

$uploadOk = 1;
$imageFileType = pathinfo($_FILES['file']['name'],PATHINFO_EXTENSION);

$uploadOk = 0;
$name = sha1(session_id().microtime().'.jpg');
$filename=$name.".jpg";
$location = "../img/profil/".$filename;


move_uploaded_file($_FILES['file']['tmp_name'],$location);
echo "uploadOk";


// SELECT ID
$req_id="SELECT id FROM utilisateurs ORDER BY id DESC";
$execute_req_id=mysqli_query($base, $req_id);
$result_req_id=mysqli_fetch_array($execute_req_id);
$id = $result_req_id['id'];

// INSERT PHOTO DE PROFIL
$insert_image = "UPDATE utilisateurs SET profil = '$filename' WHERE id = '$id'";
mysqli_query($base, $insert_image);

?>
