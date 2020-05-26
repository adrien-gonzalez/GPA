<?php
session_start();
require "config.php";

$imageFileType = pathinfo($_FILES['file']['name'],PATHINFO_EXTENSION);

$name = sha1(session_id().microtime().'.pdf');
$filename=$name.".pdf";
$location = "../img/attestations/".$filename;
	
move_uploaded_file($_FILES['file']['tmp_name'],$location);
echo "uploadOk";


// SELECT ID
$req_id="SELECT id FROM annonce ORDER BY id DESC";
$execute_req_id=mysqli_query($base, $req_id);
$result_req_id=mysqli_fetch_array($execute_req_id);
$id = $result_req_id['id'];

// INSERT PHOTO DE PROFIL
$insert_document = "UPDATE annonce SET document = '$filename' WHERE id = '$id'";
mysqli_query($base, $insert_document);

?>
