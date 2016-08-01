<?php$danas = date("Y-m-d");
function getNarudzbina($id){
	GLOBAL $conn;
	try{
		$stmt = $conn->query("SELECT * FROM narudzbine WHERE id_narudzbina = $id");
	} catch (PDOException $e) {
		print "Greška: " . $e->getMessage() . "<br/>";
		die();
	}
	return $res = $stmt->fetchAll(PDO::FETCH_OBJ);
}
function getKorpeToday($danas){
	GLOBAL $conn;
	try{
		$stmt = $conn->query("SELECT * FROM korpe WHERE vreme LIKE '$danas%'"); 
	} catch (PDOException $e) {
		print "Greška: " . $e->getMessage() . "<br/>";
		die();
	}
	return $res = $stmt->fetchAll(PDO::FETCH_OBJ);
}
function getKorisnik($id){	GLOBAL $conn;	try{		$stmt = $conn->query("SELECT * FROM korisnici WHERE korisnik_id = $id"); 	} catch (PDOException $e) {		print "Greška: " . $e->getMessage() . "<br/>";		die();	}	return $res = $stmt->fetchAll(PDO::FETCH_OBJ);}
function getNarudzbineArray($narudzbine){	if(strpos($narudzbine,",")) {		$narudzbina = explode(",",$narudzbine);	} else {		$narudzbina[] = $narudzbine;	}	return $narudzbina;}
function getPriloziArray($prilozi){	if(strpos($prilozi,",")) {		$prilog = explode(",",$prilozi);	} else {		$prilog[] = $prilozi;	}	return $prilog;}
function btnStatus($status){	if($status==1){		return "btn-warning";	} elseif($status==2) {		return "btn-success";	} elseif($status==3) {		return "btn-danger";	}}
function getArtikal($id){	GLOBAL $conn;	try{		$stmt = $conn->query("SELECT * FROM artikli WHERE artikal_id = '$id'"); 	} catch (PDOException $e) {		print "Greška: " . $e->getMessage() . "<br/>";		die();	}	return $res = $stmt->fetchAll(PDO::FETCH_OBJ);}
function getPrilog($id){	GLOBAL $conn;	try{		$stmt = $conn->query("SELECT * FROM prilozi WHERE prilog_id = '$id'"); 	} catch (PDOException $e) {		print "Greška: " . $e->getMessage() . "<br/>";		die();	}	return $res = $stmt->fetchAll(PDO::FETCH_OBJ);}
/*$sel = (count(getNarudzbineArray($korpa->narudzbine)))>1?"[0]":"";*/