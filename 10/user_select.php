<?php

session_start();
include("functions.php");
sessChk();

//DBに接続
$pdo = db_connect();

//指定テーブルからデータを取り出して変数に入れる
$stmt = $pdo->prepare("SELECT * FROM gs_user_table");
$status = $stmt->execute();

//データを表示
$view="";
if($status==false){
	$error = $stmt->errorInfo();
	exit("ErrorQuery:".$error[2]);
}else{
	while($result = $stmt->fetch(PDO::FETCH_ASSOC)){
		$view .= '<p>';
		$view .= '<a href="user_detail.php?id='.$result["id"].'">';
		$view .= $result["name"]."[".$result["lid"]."　".$result["lpw"]."]";
		$view .= '</a>';
		$view .= '　';
		$view .= '<a href="user_delete.php?id='.$result["id"].'">';
		$view .= '[削除]';
		$view .= '</a>';
		$view .= '</p>';
	}
}

?>

<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<title>会員一覧</title>
	<link href="css/xxx.css" rel="stylesheet">
</head>
<body>
	<h1>会員一覧</h1>
	<div><?=$view?></div>
	<p><a href="index.php">登録ページに戻る</a></p>
</body>
</html>