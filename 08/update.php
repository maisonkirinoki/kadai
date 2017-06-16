<?php

//POSTされたものを取得
$id = $_POST["id"];
$book_title = $_POST["book_title"];
$book_url = $_POST["book_url"];
$kansou = $_POST["kansou"];

//DB接続
try {
  $pdo = new PDO('mysql:dbname=gs_db38;charset=utf8;host=localhost','root','');
} catch (PDOException $e) {
  exit('データベースに接続できませんでした。'.$e->getMessage());
}

//UPDATEの流れ
$stmt = $pdo->prepare("UPDATE gs_bm_table SET book_title=:book_title,book_url=:book_url,kansou=:kansou WHERE id=:id");
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$stmt->bindValue(':book_title', $book_title, PDO::PARAM_STR);
$stmt->bindValue(':book_url', $book_url, PDO::PARAM_STR);
$stmt->bindValue(':kansou', $kansou, PDO::PARAM_STR);
$status = $stmt->execute();

//UPDATE処理が失敗した場合、成功した場合
if($status==false){
	$error = $stmt->errorInfo();
	exit("ErrorQuery:".$error[2]);
}else{
	header("Location: select.php");
	exit;
}

?>