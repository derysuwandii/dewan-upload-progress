<?php
	$fileName = $_FILES["file"]["name"]; // Nama File
	$fileTmp = $_FILES["file"]["tmp_name"]; // File di PHP tmp folder
	
	// Jika belum ada folder upload maka buat folder upload
	$temp = "upload/";
	if (!file_exists($temp))
		mkdir($temp);

	if(move_uploaded_file($fileTmp, $temp . "$fileName")){
	    echo "$fileName sukses diupload";
	} else {
	    echo "Upload gagal";
	}
?>