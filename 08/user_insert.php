<?php

//入力チェック
if(
	!isset($_POST["name"]) || $_POST["name"]=="" ||
	!isset($_POST["lid"]) || $_POST["lid"]=="" ||
	!isset($_POST["lpw"]) || $_POST["lpw"]==""
){
	exit('ParamError');
}

//POSTされたものを受け取る
$name = $_POST["name"];
$lid = $_POST["lid"];
$lpw = $_POST["lpw"];

//DBに接続
try {
  $pdo = new PDO('mysql:dbname=gs_db38;charset=utf8;host=localhost','root','');
} catch (PDOException $e) {
  exit('DbConnectError:'.$e->getMessage());
}

//データ登録SQL作成
$stmt = $pdo->prepare("INSERT INTO gs_user_table(id, name, lid, lpw, kanri_flg, life_flg)
VALUES(NULL, :a1, :a2, :a3, NULL, NULL)");
$stmt->bindValue(':a1', $name);
$stmt->bindValue(':a2', $lid);
$stmt->bindValue(':a3', $lpw);
$status = $stmt->execute();

//データ登録処理後
if($status==false){
	$error = $stmt->errorInfo();
	exit("QueryError:".$error[2]);
}else{
	header("Location: index.php"); //全ての処理が終わったらindex.phpに戻す
	exit;
}

?>