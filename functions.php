<?php

// fukcija za sredjivanje stringa
function sredistring($string){
    $string = str_replace("<", "", $string);
    $string = str_replace(">", "", $string);
    $string = str_replace("'", "", $string);
    $string = str_replace('"', "", $string);
    $string = str_replace("&", "", $string);
    $string = trim($string);
    $string = htmlentities($string);
    $string = filter_var($string, FILTER_SANITIZE_STRING);
    return $string;
}

//funkcija za sredjivanje adrese
function srediadresu($adresa){
    $adresa = trim($adresa);
    $adresa = htmlentities($adresa);
    return $adresa;
}

//provere statusa korisnika
function admin_in(){
    if(isset($_SESSION['status']) && $_SESSION['status'] == 3){
        return true;
    }else{
        return false;
    }
}

function logged_in(){
    if(isset($_SESSION['status']) && $_SESSION['status'] == 2){
        return true;
    }else{
        return false;
    }
}

function is_unactivated(){
    if(isset($_SESSION['status']) && $_SESSION['status'] == 1){
        return true;
    }else{
        return false;
    }
}

function is_blocked(){
    if(isset($_SESSION['status']) && $_SESSION['status'] == 0){
        return true;
    }else{
        return false;
    }
}

?>

<script>

// PETAR (funkcija za ispisivanje POP-UP prozora)--------------------------------------------------------------------------------------------------------------------
	
function zum(naziv,image,opis,cena,priloziDodatni,priloziPodrazumevani,priloziExtra,cenaPriloga){
	var productBox = '<center id="productBox"></center>';
	var productDiv = '<div id="productDiv"></div>';							//div u koji ce sve ostalo biti upisano a koji se smesta u <center id="productBox">	
	var x = '<img class="x-button" src="images/x.png" alt="x-button" onclick="exit('+"'box'"+')">';//dugme za gasenje POP-UP prozora funkcijom exit(broductBox)	
	var naslov = '<div class="productNaslov">'+naziv+'<div class="productCena">'+cena+' din.</div> </div>';	// ispisivanje naziva proizvoda i njegove cene
	var img = '<img src="'+image+'"   class="productImg"  alt=""><br>'; //ispisivanje slike proizvoda
	var form = '<br><form class="naruci" id="naruci" name="naruci"  method="post" action="korpa.php"></form>';  // forma koja ce biti smestena u <div id="product div">
	var text = '<div class="productOpis">'+opis+'</div>'  // ispisivanje opisa proizvoda	
	var artikal = '<input type="hidden" name="artikal" value="'+naziv+'">'; // hajdovan input koji sadrzi naziv proizvoda radi upisa u bazu

/*  PODRAZUMEVANI PRILOZI*/
	var podrazumevaniArray = priloziPodrazumevani.split(','); /*pretvaranje stringa u niz*/
	var i = 0;
	var podrazumevani = "";
	for (;podrazumevaniArray[i];) {   //petlja za izcitavanje niza i ispisivanje vrednosti
		podrazumevani += '<input type="checkbox" name="sastojci'+[i]+'" value="'+podrazumevaniArray[i]+'" checked>'+podrazumevaniArray[i]+'<br>';
		i++;
	}
	if(podrazumevaniArray != ""){
		var osnovniSastojci = '<div class="osnovniSastojci"><p class="p">OSNOVNI SASTOJCI:</p><br>'+podrazumevani+'<br> </div>';
	}
	else{var osnovniSastojci = "" }	
	   
	
/*   DODATNI PRILOZI  */	
	var dodatniArray = priloziDodatni.split(',');
	var i = 0;
	var dodatni = "";
	for (;dodatniArray[i];) {
		dodatni += '<input type="checkbox" name="dodatni'+[i]+'" value="'+dodatniArray[i]+'">'+dodatniArray[i]+'<br>';
		i++;
	}
	
	if(dodatniArray != ""){
		var dodaci = '<div class="dodaci"><p class="p">DODACI:</p><br>'+dodatni+'<br> </div>';     
	}
	else{var dodaci = "" }	
	
/*  EXTRA PRILOZI  */		
	var extraArray = priloziExtra.split(',');
	var cenaArray = cenaPriloga.split(',')
	var i = 0;
	var extra = "";
	var prilogCena = "";
	for (;extraArray[i];) {
		extra += '<input type="checkbox" onclick="ukupno('+cena+')" name="extradodaci'+[i]+'" value="'+extraArray[i]+','+cenaArray[i]+'">'+extraArray[i]+'<div class="dodatakCena">'+cenaArray[i]+'din.</div><br>';
			i++;
	}
	if(extraArray != ""){
		var extradodaci = '<div class="extraDodaci"><p class="p">EKSTRA DODACI:</p><br>'+extra+'<br> </div>';   
	}
	else{var extradodaci = "" }

/*    */	
	var cenaUkupna = '<input type="hidden" id="cenaUkupno" name="cena" value="'+cena+'">'; // hajdovan input koji sadrzi ukupnu cenu proizvoda radi upisa u bazu
	var submit = '<input type="submit" class="submit" name="korpa" value="KORPA"> ';
	var ukupno = '<div id="ukupno">Cena: '+cena+'din. </div>';
	
	$( "#box" ).html(productBox);
	$( "center#productBox" ).html(productDiv);
	$( "#productDiv" ).html(x+naslov+img+form+text);
	$( "form#naruci" ).html(artikal+osnovniSastojci+dodaci+extradodaci+ukupno+cenaUkupna+submit);
}

	function ukupno(cena) {
		var sve = document.forms[0];
		var txt=cena;
		var i;
		for (i = 0; i < sve.length; i++) {   // petlja za sabiranje ukupne vrednosti porudzbine
			if (sve[i].checked) {
				var pr=sve[i].value;
				var pri = pr.split(',')[1];
				var pril=Number(pri);				
				if(isNaN(pril)){
					pril=0;
				}
				txt=Number(txt);
				txt = txt + pril;
			}
		}
		$( "#ukupno" ).html('Cena: '+txt+'din.'); // upisuje u tag koji ima id="ukupno" tekst "Cena: (ukupna suma) din."
		$( "#cenaUkupno" ).val(txt);  //upisuje u tag koji ima id="cenaUkupno" vrednost value="(ukupnu sumu)" (ukupnu sumu)
	}
	
	function visible(id){
		$( "#"+id ).css("visibility","visible");
	}
	
	function exit(id){
		$( "#"+id ).html("");
	}
// END PETAR-------------------------------------------------------------------------------------------------------------------------	

</script>