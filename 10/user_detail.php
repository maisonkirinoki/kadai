<?php

session_start();
include("functions.php");
sessChk();

//GETでidの値を取得
$id = $_GET["id"];

//DB接続
$pdo = db_connect();

//指定のテーブルからデータを取得
$stmt = $pdo->prepare("SELECT * FROM gs_user_table WHERE id=:id");
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$status = $stmt->execute();

//データ表示
$view="";
if($status==false){
	$error = $stmt->errorInfo();
	exit("ErrorQuery:".$error[2]);
}else{
	$row = $stmt->fetch();
}

?>

<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<title>会員情報変更</title>
	<link href="css/xxx.css" rel="stylesheet">
</head>
<body>
	<h1>会員情報変更</h1>
	<form method="post" action="user_update.php">
		<input type="hidden" name="id" value="<?=$id?>">
		<fieldset>
			<legend>会員情報を変更することができます。</legend>
			<label>名前：<input type="text" name="name" value="<?=$row["name"]?>"></label><br>
			<label>ID：<input type="text" name="lid" value="<?=$row["lid"]?>"></label><br>
			<label>パスワード：<input type="text" name="lpw" value="<?=$row["lpw"]?>"></label>
			<input type="submit" value="更新！">
		</fieldset>
	</form>
	<p><a href="user_select.php">会員一覧に戻る</a></p>
</body>
</html>