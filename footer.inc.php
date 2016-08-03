	<div class="footer">
		<table>
			<tr class="bottom1">
				<td><h3>INFORMACIJE</h3></td>
				<td><h3>NALOG</h3></td>
				<td><h3>KONTAKT</h3></td>
			</tr>
			<tr class="bottom2">
				<td>
										
					<ul>
						<a href='#'><li>O nama</li></a>
						<a href='#'><li>Uslovi poručivanja</li></a>
						<a href='#'><li>Informacije o dostavi</li></a>
						<a href='#'><li>Knjiga utisaka</li></a>
						<a href='#'><li>Uslovi reklamacije</li></a>
					</ul>
							
				</td>
				<td>			
			
					<ul>

<?php				

	if(logged_in()){

		echo "<a href='korpa.php'><li>Moja korpa</li></a>";
		echo "<a href='mojnalog.php'><li>Moj nalog</li></a>";
		echo "<a href='#'><li>Istorija porudžbina</li></a>";
		echo "<a href='#'><li>Posalji poruku</li></a>";
		echo "<a href='logout.php'><li>Izloguj se</li></a>";

	}elseif(admin_in()){

		echo "<a href='administracija.php'><li>Administrativni panel</li></a>";
		echo "<a href='mojnalog.php'><li>Moj nalog</li></a>";
		echo "<a href='#'><li>Pregledaj poruke</li></a>";
		echo "<a href='#'><li>Statistika</li></a>";
		echo "<a href='logout.php'><li>Izloguj se</li></a>";

	}else{

		echo "<a href='register.php'><li>Registruj se</li></a>";
		echo "<a href='login.php'><li>Uloguj se</li></a>";
		echo "<a href='#'><li>Cenovnik</li></a>";
		echo "<a href='#'><li>Galerija</li></a>";
		echo "<a href='#'><li>Kontakt</li></a>";
	}	
						

?>						
					</ul>
							
				</td>
				<td>			
					<ul>
						<a href='#'><li>069 799 140</li></a>
						<a href='#'><li>info@m-burger.rs</li></a>
						<a href='#'><li>Rumenačka 25, Novi Sad</li></a>
						<a href='#'><li>Mapa-Kako do nas</li></a>
						<a href='https://www.facebook.com/M-Burger-940519562656968'><li>M-burger na Facebooku</li></a>
					</ul>
							
				</td>			
			</tr>
		</table>


		<div class="copyrights">
			<p>Copyrights &copy; Kolezeee 2016. Sva prava zadržana.</p>
		</div> <!--end bottom-->	

		
	</div> <!-- end footer -->




</div> <!-- end wrapper -->
</body>
</html>