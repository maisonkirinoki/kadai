<?php

//DB接続
function db_connect(){
	try{
		$pdo = new PDO('mysql:dbname=gs_db38;charset=utf8;host=localhost','root','');
	}
	catch(PDOException $e){
		exit('データベースに接続することができませんでした。'.$e->getMessage());
	}
	return $pdo;
}

//セッションチェック
function sessChk(){
	if(!isset($_SESSION["chk_ssid"]) || $_SESSION["chk_ssid"] != session_id()){
		echo "Login Error.";
		exit;
	}
}









?>