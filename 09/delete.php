<?php

//GET
$id = $_GET["id"];

//DB接続
try {
	$pdo = new PDO('mysql:dbname=gs_db38;charset=utf8;host=localhost','root','');
} catch (PDOException $e) {
	exit('データベースに接続できませんでした。'.$e->getMessage());
}

//DELETE
$stmt = $pdo->prepare("DELETE FROM gs_bm_table WHERE id=:id");
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$status = $stmt->execute();

//DELETE失敗、成功
if($status==false){
	$error = $stmt->errorInfo();
	exit("ErrorQuery:".$error[2]);
}else{
	header("Location: select.php");
	exit;
}

?>