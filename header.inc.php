<!DOCTYPE html>
<html>
<head>
	<title>M - BURGER</title>
	<meta charset="utf-8">
	<meta name="description" content="M BURGER">
	<link href="css/style.css" rel="stylesheet" type="text/css">
	<script type="text/javascript" src="jquery-1.11.3.min.js"></script>
</head>

<body>
	<div class="wrapper">
		<div class="black_bar_top">
			<div class="top_nav">
				<?php 
					if(logged_in()){
						echo "<a href='mojnalog.php'><button>Moj nalog</button></a>";
						echo "<a href='korpa.php'><button>Moja korpa</button></a>";
						echo "<a href='logout.php'><button>Izloguj se</button></a>";
					}
					elseif(admin_in()){
						echo "<a href='mojnalog.php'><button>Moj nalog</button></a>";
						echo "<a href='administracija.php'><button>Administracija</button></a>";
						echo "<a href='logout.php'><button>Izloguj se</button></a>";
					}
					else{
						echo "<a href='register.php'><button>Registruj se</button></a>";
						echo "<a href='login.php'><button>Uloguj se</button></a>";
					}
				?>				
			</div> <!-- end top_nav -->

			<div class="logo">
				<a href="index.php"><img src="images/m-burger.png" alt="mburger_logo"></a>
			</div> <!-- end logo -->



			<!-- VIDECEMO DA LI NAM TREBA OVAJ MENI -->	

			<div class="menu">
			
				<ul class="menulist">
					<li><a href="index.php">POČETNA</a></li>
					<li class="dropdown"><a href="#centar">MENU</a>
						<ul class="dropdown-content">
							<?php
							$kats = mysqli_query($conn, "select * from kategorije ");

							while($kat = mysqli_fetch_assoc($kats)){
								$kat_id = $kat['kat_id'];
								$kat_naziv = $kat['kat_naziv'];
								echo "<li><a href='artikli.php?kat=$kat_id'>" .$kat_naziv . "</a><br>";
							}
							?>
						</ul>
						</li>
					<li><a href="#">KNJIGA UTISAKA</a></li> 
					<li><a href="#">GALERIJA</a></li>	
					<li><a href="#">KONTAKT</a></li>		
				</ul>
			
			</div>   <!-- end menu -->

			

		</div>

		<div class="header">
			<div class="slogan">

				<h3>SPREMITE SE ZA ZALOGAJ VAŠEG ŽIVOTA</h3>

				<p>Gladni ste? Jede vam se nešto kvalitetno i ukusno?<br>
				I to što pre? <br><br>

				Najkvalitetniji sastojci čine naša jela NEUPOREDIVIM. <br>
				Brižljivost u pripremi čini nas POSEBNIM. <br>
				Spoj ukusa čini nas NEODOLJIVIM. </p>
				
			</div>
			<div class="slider">
				<img src="images/dupli_hamburger+pomfrit.png" alt="dupli+pomfrit">
				
			</div> <!-- end slider -->
			
		</div> <!-- end header -->

	