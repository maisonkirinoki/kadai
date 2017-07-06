<?php

session_start();

//functionファイル読み込み
include("functions.php");

//DB接続
$pdo = db_connect();

//SQLを実行してテーブルから抜き出す
$stmt = $pdo->prepare("SELECT * FROM gs_user_table WHERE lid=:lid AND lpw=:lpw AND life_flg=0");
$stmt->bindValue(':lid', $_POST["lid"]);
$stmt->bindValue(':lpw', $_POST["lpw"]);
$res = $stmt->execute();

//SQL実行時にエラーが発生した場合
if($res==false){
	queryError($stmt);
}

//1レコードだけ取得する方法
$val = $stmt->fetch();

//該当レコードがあればSESSIONに値を代入
if( $val["id"] != "" ){
	$_SESSION["chk_ssid"]  = session_id();
	$_SESSION["kanri_flg"] = $val['kanri_flg'];
	$_SESSION["name"]      = $val['name'];
	header("Location: select.php");
}else{
	header("Location: login.php");
}

exit();

?>