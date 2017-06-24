<?php

include("functions.php");

//GET
$id = $_GET["id"];

//DB接続
$pdo = db_connect();

//DELETE
$stmt = $pdo->prepare("DELETE FROM gs_user_table WHERE id=:id");
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$status = $stmt->execute();

//DELETE失敗、成功
if($status==false){
	$error = $stmt->errorInfo();
	exit("ErrorQuery:".$error[2]);
}else{
	header("Location: user_select.php");
	exit;
}

?>