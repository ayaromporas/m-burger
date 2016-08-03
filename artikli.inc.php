<?php

//provera postojanja GET parametra

if(isset($_GET['kat'])){    

	$kat_id = sredistring($_GET['kat']);
	$katId = +$kat_id;

	//provera postojanja kategorije iz GET parametra u bazi
	$kats = mysqli_query($conn, "select * from kategorije where kat_id='$katId'");

	while($kat = mysqli_fetch_assoc($kats)){
		$katNaziv = $kat['kat_naziv'];
	}	

	if(mysqli_num_rows($kats) == 1){   //ako prosledjene kategorije ima u bazi

		$artikli = mysqli_query($conn, "select * from artikli where artikal_kategorija like '$kat_id'");

?>		

<div class="central" id='centar'>

	<div class="main">

		<div id="box">
		</div>

		<div class="reg_log_top">           
        	<h2><?php echo $katNaziv; ?></h2>
    	</div> 

    	<div class="artikli">

<?php    		

		while($artikal = mysqli_fetch_assoc($artikli)){

			$artikalId = $artikal['artikal_id'];
			$artikalNaziv = $artikal['artikal_naziv'];
			$artikalOpis = $artikal['artikal_opis'];
			$artikalFoto = $artikal['artikal_foto'];
			$artikalPodrazumevani = $artikal['artikal_prilozi_podrazumevani'];
			$artikalDodatni = $artikal['artikal_prilozi_dodatni'];
			$artikalExtra = $artikal['artikal_prilozi_extra'];
			$artikalCena = $artikal['artikal_cena'];
			$artikalKategorija = $artikal['artikal_kategorija'];
			$artikalNapomena = $artikal['artikal_napomena'];
			$artikalStatus = $artikal['artikal_status'];



			// ispis artikala iz prosledjene kategorije
	// PETAR dodato da bi mogao da funkcionise POP-UP---------------------------------------------------------------------------------			
		//EXTRA PRILOZI					
			$prilogArrey = (explode(",",$artikalExtra)); // pretvaranje stringa u niz
			$priloziExtraArray = array();  //dfinisanje promenjive kao niz
			$cenaPrilogaArray = array();  // deinisanje promenjive kao niz
			foreach ($prilogArrey as $value) { // petlja za izcitavanje niza
				$row = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM prilozi WHERE prilog_id ='$value' "));  //izcitavanje  baze
						
				$prilogExtra = $row["prilog_naziv"]; 
				$cenaPriloga = $row["prilog_cena"];
				array_push($priloziExtraArray,$prilogExtra); // punjenje niza
				array_push($cenaPrilogaArray,$cenaPriloga); // punjenje niza
				}
			$priloziExtra = implode(",",$priloziExtraArray); // pretvaranje niza u string
			$priloziCena = implode(",",$cenaPrilogaArray); // pretvaranje niza u string
				
		//DODATNI PRILOZI					
			$prilogArrey = (explode(",",$artikalDodatni));
			$priloziDodatniArray=array();
			foreach ($prilogArrey as $value) {
				$row = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM prilozi WHERE prilog_id ='$value' "));
				$prilogDodatni = $row["prilog_naziv"];
					
				array_push($priloziDodatniArray,$prilogDodatni);
						 
			}
			$priloziDodatni = implode(",",$priloziDodatniArray);
				
		//PODRAZUMEVANI	PRILOZI				
			$prilogArrey = (explode(",",$artikalPodrazumevani));
			$priloziPodrazumevaniArray=array();
			foreach ($prilogArrey as $value) {
				$row = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM prilozi WHERE prilog_id ='$value' "));
				$prilogPodrazumevani = $row["prilog_naziv"];
						
				array_push($priloziPodrazumevaniArray,$prilogPodrazumevani);
						 
			}
			$priloziPodrazumevani = implode(",",$priloziPodrazumevaniArray);

			echo "<table>";

			echo "<tr><td rowspan='3'><img src='" . $artikalFoto . "' class='td_img'></td><td colspan='3' class='td_naziv'><h3>" . $artikalNaziv . "</h3></td></tr>";
			echo "<tr><td colspan='3'>" . $artikalOpis . "</td></tr>";
			echo "<tr><td>" . $artikalNapomena . "</td><td>" . $artikalCena . '</td><td><button onClick="zum('."'".$artikalNaziv."','".$artikalFoto."','".$artikalOpis."','".$artikalCena."','".$priloziDodatni."','".$priloziPodrazumevani."','".$priloziExtra."','".$priloziCena."'".')">Naruci</button></td></tr>';

			echo "</table>";
			echo "<div class='holder1'></div>";
// END PETAR---------------------------------------------------------------------------------

		}
?>

    	</div> <!-- end artikli -->

	</div> <!-- end main -->

	<div class='sidebar_korpa'>


<?php	

	if(logged_in()){

		//print_r($_SESSION);

		$userId = $_SESSION['user_id'];
	    $userName = $_SESSION['username'];
		$userPhone = $_SESSION['phone'];
	    $userEmail = $_SESSION['email'];
	    $userStatus = $_SESSION['status'];

	    //echo "ok";

	    echo "<h3>Vasa korpa</h3>";


	    // upit za otvorenu korpu ulogovanog korisnika
    	$korpaUpit = mysqli_query($conn, "select * from korpe where korisnik_id like '$userId' && status='0'");

    	if(mysqli_num_rows($korpaUpit) == 1){   //ako otvorene korpe tog korisnika ima u bazi

	    	while($korpa = mysqli_fetch_assoc($korpaUpit)){

	    		$korpaId = $korpa['korpa_id'];
	    		$korpaTotal = $korpa['ukupna_cena'];
	    		$korpaNarudzbine = $korpa['narudzbine'];
	    		//print_r($korpaNarudzbine);


	    		// upit za sve narudzbine u otvorenoj korpi korisnika koji je ulogovan
	    		$narudzbineArray = explode(",", $korpaNarudzbine);
	    		//print_r($narudzbineArray);


	    			// upit za listanje detalja narudzbine u odredjenoj korpi
	    			foreach ($narudzbineArray as $jednaNarudzbina) {
	    				$narudzbinaId = $jednaNarudzbina;
	    				$narudzbinaUpit = mysqli_query($conn, "select * from narudzbine where narudzbina_id like '$narudzbinaId'");

	    				// listanje detalja narudzbine
	    				while($narudzbina = mysqli_fetch_assoc($narudzbinaUpit)){

	    					$narudzbinaId = $jednaNarudzbina;
	    					$narudzbinaArtikalId = $narudzbina['artikal_id'];
	    					$narudzbinaPriloziId = $narudzbina['prilozi_id'];
	    					$narudzbinaKolicina = $narudzbina['kolicina'];
	    					$narudzbinaCena = $narudzbina['cena'];
	    					$narudzbinaNapomena = $narudzbina['napomena'];


	    					// upit za listanje detalja artikla iz narudzbine
	    					$artikliUpit = mysqli_query($conn, "select * from artikli where artikal_id like '$narudzbinaArtikalId'");

	    					while($artikal = mysqli_fetch_assoc($artikliUpit)){

							$artikalId = $artikal['artikal_id'];
							$artikalNaziv = $artikal['artikal_naziv'];
							$artikalOpis = $artikal['artikal_opis'];
							$artikalFoto = $artikal['artikal_foto'];
							$artikalPodrazumevani = $artikal['artikal_prilozi_podrazumevani'];
							$artikalDodatni = $artikal['artikal_prilozi_dodatni'];
							$artikalExtra = $artikal['artikal_prilozi_extra'];
							$artikalCena = $artikal['artikal_cena'];
							//$artikalKategorija = $artikal['artikal_kategorija'];
							$artikalNapomena = $artikal['artikal_napomena'];

							echo "Artikal : ".$artikalNaziv."<br>Kolicina : ".$narudzbinaKolicina ."<br>Ukupno : <b>";

							$artikalCena = $artikalCena * $narudzbinaKolicina;

							echo $artikalCena . "</b><br><br>";

	
	    					}

	    				}

	    			}
	    			
	    		}

	    		echo "<a href='korpa.php'><button class='dugme'>Naruci</button></a>";
	    	}

    	}else{

    		echo "Doslo je do greske pri porucivanju! Obratite se tehnickoj podrsci.";
    	}

 	}else{      //ako prosledjene kategorije nema u bazi

		header ('Location: index.php');
	}



?>
		
	</div> <!-- end sidebar_korpa -->

</div> <!-- end central -->


<?php


}else{     //ako nije prosledjen GET

	header ('Location: index.php');
}


?>



