<?php
include_once('init.inc.php');
include('header.inc.php');

if(logged_in() || is_unactivated() || is_blocked()) header ('Location: index.php');

?>
<div class="central">
	<div class="reg_log_top">
		<h2>Registracija</h2>
	</div>

	<div class="reg_log_text">
	    <p>Klikom na dugme <b><em>"Registruj se"</em></b> smatramo da ste procitali i da prihvatate <a href="">PRAVILA UPOTREBE SAJTA M-BURGER.</a><br><br>
	    Molimo Vas da pri registraciji koristite e-mail adresu kojoj imate pristup kako bi mogli da otvorite verifikacioni link koji ćemo Vam proslediti i koji je potrebno da kliknete da bi završili proces registracije. <br><br>
	    Podatke koje nam ostavljate zadržavamo za sebe. Nikada nećemo objaviti vaše podatke ili ih dati trećem licu na uvid. <br><br>
	    Registracijom se obavezujete da nećete zloupotrebljavati servis za poručivanje hrane, a ukoliko se desi da porucenu hranu nećete da primite bez opravdanog razloga bicete blokirani na ovom sajtu. <br><br>
	    Informacije o nama mozete procitati na nasoj <a href="#">KONTAKT</a> strani.<br>
	    <a href="#">USLOVI PORUCIVANJA</a> i <a href="#">INFORMACIJE O DOSTAVI</a> su Vam takodje dostupni, kao i <a href="#">USLOVI REKLAMACIJE</a>.<br><br>
	    Hvala Vam što koristite naš servis za online naručivanje hrane. Prijatno!<br><br>
	    Vaš M-Burger!</p>
	</div>  



	<div class="reg_log_form">  

	    <form action="register.php" method="POST" name="registerform">
	  
				Korisničko ime:<br>
		        <input type="text" name="username" value='<?php if(isset($_POST['submit'])){ if(isset($_POST['username'])){echo $_POST['username'];}} ?>' required><br>
		      
		        Vaš telefon:<br>
		        <input type="text" name="phone" value='<?php if(isset($_POST['submit'])){ if(isset($_POST['phone'])){echo $_POST['phone'];}} ?>' required><br>
				Vaš email:<br>
				<input type="email" name="email" value='<?php if(isset($_POST['submit'])){ if(isset($_POST['email'])){echo $_POST['email'];}} ?>' required><br>
		        Lozinka:<br>
		        <input type="password" name="password" value='<?php if(isset($_POST['submit'])){ if(isset($_POST['password'])){echo $_POST['password'];}} ?>' required><br>
		        
		        <input type="hidden" name="status" value="0">


	        <input type="submit" name="submit" value="Registruj se" class="dugme"><br><br>
	    </form>
	</div>


<?php



$regex1 = "/^[a-zA-Z]+$/";
$regex2 = "/^[A-Za-z0-9._-]+\@[a-zA-Z0-9]+.[a-zA-Z]{2,3}$/";
$regex3 = "/^[a-zA-Z0-9]+$/";
$regex4 = "/^[0-9]+$/";
$regex5 = "/^[A-Za-z0-9._-]+$/";

if(isset($_POST['submit'])){

	//provera telefona
	if(!empty($_POST['phone'])){
		$phone = sredistring($_POST['phone']);
		if(!preg_match($regex4, $phone)){
			$errors[] = "Unesite samo brojeve u polje za telefon";
		}
	}	

	//provera emaila
	if(!empty($_POST['email'])){
		$email = sredistring($_POST['email']);
		if(!preg_match($regex2, $email)){
			$errors[] = "Unesite validan email";
		}
	}else{
		$errors[] = "Morate uneti email";
	}

	//provera username-a
	if(!empty($_POST['username'])){
		$username = sredistring($_POST['username']);
		if(!preg_match($regex3, $username)){
			$errors[] = "Nisu dozvoljeni razmaci i specijalni karakteri u polju za korisnicko ime";
		}
	}else{
		$errors[] = "Morate uneti korisnicko ime";
	}

	//provera passworda
	if(!empty($_POST['password'])){
		$password = sredistring($_POST['password']);
		if(!preg_match($regex3, $password)){
			$errors[] = "Password moze sadrzati samo slova ili brojeve";
		}
		if(!(strlen($password) > 5 && strlen($password) < 11 )){
			$errors[] = "Lozinka moze imati 6-10 karaktera";
		}
	}else{
		$errors[] = "Morate uneti lozinku";
	}


	//provera postojanja korisnika
	$checkEmail = mysqli_query($conn, "select * from korisnici where korisnik_email='$email'");
	if(mysqli_num_rows($checkEmail) == 1){
		$errors[] = "Korisnik sa ovim emailom vec postoji u bazi";
	}
	$checkUsername = mysqli_query($conn, "select * from korisnici where korisnik_username='$username'");
	if(mysqli_num_rows($checkUsername) == 1){
		$errors[] = "Korisnik sa ovim korisnickim imenom vec postoji u bazi";
	}
	$checkPhone = mysqli_query($conn, "select * from korisnici where korisnik_brojtel='$phone'");
	if(mysqli_num_rows($checkPhone) == 1){
		$errors[] = "Korisnik sa ovim telefonom vec postoji u bazi";
	}

	//provera greski i upis u bazu ukoliko ih nema
	if(empty($errors)){
		$registracija = mysqli_query($conn, "insert into korisnici (korisnik_brojtel,korisnik_email,korisnik_username,korisnik_password,korisnik_status) 
			values ('$phone','$email','$username','$password','1')");
		if($registracija){
			echo "<script>alert('Uspesno ste poslali formu. Poslat Vam je email sa linkom koji je potrebno da kliknete kako biste zavrsili proces registracije. Nakon toga mozete porucivati.'); </script>";

			$_SESSION['username'] = $username;
			$_SESSION['status'] = 0;
			
		}else{
			echo "<script>alert('Doslo je do greske pri procesu registracije. Obratite se tehnickoj podrsci.'); </script>";
		}			
	}


	
}

else{
	//$errors[] = "Ovo korisnik vidi kad prvi put otvori stranu";
}



foreach ($errors as $error) {

	echo "<div class='warning'>". $error . "!</div>";
	echo "<br>";

}

echo "</div>";

include('footer.inc.php');


?>

