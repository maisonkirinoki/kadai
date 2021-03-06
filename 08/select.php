<?php

//DBに接続
try{
	$pdo = new PDO('mysql:dbname=gs_db38;charset=utf8;host=localhost','root','');
}catch(PDOException $e){
	exit('データベースに接続することができませんでした。'.$e->getMessage());
}

//指定テーブルからデータを取り出して変数に入れる
$stmt = $pdo->prepare("SELECT * FROM gs_bm_table");
$status = $stmt->execute();

//データを表示
$view="";
if($status==false){
	$error = $stmt->errorInfo();
	exit("ErrorQuery:".$error[2]);
}else{
	while($result = $stmt->fetch(PDO::FETCH_ASSOC)){
		$view .= '<p>';
		$view .= '<a href="detail.php?id='.$result["id"].'">';
		$view .= $result["book_title"]."[".$result["indate"]."]";
		$view .= '</a>';
		$view .= '　';
		$view .= '<a href="delete.php?id='.$result["id"].'">';
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
	<title>記録の蓄積を表示</title>
	<link href="css/xxx.css" rel="stylesheet">
</head>
<body>
	<h1>一覧</h1>
	<div><?=$view?></div>
	<p><a href="index.php">読書の記録を登録する</a></p>
</body>
</html>