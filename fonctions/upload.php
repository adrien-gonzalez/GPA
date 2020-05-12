<?php

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