<div class="central">
    <div class="reg_log_top">
        <h2>Vasa korpa</h2>
    </div>

    <div class="reg_log_text">
        <p>Pogledajte detaljan prikaz Vase korpe i proverite jos jednom da li je sve sto ste zeleli da porucite tu.  </p>
    </div> 

    <div class="prikaz_korpe">

<?php
	//  PETAR ---------------------------------------------------------------------------------------------------------
	if(isset($_POST['korpa'])){
		echo $_POST['artikal']."<br>";
	
		for($i=0;isset($_POST['sastojci'.$i]);$i++){
			echo $_POST['sastojci'.$i]."<br>";
		}
	
		for($i=0;isset($_POST['dodatni'.$i]);$i++){
			echo $_POST['dodatni'.$i]."<br>";
		}

		for($i=0;isset($_POST['extradodaci'.$i]);$i++){
			echo $_POST['extradodaci'.$i]."<br>";
		}

		echo $_POST['cena']."<br>";
	}
	// END PETAR------------------------------------------------------------------------------------------------------


	print_r($_SESSION);

	$userId = $_SESSION['user_id'];
    $userName = $_SESSION['username'];
	$userPhone = $_SESSION['phone'];
    $userEmail = $_SESSION['email'];
    $userStatus = $_SESSION['status'];

	// upit za otvorenu korpu ulogovanog korisnika
    	$korpaUpit = mysqli_query($conn, "select * from korpe where korisnik_id like '$userId' && status='0'");

    	if(mysqli_num_rows($korpaUpit) == 1){   //ako ima otvorene korpe tog korisnika u bazi

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

							echo "<img src='{$artikalFoto}'><br>";

							echo "Artikal : ".$artikalNaziv."<br>Kolicina : ".$narudzbinaKolicina ."<br>Ukupno : <b>";

							$artikalCena = $artikalCena * $narudzbinaKolicina;

							echo $artikalCena . "</b><br><br>";

	
	    					}

	    				}

	    			}
	    			
	    		}

	    		echo "<a href='korpa.php'><button class='dugme'>Posalji porudzbinu</button></a>";
	    	}else{

    		echo "Doslo je do greske pri porucivanju! Obratite se tehnickoj podrsci.";
    	}



    	







?>
    </div>




</div>   <!-- end central -->    