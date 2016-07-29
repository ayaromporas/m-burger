	<div class="central" id='centar'>

		<div class="main">
<?php

// upit za prikaz kategorija

$kats = mysqli_query($conn, "select * from kategorije");


echo "<table><tr>";

$kats = mysqli_query($conn, "select * from kategorije where kat_id<4");

while($kat = mysqli_fetch_assoc($kats)){
	$kat_naziv = $kat['kat_naziv'];
	$kat_foto = $kat['kat_foto'];


	echo "<td>";
	echo "<div class='kat'><a href='artikli.php?kat={$kat_naziv}'>" . $kat_naziv . "</a><br>";
	echo "<a href='artikli.php?kat={$kat_naziv}'><img src=". $kat_foto . "></a></div>";
	echo "</td>";
}

echo "</tr></table>";
echo "<div id='holder1'></div>";
echo "<table><tr>";

$kats = mysqli_query($conn, "select * from kategorije where kat_id>3 && kat_id<7");

while($kat = mysqli_fetch_assoc($kats)){
	$kat_naziv = $kat['kat_naziv'];
	$kat_foto = $kat['kat_foto'];
	

	echo "<td>";
	echo "<div class='kat'><a href='artikli.php?kat={$kat_naziv}'>" . $kat_naziv . "</a><br>";
	echo "<a href='artikli.php?kat={$kat_naziv}'><img src=". $kat_foto . "></a></div>";
	echo "</td>";
}

echo "</tr></table>";
echo "<div id='holder1'></div>";
echo "<table><tr>";

$kats = mysqli_query($conn, "select * from kategorije where kat_id>6");

while($kat = mysqli_fetch_assoc($kats)){
	$kat_naziv = $kat['kat_naziv'];
	$kat_foto = $kat['kat_foto'];


	echo "<td>";
	echo "<div class='kat'><a href='artikli.php?kat={$kat_naziv}'>" . $kat_naziv . "</a><br>";
	echo "<a href='artikli.php?kat={$kat_naziv}'><img src=". $kat_foto . "></a></div>";
	
	echo "</td>";

}

echo "</tr></table>";

?>
		</div> <!-- end main -->

		<div class='sidebar'>
		

		
		</div> <!-- end sidebar -->

	</div> <!-- end central -->


