<?php
session_start();
//print_r($_SESSION);
//error_reporting(0);
require_once('connect.inc.php');
require_once('functions.php');

$errors = array();

if(isset($_SESSION['username'])){

	$un = $_SESSION['username'];

	$query = mysqli_query($conn, "select * from korisnici where korisnik_username='$un'");

	while($row = mysqli_fetch_assoc($query)){
			$userStatus = $row['korisnik_status'];

			if($userStatus == 1 || $userStatus == 0){
		
				header('Location: logout.php');
        	}
		}
}
   




?>