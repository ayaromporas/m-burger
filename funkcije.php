<?php
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
function getKorisnik($id){
function getNarudzbineArray($narudzbine){
function getPriloziArray($prilozi){
function btnStatus($status){
function getArtikal($id){
function getPrilog($id){
/*$sel = (count(getNarudzbineArray($korpa->narudzbine)))>1?"[0]":"";*/