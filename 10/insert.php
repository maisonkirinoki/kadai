<?php

//入力チェック
if(
	!isset($_POST["book_title"]) || $_POST["book_title"]=="" ||
	!isset($_POST["book_url"]) || $_POST["book_url"]=="" ||
	!isset($_POST["kansou"]) || $_POST["kansou"]==""
){
	exit('ParamError');
}

//POSTされたものを受け取る
$book_title = $_POST["book_title"];
$book_url   = $_POST["book_url"];
$kansou     = $_POST["kansou"];

//DBに接続
try {
  $pdo = new PDO('mysql:dbname=gs_db38;charset=utf8;host=localhost','root','');
} catch (PDOException $e) {
  exit('DbConnectError:'.$e->getMessage());
}

//データ登録SQL作成
$stmt = $pdo->prepare("INSERT INTO gs_bm_table(id, book_title, book_url, kansou, indate)
VALUES(NULL, :a1, :a2, :a3, sysdate())");
$stmt->bindValue(':a1', $book_title);
$stmt->bindValue(':a2', $book_url);
$stmt->bindValue(':a3', $kansou);
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