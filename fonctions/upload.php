<?php
session_start();
require "config.php";

$uploadOk = 1;
$valid_extensions = array("jpg","jpeg","png");
$imageFileType = pathinfo($_FILES['file']['name'],PATHINFO_EXTENSION);

if( !in_array(strtolower($imageFileType),$valid_extensions) ) {
   
   echo "wrong_format";
}
else
{
	$uploadOk = 0;
	$name = sha1(session_id().microtime().'.jpg');
	$filename=$name.".jpg";
	$location = "../img/profil/".$filename;

	move_uploaded_file($_FILES['file']['tmp_name'],$location);
	echo "uploadOk";
}

// SELECT ID
$req_id="SELECT id FROM utilisateurs ORDER BY id DESC";
$execute_req_id=mysqli_query($base, $req_id);
$result_req_id=mysqli_fetch_array($execute_req_id);
$id = $result_req_id['id'];

// INSERT PHOTO DE PROFIL
$insert_image = "UPDATE utilisateurs SET profil = '$location' WHERE id = '$id'";
mysqli_query($base, $insert_image);
?>
