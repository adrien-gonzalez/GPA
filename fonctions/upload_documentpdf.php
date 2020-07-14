<?php
session_start();
require "config.php";

	$imageFileType = pathinfo($_FILES['file']['name'],PATHINFO_EXTENSION);
	$name = sha1(session_id().microtime().'.pdf');
	$filename=$name.".pdf";
	$location = "../img/attestations/".$filename;

	move_uploaded_file($_FILES['file']['tmp_name'],$location);
	echo $name;
?>
