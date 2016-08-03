<?php

$conn = mysqli_connect("mysql334.loopia.se","ajaromp@l31495","nefertiti1205","lifedesign_rs_db_3");

mysqli_query($conn, 'SET NAMES utf8');

if(!$conn){
	echo "Konekcija nije uspela!";
}



?>
