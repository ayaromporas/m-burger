<div class="central">
    <div class="reg_log_top">
        <h2>Vasa korpa</h2>
    </div>

    <div class="reg_log_text">
        <p>Pogledajte detaljan prikaz Vase korpe i proverite jos jednom da li je sve sto ste zeleli da porucite tu.  </p>
    </div> 

    <div class="prikaz_korpe">

<?php

	//print_r($_SESSION);

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


							// upit za listanje priloga detaljno
							$priloziPodrazumevaniArray = explode(",", $artikalPodrazumevani);
							$priloziDodatniArray = explode(",", $artikalDodatni);
							$priloziExtraArray = explode(",", $artikalExtra);


							//iscrtavanje tabele
							echo "<table>";

							echo "<tr><td rowspan='4'><img src='../{$artikalFoto}' height='100'></td>";

							echo "<td colspan='3'><b>".$artikalNaziv . "</b></td></tr>";

							echo "<tr><td colspan='3'>".$artikalOpis . "</td></tr>";

							echo "<tr><td><b>Osnovni prilozi:</b><br>";



								foreach ($priloziPodrazumevaniArray as $prilogPodrazumevani) {
								$prilPodr = $prilogPodrazumevani;
								$prilPodrUpit = mysqli_query($conn, "select * from prilozi where prilog_id like '$prilogPodrazumevani'");
								//echo $prilogPodrazumevani;


								// listanje naziva podrazumevanih priloga
								while($pP = mysqli_fetch_assoc($prilPodrUpit)){
									$prilog_naziv = $pP['prilog_naziv'];
									echo $prilog_naziv . "<br>";
									}
								}

								echo "</td><td><b>Dodatni prilozi: </b><br>";

								foreach ($priloziDodatniArray as $prilogDodatni) {
								$prilDod = $prilogDodatni;
								$prilDodUpit = mysqli_query($conn, "select * from prilozi where prilog_id like '$prilogDodatni'");
								//echo $prilogPodrazumevani;


								// listanje naziva dodatnih priloga
								while($pD = mysqli_fetch_assoc($prilDodUpit)){
									$prilog_naziv = $pD['prilog_naziv'];
									echo $prilog_naziv . "<br>";
									}
								}

								echo "</td><td><b>Extra prilozi: </b><br>";

								foreach ($priloziExtraArray as $prilogExtra) {
								$prilExtra = $prilogExtra;
								$prilExtUpit = mysqli_query($conn, "select * from prilozi where prilog_id like '$prilogExtra'");
								//echo $prilogPodrazumevani;


								// listanje naziva extra priloga
								while($pE = mysqli_fetch_assoc($prilExtUpit)){
									$prilog_naziv = $pE['prilog_naziv'];
									echo $prilog_naziv . "<br>";
									}
								}

								echo "</td></tr>";

							echo "<tr><td colspan='2'>Kolicina : ".$narudzbinaKolicina ."</td><td>Ukupno : <b>";

							$artikalCena = $artikalCena * $narudzbinaKolicina;

							echo $artikalCena . "</b></td></tr>";

							echo "</table>";

							echo "<img src='../images/x.png'>";
	
	    					}
	    				}
	    			}	
	    			
	    		}
?>

	<form name='korpa' action='#' method='post'>

		<p>Unesite svoju adresu:</p>
		<input type='text' name='adresa'><br>
		<p>Napomena za dostavu:</p>
		<textarea name='napomena'></textarea><br><br>
		<button type='submit' name='submit' value='Posalji porudzbinu' class='dugme'>Posalji porudzbinu</button>

	</form>	

<?php
	    		

	    	}else{

    		echo "Vasa korpa je prazna.";
    	}



?>
    </div>




</div>   <!-- end central -->    